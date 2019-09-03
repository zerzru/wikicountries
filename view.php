<?php
    session_start();
    require_once('engine/engine.php');
    $article = $_GET['page'];
    $version = $_GET['id'];

    $request = mysql_query("SELECT * FROM $article WHERE id='$version'");
    $row = mysql_fetch_assoc($request);
?>

<!DOCTYPE html>
<html lang="ru">
    <head>
        <title>Wikicountries | Просмотр страницы <?php echo "«$article»"; ?></title>
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
            <span class="aname"><?php echo "Просмотр версии $version страницы «{$article}»";?></span> <br>
            <div class="article_management"><li><a href="edit.php?page=<?php echo $article; ?>">Изменить</a></li><li><a href="history.php?article=<?php echo $article; ?>">История</a></li></div><br><br><hr style="margin-top:30px">
            <center>
                <div class="reminder">
                    <?php echo "Вы читаете версию страницы, созданную {$row['date']}. Эта версия может значительно отличаться от <a href='$article.php'>последней версии</a> страницы";?>
                </div> <br>
                <?php
                    $code = file_get_contents($row['code']);
                    echo $code;
                ?>
            </center>
        </div>
    </body>
</html>