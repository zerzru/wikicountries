<?php
    session_start();
    require_once('engine.php');

    if(isset($_POST['submit'])) {
        global $usersTableName, $mainFileLink, $protocol;
        $login = $_POST['login'];
        $password = $_POST['password'];

        $login = stripslashes($login);
        $login = htmlspecialchars($login);
        $login = trim($login);

        $password = trim($password);
        $password = stripslashes($password);
        $password = htmlspecialchars($password);
        $password = $password.'ahsfdklasjfeshforjeip';
        $password = md5($password);
        $password = sha1($password);
        $password = md5($password);
        $password = sha1($password);
        
        $request = mysql_query("SELECT * FROM $usersTableName WHERE login='{$login}'");
        $row = mysql_fetch_array($request);

        if(empty($row['password'])) {
            exit("Пользователь с именем <strong>{$login}</strong> не существует");
        } else {
            if($row['password']==$password) {
                $_SESSION['login'] = $row['login'];
                $_SESSION['id'] = $row['id'];
                header("Location: {$protocol}{$mainFileLink}");
            } else {
                exit('Логин или пароль не совпадают');
            }
        }
    }
?>