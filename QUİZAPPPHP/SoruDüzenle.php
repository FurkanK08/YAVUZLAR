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
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="Duzenle" >
    <div class="container">
        
        <h1>Soru Düzenle</h1>
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
    <form id="SoruDuzenle" action="UpdateSoru.php" method="POST" >
        <div id="form-Duzenle">
            <label for="soru">Soru: <?php echo $result['soru']; ?> </label><br>
            <input type="text" id="soru-I" name="soru"   autofocus>
        </div>
       
       
        <div id="form-Duzenle">
            <label for="a">A: <?php echo $result['a']; ?></label><br>
            <input type="text" id="A-I" name="A" >
        </div>
      
        <div id="form-Duzenle">
            <label for="b">B: <?php echo $result['b']; ?></label><br>
            <input type="text" id="B-I" name="B" >
        </div>
        <div id="form-Duzenle">
            <label for="c">C: <?php echo $result['c']; ?></label><br>
        <input type="text" id="C-I" name="C" >
        </div>
        <div id="form-Duzenle">
            <label for="d">D: <?php echo $result['d']; ?></label><br>
        <input type="text" id="D-I" name="D" >
        </div>
        <div id="form-Duzenle">
            <label for="e">E: <?php echo $result['e']; ?></label><br>
        <input type="text" id="E-I" name="E" >
        </div>
        <div class="form-duzenle">
        <label for="Dogru-cevap-duzenle">Doğru cevabı seçiniz:

            <select id="Dogru-cevap-duzenle" name="Dogru-cevap-duzenle">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
               </select>

        </label>
    </div>
        
            <button id="kaydet">Kaydet</button> 
    </form>

</div>
</div>
<script src="SoruDuzenle.js"></script>
</body>
</html>