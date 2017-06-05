<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 04.06.2017
 * Time: 16:17
 */
function autoload($class) {
    require_once("../db/".strtolower($class).".php");
}
spl_autoload_register('autoload');

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $json = file_get_contents("php://input");
    $id_user = $json;
    $db = database::get_instance();
    $pg_con = $db->get_connection();
    pg_prepare($pg_con, "about_user", 'SELECT * FROM myschema.user_activity WHERE id_user = $1;');
    $result = pg_execute($pg_con, "about_user", array($id_user));
    $array = [];
    while ($data = pg_fetch_object($result)) {
        $array[] = $data;
    }
    $result = json_encode($array, JSON_UNESCAPED_UNICODE);
    echo $result;
}