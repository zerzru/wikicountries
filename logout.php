<?php
    session_start();
    session_destroy();
    require_once('engine.php');
    global $protocol, $projectLink;
    header("Location: {$protocol}{$projectLink}");
    exit;
?>