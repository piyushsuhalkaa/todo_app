<?php
require 'database.php';
//return $pdo;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ToDo - App</title>
    <link rel="stylesheet" href="./styles/style.css">
</head>
<body>
    <header>
        <h1>TO DO APP</h1>
    </header>
    <section class="container">
        <div class="main-section">
            <div class="add-section">
                <form action="">
                    <input type="text" name="task" placeholder="add your task here..."  required/>
                    <button type="submit"> Add Task</button>
                </form>
            </div>
            <div class="filter-section">
                <button>Show All</button>
                <button>Show Completed</button>
                <button>Show Pending</button>
            </div>
            <?php
                $todos = $conn->query("SELECT * FROM todo_items WHERE status = 1")
            ?>
            <div class="show-todo-section">
                <?php if($todos->rowCount() == 0 ){ ?>
                    <center><h2>No ToDo List To Show!</h2></center>
                <?php } else {
                    while($todo = $todos->fetch(PDO::FETCH_ASSOC)){
                        $checked = $todo['completed'] ? 'checked' : ''; ?>
                    <div class="todo-item">
                        <span id=<?php echo $todo['id']; ?> class="remove-to-do">x</span>
                        <input type="checkbox" class="check-box" <?php echo $checked; ?> >
                        <h2 class="<?php echo $checked;?>"> <?php echo $todo['task'];  ?></h2>
                        <small>Created at: <?php echo date("d-m-Y", strtotime($todo['created_at']));  ?></small>
                    </div>
                <?php }
                }?>
            </div>
        </div>
    </section>
</body>
</html>