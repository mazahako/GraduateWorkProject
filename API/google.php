<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 17.05.2017
 * Time: 17:48
 */
if (!isset($_SESSION))session_start();
function autoload($class) {
    require_once("../db/".strtolower($class).".php");
}
spl_autoload_register('autoload');

$client_id = "826057968516-cikh39okvmei2hojokpaciv2lcm16oop.apps.googleusercontent.com";
$client_secret = "4PvUhrjH7xiChj-RDmqztSFL";
$redirect_uri = "http://localhost/GraduateWork/API/google.php";

if (isset($_GET['code'])) {
    $result = false;

    $params = array(
        'client_id'     => $client_id,
        'client_secret' => $client_secret,
        'redirect_uri'  => $redirect_uri,
        'grant_type'    => 'authorization_code',
        'code'          => $_GET['code']
    );

    $url = 'https://accounts.google.com/o/oauth2/token';
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, urldecode(http_build_query($params)));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    $result = curl_exec($curl);
    curl_close($curl);
    $tokenInfo = json_decode($result, true);

    if (isset($tokenInfo['access_token'])) {
        $params['access_token'] = $tokenInfo['access_token'];
        $json_google = file_get_contents('https://www.googleapis.com/oauth2/v1/userinfo' . '?' . urldecode(http_build_query($params)));
        $userInfo = json_decode($json_google, true);
        if (isset($userInfo['id'])) {
            $userInfo = $userInfo;
            $result = true;

            $db = database::get_instance();
            $pg_con = $db->get_connection();
            $user_social_id = $userInfo['id'].'';

            $result = pg_query($pg_con, "SELECT id_user FROM myschema.users WHERE social_id='$user_social_id'");
            $query = new query($pg_con);
            if (!pg_fetch_row($result)) {
                $query->add_user($userInfo['id'], $userInfo['given_name'], $userInfo['family_name'], $json_google, $userInfo['email'], 'google');
            }
            $result = pg_query($pg_con, "SELECT id_user FROM myschema.users WHERE social_id='$user_social_id'");
            $id_user = pg_fetch_row($result)[0];
            $query->add_record($id_user);

            foreach ($userInfo as $key=>$value) {
                echo $key."->".$value."<br>";
            }
        }

    }
    if ($result) {
        $_SESSION['user'] = $userInfo;
        $_SESSION['id_user'] = $id_user;
        header('Location: ../index.php');
    }
}





