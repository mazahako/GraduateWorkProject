<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 04.06.2017
 * Time: 16:17
 */
function autoload($class) {
    require_once("../".strtolower($class).".php");
}
spl_autoload_register('autoload');

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $json = file_get_contents("php://input");
    //$json = '{"id_user": 1}';
    $id_user = json_decode($json, true);
    $id_user = $id_user["id_user"];
    $db = database::get_instance();
    $pg_con = $db->get_connection();
    pg_prepare($pg_con, "about_user", 'SELECT result FROM myschema.user_activity WHERE id_user = $1;');
    $result = pg_execute($pg_con, "about_user", array($id_user));
    $result = json_encode(pg_fetch_all($result), JSON_UNESCAPED_UNICODE);
    echo $result;
}