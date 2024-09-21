<?php
session_start();
include '/functions/functions.php';
if(!isset($_POST['username']) && isset($_POST['password'])){
    header("hatalı giriş yaptınız. ");
    die();
 }
 else{ 
    $username = $_POST['username'];
    $password = $_POST['password'];
    $result=login($username,$password);
   if($result['count'] == 1){
    $_SESSION['id'] = $result['id'];
    $_SESSION['username'] = $result['username'];
    header("Location: index.php?id=".$result['id']) ;
    die();
   }
   else{
    header("location: login.php?message=hatalı giriş yaptınız. ");
    die();
   }

 }
?>