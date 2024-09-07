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

<div class="soru-ekle"> 
    <div class="container">
        <h1>Soru Ekle</h1>
        <div class="soru-form">
            <form action="AddSoru.php" method="POST">
                <input type="text" id="soru-ekle-input" name="soru" placeholder="Soru" required>
                <label >
                    <input type="text" id="cevap-ekle-input1" name="cevap1" placeholder="Cevap1" required>
                </label>
                <label >
                    <input type="text" id="cevap-ekle-input2" name="cevap2" placeholder="Cevap2" required>
                </label>
                <label >
                    <input type="text" id="cevap-ekle-input3" name="cevap3" placeholder="Cevap3" required>
                </label>
                <label >
                    <input type="text" id="cevap-ekle-input4" name="cevap4" placeholder="Cevap4" required>
                </label>
                <label >
                    <input type="text" id="cevap-ekle-input5" name="cevap5" placeholder="Cevap5" required >
                </label> <br>
                <label for="Dogru-cevap">Doğru cevabı seçiniz:

                    <select id="Dogru-cevap" name="Dogru-cevap">
                        <option value="a">1</option>
                        <option value="b">2</option>
                        <option value="c">3</option>
                        <option value="d">4</option>
                        <option value="e">5</option>
                       </select>
    
                </label>
                
                <button id="soru-ekle" >Soru ekle</button>   
            </form>
            
        </div>
    </div>
</div>
</body>
</html>