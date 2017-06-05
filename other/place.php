<?php

session_start();
if ($_SESSION['admin']!='admin') {
    header("Location: admin.php");
}?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin</title>
</head>
<body>
<form action="<?=$_SERVER['PHP_SELF']?>" method="POST">
    <h4>Добавить место</h4>
    <input name="region" placeholder="Область" type="text"><br>
    <input name="locality" placeholder="Населенный пункт" type="text"><br>
    <input name="school" placeholder="Учебное заведение" type="text"><br>
    <textarea name="comment" placeholder="Коментарий"></textarea><br>
    <input name="contact_person" placeholder="Контактное лицо" type="text"><br>
    <input type="submit" name="submit" value="Добавить">
</form>
</body>
</html>

<?php
    if (isset($_POST['submit'])) {
        $place = array($_POST['region'], $_POST['locality'], $_POST['school'], $_POST['comment'], $_POST['contact_person']);
        require_once 'database.php';
        $db = database::get_instance();
        $pg_con = $db->get_connection();
        pg_prepare($pg_con, "add_place", 'INSERT INTO myschema.places(region, locality, school, date, comment, contact_person) VALUES ($1, $2, $3, now(), $4, $5) RETURNING id_place');
        $id_place = pg_fetch_row(pg_execute($pg_con, "add_place", $place));
        echo $id_place[0];
    }

