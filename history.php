<?php
    session_start();
    require_once('engine/engine.php');
    $page_name = $_GET['article'];
?>

<!DOCTYPE html>
<html lang="ru">
    <head>
        <title>Wikicountries | История страницы «<?php echo $page_name; ?>»</title>
        <link rel="stylesheet" type="text/css" href="http://localhost/wiki/lib/scripts/style.css">
        <link rel="icon" type="image/x-icon" href="http://localhost/wiki/lib/images/icon.png">
    </head>
    <body>
        <?php show_menu(); ?>
        <header class="top">
            <?php
                show_account_name();
                show_account_links();
            ?>
        </header> <br>
        <div class="created_article">
            <span class="aname"><?php echo "Просмотр измений статьи «{$page_name}»";?></span> <br>
            <div class="article_management"><li><a href="edit.php?page=<?php echo $page_name; ?>">Изменить</a></li><li><a href="history.php?article=<?php echo $page_name; ?>">История</a></li></div><br><br><hr style="margin-top:30px">
            <table class="table">
                <tr><th>ID</th><th>Имя</th><th>Описание изменений</th><th>Дата</th><th>Код</th></tr>
                <?php
                    $request = mysql_query("SELECT * FROM {$page_name}");
                    while($row = mysql_fetch_assoc($request)) {
                        echo "<tr><td>{$row['id']}</td><td>{$row['name']}</td><td>{$row['comment']}</td><td>{$row['date']}</td><td><a href='view.php?page=$page_name&id={$row['id']}'>Посмотреть страницу</a></td></tr>";
                    }
                ?>
            </table>
        </div>
    </body>
</html>