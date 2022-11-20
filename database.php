<?php

$name = "localhost";
$userName = "admin";
$password = "admin";

$db_name = "todo_app";

try {
    $conn = new PDO("mysql:host=localhost;dbname=todo_app",$userName,$password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected!1 ";
} catch (PDOException $e) {
    echo "Connection Failed: ".$e->getMessage();
}
?>