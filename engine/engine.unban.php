<?php
    session_start();
    require_once('engine.php');

    function show_result() {
        global $bannedTableName, $protocol, $projectLink, $link;

        if(isset($_POST['submit'])) {
            $date = date('d.m.Y H:i:s');
            $settings = parse_ini_file('config.ini');
            $urequest = $_POST['unbantext'];
            $name = $_POST['user'];
            $ip = getUserIP();
            $request = mysqli_query($link, "INSERT INTO $bannedTableName(login, ip, text, date, status) VALUES('{$name}', '{$ip}', '{$urequest}', '{$date}', 'Не рассмотрен');");
            $afterrequest = mysqli_query($link, "SELECT * FROM $bannedTableName WHERE login='$name'");
            $row = mysqli_fetch_assoc($afterrequest);

            echo "Ваш запрос был успешно отправлен. Ваш уникальный ID запроса: {$row['id']}. Вы можете проверять статус дела на <a href='{$protocol}{$projectLink}check_status?id={$row['id']}'>этой</a> странице. <a href='{$protocol}{$projectLink}'>Вернуться на главную страницу</a>";
        }
    }
?>

<!DOCTYPE html>
<html lang="ru">
    <head>
        <title>Wikicountries | Проверить статус дела</title>
        <?php
            show_head_html();
        ?>
    </head>
    <body>
        <?php show_menu(); ?>
        <header class="top">
            <?php
                check_user_status();
                show_account_name();
                show_account_links();
            ?>
        </header> <br>
        <div class="created_article">
            <span class="aname">Отправить запрос на разблокировку</span> <br> <br> <br> <br> <br> <br>
            <?php show_result() ?>
        </div>
    </body>
</html>