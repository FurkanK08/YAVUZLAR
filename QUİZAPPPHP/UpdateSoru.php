<?php
$id=$_COOKIE['id'];
$soru=$_POST['soru'];
$a=$_POST['A'];
$b=$_POST['B'];
$c=$_POST['C'];
$d=$_POST['D'];
$e=$_POST['E'];
$Dogru_cevap=$_POST['Dogru-cevap-duzenle'];
include '/functions/db.php';
$update="UPDATE sorular SET soru='$soru',a='$a',b='$b',c='$c',d='$d',e='$e',Dogru_Cevap='$Dogru_cevap' WHERE id='$id'";
$statment=$pdo->prepare($update);
$statment->execute();
header("Location: SoruDüzenle.php?message=Soru güncellendi. ");    


?>