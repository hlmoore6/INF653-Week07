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
                <form class="add-item-container" action="<?php echo $_SERVER["PHP_SELF"] ?>" method="POST">
                    <h2>Add Item</h2>
                    <input name="title" class="item-input" placeholder="Title"></input>            
                    <input name="description" class="item-input" placeholder="Description"></input>            
                    <?php if(sizeof($categories) == 0) :?>
                        <div>Please add a category</div>
                    <?php else :?>
                        <select name="category_id">
                            <?php foreach($categories as $category) :?>
                                <option value="<?php echo $category["categoryID"] ?>">
                                    <?php echo $category["categoryName"] ?>
                                </option>
                            <?php endforeach ?>
                        </select>
                        <button type="submit" class="form-submit">Add Item</button>
                    <?php endif ?>
                    <input name="action" type="hidden" value="insert_item"/>
                </form>
            </main>
            <div class="links"> 
                <a href=".">View To Do List</a>
            </div>
            <?php include("./view/footer.php"); ?>
        </div>
    </body>
</html>
