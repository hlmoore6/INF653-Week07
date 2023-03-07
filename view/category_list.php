<?php 
    require_once("./model/category_db.php");

    $categories = get_categories();
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
            <main>
                <h2>Category List</h2>
                <?php if (sizeof($categories) == 0) :?>
                    <div>No Categories</div>
                <?php else :?>
                    <ul class="item-list">
                        <?php foreach($categories as $category) :?>
                            <li class="todo-item">
                                <h2 class="todo-item-title"><?php echo $category["categoryName"] ?></h2>
                                <br/>
                                <form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="POST">
                                    <input type="hidden" name="category_id" value="<?php echo $category["categoryID"] ?>"/>
                                    <input type="hidden" name="action" value="remove_category"/>
                                    <button type="submit" class="todo-item-erase">X</button>
                                </form>
                            </li>
                        <?php endforeach ?>
                    </ul>
                <?php endif ?>

                <h2>Add Category</h2>
                <form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="POST">
                    <input type="text" name="category_name"></input>
                    <button type="submit">Add Category</button>
                    <input type="hidden" name="action" value="add_category"/>
                </form>
                <div class="links"> 
                    <a href=".">View To Do List</a>
                </div>
            </main>
        </div>
    </body>
</html>