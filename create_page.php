<?php
    session_start();
    require_once 'engine.php';
    if (empty($_SESSION['login']) or empty($_SESSION['id'])) {
        header('Location: index.php');
    }

    $request = mysql_query("SELECT * FROM users WHERE login='{$_SESSION['login']}'");
    $row = mysql_fetch_array($request);

    if($row['banned']=='yes') {
        header('Location: index.php');
    }
?>
<!DOCTYPE html>
<html lang="ru">
    <head>
        <title>Wikicountries | Создать статью</title>
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
            <h1>Создать статью</h1>
            <button class="bold" type="button">Жирный</button>
            <button class="italic">Курсив</button>
            <button class="underline">Подчёркнутый</button>
            <button class="link">Ссылка</button>
            <button class="image_b">Картинка</button>
            <button class="country_card">Карточка:Страна</button>
            <button class="up">Повышение</button>
            <button class="down">Понижение</button>
            <button class="upper">Степень</button>
            <button class="br">Перенос строки</button>
            <button class="green_t">Зелёный текст</button> <br>
            <button class="red_t">Красный текст</button>
            <button class="table_b">Таблица</button>
            <br> <br>
            <form action="engine.article.php" method="post" class="new_article">
                <input name="name" type="text" class="name" placeholder="Название статьи" required> <br> <br>
                <textarea name="article" type="text" class="article_i" id="article">Текст статьи</textarea> <br>
                <input name="comment" type="text" class="text" placeholder="Пояснение изменений">
                <input name="submit" type="submit" class="submit" value="Записать страницу">
                <br><br><br>
            </form>
        </div>
        <script src="https://wikicountries.000webhostapp.com/lib/scripts/main.js"></script>
    </body>
</html>