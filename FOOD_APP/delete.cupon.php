<?php
if(isset($_GET['id'])){
    include './functions/db.php';
    $id = $_GET['id'];
    $query = "DELETE FROM cupon WHERE id = $id";
    $statement = $pdo->prepare($query);
    $statement->execute();
    header("Location: Admin_panel.php");
    exit();
}