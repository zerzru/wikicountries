<?php
    session_start();
    require_once('engine.php');

    if(isset($_POST['submit'])) {
        global $articlesFolder, $protocol, $articlesLink;
        $name = $_POST['name'];
        $comment = $_POST['comment'];
        $post = $_POST['e_article'];
        $reserved_post = $post;
        $date = date('d.m.Y H:i:s');
        $ip = getUserIP();

        $fp = fopen("{$articlesFolder}{$name}_editing.php.txt", 'w');
        fwrite($fp, $post);
        fclose($fp);

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
        
        $post = str_replace('(i', '<img  src="', $post);
        $post = str_replace('i)', '" class="image">', $post);

        $post = str_replace('[upper]', '<sup>', $post);
        $post = str_replace('[/upper]', '</sup>', $post);

        #tables
        $post = str_replace('[table]', '<table class="table">', $post);
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

        $post = str_replace('[red_t]', '<span class="red">', $post);
        $post = str_replace('[/red_t]', '</span>', $post);

        #loading_info
        $post = str_replace('[script]', '<script>', $post);
        $post = str_replace('[/script]', '</script>', $post);

        $post = str_replace('[==', '<div id="main">', $post);
        $post = str_replace('==]', '</div>', $post);

        #links
        $post = str_replace('[', '<a href="', $post);
        $post = str_replace('|', '" class="link">', $post);
        $post = str_replace(']', '</a>', $post);

        $q = mysql_query("SELECT * FROM `{$name}` ORDER BY id DESC LIMIT 1");
        $qf = mysql_fetch_assoc($q);
        $idn = $qf['id'];
        $idn = $idn + 1;

        $fp3 = fopen("{$articlesFolder}{$name}_$idn.php.txt", 'w');
        fwrite($fp3, $post);
        fclose($fp3);

        $fp2 = fopen("{$articlesFolder}{$name}.php.txt", 'w');
        fwrite($fp2, $post);
        fclose($fp2);

        $code = $name.'_'.$idn.'.php.txt';

        $request = mysql_query("INSERT INTO {$name}(name, comment, code, date, ip) VALUES('{$_SESSION['login']}', '$comment', '$code', '$date', '$ip')");

        header("Location: {$protocol}{$articlesLink}{$name}.php");
    }
?>