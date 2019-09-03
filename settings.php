<?php
    session_start();
    require_once('engine.php');
    if(empty($_SESSION['login'])) {
        header("Location: index");
    }
?>

<!DOCTYPE html>
<html lang="ru">
    <head>
        <title>Wikicountries | Настройки</title>
        <?php
            show_head_html();
        ?>
    </head>
    <body>
        <header class="top">
            <?php
                check_user_status();
                show_account_name();
                show_account_links();
            ?>
        </header> <br>
        <?php show_menu(); ?>
        <div class="created_article">
            <h1>Настройки</h1> <hr>
            <?php
                get_user_info();
            ?>
        </div>
    </body>
</html>