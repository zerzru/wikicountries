<?php
    session_start();
    require_once('engine.php');

    if(isset($_POST['a_save'])) {
        global $articlesFolder, $articlesLink, $usersTableName, $protocol;
        $article_name = $_POST['a_name'];
        copy("{$articlesFolder}{$article_name}.php.txt",
            "{$articlesFolder}{$article_name}.php_saved.txt");
        header("Location: {$protocol}{$articlesLink}{$article_name}.php");
    };

    if(isset($_POST['a_ban'])) {
        global $usersTableName, $protocol, $articlesLink;
        $user_name = $_POST['a_name'];
        $request = mysql_query("UPDATE `$usersTableName` SET `banned`='yes' WHERE login='{$user_name}'");
        header("Location: {$protocol}{$articlesLink}user_{$user_name}.php");
    };

    if(isset($_POST['a_unban'])) {
        global $usersTableName, $protocol, $articlesLink;
        $user_name = $_POST['a_name'];
        $request = mysql_query("UPDATE `$usersTableName` SET `banned`='' WHERE login='{$user_name}'");
        header("Location: {$protocol}{$articlesLink}user_{$user_name}.php");
    };

    if(isset($_POST['still'])) {
        global $bannedTableName, $projectLink, $protocol;
        $issue_id_s = $_GET['still'];
        $request = mysql_query("UPDATE {$bannedTableName} SET status='Решение: оставить заблокированным' WHERE id='$issue_id_s'");
        header("Location: {$protocol}{$projectLink}unban_panel.php");
    };

    if(isset($_POST['unblock'])) {
        global $bannedTableName, $usersTableName, $protocol, $projectLink;
        $issue_id_u = $_GET['unblock'];
        $user = $_GET['user'];
        $request = mysql_query("UPDATE {$usersTableName} SET banned='' WHERE login='$user'");
        $request = mysql_query("UPDATE {$bannedTableName} SET status='Решение: разблокировать' WHERE login='$user'");
        header("Location: {$protocol}{$projectLink}unban_panel.php");
    };

    if(isset($_POST['list'])) {
        global $bannedUsersListTableName, $protocol, $projectLink;
        $user = $_POST['user'];
        $settings = parse_ini_file('config.ini');
        $request = mysql_query("INSERT INTO {$bannedUsersListTableName}(login) VALUES($user)");
        header("Location: {$protocol}{$projectLink}unban_panel.php");
    };

    if(isset($_POST['f_article'])) {
        global $articlesTableName;
        $name = $_POST['a_name'];
        $request = mysql_query("UPDATE {$articlesTableName} SET type='favourite' WHERE name='$name'");
        header("Location: {$protocol}{$articlesLink}{$name}.php");
    }

    if(isset($_POST['g_article'])) {
        global $articlesTableName;
        $name = $_POST['a_name'];
        $request = mysql_query("UPDATE {$articlesTableName} SET type='good' WHERE name='$name'");
        header("Location: {$protocol}{$articlesLink}{$name}.php");
    }
?>