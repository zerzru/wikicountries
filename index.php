<?php
    session_start();
    require_once('engine.php');
?>
<!DOCTYPE html>
<html lang="ru">
    <head>
        <title>Wikicountries | Главная страница</title>
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
            <div class="welcome">
                <h1>Добро пожаловать в <span>Wikicountries</span>! <br> Свободная энциклопедия для публикации информации о странах(в том числе выдуманных) на русском языке</h1>
            </div>
            <div class="main_articles">
                <p>Избранные статьи</p>
                <ul>
                <?php
                    show_articles('favourite');
                ?>
                </ul>
            </div>
            <div class="main_articles">
                <p>Хорошие статьи</p>
                <ul>
                <?php
                    show_articles('good');
                ?>
                </ul>
            </div>
            <div class="main_articles">
                <p>Новые статьи</p>
                <ul>
                <?php
                    show_articles('new');
                ?>
                </ul>
            </div>
            <div class="main_articles">
                <p>Будущие статьи</p>
                <ul>
                <?php
                    show_articles('future');
                ?>
                </ul>
            </div>
            <footer>
                <?php
                    global $notice;
                    echo $notice;
                ?>
            </footer>
        </div>
    </body>
    <script src="http://localhost/wiki/lib/scripts/main.js"></script>
</html>