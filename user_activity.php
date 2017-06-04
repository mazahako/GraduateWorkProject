<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 04.06.2017
 * Time: 10:13
 */
if (!isset($_SESSION))session_start();
if (!$_SESSION['id_user']) {
    header("Location: auth.php");
    exit();
}

require_once 'database.php';
require_once 'query.php';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = file_get_contents("php://input");
    $id_user = $_SESSION['id_user'];
    //echo $data;
    $db = database::get_instance();
    $pg_con = $db->get_connection();
    $query = new query($pg_con);
    $query->add_record($id_user, $data);
}