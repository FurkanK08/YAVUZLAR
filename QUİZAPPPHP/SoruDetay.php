<?php
session_start();
include 'functions/functions.php';
if (!isset($_SESSION['id']) && !isset($_SESSION['username'])) {
    
    
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
    <title>Document</title>
    <link rel="stylesheet" href="css/List.css">
</head>
<body>
<div class="detay">
<div class="container">
    <div class="table">
        <table>
            <thead>
                <tr>
                    <th>Soru</th>
                    <th>A</th>
                    <th>B</th>
                    <th>C</th>
                    <th>D</th>
                    <th>E</th>
                    <th>Dogru Cevap</th>
                </tr>
                <tr>
                <?php 
    if(isset($_COOKIE['id'])){
        $soru_ara = $_COOKIE['id'];
        include '\functions\db.php';
        $query="SELECT * FROM sorular WHERE id='$soru_ara'";
        $statement=$pdo->prepare($query);
        $statement->execute();
        $result = $statement->fetch();
    }
    
    ?>
                    
                    <td id="soru"><?php echo $result['soru']; ?></td>
                    <td id="A"> <?php echo $result['a']; ?> </td>
                    <td id="B"> <?php echo $result['b']; ?> </td>
                    <td id="C"><?php echo $result['c']; ?> </td>
                    <td id="D"><?php echo $result['d']; ?> </td>
                    <td id="E"><?php echo $result['e']; ?> </td>
                    <td id="E"><?php echo $result['Dogru_Cevap']; ?> </td>
                </tr>
            </thead>
    </div>
</div>
</div>
<script src="soruDetay.js" ></script>
<body>
    
</body>
</html>