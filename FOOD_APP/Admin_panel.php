<?php
session_start();
if($_SESSION['username']==null || $_SESSION['username']!="admin"){
    header("Location: index.php?message=yetki yok!");
}
ob_start();
include './functions/db.php';
$query = "SELECT * FROM users";
$statement = $pdo->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
$query2 = "SELECT * FROM company";
$statement2 = $pdo->prepare($query2);
$statement2->execute();
$result2 = $statement2->fetchAll();
$query3= "SELECT * FROM cupon";
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

<div class="container">
    <h1 class="my-5 d-flex justify-content-center">Admin Panel</h1>

    <div class="row">
    
    <div class="col-md-6 my-5">
            
            <form class="d-flex form-inline" action="" method="POST">
          <input class="form-control " type="search" placeholder="name" name="name" aria-label="Search">
            <select class="form-select" aria-label="Tüm hepsi" name="filter">
              <option selected value="default">Filtrele</option>
              <option value="1">tümü</option>
              <option value="2">silinmiş</option>
              <option value="3">aktif</option>
            </select>
    
        
          <button class="btn btn-outline-success " type="submit" name="search" >Search</button>
        </form>
        <?php 
        if(isset($_POST['search'])){
          if(isset($_POST['name'])){
            $name = $_POST['name'];
          }
            $filter = $_POST['filter'];
            if($filter==1 || $filter=="default"){
              if(isset($name)){
                $query="SELECT * FROM users WHERE name LIKE '%".$name."%'";}
              else{
                $query="SELECT * FROM users";
              }
                $statement=$pdo->prepare($query);
                $statement->execute();
                $result = $statement->fetchAll();
            }
            if($filter==2){
              if(isset($name)){
                $query="SELECT * FROM users WHERE deleted_at IS NOT NULL AND name LIKE '%".$name."%'";
            }
              else{
                $query="SELECT * FROM users WHERE deleted_at IS NOT NULL";
              }
                $statement=$pdo->prepare($query);
                $statement->execute();
                $result = $statement->fetchAll();
            }
            if($filter==3){
                if(isset($name)){
                    $query="SELECT * FROM users WHERE deleted_at IS NULL AND name LIKE '%".$name."%'";
                }
                else{
                $query="SELECT * FROM users WHERE deleted_at IS NULL";
                }
                $statement=$pdo->prepare($query);
                $statement->execute();
                $result = $statement->fetchAll();
            }
        }
        
        ?>
      
            <table class="table my-5">
      <thead>
        <tr>
          <th scope="col">Sil</th>
          <th scope="col">id</th>
          <th scope="col">isim</th>
          <th scope="col">soyisim</th>
          <th scope="col">kullanıcı adı</th>
         
        </tr>
      </thead>
      <tbody>
        <tr>
          <?php
          foreach($result as $row){
              echo "<td><a href='delete.php?id=$row[id]' class='btn btn-outline-danger'>Sil</a></td>";
              echo "<td>$row[id]</td>";
              echo "<td>$row[name]</td>";
              echo "<td>$row[surname]</td>";
              echo "<td>$row[username]</td> </tr>";
               }

        ?>
      </tbody>
      <tfoot class="table-group-divider" >
    <tr>
      <td colspan="6"></td>

    </tr>
  </tfoot>
    </table>
    </div>

       
        <div class="col-md-6 my-5">
            
            <form class="d-flex form-inline" action="" method="POST">
          <input class="form-control " type="search" placeholder="Search" name="name_company" aria-label="Search">
         
    
            <select class="form-select" aria-label="Tüm hepsi" name="filter_company">
              <option selected value="default">Filtrele</option>
              <option value="1">tümü</option>
              <option value="2">silinmiş</option>
              <option value="3">aktif</option>
            </select>
    
        
          <button class="btn btn-outline-success " name="search_company" type="submit">Search</button>
        </form>
        <?php
        if(isset($_POST['search_company'])){
          if(isset($_POST['name_company'])){
            $name_company = $_POST['name_company'];
          }
            $filter_company = $_POST['filter_company'];
            if($filter_company==1 || $filter_company=="default"){
              if(isset($name_company)){
                $query2="SELECT * FROM company WHERE name LIKE '%".$name_company."%'";}
              else{
                $query2="SELECT * FROM company";
              }
                $statement2=$pdo->prepare($query2);
                $statement2->execute();
                $result2 = $statement2->fetchAll();
            }
            if($filter_company==2){
              if(isset($name_company)){
                $query2="SELECT * FROM company WHERE deleted_at IS NOT NULL AND name LIKE '%".$name_company."%'";
            }
              else{
                $query2="SELECT * FROM company WHERE deleted_at IS NOT NULL";
              }
                $statement2=$pdo->prepare($query2);
                $statement2->execute();
                $result2 = $statement2->fetchAll();
            }
            if($filter_company==3){
                if(isset($name_company)){
                    $query2="SELECT * FROM company WHERE deleted_at IS NULL AND name LIKE '%".$name_company."%'";
                }
                else{
                $query2="SELECT * FROM company WHERE deleted_at IS NULL";
                }
                $statement2=$pdo->prepare($query2);
                $statement2->execute();
                $result2 = $statement2->fetchAll();
            }
        }

          
