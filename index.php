<?php
    require_once("./model/database.php");
    require_once("./model/item_db.php");
    require_once("./model/category_db.php");

    $action = filter_input(INPUT_POST, "action", FILTER_UNSAFE_RAW);
    if ($action == null) {
        $action = filter_input(INPUT_GET, "action", FILTER_UNSAFE_RAW);
    }

    switch ($action) {
        case "insert_item":
            $title = filter_input(INPUT_POST, "title", FILTER_UNSAFE_RAW);
            $description = filter_input(INPUT_POST, "description", FILTER_UNSAFE_RAW);
            $category_id = filter_input(INPUT_POST, "category_id", FILTER_UNSAFE_RAW);
            add_item($category_id, $title, $description);
            header("Location: .");
            break;
        case "remove_item":
            $itemNum = filter_input(INPUT_POST, "item_num", FILTER_VALIDATE_INT);
            delete_item($itemNum);
            header("Location: .");
            break;
        case "add_item":
            include("./view/add_item_form.php");
            break;
        case "edit_categories":
            include("./view/category_list.php");
            break;
        case "add_category":
            $category_name = filter_input(INPUT_POST, "category_name", FILTER_UNSAFE_RAW);
            add_category($category_name);
            header("Location: .");
            break;
        case "remove_category":
            $category_id = filter_input(INPUT_POST, "category_id", FILTER_UNSAFE_RAW);
            delete_category($category_id);
            header("Location: .");
            break;
        case "item_list":
        default:
            include("./view/item_list.php");
            break;
    }

?>
