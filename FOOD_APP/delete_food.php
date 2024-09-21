<?php
$id=$_GET['id'];
include './functions/db.php';  

$query = "UPDATE food SET deleted_at = 1 WHERE id = $id";
$statement = $pdo->prepare($query);
$statement->execute();
header("Location: company_panel.php?message=Yemek Silindi!");


?>