<?php
    session_start();
    require_once('engine.php');
?>
<!DOCTYPE html>
<html lang="ru">
    <head>
        <title>Wikicountries | Авторы</title>
        <link rel="stylesheet" type="text/css" href="https://wikicountries.000webhostapp.com/lib/scripts/style.css">
        <link rel="icon" type="image/x-icon" href="https://wikicountries.000webhostapp.com/lib/lib/images/icon.jpg">
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
            <span class="aname">Авторы</span> <br> <br> <br><hr style="margin-top:30px">
            <ul>
                <li>Елисей "ZerZru" Шаров - создатель дизайна, работы сайта, движка и тестировщик</li>
                <li>TrakounetFox - тестировщик</li>
            </ul> <br>
            Вы можете помочь проекту и появиться на этой странице, написав на одну из следующих почт:
            <ul>
                <li><a href="mailto:elisei.sharow@yandex.ru">elisei.sharow@yandex.ru</a></li>
                <li><a href="mailto:playofstiverz@gmail.com">playofstiverz@gmail.com</a></li>
            </ul>
        </div>
    </body>
</html>