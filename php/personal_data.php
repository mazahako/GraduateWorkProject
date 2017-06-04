<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 04.06.2017
 * Time: 21:48
 */
function autoload($class) {
    require_once("../".strtolower($class).".php");
}
spl_autoload_register('autoload');

$result = json_encode(pg_fetch_object($result), JSON_UNESCAPED_UNICODE);
echo $result;
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_user = file_get_contents("php://input");
    $db = database::get_instance();
    $pg_con = $db->get_connection();
    pg_prepare($pg_con, "personal_data", 'SELECT * FROM myschema.users WHERE id_user = $1;');
    $result = pg_execute($pg_con, "personal_data", array($id_user));
    $result = json_encode(pg_fetch_object($result), JSON_UNESCAPED_UNICODE);
    echo $result;
}