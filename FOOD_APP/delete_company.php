<?php
include './functions/db.php';
$id = $_GET['id'];
$query = "update company set deleted_at ='1' where id = $id";
$statement = $pdo->prepare($query);
$statement->execute();
header("Location: Admin_panel.php");

?>