?>
      
            <table class="table my-5">
      <thead>
        <tr>
          <th scope="col">Sil</th>
          <th scope="col">id</th>
          <th scope="col">isim</th>
          <th scope="col">tanım</th>
          <th scope="col">gösel</th>
          <th scope="col">Güncelle</th>
        </tr>
      </thead>
      <tbody>
        <?php 

        foreach($result2 as $row){
            echo "<td><a href='delete_company.php?id=$row[id]' class='btn btn-outline-danger'>Sil</a></td>";
            echo "<td>$row[id]</td>";
            echo "<td>$row[name]</td>";
           echo "<td>$row[description]</td>";
            echo "<td><img src='$row[logo_path]' width='50'></td>";
            echo "<td><a href='updated_company.php?id=$row[id]' class='btn btn-outline-success'>Güncelle</a></td> </tr>"; }

        ?>
      </tbody>
      <tfoot class="table-group-divider" >
    <tr>
     <td colspan="5"></td>
     <td colspan="1"><button class="btn btn-outline-success" onclick="window.location.href='add_company.php'">firma ekle</a></td>
 

    </tr>
  </tfoot>
    </table>
    </div>
        </div>
    <div class="card">

    </div>
    <div class="col-md-6 my-5">
            <h2>Kupon Yönetimi</h2>
            <form action="" method="POST">
                <div class="mb-3">
                    <label for="couponName" class="form-label">Kupon İsmi</label>
                    <input type="text" class="form-control" id="couponName" name="coupon_name" placeholder="Kupon Adı">
                </div>
               
                <div class="mb-3">
                   <label for="restaurantid" class="form-label">Kupon Kodu</label>
                    <input type="text" class="form-control" id="couponRestaurant" name="restaurant_id" placeholder="Restaurant id"> 
                </div>
                <div class="mb-3">
                    <label for="couponDiscount" class="form-label">İndirim Tutarı</label>
                    <input type="number" class="form-control" id="couponDiscount" name="coupon_indirim" placeholder="indirim">
                </div>
                <button type="submit" name="coupon_ekle" class="btn btn-success">Kupon Ekle</button>
            </form>
            <?php
            if(isset($_POST['coupon_ekle'])){
               if(isset($_POST['coupon_name'])  && isset($_POST['restaurant_id']) && isset($_POST['coupon_indirim'])){
                $coupon_name = $_POST['coupon_name'];
                $restaurant_id = $_POST['restaurant_id'];
                $coupon_indirim = $_POST['coupon_indirim'];
                $query = "INSERT INTO cupon (name, restaurant_id, discount) VALUES ('$coupon_name', '$restaurant_id', '$coupon_indirim')";
                $statement = $pdo->prepare($query);
                $statement->execute();
                header("Location: ".$_SERVER['PHP_SELF']);
                ob_end_clean();
                exit;
            } 
          }
            ?>

            <table class="table my-5">
                <thead>
                    <tr>
                        <th scope="col">Sil</th>
                        <th scope="col">Kupon ID</th>
                        <th scope="col">Kupon İsmi</th>
                        <th scope="col">İndirim</th>
                        
                    </tr>
                </thead>
                <tbody>
                  
                    <?php 
                    foreach($result3 as $row){
                        echo "<tr><td><a href='delete.cupon.php?id=$row[id]' class='btn btn-outline-danger'>Sil</a></td>";
                        echo "<td>$row[id]</td>";
                        echo "<td>$row[name]</td>";
                        echo "<td>$row[discount] $</td> </tr>";
                        $query = "SELECT * FROM restaurant WHERE id = {$row['restaurant_id']}";
                    $statement = $pdo->prepare($query);
                    $statement->execute();
                    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                    $query2= "UPDATE food SET discount = {$row['discount']} WHERE restaurant_id = {$row['restaurant_id']}";
                    $statement2 = $pdo->prepare($query2);
                    $statement2->execute();
                        
                    }
                    
                    ?>
                    
                </tbody>
            </table>
        </div>
        

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>   
</body>
</html>