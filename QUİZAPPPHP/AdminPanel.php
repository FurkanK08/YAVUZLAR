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
    <title>Admin PANEL</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
    
     <div class="soru-ara">
     <button id="soru-ara" onclick="window.location.href='soruAra.php'" >Soru ara</button>
     </div>
     <div class="soru_ekle">
         <button id="soru-ekle" onclick="window.location.href='SoruEkle.php'" >Soru ekle</button>
     </div>
    </div>
</body>
</html>