<?php
    session_start();
    require_once('engine.php');

    if(isset($_POST['submit'])) {
        $settings = parse_ini_file('config.ini');
        $bannedTableName = $settings['bannedTableName'];
        $issue_id = $_POST['check_id'];
        $request = mysql_query("SELECT * FROM $bannedTableName WHERE id='{$issue_id}'");
        $row = mysql_fetch_assoc($request);
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
            <h1>Проверить статус дела</h1> <hr>
            <form action="check_status" method="post">
                <input name="check_id" type="text" placeholder="ID запроса о разблокировке">
                <input name="submit" type="submit" class="submit" value="Проверить">
            </form>
            <?php
            if(empty($row)) {
                echo 'На этой странице Вы можете <strong>проверить</strong> статус дела о разблокировке вашего аккаунта. Для этого, просто введите в форму выше <strong>ID</strong> Вашего запроса(он даётся при заполнении запроса) и нажмите на кнопку "Проверить"  или Enter';
            } else {
                echo
"<table class='table'>
    <tr><td>ID запроса</td><td>{$row['id']}</td></tr>
    <tr><td>Пользователь</td><td>{$row['login']}</td></tr>
    <tr><td>Текст сообщения</td><td>{$row['text']}</td></tr>
    <tr><td>Дата запроса</td><td>{$row['date']}</td></tr>
    <tr><td>Статус</td><td>{$row['status']}</td></tr>
</table>";}
            ?>
        </div>
    </body>
</html>