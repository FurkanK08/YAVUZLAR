<?php
session_start();
include 'functions/functions.php';
if (!isset($_SESSION['id']) && !isset($_SESSION['username'])) {
header("Location: login.php?message=You are not logged in!");
    
}
if($_SESSION['id'] !=0){
    header("Location: index.php?message=Yetkili Değilsiniz!");
} 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="css/List.css">
</head>
<body>
    <div class="container">
    <div class="soru_ara">
        <form action="" method="GET">
        <input type="text" id="soru-ara" name="soru-ara" placeholder="soru İD giriniz">
        <button type="submit" id="ara">ara</button>
    </form>
    <?php 
    if(isset($_GET['soru-ara'])){
        $soru_ara = $_GET['soru-ara'];
        include '\functions\db.php';
        $query="SELECT * FROM sorular WHERE id='$soru_ara'";
        $statement=$pdo->prepare($query);
        $statement->execute();
        $result = $statement->fetch();
        if($result==null){
            header("Location: soruAra.php?message=Soru bulunamadı!");

        }

    }
    else{ 
        $soru_ara =0;
        include '\functions\db.php';
        $query="SELECT * FROM sorular WHERE id='$soru_ara'";
        $statement=$pdo->prepare($query);
        $statement->execute();
        $result = $statement->fetch();

    }
    
    ?>
    </div>
    <div class="table">
        <table>
            <thead>
                <tr>
                    <th>id</th>
                    <th>Soru</th>
                    <th>sil</th>
                    <th>düzenle</th>
                    <th>detay</th>
                </tr>
                <tr>
                    <td id="id"> <?php echo $result['id']; ?> </td>
                    <td id="soru"> <?php echo $result['soru']; ?></td>
                    <td><form action="" method="POST"  >
                    <button id="sil" name="sil" value="<?php echo $result['id']; ?>" >sil</button> </form></td>
                    <?php 
                    if(isset($_POST['sil'])){
                        $sil = $_POST['sil'];
                        include '\functions\db.php';
                        $query="DELETE FROM sorular WHERE id='$soru_ara'";
                        $statement=$pdo->prepare($query);
                        $statement->execute();
                        header("Location: soruAra.php?message=Soru Silindi!");
                        
                    }
                    
                    ?>
                        
                    <td><button id="duzenle" name="duzenle" value="<?php echo $result['id']; ?>"  onclick="window.location.href='SoruDüzenle.php'">duzenle</button></td>
                    <td><button id="detay" name="detay" value="<?php echo $result['id']; ?>" onclick="window.location.href='SoruDetay.php'" >detay</button"></td>
                </tr>
            </thead>
    </div>
</div>

<script src="script.js" ></script>    
</body>
</html>
<?php 
setcookie("id", $result['id'], time() + 900, "/");

?>