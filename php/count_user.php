<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 04.06.2017
 * Time: 14:44
 */
function autoload($class) {
    require_once("../db/".strtolower($class).".php");
}
spl_autoload_register('autoload');

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $db = database::get_instance();
    $pg_con = $db->get_connection();
    $count = pg_query($pg_con, "SELECT count(*) FROM myschema.users");
    $count = pg_fetch_row($count)[0];
    echo json_encode(array("count" => $count));
}