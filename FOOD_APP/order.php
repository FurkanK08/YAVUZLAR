<?php
session_start();
ob_start();
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
<div class="container">
    <?php
    include './functions/db.php';
    $query="SELECT * FROM restaurant where id={$_GET['id']}";
    $statement=$pdo->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $restaurant_id=$result[0]['id'];
    $query2= "SELECT * FROM food where restaurant_id= $restaurant_id";
    $statement2 = $pdo->prepare($query2);
    $statement2->execute();
    $result2 = $statement2->fetchAll();

    ?>
<div class="col">
          <div class="card shadow-sm">
          <img src="./image/<?php echo $result[0]['image_path']; ?>" class="bd-placeholder-img card-img-top" width="100%" height="225" alt="restaurant resmi" />
            <div class="card-body">
             <h1 class="card-title text-warning"><?php echo $result[0]['name']; ?></h1>
             <h2 class="card-text text-secondary"><?php echo $result[0]['description']; ?></h2>
             <form action="" method="POST">
             <button  class="btn btn-md btn-warning float-end" name="yorum_ekle">Yorum Ekle</f>
             </form>
             <form  action="" method="POST">
             <button  class="btn  btn-md btn-danger float-end" name="yorumlar">Yorumlar</f>
             </form>
            </div>
          </div>
</div>
<div class="row">
          
          <?php 
           
          foreach ($result2 as $row) {
            echo' <div class="col-md-3 my-3">
        <div class="card" style="width: 18rem;">
  <img src="'.$row['image_path']; echo'" class="card-img-top" style="width: 100%; height: 200px; object-fit: cover" alt="...">
  <div class="card-body">
    <h5 class="card-title">'.$row['name']; echo'</h5>
    <p class="card-text">'.$row['description']; echo'</p>';
    
    if(isset($row['discount'])){
      $indirimli_tutar=$row['price']-($row['discount']);
       echo '<strike>'.$row['price']; echo'$</strike>';
       echo '<p class="card-text">indirimli tutar: '.$indirimli_tutar; echo'$</p>';

    }
    else{
      echo '<p class="card-text">'.$row['price']; echo'$</p>';
    }

    echo'<form action="" method="POST">
    <button type="submit" name="sepete_ekle" value="'.$row['id']; echo'" class="btn btn-primary">sepete ekle</a>
    </form>
  </div>
</div></div>';
        
          }
          if(isset($_POST['sepete_ekle'])){
            $food_id = $_POST['sepete_ekle'];
            $query = "INSERT INTO basket (user_id, food_id, quantity) VALUES ({$_SESSION['id']}, $food_id, 1)";
            $statement = $pdo->prepare($query);
            $statement->execute();
            header("Location: order.php?id={$_GET['id']}&message=Urun sepete eklendi!");
          }
          ?>
          
</div>
<?php 
if(isset($_POST['yorum_ekle'])){
    echo'
    <div class="card bg-light text-white mb-5">
    <form class="p-3" action="" method="POST">
    <div class="mb-3">
  <label for="exampleFormControlTextarea1" class="form-label">a</label>
  <div class="mb-3">
  <input type="text" class="form-control" id="exampleFormControlInput1" name="baslik" placeholder="baslık">
</div>
  <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="yorum" name="yorum"></textarea>
</div>
<div class="mb-3">
<label for="puanla" class="form-label small">puanla</label>
<input type="range" class="form-range" min="1" max="10"  id="puanla" value="5" name="score">
</div>
<div class="mb-3 d-flex justify-content-center">
<button type="submit" class="btn btn-primary" name="yorum_gonder">Gönder</button> </div>
</form></div>
';
}
if(isset($_POST['yorumlar'])){
include './functions/db.php';
$query="SELECT * FROM comments where restaurant_id={$_GET['id']}";
$statement=$pdo->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
$query2="SELECT * FROM users where id={$_SESSION['id']}";
$statement2=$pdo->prepare($query2);
$statement2->execute();
$result2 = $statement2->fetchAll();
foreach ($result as $row) {
echo '<div class="card bg-light text-white mb-5 p-5">
<div class="table-responsive">
<table class="table table-md table-striped">
  <thead>
    <tr>
      <th  scope="col">kullanıcı adı</th>
      <th scope="col">yemek adı</th>
      <th scope="col">yorum</th>
      <th scope="col">puan</th>
      <th scope="col">oluşturulma tarhi</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">';echo $result2[$row['user_id']]['username'];echo'</th>
      <td>';echo $row['title'];echo'</td>
      <td>';echo $row['comment'];echo'</td>
      <td>';echo $row['score']; echo'</td>
      <td>';echo $row['created_at']; echo'</td>
    </tr>
    </tbody>
</table>
</div>

</div>';}
}
if(isset($_POST['yorum_gonder'])){
    include './functions/db.php';
    $score = $_POST['score'];
    $baslik = $_POST['baslik'];
    $yorum = $_POST['yorum'];
    $query = "INSERT INTO comments (user_id,restaurant_id,score,title,comment) VALUES ( '$_SESSION[id]', '$_GET[id]', '$score', '$baslik', '$yorum')";
    $statement = $pdo->prepare($query);
    $statement->execute();
    ob_end_clean();
    header("Location: order.php?id=$_GET[id]");
}
?>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script> 
</body>
</html>