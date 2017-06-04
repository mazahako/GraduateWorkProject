<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 28.05.2017
 * Time: 18:20
 */
if (!isset($_SESSION))session_start();
function autoload($class) {
    require_once('../'.strtolower($class).".php");
}
spl_autoload_register('autoload');

$client_id = '1249921792'; // Application ID
$public_key = 'CBAMEBILEBABABABA'; // Публичный ключ приложения
$client_secret = '73BFE05637B1C8A88659B3D7'; // Секретный ключ приложения
$redirect_uri = 'http://localhost/GraduateWork/API/ok.php'; // Ссылка на приложение

if (isset($_GET['code'])) {

    $params = array(
        'code' => $_GET['code'],
        'redirect_uri' => $redirect_uri,
        'grant_type' => 'authorization_code',
        'client_id' => $client_id,
        'client_secret' => $client_secret
    );

    $url = 'http://api.odnoklassniki.ru/oauth/token.do';

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url); // url, куда будет отправлен запрос
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, urldecode(http_build_query($params))); // передаём параметры
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    $result = curl_exec($curl);
    curl_close($curl);

    $tokenInfo = json_decode($result, true);
}


if (isset($tokenInfo['access_token']) && isset($public_key)) {
    $sign = md5("application_key={$public_key}format=jsonmethod=users.getCurrentUser" . md5("{$tokenInfo['access_token']}{$client_secret}"));

    $params = array(
        'method'          => 'users.getCurrentUser',
        'access_token'    => $tokenInfo['access_token'],
        'application_key' => $public_key,
        'format'          => 'json',
        'sig'             => $sign
    );
    $json_ok = file_get_contents('http://api.odnoklassniki.ru/fb.do' . '?' . urldecode(http_build_query($params)));
    $userInfo = json_decode($json_ok, true);

    $db = database::get_instance();
    $pg_con = $db->get_connection();
    $user_social_id = $userInfo['uid'].'';


    $result = pg_query($pg_con, "SELECT id_user FROM myschema.users WHERE social_id='$user_social_id'");
    $query = new query($pg_con);
    if (!pg_fetch_row($result)) {
        $query->add_user($userInfo['uid'], $userInfo['first_name'], $userInfo['last_name'], $json_ok);
    }

    $result = pg_query($pg_con, "SELECT id_user FROM myschema.users WHERE social_id='$user_social_id'");
    $id_user = pg_fetch_row($result)[0];
    $query->add_record($id_user);
    if (isset($userInfo['uid'])) {
        $result = true;
    }
    if ($result) {
        $_SESSION['user'] = $userInfo;
        $_SESSION['id_user'] = $id_user;
        header('Location: ../index.php');
    }
}