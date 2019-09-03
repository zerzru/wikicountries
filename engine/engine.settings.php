<?php
    session_start();
    require_once('engine.php');

    if(isset($_POST['submit'])) {
        global $usersTableName;
        $settings = parse_ini_file('config.ini');

        echo "
<script>
    function comeback() {
        location.replace('settings');
    }
</script>";

        $new_email = $_POST['e_email'];
        $old_passw = $_POST['current_passw'];
        $new_passw = $_POST['new_passw'];
        $con_passw = $_POST['confirm_passw'];
        
        $prerequest = mysql_query("SELECT * FROM $usersTableName WHERE login='{$_SESSION['login']}'");
        $row = mysql_fetch_assoc($prerequest);
        if($new_email == $row['email']) {
            echo '';
        } else {
            $request = mysql_query("UPDATE `$usersTableName` SET `email`='$new_email' WHERE login='{$_SESSION['login']}'");
            echo "Почта была успешно измененна. Вы вернётесь через 5 секунд <br>
            <script>
                setTimeout(comeback, 5000);
            </script>";
        }

        if(!empty($new_passw)) {
            if($con_passw == $new_passw) {
                $new_passw = md5($new_passw);
                $new_passw = sha1($new_passw);
                $new_passw = md5($new_passw);
                $new_passw = sha1($new_passw);
                $request = mysql_query("UPDATE `$usersTableName` SET `password`='$new_passw' WHERE login='{$_SESSION['login']}'");
                echo "Пароль был успешно изменён. Вы вернётесь через 5 секунд <br>";
            }
        }

        echo '
<script>
    comeback();
</script>
';
    }
?>