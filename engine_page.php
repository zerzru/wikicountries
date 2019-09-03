<?php
    session_start();
    require_once('engine.php');
?>
<!DOCTYPE html>
<html lang="ru">
    <head>
        <title>Wikicountries | Движок</title>
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
            <span class="aname">Движок</span> <br> <br> <br><hr style="margin-top:30px">
            Скоро здесь появится информация о движке, на котором написан проект Wikicountries, а также инструкция о том, как его использовать для своего сайта
        </div>
    </body>
</html>