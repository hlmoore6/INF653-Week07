<?php
    require_once("./model/todoitems.php");

    $action = filter_input(INPUT_POST, "action", FILTER_UNSAFE_RAW);

    switch ($action) {
        case "insert_item":
            $title = filter_input(INPUT_POST, "title", FILTER_UNSAFE_RAW);
            $description = filter_input(INPUT_POST, "description", FILTER_UNSAFE_RAW);
            addTodoItem($title, $description);
            break;
        case "remove_item":
            $itemNum = filter_input(INPUT_POST, "item_num", FILTER_VALIDATE_INT);
            removeItem($itemNum);
            break;
        default:
            break;
    }

    $action = "";

    $todoItems = getTodoItems();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Todo List Assignment</title>
        <link rel="stylesheet" href="view/main.css">
    </head>
    <body>
        <div id="container">
            <div class="container-content">
                <div class="container-header">
                    <h1>ToDo List</h1>
                </div>
                <?php if ($todoItems == null) : ?>
                    <h2>No items</h2>
                <?php else: ?>
                    <ul class="todo-list-items">
                    <?php foreach($todoItems as $item) :?>
                        <li class="todo-item">
                            <h2 class="todo-item-title"><?php echo $item["Title"] ?></h2>
                            <p class="todo-item-description"><?php echo $item["Description"] ?></p>
                            <form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="POST">
                                <button type="submit" class="todo-item-erase">X</button>
                                <input type="hidden" name="item_num" value="<?=$item["ItemNum"]?>"/>
                                <input type="hidden" name="action" value="remove_item"/>
                            </form>
                        </li>
                    <?php endforeach ?>
                    </ul>
                <?php endif ?>
            </div>
            <form class="add-item-container" action="<?php echo $_SERVER["PHP_SELF"] ?>" method="POST">
                <h2>Add Item</h2>
                <input name="title" class="item-input" placeholder="Title"></input>            
                <input name="description" class="item-input" placeholder="Description"></input>            
                <button type="submit" class="form-submit">Add Item</button>
                <input name="action" type="hidden" value="insert_item"/>
            </form>
        </div>
    </body>
</html>
