<?php
    session_start();
include './functions/functions.php';
if(!isset($_POST['username']) && isset($_POST['password'])){
    header("username veya sifre hatalı");
    die();
 }
 else{ 
    $username = $_POST['username'];
    $password = $_POST['password'];
    $result=login($username);
   if( password_verify($password, $result['password'])){
    $_SESSION['username'] = $result['username'];
    $_SESSION['id'] = $result['id'];
    $_SESSION['company_id'] = $result['company_id'];
    $_SESSION['role'] = $result['role'];
    header("Location: index.php?id=".$_SESSION['id']);  ;
    die();
   }
   else{
    header("location: login.php?message=hatalı giriş yaptınız. ");
    die();
   }

 }
?>