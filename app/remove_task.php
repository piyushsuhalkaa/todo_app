<?php
if(isset($_POST['id'])){
    require '../database.php';
    
    $remove_item = $_POST['id'];
    if(!empty($remove_item)){
        $request = $conn->prepare("UPDATE todo_items SET status='0' WHERE id = ?");
        $response = $request->execute([$remove_item]);
        if($response){
            echo 1;
            //header("location: ../index.php?res=success");
        }
        $conn = null;
        exit();
    }
}

?>
