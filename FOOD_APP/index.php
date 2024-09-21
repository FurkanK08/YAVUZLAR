<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
<?php include 'navbar.php'; ?>
<div class="box">
    <h1>YEMEK SİTESİ</h1>
</div>

  <?php 
if(isset($_SESSION['id'])){
  include './functions/db.php';
  $query="SELECT * FROM 'order' WHERE user_id={$_SESSION['id']}";
  $statement=$pdo->prepare($query);
  $statement->execute();
  $result = $statement->fetchAll(); 
  if(empty($result)){
    $query="INSERT INTO 'order' (user_id) VALUES ({$_SESSION['id']})";
    $statement=$pdo->prepare($query);
    $statement->execute();
    $query2="SELECT * FROM 'order' WHERE user_id={$_SESSION['id']}";
    $statement2=$pdo->prepare($query2);
    $statement2->execute();
    $result2 = $statement2->fetchAll();
    
  }
  if(!empty($result)){
  if($_SESSION['id']==$result[0]['user_id'] || $result2[0]['user_id']==$_SESSION['id']){
    if(!empty($result)){
      if($result[0]['order_statüs']!="sipariş teslim edildi"){

  echo'
  <div class="card bg-light">
  <div class="card-header">
    
  </div>
  <div class="card-body">
    <blockquote class="blockquote mb-2 d-flex justify-content-center ">
      <p class="text-success">SİPARİŞ DURUMU: '.$result[0]['order_statüs']; echo'</p>
    </blockquote>
  </div>
</div>';
  }
}}
  
}}
  
  ?>
  
<div class="row "><
<?php
include './functions/db.php';
$query="SELECT * FROM company";
$statement=$pdo->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
foreach ($result as $row) {
    echo'

<div class="col md-4 my-3 mb-3 d-flex justify-content-center">
<div class="card mb-3 justify-content-center align-items-center d-flex" style="width: 20rem;">
  <img src="'.$row['logo_path']; echo'." class="card-img-top" style="width: 100%; height: 200px; object-fit: cover" alt="...">
  <div class="card-body">
    <h5 class="card-title">'.$row['name']; echo' </h5>
    <p class="card-text">'.$row['description']; echo'</p>
    <a href="order.php?id='.$row['id']; echo'" class="btn btn-primary">Hemen Sipariş Ver</a>
  </div>
</div>
</div>';
}
 ?>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>