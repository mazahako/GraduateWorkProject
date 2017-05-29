<?php

require_once 'database.php';
if (isset($_POST['submit'])) {
    $social_type = $_POST['social_type'];
    $school = $_POST['school'];
    $db = database::get_instance();
    $pg_con = $db->get_connection();
//test


}
