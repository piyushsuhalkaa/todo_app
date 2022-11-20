<?php
require 'database.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ToDo - App</title>
    <link rel="stylesheet" href="./styles/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">  
</head>

<body class="container">
    <header>
        <h1>TO DO APP</h1>
    </header>
    <section>
        <div class="main-section">
            <div class="add-section">
                <form action="app/add_task.php" method="POST">
                    <input type="text" name="task" placeholder="add your task here..." required/>
                    <button type="submit"> Add Task</button>
                </form>
            </div>
            <div class="filter-section">
                <button class="btn btn-primary mb-3">Show All</button>
                <button class="btn btn-primary mb-3">Show Pending</button>
                <button class="btn btn-primary mb-3">Show Completed</button>
            </div>

            <div class="show-todo-section">
            <div id="empty" style="display: none;">
                <center>
                            <h3>No ToDo List To Show!</h3>
                </center>
            </div>
                <?php
                $todos = $conn->query("SELECT * FROM todo_items WHERE status = 1 ORDER BY id desc");
                if ($todos->rowCount() == 0) { ?>
                    <center>
                        <h3>No ToDo List To Show!</h3>
                    </center>
                    <?php } else {
                    while ($todo = $todos->fetch(PDO::FETCH_ASSOC)) {
                        $checked = $todo['completed'] ? 'checked' : ''; ?>
                        <div class="todo-item">
                            <span id=<?php echo $todo['id']; ?> class="remove-todo">x</span>
                            <input type="checkbox" class="check-box" data-id="<?php echo $todo['id']; ?>" <?php echo $checked; ?>>
                            <h2 class="<?php echo $checked; ?>"> <?php echo $todo['task'];  ?></h2>
                            <small>Created at: <?php echo date("d-m-Y", strtotime($todo['created']));  ?></small>
                        </div>
                <?php }
                } ?>
            </div>
        </div>
    </section>
    <script src="scripts/jquery-3.6.1.min.js"> </script>
    <script>
        $(document).ready(function(){
            $('.remove-todo').click(function(){
                let id = $(this).attr('id');
                $.post('app/remove_task.php',
                    {
                        id: id
                    },
                    (data) => {
                        $(this).parent().hide(500);
                    });
                    checkToDo();
                })
            $('.check-box').click(function(){
                let id = $(this).attr('data-id');
                let isCompleted = $(this).prop('checked') == true ? 1 : 0;
                $.post('app/check_task.php',
                    {
                        id,
                        isCompleted
                    },
                    (data) => {
                        h2 = $(this).next();
                        if(isCompleted){
                            h2.addClass('checked');
                        } else {
                            h2.removeClass('checked');
                        }
                    });
            })
        });
        function checkToDo(){
            let childElements =  $(".todo-item:visible").length;
            if(childElements <=1 ){
                setTimeout(function() {
                document.getElementById("empty").style.display = "block";
                }, 600);  
                console.log("LAST ElEment");
            }
        }
    </script>    
</body>

</html>