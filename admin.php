<!DOCTYPE html>
<html>
<head>
    <title>Admin</title>
</head>
<body>
<form action="<?=$_SERVER['PHP_SELF']?>" method="POST">
    <h4>Войти в кабинет</h4>
    <input name="login" placeholder="login" type="text"><br>
    <input name="password" placeholder="password" type="password"><br>
    <input type="submit" name="submit" value="Войти">
</form>
</body>
</html>
<?php

function autoload($class) {
    require_once(strtolower($class).".php");
}
spl_autoload_register('autoload');

if (isset($_POST['submit'])) {
    $login = $_POST['login'];
    $password = $_POST['password'];
    if($login=='admin' && $password=='admin') {
        echo "Вы успешно атворизованы"."<br>";
        session_start();
        $_SESSION['admin']='admin';
        header('Location: place.php');
    } else echo "Такого пользователя не существет, повторите попытку";
}