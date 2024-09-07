<?php 
$soru=$_POST['soru'];
$a=$_POST['cevap1'];
$b=$_POST['cevap2'];
$c=$_POST['cevap3'];
$d=$_POST['cevap4'];
$e=$_POST['cevap5'];
$Dogru_cevap=$_POST['Dogru-cevap'];
include '/functions/db.php';
$add="INSERT INTO sorular (soru,a,b,c,d,e,Dogru_Cevap) VALUES ('$soru','$a','$b','$c','$d','$e','$Dogru_cevap')";
$statment=$pdo->prepare($add);
$statment->execute();
header("Location: SoruEkle.php?message=Soru başarıyla eklendi. ");

?>