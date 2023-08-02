<?php
    require_once('engine.php');
    date_default_timezone_set('UTC+5');

    function show_result() {
        if (isset($_POST['submit'])) {
            global $usersTableName, $articlesFolder, $link;
            $login = $_POST['login'];
            $password = $_POST['password'];
            $c_password = $_POST['c_password'];
            $email = $_POST['email'];
            $answer = $_POST['answer'];

            $regdate = date('d.m.Y H:i:s');
            $user_ip = getUserIP();

            if($c_password != $password) {
                echo "Пароли не совпадают. Пожалуйста, проверьте правильность написания пароля";
            } else {
                $login = stripcslashes($login);
                $login = htmlspecialchars($login);
                $login = trim($login);

                $password = stripcslashes($password);
                $password = htmlspecialchars($password);
                $password = trim($password);
                $password = $password.'ahsfdklasjfeshforjeip';
                $password = md5($password);
                $password = sha1($password);
                $password = md5($password);
                $password = sha1($password);

                $request = mysqli_query($link, "SELECT `id` FROM `{$usersTableName}` WHERE login='$login'");
                $answer = mysqli_fetch_array($request);
                if(!empty($answer['id'])) {
                    exit('Пользователь с таким именем уже существует');
                }

                $request2 = mysqli_query($link, "INSERT INTO {$usersTableName} (login, password, email, cquestion, date, ip, admin, banned) VALUES ('{$login}', '{$password}', '{$email}', '{$answer}', '{$regdate}', '{$user_ip}', 'no', 'no')");

                if($request2 == 'TRUE') {
                    echo "Пользователь {$login} успешно зарегистрирован<br>";
                    $fp = fopen("../{$articlesFolder}user_{$login}.php", 'w');
                    fwrite($fp,
    '<?php
        session_start();
        require_once("../engine/engine.php");
        $page_code = file_get_contents("user_'.$login.'.php.txt");
    ?>
    <!DOCTYPE html>
    <html lang="ru">
        <head>
            <meta charset="UTF-8">
            <title>Wikicountries | Участник: '.$login.'</title>
            <link rel="stylesheet" type="text/css" href="/lib/scripts/style.css">
            <link rel="icon" type="image/x-icon" href="/lib/images/icon.jpg">
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
                <form action="/engine/engine.admin.php" method="post">
                    <?php
                        show_admin_buttons_user("'.$login.'");
                    ?>
                </form>
                <a href="/edit.php?page=user_'.$login.'"><button>Редактировать</button></a>
                <?php echo $page_code; ?>
            </div>
        </body>
    </html>
    ');
                    fclose($fp);

                    $post = "Это страница участника <strong>{$login}</strong>";
                    $fp2 = fopen("../{$articlesFolder}user_{$login}.php.txt", 'w');
                    fwrite($fp2, $post);
                    fclose($fp2);

                    $post = "Это страница участника [b]{$login}[/b]";
                    $fp3 = fopen("../{$articlesFolder}user_{$login}_editing.php.txt", 'w');
                    fwrite($fp3, $post);
                    fclose($fp3);

                    $request = mysqli_query($link,
                    "CREATE TABLE {$login}(
                    `id` INT(255) NOT NULL UNIQUE AUTO_INCREMENT,
                    `name` VARCHAR(255) NOT NULL,
                    `code` VARCHAR(255),
                    `comment` VARCHAR(255),
                    `date` VARCHAR(255),
                    `ip` VARCHAR(255),
                    PRIMARY KEY(id))");

                } else {
                    echo 'Произошла неизвестная ошибка. Пожалуйста, перезагрузите страницу или попробуйте позже';
                }
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="UTF-8">
        <title>Wikicountries | Регистрация</title>
        <link rel="stylesheet" type="text/css" href="/lib/scripts/style.css">
        <link rel="icon" type="image/x-icon" href="/lib/images/icon.jpg">
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
            <h1>Регистрация</h1> <hr>
            <?php
                show_result();
            ?>
        </div>
    </body>
</html>