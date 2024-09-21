<?php 
session_start();
if($_SESSION['username']!=null || $_SESSION['role']=="firma") {
}
else{
    header("Location: index.php?message=yetki yok!");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<body>
    <?php include 'navbar.php'; ?>
    <?php
    include './functions/db.php';
    $query = "SELECT * FROM users where id={$_SESSION['id']}";
    $statement = $pdo->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $company_id=$result[0]['company_id'];
    if(!empty($company_id)){
      $query2 = "SELECT * FROM restaurant where id={$company_id}";
      $statement2 = $pdo->prepare($query2);
      $statement2->execute();
      $result2 = $statement2->fetchAll(); 
      $restaurant_id=$result2[0]['id'];
    }
    if(!empty($restaurant_id)){
  
   
    $query3= "SELECT * FROM food where restaurant_id= $restaurant_id";
    $statement3 = $pdo->prepare($query3);
    $statement3->execute();
    $result3 = $statement3->fetchAll();}
?>

<div class="container">
    <h1 class="my-5 d-flex justify-content-center">Firma Panel</h1>

    <div class="row d-flex justify-content-center">
        <div class="col-md-6 my-5">
        <form class="d-flex form-inline " action="" method="POST">
          <input class="form-control " type="search" placeholder="Search" aria-label="Search" name="name">
         
    
            <select class="form-select" aria-label="Tüm hepsi" name="filter">
              <option selected value="default">Filtrele</option>
              <option value="1">tümü</option>
              <option value="2">silinmiş</option>
              <option value="3">aktif</option>
            </select>
    
        
          <button class="btn btn-outline-success " name="search" type="submit">Search</button>
        </form>
        <?php 
        if(isset($_POST['search'])){
          if(isset($_POST['name'])){
            $_idname = $_POST['name'];
          }
            $filter = $_POST['filter'];
            if($filter==1 || $filter=="default"){
              if(isset($name)){
                $query="SELECT * FROM food WHERE restaurant_id= $restaurant_id AND name LIKE '%".$name."%'";}
              else{
                $query="SELECT * FROM food where restaurant_id= $restaurant_id";}
              $statement3 = $pdo->prepare($query);
              $statement3->execute();
              $result3 = $statement3->fetchAll();
            }
            else if($filter==2){
              if(isset($name)){
                $query="SELECT * FROM food WHERE restaurant_id= $restaurant AND name LIKE '%".$name."%' AND deleted_at IS NOT NULL";}
              else{
                $query="SELECT * FROM food WHERE restaurant_id= $restaurant_id AND deleted_at IS NOT NULL";}
              $statement3 = $pdo->prepare($query);
              $statement3->execute();
              $result3 = $statement3->fetchAll();
            }
            else if($filter==3){
                if(isset($name)){
                    $query="SELECT * FROM food WHERE restaurant_id= $restaurant_id AND name LIKE '%".$name."%' AND deleted_at IS NULL";}
                else{
                $query="SELECT * FROM food WHERE restaurant_id= $restaurant_id AND deleted_at IS NULL";}
                $statement3 = $pdo->prepare($query);
                $statement3->execute();
                $result3 = $statement3->fetchAll();
            }
          
        }
        ?>
    <table class="table table-striped table-hover">
  <thead>
    <tr>
        <th scope="col">Sil</th>
      <th scope="col">id</th>
      <th scope="col">yemek adı</th>
      <th scope="col">acıklama</th>
      <th scope="col">fiyatı</th>
      <th scope="col">güncelle</th>
    </tr>
  </thead>
  <tbody>
   <?php
   if(!empty($result3)){
    foreach($result3 as $row){
      echo "<tr>";
      echo "<td><a href='delete_food.php?id=$row[id]'><button type='button' class='btn btn-danger'>sil</button></a></td>";
      echo "<td>$row[id]</td>";
      echo "<td>$row[name]</td>";
      echo "<td>$row[description]</td>";
      echo "<td>$row[price]</td>";
      echo "<td><a href='updated_food.php?id=$row[id]'><button type='button' class='btn btn-success'>güncelle</button></a></td>";
      echo "</tr>";
  }
     
   }

   ?>
  </tbody>
  <tfoot>
    <tr>
      <th colspan="5"></th>
      <th><button type="button" onclick="window.location.href='add_food.php'" class="btn btn-success">yemek ekle</button></th>
      
    </tr>
  </tfoot>
</table>
</div>  
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>   
    
</body>
</html>