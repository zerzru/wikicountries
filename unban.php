<?php
    session_start();
    require_once('engine.php');
    $username = $_GET['user'];
    $ip = getUserIP();
?>

<!DOCTYPE html>
<html lang="ru">
    <head>
        <title>Wikicountries | Зарос на разблокировку</title>
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
            <h1>Запрос на разблокировку пользователя <?php echo $_SESSION['login']; ?></h1> <hr>
            Почему мы должны Вас разблокировать? Если от вашего IP кто-то совершил вандализм(и это были не вы), <br> то укажите, какой конкретный IP и ник был забанен <br> <br>
            <form action="engine.unban.php" method="post">
            <textarea name="unbantext" class="article_i">Сообщение администратору, почему вас должны разблокировать(сотрите этот текст)</textarea> <br>
                <input name="user" type="text" value="<?php echo $username; ?>" style="display:none;">
                <input name="ip" type="text" value="<?php echo $ip; ?>" style="display:none;">
                <input name="submit" type="submit">
            </form>
        </div>
    </body>
</html>