<?php
    session_start();
    require_once 'engine/engine.php';
    check_user_status();
    $page_name = $_GET['page'];
    $page_code = file_get_contents("{$page_name}_editing.php.txt");
?>
<!-- «» -->
<!DOCTYPE html>
<html lang="ru">
    <head>
        <title>Wikicountries | Редактировать статью «<?php echo $page_name; ?>»</title>
        <link rel="stylesheet" type="text/css" href="http://localhost/wiki/lib/scripts/style.css">
        <link rel="icon" type="image/x-icon" href="http://localhost/wiki/lib/images/icon.jpg">
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
            <h1>Редактировать статью «<?php echo $page_name; ?>»</h1>
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
            <form action="engine/engine.edit.php" method="post" class="new_article">
                <input name="name" type="text" class="name" placeholder="Название статьи" value="<?php echo $page_name; ?>" style="display:none;">
                <textarea name="e_article" type="text" class="article_i" id="article"><?php echo $page_code; ?></textarea> <br> <br>
                <input name="comment" type="text" class="text" placeholder="Пояснение изменений">
                <input name="submit" type="submit" class="submit" value="Записать страницу">
            </form>
        </div>
    </body>
    <script src="http://localhost/wiki/lib/scripts/main.js"></script>
</html>