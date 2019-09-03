<?php
    require_once('engine.php');
    date_default_timezone_get('UTC+5');

    function show_result() {
        if (isset($_POST['submit'])) {
            global $usersTableName, $articlesFolder;
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

                $request = mysql_query("SELECT `id` FROM `{$usersTableName}` WHERE login='$login'");
                $answer = mysql_fetch_array($request);
                if(!empty($answer['id'])) {
                    exit('Пользователь с таким именем уже существует');
                }

                $request2 = mysql_query("INSERT INTO {$usersTableName} (login, password, email, cquestion, date, ip) VALUES ('{$login}', '{$password}', '{$email}', '{$answer}', '{$regdate}', '{$user_ip}')");

                if($request2 == 'TRUE') {
                    echo "Пользователь {$login} успешно зарегистрирован<br>";
                    $fp = fopen("{$articlesFolder}user_{$login}.php", 'w');
                    fwrite($fp,
    '<?php
        session_start();
        require_once("engine/engine.php");
        $page_code = file_get_contents("user_'.$login.'.php.txt");
    ?>
    <!DOCTYPE html>
    <html lang="ru">
        <head>
            <meta charset="UTF-8">
            <title>Wikicountries | Участник: '.$login.'</title>
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
                <form action="engine.admin.php" method="post">
                    <?php
                        show_admin_buttons_user();
                    ?>
                </form>
                <a href="edit.php?page=user_'.$login.'"><button>Редактировать</button></a>
                <?php echo $page_code; ?>
            </div>
        </body>
    </html>
    ');
                    fclose($fp);

                    $post = "Это страница участника <strong>{$login}</strong>";
                    $fp2 = fopen("{$articlesFolder}user_{$login}.php.txt", 'w');
                    fwrite($fp2, $post);
                    fclose($fp2);

                    $post = "Это страница участника [b]{$login}[/b]";
                    $fp3 = fopen("{$articlesFolder}user_{$login}_editing.php.txt", 'w');
                    fwrite($fp3, $post);
                    fclose($fp3);
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
            <h1>Регистрация</h1> <hr>
            <?php
                show_result();
            ?>
        </div>
    </body>
</html>