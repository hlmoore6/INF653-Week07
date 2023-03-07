<?php
    require_once("./model/item_db.php");
    require_once("./model/category_db.php");

    $category = FILTER_INPUT(INPUT_GET, "category_id", FILTER_VALIDATE_INT);

    $categories = get_categories();

    if (!isset($category)) {
        $todoItems = get_items();
    }
    else {
        $todoItems = get_items_by_category($category);
    }

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Todo List Assignment</title>
        <link rel="stylesheet" href="./view/main.css">
    </head>
    <body>
        <div id="container">
            <?php include("./view/header.php"); ?>
            <main class="item-list-container">
                <?php if(sizeof($categories) == 0) :?>
                    <div>Please add a category</div>
                <?php else :?>
                    <form class="category-select" action="<?php echo $_SERVER["PHP_SELF"] ?>" method="GET">
                        <input type="hidden" name="action" value="item_list"/>
                        <select name="category_id">
                            <?php foreach($categories as $cat) :?>
                            <option value="<?php echo $cat["categoryID"] ?>">
                                <?php echo $cat["categoryName"] ?>
                            </option>
                            <?php endforeach ?>
                        </select>
                        <button type="submit">Submit</button>
                    </form>
                <?php endif ?>
                <?php if (!isset($todoItems)) : ?>
                    <h2>No items</h2>
                <?php else: ?>
                    <ul class="item-list">
                    <?php foreach($todoItems as $item) :?>
                        <li class="todo-item">
                            <h2 class="todo-item-title"><?php echo $item["Title"] ?></h2>
                            <h4 class="todo-item-description">Category: <?php echo get_category_name($item["categoryID"] ?? "No Category") ?></h4>
                            <p class="todo-item-description"><?php echo $item["Description"] ?></p>
                            <form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="POST">
                                <button type="submit" class="todo-item-erase">X</button>
                                <input type="hidden" name="item_num" value="<?php echo $item["ItemNum"] ?>"/>
                                <input type="hidden" name="action" value="remove_item"/>
                            </form>
                        </li>
                    <?php endforeach ?>
                    </ul>
                <?php endif ?>
                <div class="links">
                    <a href="?action=add_item">Click Here</a> to add a new item to the list
                    <br/>
                    <a href="?action=edit_categories">View/Edit Categories</a>
                </div>
            </main>
            <?php include("./view/footer.php"); ?>
        </div>
    </body>
</html>

