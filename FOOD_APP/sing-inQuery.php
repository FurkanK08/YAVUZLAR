<?php
if(isset($_POST['name']) && isset($_POST['surname']) && isset($_POST['username'])  && isset($_POST['password']) ){
$name = $_POST['name'];
$surname = $_POST['surname'];
$username = $_POST['username'];
$password = $_POST['password'];
$hashedPassword= password_hash($password, PASSWORD_ARGON2ID);

include './functions/db.php';

$query = "INSERT INTO users(name,surname,username,password) VALUES('$name','$surname','$username','$hashedPassword')";
$statement = $pdo->prepare($query);
$statement->execute();
header("Location: sing-in.php?message=Kayıt Başarılı!");
}
else{
    header("Location: sing-in.php?message=Hatalı Giriş!");
}
?>