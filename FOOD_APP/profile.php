<?php
session_start();
include './functions/db.php';
ob_start();

$username = $_SESSION['username'];
if($_SESSION['username']==null){
    header("Location: login.php?message=Lütfen Giriş Yapın!");
}
$query="SELECT * FROM users WHERE username='$username'";
$statement=$pdo->prepare($query);
$statement->execute();
$result = $statement->fetch();
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
    <div class="row">
        <div class="col-md-6 my-5">
        <div class="d-grid gap-2 d-md-flex justify-content-center">
        <figure class="figure">
  <img src="<?php echo $result['image_path']; ?>" class="figure-img img-fluid rounded" alt="..." style="object-fit: cover;" width="300" height="300">
</figure>
</div>
<div class="d-grid gap-2 d-md-flex justify-content-center">
<form method="POST" enctype="multipart/form-data"    >
        <div class="mb-3">
            <label for="formFile" class="form-label">Resimi Değiştir</label>
            <input class="form-control" type="file" id="formFile" accept="/image/*" name="image">
            <button type="submit" class="btn btn-primary my-1" name="resimguncelle" >Değiştir</button>
        </div>
        
    </form>
</div>
            </div>
        <div class="col-md-6 my-5">
            <h1 style="text-align: center;">Hosgeldiniz <?php echo $result['name']; ?></h1>
            <div class="text-center">
            <h2 style="text-align: center;">Hesap Bilgileri</h2>
            <ul class="list-group list-group-flush  ">
                <li class="list-group-item">Ad Soyad: <?php echo $result['name']; ?> <?php echo $result['surname']; ?></li>
                <li class="list-group-item">Kullanıcı Adı: <?php echo $result['username']; ?></li>
                <li class="list-group-item">Role: <?php echo $result['role']; ?></li>
                <li class="list-group-item">Bakiye: <?php echo $result['balance']; ?></li>
            </ul>
            <form action="profile.php" method="POST">
            <button class="btn btn-primary" name="action" value="yatır">Bakiye Yatır</button>
            <button class="btn btn-primary" name="action" value="cek">Bakiye Cek</button>
            <button class="btn btn-primary" name="action" value="sifre_degistir" >şifre değiştir</button>
            </form>
            </div>
        <?php 
        if(isset($_POST['action']) && $_POST['action']=='yatır'){
            echo'
            <form action="profile.php" method="POST">
            <div class="mb-3">
            <label for="balance" class="form-label">Yatırılacak Miktar</label>
            <input type="number" class="form-control" id="balance" name="balance">
            </div>
            <button type="submit"  class="btn btn-primary" name="yatırButton">Yatır</button>
            </form>
            '; }

            if(isset($_POST['action']) && $_POST['action']=='cek'){
                echo'
                <form action="profile.php" method="POST">
                <div class="mb-3">
                <label for="balance" class="form-label">Cekilecek Miktar</label>
                <input type="number" class="form-control" id="balance" name="balance">
                </div>
                <button type="submit" class="btn btn-primary" name="cekButton">Cek</button>
                </form>
                '; }
                if(isset($_POST['action']) && $_POST['action']=='sifre_degistir'){
                    echo'
                    <form action="profile.php" method="POST">
                    <div class="mb-3">
                    <label for="balance" class="form-label">Yeni Sifre</label>
                    <input type="password" class="form-control" id="sifre" name="sifre">
                    </div>
                    <button type="submit" class="btn btn-primary" name="sifreButton">Sifre değiştir</button>
                    </form>
                    '; }

        if(isset($_POST['sifreButton'])){
            $username = $_SESSION['username'];
            $password = $_POST['sifre'];
            $passwordHashed = password_hash($password, PASSWORD_ARGON2ID);
            $query = "UPDATE users SET password = '$passwordHashed' WHERE username = '$username'";
            $statement = $pdo->prepare($query);
            $statement->execute();
            header("Location: profile.php?message=Sifre Değiştirildi!");
            exit();
            ob_end_clean();
        }
            if(isset($_POST['cekButton'])){
                if($_POST['balance']>$result['balance']){
                    header("Location: profile.php?message=Bakiye Yetersiz!");
                    exit();
                    ob_end_clean();
                }
                elseif($_POST['balance']<=0){
                    header("Location: profile.php?message=Hatalı Miktar!");
                    exit();
                    ob_end_clean();
                }
                else{
                $username = $_SESSION['username'];
                $balance = $result['balance'] - $_POST['balance'];
                $query = "UPDATE users SET balance = '$balance' WHERE username = '$username'";
                $statement = $pdo->prepare($query);
                $statement->execute();
               header("Location: profile.php?message=Bakiye Cekildi!");
               exit();
               ob_end_clean();}
                
            } 
            if(isset($_POST['resimguncelle'])   && isset($_FILES['image'])){
                $username = $_SESSION['username'];
                $target_dir = "./image/";
                $target_file = $target_dir . basename($_FILES["image"]["name"]);
                $imageFileType= strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                if((move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)))
                {
                    
                   echo "dosya yüklendi";
                }
                else
                {
                    echo "dosya yüklemedi";
                    exit();
                }
                $query = "UPDATE users SET image_path = '$target_file' WHERE username = '$username'";
                $statement = $pdo->prepare($query);
                $statement->execute();
                header("Location: profile.php?message=Resim Eklendi!");
                exit();
                ob_end_clean();

            }
            
            
           if(isset($_POST['yatırButton'])){
            if($_POST['balance']<0){
                header("Location: profile.php?message=Bakiye Yetersiz!");
                exit();
                ob_end_clean();
            }
            else{
            $username = $_SESSION['username'];
            $balance = $result['balance'] + $_POST['balance'];
            $query = "UPDATE users SET balance = '$balance' WHERE username = '$username'";
            $statement = $pdo->prepare($query);
            $statement->execute();
           header("Location: profile.php?message=Bakiye Yatırıldı!");
           exit();
           ob_end_clean();}
        
    }

        ?>
            
    </div>
    </div>

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>
<?php

?>