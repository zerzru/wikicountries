<?php
    session_start();
    require_once('engine.php');

    if(isset($_POST['submit'])) {
        global $protocol, $projectLink;
        $uemail = $_POST['email'];
        $uanswer = $_POST['answer'];

        $request = mysql_query("SELECT * FROM users WHERE email = '$uemail'");
        $row = mysql_fetch_assoc($request);
        if($uanswer == $row['cquestion']) {
            $password = '123';
            $password = $password.'ahsfdklasjfeshforjeip';
            $password = md5($password);
            $password = sha1($password);
            $password = md5($password);
            $password = sha1($password);
            $request2 = mysql_query("UPDATE users SET password='$password' WHERE email='$uemail'");
            echo "Пароль успешно изменён. Ваш временный пароль: 123. Чтобы изменить пароль, войдите в свой аккаунт, используя следующие данные: имя пользователя - <strong>{$row['login']}</strong> и пароль - <strong>123</strong>. Затем, перейдите в настройки и заполните форму <strong>Пароль</strong>";
        } else {
            echo "Ответ не совпадает с вопросом или указана неверная почта";
        }
    }
?>