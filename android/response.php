<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 04.06.2017
 * Time: 19:23
 */
if (!isset($_SESSION))session_start();
//if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_user = $_SESSION['id_user'];
    $id_place = $_SESSION['id_place'];
    echo json_encode(array("id_user" => $id_user, "id_place" => $id_place));
//}