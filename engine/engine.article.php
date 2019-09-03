<?php
    session_start();
    #THIS FILE IS A PART OF WIKICOUNTRIES ENGINE AND HAS THE SAME LICENSE
    require_once('engine.php');

    function show_result() {
        if (isset($_POST['submit'])) {
            global $articlesFolder, $articlesLink, $articlesTableName, $protocol;
            $name = $_POST['name'];
            $post = $_POST['article'];
            $comment = $_POST['comment'];
            $reserved_post = $post;
            $ip = getUserIP();
            $date = date('d.m.Y H:i:s');

            #make transliteration to english letters, if russian
            #BIG LETTERS
            $ename = $name;
            $ename = str_replace('А', 'A', $ename);
            $ename = str_replace('Б', 'B', $ename);
            $ename = str_replace('В', 'V', $ename);
            $ename = str_replace('Г', 'G', $ename);
            $ename = str_replace('Д', 'D', $ename);
            $ename = str_replace('Е', 'E', $ename);
            $ename = str_replace('Ё', 'YO', $ename);
            $ename = str_replace('Ж', 'ZH', $ename);
            $ename = str_replace('З', 'Z', $ename);
            $ename = str_replace('И', 'I', $ename);
            $ename = str_replace('Ц', 'IY', $ename);
            $ename = str_replace('К', 'K', $ename);
            $ename = str_replace('Л', 'L', $ename);
            $ename = str_replace('М', 'M', $ename);
            $ename = str_replace('Н', 'N', $ename);
            $ename = str_replace('О', 'O', $ename);
            $ename = str_replace('П', 'P', $ename);
            $ename = str_replace('Р', 'R', $ename);
            $ename = str_replace('С', 'S', $ename);
            $ename = str_replace('Т', 'T', $ename);
            $ename = str_replace('У', 'U', $ename);
            $ename = str_replace('Ф', 'F', $ename);
            $ename = str_replace('Х', 'KH', $ename);
            $ename = str_replace('Ц', 'TS', $ename);
            $ename = str_replace('Ч', 'CH', $ename);
            $ename = str_replace('Ш', 'SH', $ename);
            $ename = str_replace('Щ', 'SCH', $ename);
            $ename = str_replace('Ы', 'II', $ename);
            $ename = str_replace('Э', 'YE', $ename);
            $ename = str_replace('Ю', 'YU', $ename);
            $ename = str_replace('Я', 'YA', $ename);

            #small letters
            $ename = str_replace('а', 'a', $ename);
            $ename = str_replace('б', 'b', $ename);
            $ename = str_replace('в', 'v', $ename);
            $ename = str_replace('г', 'g', $ename);
            $ename = str_replace('д', 'd', $ename);
            $ename = str_replace('е', 'e', $ename);
            $ename = str_replace('ё', 'yo', $ename);
            $ename = str_replace('ж', 'zh', $ename);
            $ename = str_replace('з', 'z', $ename);
            $ename = str_replace('и', 'i', $ename);
            $ename = str_replace('й', 'iy', $ename);
            $ename = str_replace('к', 'k', $ename);
            $ename = str_replace('л', 'l', $ename);
            $ename = str_replace('м', 'm', $ename);
            $ename = str_replace('н', 'n', $ename);
            $ename = str_replace('о', 'o', $ename);
            $ename = str_replace('п', 'p', $ename);
            $ename = str_replace('р', 'r', $ename);
            $ename = str_replace('с', 's', $ename);
            $ename = str_replace('т', 't', $ename);
            $ename = str_replace('у', 'u', $ename);
            $ename = str_replace('ф', 'f', $ename);
            $ename = str_replace('х', 'kh', $ename);
            $ename = str_replace('ц', 'ts', $ename);
            $ename = str_replace('ч', 'ch', $ename);
            $ename = str_replace('ш', 'sh', $ename);
            $ename = str_replace('щ', 'sch', $ename);
            $ename = str_replace('ъ', '', $ename);
            $ename = str_replace('ы', 'ii', $ename);
            $ename = str_replace('ь', '', $ename);
            $ename = str_replace('э', 'ye', $ename);
            $ename = str_replace('ю', 'yu', $ename);
            $ename = str_replace('я', 'ya', $ename);
            $ename = str_replace(' ', '_', $ename);

            $prerequest = mysql_query("SELECT * FROM $ename");
            if(!empty($prerequest)) {
                echo "Страница <a href='{$protocol}{$articlesLink}$ename.php'>$name</a> уже существует <br> <br>
                <iframe src='{$protocol}{$articlesLink}$ename.php' width='1000px' height='300px'></iframe>";
            } else {
                $fp2 = fopen("{$articlesFolder}{$ename}_editing.php.txt", 'w');
                fwrite($fp2, $post);
                fclose($fp2);

                #standart htmls
                $post = strip_tags($post);
                $post = str_replace('[h1]', '<h1>', $post);
                $post = str_replace('[/h1]', '</h1> <hr>', $post);

                $post = str_replace('[h2]', '<h2>', $post);
                $post = str_replace('[/h2]', '</h2> <hr>', $post);
                
                $post = str_replace('[h3]', '<h3>', $post);
                $post = str_replace('[/h3]', '</h3>', $post);
                
                $post = str_replace('[b]', '<strong>', $post);
                $post = str_replace('[/b]', '</strong>', $post);

                $post = str_replace('[i]', '<i>', $post);
                $post = str_replace('[/i]', '</i>', $post);
                
                $post = str_replace('[u]', '<u>', $post);
                $post = str_replace('[/u]', '</u>', $post);

                $post = str_replace('[br]', '<br>', $post);
                
                $post = str_replace('(i', '<img src="', $post);
                $post = str_replace('i)', '">', $post);

                $post = str_replace('[upper]', '<sup>', $post);
                $post = str_replace('[/upper]', '</sup>', $post);

                #tables
                $post = str_replace('[table]', '<table class="table_dark">', $post);
                $post = str_replace('[строка]', '<tr>', $post);
                $post = str_replace('[/строка]', '</tr>', $post);
                $post = str_replace('[контент]', '<td>', $post);
                $post = str_replace('[/контент]', '</td>', $post);
                $post = str_replace('[столбец]', '<th>', $post);
                $post = str_replace('[/столбец]', '</th>', $post);
                $post = str_replace('[/table]', '</table>', $post);

                #userboxes
                $post = str_replace('{{', '<div class="', $post);
                $post = str_replace('(f', '<img src="', $post);
                $post = str_replace('f)', '" class="flag">', $post);
                $post = str_replace('(e', '<img src="', $post);
                $post = str_replace('e)', '" class="emblem">', $post);
                $post = str_replace('| Самоназвание = ', '<br><br><span class="left_text">Самоназвание</span>', $post);
                $post = str_replace('| ВВП = ', '<br><br><span class="left_text">ВВП</span>', $post);
                $post = str_replace('| ИЧР = ', '<br><br><span class="left_text">ИЧР</span>', $post);
                $post = str_replace('| Официальный язык = ', '<br><br><span class="left_text">Официальный язык</span>', $post);
                $post = str_replace('| Столица = ', '<br><br><span class="left_text">Столица</span>', $post);
                $post = str_replace('| Президент = ', '<br><span class="left_text">Президент</span>', $post);
                $post = str_replace('| Монарх = ', '<br><br><span class="left_text">Монарх</span>', $post);
                $post = str_replace('| Госрелигия = ', '<br><br><span class="left_text">Религия</span>', $post);
                $post = str_replace('| Население = ', '<br><br><span class="left_text">Население</span>', $post);
                $post = str_replace('| Основание = ', '<br><br><span class="left_text">Основание</span>', $post);
                $post = str_replace('| Крупнейшие города = ', '<br><br><span class="left_text">Крупнейшие города</span>', $post);
                $post = str_replace('| Форма правления = ', '<br><br><span class="left_text">Форма правления</span>', $post);
                $post = str_replace('| Президент = ', '<br><br><span class="left_text">Президент</span>', $post);
                $post = str_replace('| Премьер министр = ', '<br><br><span class="left_text">Премьер министр</span>', $post);
                $post = str_replace('| Территория = ', '<br><br><span class="left_text">Территория</span>', $post);
                $post = str_replace('| Названия жителей = ', '<br><br><span class="left_text">Названия жителей</span>', $post);
                $post = str_replace('| Валюта = ', '<br><br><span class="left_text">Валюта</span>', $post);
                $post = str_replace('| Домены = ', '<br><br><span class="left_text">Домены</span>', $post);
                $post = str_replace('| Код ISO = ', '<br><br><span class="left_text">Код ISO</span>', $post);
                $post = str_replace('| Код МОК = ', '<br><br><span class="left_text">Код МОК</span>', $post);
                $post = str_replace('| Телефонный код = ', '<br><br><span class="left_text">Телефонный код</span>', $post);
                $post = str_replace('| Часовые пояса = ', '<br><br><span class="left_text">Часовые пояса</span>', $post);
                $post = str_replace('| Автомобильное движение = ', '<br><br><span class="left_text">Автомобильное движение</span>', $post);

                $post = str_replace('}}', '</div>', $post);
                $post = str_replace('}', '">', $post);

                #special symbols
                $post = str_replace('[up]', '<span class="green">▲</span>', $post);
                $post = str_replace('[down]', '<span class="red">▼</span>', $post);

                #colors
                $post = str_replace('[green]', '<span class="green">', $post);
                $post = str_replace('[/green]', '</span>', $post);

                $post = str_replace('[red]', '<span class="red">', $post);
                $post = str_replace('[/red]', '</span>', $post);

                $post = str_replace('[==', '<div id="main">', $post);
                $post = str_replace('==]', '</div>', $post);

                #links
                $post = str_replace('[', '<a href="', $post);
                $post = str_replace('|', '" class="link">', $post);
                $post = str_replace(']', '</a>', $post);

                $fp4 = fopen("{$articlesFolder}{$ename}_1.php.txt", 'w');
                fwrite($fp4, $post);
                fclose($fp4);

                $fp2 = fopen("{$articlesFolder}{$ename}.php.txt", 'w');
                fwrite($fp2, $post);
                fclose($fp2);

                $fp = fopen("{$articlesFolder}{$ename}.php", 'w');
                fwrite($fp,
'<?php
    session_start();
    require_once("engine.php");
    $page_code = file_get_contents("'.$ename.'.php.txt");
?>

<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="UTF-8">
        <title>Wikicountries | '.$name.'</title>
        <link rel="stylesheet" type="text/css" href="{$protocol}{$projectLink}lib/scripts/style.css">
        <link rel="icon" type="image/x-icon" href="{$protocol}{$projectLink}lib/images/icon.jpg">
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
            <span class="aname">'.$name.'</span> <br>
            <div class="article_management"><?php check_article_status("'.$ename.'"); ?><li><a href="edit.php?page='.$ename.'">Изменить</a></li><li><a href="history.php?article='.$ename.'">История</a></li></div><br><br><hr style="margin-top:30px">
                <?php show_admin_buttons_article(); ?>
                <?php echo $page_code; ?>
            </div>
            <div class="author">Первое изменение этой страницы было сделано пользователем '.$_SESSION['login'].' в '.$date.'</div>
        </div>
    </body>
</html>');
                fclose($fp);

                $request = mysql_query(
                    "CREATE TABLE {$ename}(
                    `id` INT(255) NOT NULL UNIQUE AUTO_INCREMENT,
                    `name` VARCHAR(255) NOT NULL,
                    `code` VARCHAR(255),
                    `comment` VARCHAR(255),
                    `date` VARCHAR(255),
                    `ip` VARCHAR(255),
                    PRIMARY KEY(id))");

                global $protocol, $articlesLink;

                $request = mysql_query("INSERT INTO {$ename}(name, comment, code, date, ip) VALUES('{$_SESSION['login']}', '$comment', '{$ename}_1.php.txt', '$date', '$ip')");

                $request = mysql_query("INSERT INTO {$articlesTableName}(name, type, description, date) VALUES('$ename', 'new', '{$protocol}{$articlesLink}{$ename}.php', '$date')");
                header("{$articlesLink}{$ename}.php");
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="UTF-8">
        <title>Wikicountries | Создание страницы</title>
        <link rel="stylesheet" type="text/css" href="https://wikicountries.000webhostapp.com/lib/scripts/style.css">
        <link rel="icon" type="image/x-icon" href="https://wikicountries.000webhostapp.com/lib/images/icon.jpg">
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
            <h1>Создание страницы</h1> <hr>
            <?php
                show_result();
            ?>
        </div>
    </body>
</html>