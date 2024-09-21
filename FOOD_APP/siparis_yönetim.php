<?php 
session_start();
ob_start();
if($_SESSION['username']!=null || $_SESSION['role']=="firma") {
}
else{
    header("Location: index.php?message=yetki yok!");
}
include './functions/db.php';
$query3= "SELECT * FROM users where id={$_SESSION['id']}";
$statement3 = $pdo->prepare($query3);
$statement3->execute();
$result3 = $statement3->fetchAll();

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
<div class="container bg-light  border border-2 rounded" style="margin-top: 50px">

<div class="row d-flex justify-content-center "  >
    <h1 class="my-5 d-flex justify-content-center">Siparisler</h1>

    <div class="col-md-9 my-5">
        <table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">id</th>
     <th scope="col">müşteri adı</th>
      <th scope="col">tarih</th>
      <th scope="col">adet</th>
      <th scope="col">toplam fiyat</th>
      <th scope="col">sipariş durumu</th>
    </tr>
  </thead>
  <tbody>
    
      <?php 

$query = "SELECT * FROM 'order' WHERE company_id={$result3[0]['company_id']}";
$statement = $pdo->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
foreach($result as $row){
  $query2 = "SELECT * FROM order_items WHERE order_id=$row[id]";
  $statement2 = $pdo->prepare($query2);
  $statement2->execute();
  $result2 = $statement2->fetchAll();
  $food_id = $result2[0]['food_id'];
  if(!empty($result2)){
    $query3 = "SELECT * FROM food WHERE id=$food_id";
    $statement3 = $pdo->prepare($query3);
    $statement3->execute();
    $result3 = $statement3->fetchAll();
    $query4 = "SELECT * FROM users WHERE id=$row[user_id]";
    $statement4 = $pdo->prepare($query4);
    $statement4->execute();
    $result4 = $statement4->fetchAll();
  }
  else{ 
  echo "<h1>hata</h1>";
  }
if(!empty($result3)){
    echo '<tr><td>';echo $row['id']; echo '</td><td>';
    echo $result4[0]['name'];echo '</td><td>';
    echo $row['created_at'];echo '</td><td>';
    echo $result2[0]['quantity'];echo '</td><td>';
    echo $row['total_price'];echo '</td><td>';
    echo $row['order_statüs'];echo '</td></tr>';
}
else{
  echo "<h1>hata</h1>";
}
}
?>
    
  </tbody>
  <tfoot>
    
    <form action="" method="POST">
    <tr>
      <td colspan="2"></td>
      <td colspan="1">
        <select class="form-select bg-light" aria-label="Default select example" name="id">
          <option selected>sipariş seç</option>
          <?php 
          
foreach($result as $row){
  echo '<option value="';echo $row['id'];echo '">';echo $row['id'];echo '</option>';

}
  ?>
      </td>
      <td><select class="form-select bg-light" aria-label="Default select example" name="durum">
  <option selected>sipariş durumu seç</option>
  <option value="1">sipariş alındı</option>
  <option value="2">sipariş hazırlanıyor</option>
  <option value="3">yola çıktı</option>
  <option value="4">sipariş teslim edildi</option>
</select></td>
      <td><button type="submit" class="btn btn-success" name="güncelle">sipariş durumunu güncelle</button></td>
    </tr>
    </form>
    <?php
    if(isset($_POST['güncelle'])){ 
      if($_POST['durum']==1 && !empty($_POST['id'])){
        $query = "UPDATE `order` SET `order_statüs`='sipariş alındı'  WHERE company_id={$result[0]['company_id']} AND id={$_POST['id']}";
        $statement = $pdo->prepare($query);
        $statement->execute();
        ob_end_clean();
        header("location: siparis_yönetim.php?message=sipariş durumu seçildi");
    }
    if($_POST['durum']==2 && !empty($_POST['id'])){
        $query = "UPDATE `order` SET `order_statüs`='sipariş hazırlanıyor' WHERE company_id={$result[0]['company_id']} AND id={$_POST['id']}";
        $statement = $pdo->prepare($query);
        $statement->execute();
        ob_end_clean();
        header("location: siparis_yönetim.php?message=sipariş durumu seçildi");
    }
    if($_POST['durum']==3 && !empty($_POST['id'])){
        $query = "UPDATE `order` SET `order_statüs`='yola çıktı' WHERE company_id={$result[0]['company_id']} AND id={$_POST['id']}";
        $statement = $pdo->prepare($query);
        $statement->execute();
        ob_end_clean();
        header("location: siparis_yönetim.php?message=sipariş durumu seçildi");
    }
    if($_POST['durum']==4 && !empty($_POST['id'])){
        $query = "UPDATE `order` SET `order_statüs`='sipariş teslim edildi' WHERE company_id= {$result[0]['company_id']} AND id={$_POST['id']}";
        $statement = $pdo->prepare($query);
        $statement->execute();
        ob_end_clean();
        header("location: siparis_yönetim.php?message=sipariş durumu seçildi");
    }
  }
    ?>
  </tfoot>
</table>

    </div>


</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>   
    
</body>
</html>