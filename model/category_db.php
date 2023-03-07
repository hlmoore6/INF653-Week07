<?php
    require_once("database.php");

    function get_categories() {
        global $db;

        $query = "SELECT * FROM categories";
        $stmt = $db->prepare($query);
        $stmt->execute();

        $categories = $stmt->fetchAll();

        $stmt->closeCursor();

        return $categories;
    }

    function delete_category($category_id) {
        global $db;

        $query = "DELETE FROM categories WHERE categoryID = :category_id";
        $stmt = $db->prepare($query);
        $stmt->bindValue(":category_id", $category_id);
        $stmt->execute();
        $stmt->closeCursor();
    }

    function add_category($category_name) {
        global $db;

        $query = "INSERT INTO categories (categoryName) VALUES (:category_name)";
        $stmt = $db->prepare($query);
        $stmt->bindValue(":category_name", $category_name);
        $stmt->execute();
        $stmt->closeCursor();
    }

    function get_category_name($category_id) {
        global $db;

        try {
            $query = "SELECT categoryName FROM categories WHERE categoryID = :category_id";
            $stmt = $db->prepare($query);
            $stmt->bindValue(":category_id", $category_id);
            $stmt->execute();

            $category = $stmt->fetch();

            $stmt->closeCursor();
            
            if (!$category) {
                return null;
            }

            return $category[0];
        } catch (PDOException $e) {
            return null;
        }
    }

?>