<?php
session_start();
if(isset($_POST['task'])){
    require '../database.php';

    $task = $_POST['task'];
    if(!empty($task)){
        $request = $conn->prepare("INSERT INTO todo_items(task) value(?)");
        $response = $request->execute([$task]);
        if($response){
            header("location: ../index.php");
        }
        $conn = null;
        exit();
    }
}

?>