<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 04.06.2017
 * Time: 15:21
 */
function autoload($class) {
    require_once("../".strtolower($class).".php");
}
spl_autoload_register('autoload');

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $json = file_get_contents("php://input");

    $page = $json;
    $max = $page*20;
    $min = $max-20;
    $db = database::get_instance();
    $pg_con = $db->get_connection();
    pg_prepare($pg_con, "page", 'SELECT (id_user, firstname, surname) FROM myschema.users WHERE id_user >= $1 AND id_user <= $2');
    $result = pg_execute($pg_con, "page", array($min, $max));
    $result = json_encode(pg_fetch_all($result), JSON_UNESCAPED_UNICODE);
    echo $result;
}