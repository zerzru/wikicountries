<?php
    session_start();
    require_once('engine.php');
?>

<!DOCTYPE html>
<html lang="ru">
    <head>
        <title>Wikicountries | Вход и регистрация</title>
        <?php
            show_head_html();
        ?>
    </head>
    <body>
        <?php show_menu(); ?>
        <div class="created_article">
            <div class="registration">
                <form action="engine.registration.php" method="post">
                    <p>Ваше имя пользователя</p>
                    <input name="login" type="text" placeholder="Ваш логин" class="r_login" required>
                    <p>Почта</p>
                    <input name="email" type="email" class="r_email" placeholder="Нужна для восстановления" required>
                    <p>Контрольный вопрос</p>
                    <input name="answer" type="text" class="r_answer" placeholder="Введите Вопрос: Ответ">
                    <p>Ваш пароль</p>
                    <input name="password" type="password" class="r_password" required>
                    <p>Пожалуйста, повторите Ваш пароль</p>
                    <input name="c_password" type="password" class="r_password" required> <br>
                    <input name="submit" type="submit" class="submit" value="Зарегистрироваться">
                </form>
            </div>
            <div class="authorization">
                <form action="engine.authorization.php" method="post">
                    <p>Имя пользователя</p>
                    <input name="login" type="text" placeholder="Ваш логин" class="r_login" required>
                    <p>Пароль</p>
                    <input name="password" type="password" class="r_password" required> <br>
                    <input name="submit" type="submit" class="submit" value="Войти"><a href="password_recovery">Забыли пароль?</a>
                </form>
            </div>
        </div>
    </body>
</html>