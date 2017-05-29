<?php

if (!isset($_SESSION))session_start();
function autoload($class) {
    require_once('../'.strtolower($class).".php");
}
spl_autoload_register('autoload');


$app_id = '5883776';
$secure_key = 'LyQLATLlYVfYjfqkKgaW';
$url = 'http://localhost/GraduateWork/API/vk.php';
if (isset($_GET['code'])) {

    $params = array(
        'client_id' => $app_id,
        'client_secret' => $secure_key,
        'redirect_uri' => $url,
        'code' => $_GET['code']
    );
    $token = json_decode(file_get_contents('https://oauth.vk.com/access_token' . '?' . urldecode(http_build_query($params))), true);

    if (isset($token['access_token'])) {
        $params = array(
            'uids'         => $token['user_id'],
            'fields'       => 'uid,verified,first_name,last_name,city,country,home_town,education,schools,screen_name,sex,bdate,photo_50',
            'access_token' => $token['access_token']
        );

        $json_vk = file_get_contents('https://api.vk.com/method/users.get' . '?' . urldecode(http_build_query($params)));
        $userInfo = json_decode($json_vk, true);

        if (isset($userInfo['response'][0]['uid'])) {
            $userInfo = $userInfo['response'][0];
            $result = true;
            $db = database::get_instance();
            $pg_con = $db->get_connection();
            $user_social_id = $userInfo['uid'].'';

            $result = pg_query($pg_con, "SELECT id_user FROM myschema.users WHERE social_id='$user_social_id'");
            $query = new query($pg_con);
            if (!pg_fetch_row($result)) {
                $query->add_user($userInfo['uid'], $userInfo['first_name'], $userInfo['last_name'], $json_vk);
            }
                $result = pg_query($pg_con, "SELECT id_user FROM myschema.users WHERE social_id='$user_social_id'");
                $query->add_record(pg_fetch_row($result)[0]);
        }
        if ($result) {
            $_SESSION['user'] = $userInfo;
            header('Location: ../index.php');
        }
    }
}






