<?php

if(isset($_POST['id'])){
    require '../database.php';

    $remove_item = $_POST['id'];
    $status = $_POST['isCompleted'];
    if(!empty($remove_item)){
        $query = "UPDATE todo_items SET completed=$status WHERE id = ?";
        $request = $conn->prepare($query);
        $response = $request->execute([$remove_item]);
        if($response){
            echo 1;
        }
        $conn = null;
        exit();
    }
}
?>
