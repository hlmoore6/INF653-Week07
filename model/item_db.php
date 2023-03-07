<?php
    require_once("./model/database.php");

    function get_items() {
        global $db;

        try {
            $statement = $db->prepare('SELECT * FROM todoitems');
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
    function get_items_by_category($category_id) {

        global $db;

        $query = "SELECT * FROM todoitems WHERE categoryID = :category_id";
        $stmt = $db->prepare($query);
        $stmt->bindValue(":category_id", $category_id);
        $stmt->execute();
        
        $items = $stmt->fetchAll();

        $stmt->closeCursor();

        return $items;
    }

    function get_item($item_id) {
        global $db;

        $query = "SELECT * FROM todoitems WHERE ItemNum = :item_id";
        $stmt = $db->prepare($query);
        $stmt->bindValue(":item_id", $item_id);
        $stmt->execute();

        $item = $stmt->fetch();

        $stmt->closeCursor();

        return $item;
    }

    function delete_item($item_id) {
        global $db;

        $query = "DELETE FROM todoitems WHERE ItemNum = :item_id";
        $stmt = $db->prepare($query);
        $stmt->bindValue(":item_id", $item_id);
        $stmt->execute();
        $stmt->closeCursor();
    }

    function add_item($category_id, $title, $description) {
        global $db;

        try {
            $query = "INSERT INTO todoitems (categoryID, Title, Description) VALUES (:category_id, :title, :description)";
            $stmt = $db->prepare($query);
            $stmt->bindValue(":category_id", $category_id);
            $stmt->bindValue(":title", $title);
            $stmt->bindValue(":description", $description);
            $stmt->execute();
            $stmt->closeCursor();
            return true;
        } catch( PDOException $e) {
            return false;
        }
    }

    // function addTodoItem ($title, $description) {
        // global $dsn;
        // global $username;
        // global $password;

        // try {
            // $pdo = new PDO($dsn, $username, $password);
            // $statement = $pdo->prepare("INSERT INTO todoitems (Title, Description) VALUES (:title, :description)");
            // $statement->bindValue("title", $title);
            // $statement->bindValue("description", $description);
            // $statement->execute();
            // $statement->closeCursor();
        // } catch (PDOException $e) {

        // }
    // }

    // function removeItem ($itemNum) {
        // global $dsn;
        // global $username;
        // global $password;

        // try {
            // $pdo = new PDO($dsn, $username, $password);

            // $statement = $pdo->prepare("DELETE FROM todoitems WHERE ItemNum = :item_num");
            // $statement->bindValue("item_num", $itemNum);
            // $statement->execute();
            // $statement->closeCursor();
        // } catch (PDOException $e) {

        // }
    // }

?>