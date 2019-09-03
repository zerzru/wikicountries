<?php
    require_once('engine.admin.php');
    global $usersTableName, $protocol, $projectLink, $bannedTableName;
    $request = mysql_query("SELECT * FROM {$usersTableName} WHERE login='{$_SESSION['login']}'");
    $row = mysql_fetch_assoc($request);
    if($row['admin']=='yes') {
        $administration='TRUE';
    } else {
        $settings = parse_ini_file('config.ini');
        header("Location: {$protocol}{$projectLink}");
        $administration='FALSE';
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Wikicountries | Панель разблокировок</title>
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
            <h1>Панель разблокировок</h1> <hr>
            <table class="table">
                <tr><th>Пользователь</th><th>ID запроса</th><th>Дата</th><th>IP</th><th>Текст запроса</th><th>Решение</th></tr>
                <?php
                    if($administration=='TRUE') {
                        $request = mysql_query("SELECT * FROM banned WHERE status='Не рассмотрен'");
                        while($row = mysql_fetch_assoc($request)) {
                            echo "<tr><td>{$row['login']}</td><td>{$row['id']}</td><td>{$row['date']}</td><td>{$row['ip']}</td><td>{$row['text']}</td>
                                          <form action='engine.admin.php?still={$row['id']}' method='post'><td><input name='still' type='submit' class='submit' value='Оставить'></form>
                                          <form action='engine.admin.php?unblock={$row['id']}&user={$row['login']}' method='post'><input name='unblock' type='submit' class='submit' value='Разблокировать'></form></td></tr>";
                        }
                    } else if($administration=='FALSE') {
                        header("Location: {$protocol}{projectLink}");
                    } else {
                        echo "Данный аккаунт не обладает правами администратора";
                    }
                ?>
            </table>
            <form action="engine.admin.php">
                <input name="user" type="text" class="text" placeholder="Имя участника, которого вы разблокировали">
                <input name="list" type="submit" value="Добавить в список">
            </form>
        </div>
    </body>
</html>