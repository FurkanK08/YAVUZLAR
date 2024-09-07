<?php
session_start();
include 'functions/functions.php';
if (!isset($_SESSION['id']) && !isset($_SESSION['username'])) {
       
}
 
?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SKOREBOARD</title>
    <link rel="stylesheet" href="css/List.css">
</head>
<body>
<div class="detay">
<div class="container">
    <div class="table">
    <?php 
    if(isset($_SESSION['id'])){
        $id = $_SESSION['id'];
        include '\functions\db.php';
        $query="SELECT * FROM Score_Log WHERE id='$id'";
        $statement=$pdo->prepare($query);
        $statement->execute();
        $result = $statement->fetch();
    }
    ?>
        <table>
            <thead>
                <tr>
                    <th>Toplam Çözülen Soru Sayısı</th>
                    <th>Toplam Doğru Cevaplarınız</th>
                    <th>Toplam Yanlış Cevaplarınız</th>
                    <th>Skor'unuz</th>
                </tr>
                <tr>
                    
                    <td id="soru"><?php echo $result['soru_sayısı']; ?></td>
                    <td id="A"><?php echo $result['dogru_sayısı']; ?> </td>
                    <td id="B"><?php echo $result['yanlıs_sayısı']; ?> </td>
                    <td id="C"><?php echo $result['score']; ?> </td>
                    
                </tr>
            </thead>
    </div>
</div>
</div>
<body>
    
</body>
</html>