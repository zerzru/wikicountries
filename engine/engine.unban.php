<?php
    session_start();
    require_once('engine.php');

    if(isset($_POST['submit'])) {
        global $bannedTableName, $protocol, $projectLink;
        $date = date('d.m.Y H:i:s');
        $settings = parse_ini_file('config.ini');
        $urequest = $_POST['unbantext'];
        $name = $_POST['user'];
        $ip = getUserIP();
        $request = mysql_query("INSERT INTO $bannedTableName(login, ip, text, date, status) VALUES('{$name}', '{$ip}', '{$urequest}', '{$date}', 'Не рассмотрен');");
        $afterrequest = mysql_query("SELECT * FROM $bannedTableName WHERE login='$name'");
        $row = mysql_fetch_assoc($afterrequest);
        echo "Ваш запрос был успешно отправлен. Ваш уникальный ID запроса: {$row['id']}. Вы можете проверять статус дела на <a href='{$protocol}{$projectLink}check_status?id={$row['id']}'>этой</a> странице. <a href='{$protocol}{$projectLink}'>Вернуться на главную страницу</a>";
    }
?>