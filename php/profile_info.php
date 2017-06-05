<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 05.06.2017
 * Time: 17:48
 */
if (!isset($_SESSION))session_start();
if (!$_SESSION['user']) {
    header("Location: auth.php");
    exit();
}
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = json_encode($_SESSION['user'], JSON_UNESCAPED_UNICODE);
    echo $user;
}