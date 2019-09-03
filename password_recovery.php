<?php
    session_start();
    require_once('engine.php');
?>

<!DOCTYPE html>
<html lang="ru">
    <head>
        <title>Wikicountries | Восстановление пароля</title>
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
            <h1>Восстановление пароля</h1> <hr>
            <form action="engine.recovery.php" method="post">
                <h3>Почта</h3>
                <input name="email" type="text" placeholder="Ваш E-mail">
                <h3>Контрольный вопрос</h3>
                <input name="answer" type="text" placeholder="Вопрос: Ответ"> <br> <br>
                <input name="submit" type="submit" class="submit" value="Восстановить">
            </form>
        </div>
    </body>
</html>