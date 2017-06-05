<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 28.05.2017
 * Time: 17:34
 */
if (!isset($_SESSION))session_start();
function autoload($class) {
    require_once("../db/".strtolower($class).".php");
}
spl_autoload_register('autoload');

$client_id = '176216536202399'; // Client ID
$client_secret = 'b4df154120290969e3c23a2f3253f6e6'; // Client secret
$redirect_uri = 'http://localhost/GraduateWork/API/facebook.php'; // Redirect URIs

$url = 'https://www.facebook.com/v2.9/dialog/oauth';
if (isset($_GET['code'])) {
    $result = false;

    $params = array(
        'client_id'     => $client_id,
        'redirect_uri'  => $redirect_uri,
        'client_secret' => $client_secret,
        'code'          => $_GET['code']
    );

    $url = 'https://graph.facebook.com/v2.9/oauth/access_token';

    $tokenInfo = null;
    $tokenInfo = json_decode(file_get_contents($url . '?' . http_build_query($params)), true);

    if (count($tokenInfo) > 0 && isset($tokenInfo['access_token'])) {
        $params = array(
            'fields' => 'id,name,first_name,last_name,email,birthday,devices,education', //https://developers.facebook.com/docs/graph-api/reference/v2.3/user
            'access_token' => $tokenInfo['access_token']
        );
        $url = 'https://graph.facebook.com/v2.9/me?';;
        $json_fb = file_get_contents($url.urldecode(http_build_query($params)));
        $userInfo=json_decode($json_fb,true);

        $db = database::get_instance();
        $pg_con = $db->get_connection();
        $user_social_id = $userInfo['id'].'';


        $result = pg_query($pg_con, "SELECT id_user FROM myschema.users WHERE social_id='$user_social_id'");
        $query = new query($pg_con);
        if (!pg_fetch_row($result)) {
            $query->add_user($userInfo['id'], $userInfo['first_name'], $userInfo['last_name'], $json_fb, $userInfo['email'], 'fb');
        }

        $result = pg_query($pg_con, "SELECT id_user FROM myschema.users WHERE social_id='$user_social_id'");
        $id_user = pg_fetch_row($result)[0];
        $query->add_record($id_user);
        if (isset($userInfo['id'])) {
            $userInfo = $userInfo;
            $result = true;
        }
    }

    if ($result) {
        $_SESSION['user'] = $userInfo;
        $_SESSION['id_user'] = $id_user;
        header('Location: ../index.php');
    }
}