<?php 
session_start();

session_unset();
session_destroy();

header("Location: Login.php?message=Çıkış Yapıldı!");
exit;
?>