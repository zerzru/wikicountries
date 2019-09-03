<?php
    #THIS FILE SAVED BY SCGLICENSE 1.0
    $MAIN = array();
    $MAIN['Version'] = 'v0001-a';
    $MAIN['Build'] = 'WikiCountries PHP5-Build v0001-a';
    $MAIN['Company'] = 'SCG';
    $MAIN['CompanyFullname'] = 'SharovCompanyGroup';
    
    $settings = parse_ini_file('config.ini');
    
    $host = $settings['host'];
    $notice = $settings['notice'];
    $database = $settings['database'];
    $user = $settings['user'];
    $password = $settings['password'];
    $mainFileLink = $settings['mainFileLink'];
    $articlesLink = $settings['articlesLink'];
    $projectLink = $settings['projectLink'];
    $articlesTableName = $settings['articlesTableName'];
    $usersTableName = $settings['usersTableName'];
    $articlesFolder = $settings['articlesFolder'];
    $bannedTableName = $settings['bannedTableName'];
    $protocol = $settings['protocol'];
    $bannedUsersListTableName = $settings['bannedUsersListTableName'];

    $link = mysqli_connect($host, $user, $password, $database) or die("".mysqli_error($link));

    mysql_connect($host, $user, $password) or die('Ошибка подключения к базе данных');
    mysql_select_db($database) or die('Ошибка подключения к базе данных');

    function tech_works($mode, $type, $date, $time) {
        if($mode=='true') {
            if($type=='design') {
                exit("<center><h1>Технические работы</h1>Здравствуйте! На данный момент, ведутся работы над дизайном проекта WikiCountries</center>");
            }
        } else if($mode=='false') {

        } else {
            echo "Unknown work's mode. Please, chech your arguments at function calling";
        }
    }

    function show_articles($type) {
        global $articlesTableName;

        $request = mysql_query("SELECT * FROM {$articlesTableName} WHERE type='$type'");
        while($row = mysql_fetch_assoc($request)) {
            echo "<li><a href='{$row['link']}'>{$row['name']}</a></li>";
        }
    }

    function check_user_status() {
        global $usersTableName, $protocol, $projectLink;
        if(empty($_SESSION['login'])) {
            echo '';
        } else {
            $request = mysql_query("SELECT * FROM {$usersTableName} WHERE login='{$_SESSION['login']}'");
            $row = mysql_fetch_assoc($request);

            if($row['banned']=='yes') {
                header("{$protocol}{$projectLink}");   
            }
        
            if($row['admin']=='yes') {
                echo "<span class='favourite'>Администратор</span>";
            }
        }
    }

    function check_article_status($name) {
        global $articlesTableName;
        $request = mysql_query("SELECT * FROM {$articlesTableName} WHERE name='$name'");
        $row = mysql_fetch_assoc($request);

        if($row['type']=='new') {
            echo "<span class='new'>Новая статья</span>";
        }

        if($row['type']=='future') {
            echo "<span class='future'>Будущая статья</span>";
        }

        if($row['type']=='good') {
            echo "<span class='good'>Хорошая статья</span>";
        }

        if($row['type']=='favourite') {
            echo "<span class='favourite'>Избранная статья</span>";
        }
    }

    function show_account_name() {
        global $usersTableName, $bannedTableName, $protocol, $projectLink, $articlesLink;
        if (empty($_SESSION['login']) or empty($_SESSION['id'])) {
            echo "Гость ";
        } else {
            $request = "SELECT * FROM {$usersTableName} WHERE login = '{$_SESSION['login']}'";
            $answers = mysql_query($request);
            $row = mysql_fetch_assoc($answers);
            $afterrequest = "SELECT * FROM {$bannedTableName} WHERE login = '{$_SESSION['login']}'";
            $afteranswers = mysql_query($afterrequest);
            $afterrow = mysql_fetch_assoc($afteranswers);

            if ($row['banned']=='yes') {
                if(empty($afterrow['id'])) {
                    echo "<div class='ban'>Вы больше не можете создавать и редактировать статьи. <a href='{$protocol}{$projectLink}unban?user={$_SESSION['login']}'>Запросить разблокировку</a></div>Добро пожаловать, <a href='{$protocol}{$articlesLink}user_{$_SESSION['login']}'>{$_SESSION['login']}</a>! ";
                } else {
                    echo "<div class='rban'>Запрос о разблокировке отправлен. <a href='{$protocol}{$projectLink}check_status'>Проверить статус</a></div>Добро пожаловать, <a href='{$protocol}{$articlesLink}user_{$_SESSION['login']}'>{$_SESSION['login']}</a>!";
                }
            } else {
                echo "Добро пожаловать, <a href='{$protocol}{$articlesLink}user_{$_SESSION['login']}'>{$_SESSION['login']}</a>! ";
            }

            echo "<a href='{$protocol}{$projectLink}create_page'>Создать статью</a> ";
        };
    };

    function show_account_links() {
        global $projectLink, $protocol;

        if (empty($_SESSION['login']) or empty($_SESSION['id'])) {
            echo "<a href='{$protocol}{$projectLink}login'>Войти/Регистрация</a>";
        } else {
            echo "<a href='{$protocol}{$projectLink}logout'>Выйти</a>";
        };
    };

    function show_admin_buttons_user() {
        global $usersTableName;
        $request = mysql_query("SELECT * FROM $usersTableName WHERE login='{$_SESSION['login']}'");
        $row = mysql_fetch_array($request);

        if($row["admin"]=="yes") {
            echo '<p>';
            echo "<input name='a_name' class='submit' type='text' placeholder='Имя пользователя'>";
            echo "<input name='a_ban' class='submit' type='submit' value='Заблокировать'>";
            echo "<input name='a_unban' class='submit' type='submit' value='Разблокировать'>";
            echo '</p>';
        };
    };

    function show_head_html() {
        global $protocol, $projectLink;
        echo
'<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="'.$protocol.$projectLink.'lib/scripts/style.css">
<link rel="icon" type="image/x-icon" href="'.$protocol.$projectLink.'lib/images/icon.jpg">';
    }

    function show_admin_buttons_article() {
        global $usersTableName;
        $request = mysql_query("SELECT * FROM $usersTableName WHERE login='{$_SESSION['login']}'");
        $row = mysql_fetch_array($request);

        if($row['admin']=='yes') {
            echo "<p><form action='engine/engine.admin.php' method='post'><input name='a_name' class='submit' type='text'>";
            echo "<input name='f_article' class='submit' type='submit' value='Избранная статья'>";
            echo "<input name='g_article' class='submit' type='submit' value='Хорошая статья'>";
            echo "<input name='a_save' class='submit' type='submit' value='Сохранить статью'>";
            echo "<input name='a_delete' class='submit' type='submit' value='Удалить статью'></form></p>";
        };
    };

    function show_menu() {
        global $usersTableName, $protocol, $projectLink;
        if(empty($_SESSION['login'])) {
            echo
"<div class='menu'>
    <a href='{$protocol}{$projectLink}'><img src='{$protocol}{$projectLink}lib/images/icon.png' width='160px'></a>
    <li><a href='{$protocol}{$projectLink}index'>Главная</a></li>
    <li><a href='{$protocol}{$projectLink}authors'>Авторы</a></li>
    <li><a href='{$protocol}{$projectLink}engine.php'>Движок</a></li>
    <li><a href='{$protocol}{$projectLink}check_status'>Проверить дело</li>
    <li><a href='{$protocol}{$projectLink}settings'>Настройки</a></li>
    <li><a href='{$protocol}{$projectLink}about'>О проекте</a></li>
    <li><a href='{$protocol}{$projectLink}license'>Лицензия</a></li>
</div>
";
        } else {
            $request = mysql_query("SELECT * FROM {$usersTableName} WHERE login='{$_SESSION['login']}'");
            $row = mysql_fetch_assoc($request);
            if($row['admin']=='yes') {
                $admin_link = "<li><a href='{$protocol}{$projectLink}unban_panel'>Панель</a></li>";
            } else {
                $admin_link = '';
            }
            echo
"<div class='menu'>
    <a href='{$protocol}{$projectLink}'><img src='{$protocol}{$projectLink}lib/images/icon.png' width='160px'></a>
    <li><a href='{$protocol}{$projectLink}index'>Главная</a></li>
    <li><a href='{$protocol}{$projectLink}author'>Авторы</a></li>
    <li><a href='{$protocol}{$projectLink}engine.php'>Движок</a></li>
    $admin_link
    <li><a href='{$protocol}{$projectLink}check_status'>Проверить дело</li>
    <li><a href='{$protocol}{$projectLink}settings'>Настройки</a></li>
    <li><a href='{$protocol}{$projectLink}about'>О проекте</a></li>
    <li><a href='{$protocol}{$projectLink}license'>Лицензия</a></li>
</div>
";
        }
    }

    function get_user_info() {
        global $usersTableName;
        $request = mysql_query("SELECT * FROM {$usersTableName} WHERE login='{$_SESSION['login']}'");
        $row = mysql_fetch_assoc($request);

        if($row['banned']=='yes') {
            $banned = 'Да';
        } else {
            $banned = 'Нет';
        }

        if($row['admin']=='yes') {
            $admin = 'Да';
        } else {
            $admin = 'Нет';
        }

        echo
"
<div class='user_info'>
    <form action='engine/engine.settings.php' method='post'>
        <h3>Информация</h3>
        <table class='table'>
            <tr><td>Имя пользователя</td><td>{$row['login']}</td></tr>
            <tr><td>Время регистрации</td><td>{$row['date']}</td></tr>
            <tr><td>IP</td><td>{$row['ip']}</td></tr>
            <tr><td>Почта</td><td><input name='e_email' type='email' class='e_email' required value='{$row['email']}'></td></tr>
            <tr><td>ID</td><td>{$row['id']}</td></tr>
            <tr><td>Забанен</td><td>{$banned}</td></tr>
            <tr><td>Администратор</td><td>{$admin}</td></tr>
        </table> <br>
        <h3>Пароль</h3>
        <table class='table'>
            <tr><td>Текущий пароль</td><td><input name='current_passw' type='password' class='password'></td></tr>
            <tr><td>Новый пароль</td><td><input name='new_passw' type='password' class='password'></td></tr>
            <tr><td>Подтвердите пароль</td><td><input name='confirm_passw' type='password' class='password'></td></tr>
        </table>
        <input name='submit' type='submit' class='submit' value='Обновить информацию'>
    </form>
</div>
";
    }

    function getUserIP() {
        $client = @$_SERVER['HTTP_CLIENT_IP'];
        $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
        $remote = $_SERVER['REMOTE_ADDR'];

        if(filter_var($client, FILTER_VALIDATE_IP)) {
            $ip = $client;
        } else if(filter_var($forward, FILTER_VALIDATE_IP)) {
            $ip = $forward;
        } else {
            $ip = $remote;
        }
        return $ip;
    };
?>