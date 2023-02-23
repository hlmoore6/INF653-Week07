<?php
    $dsn = 'mysql:host=localhost;dbname=todolist';
    $username = 'mgs_user';
    $password = 'pa55word';

    function getTodoItems() {
        global $dsn;
        global $username;
        global $password;

        try {
            $pdo = new PDO($dsn, $username, $password);
            $statement = $pdo->prepare('SELECT * FROM todoitems');
            $statement->execute();
            $items = $statement->fetchAll();
            $statement->closeCursor();

            return $items;
        } catch (PDOException $e) {
            $em = $e->getMessage();
            echo $em;
            return null;
        }
    }

    function addTodoItem($title, $description) {
        global $dsn;
        global $username;
        global $password;

        try {
            $pdo = new PDO($dsn, $username, $password);
            $statement = $pdo->prepare("INSERT INTO todoitems (Title, Description) VALUES (:title, :description)");
            $statement->bindValue("title", $title);
            $statement->bindValue("description", $description);
            $statement->execute();
            $statement->closeCursor();
        } catch (PDOException $e) {

        }
    }

    function removeItem($itemNum) {
        global $dsn;
        global $username;
        global $password;

        try {
            $pdo = new PDO($dsn, $username, $password);

            $statement = $pdo->prepare("DELETE FROM todoitems WHERE ItemNum = :item_num");
            $statement->bindValue("item_num", $itemNum);
            $statement->execute();
            $statement->closeCursor();
        } catch (PDOException $e) {

        }
    }
?>
