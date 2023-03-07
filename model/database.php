<?php
    $dsn = 'mysql:host=localhost;dbname=todolist';
    $username = 'mgs_user';
    $password = 'pa55word';

    $db = null;
    try {
        $db = new PDO($dsn, $username, $password);
    } catch (PDOException $e) {
        include("error.php");
    }

    function init_db() {
        global $db;
        if ($db != null) {
            return $db;
        }

    }


?>
