<?php
session_start();
include 'functions/functions.php';
if (!isset($_SESSION['id']) && !isset($_SESSION['username'])) {
    header("Location: login.php?message=You are not logged in!");
    exit();
}
$user_id=$_SESSION['id'];
include 'functions/db.php';
$query2="SELECT * FROM Score_Log WHERE id='$user_id'";
$statement2=$pdo->prepare($query2);
$statement2->execute();
$result2 = $statement2->fetch();


if (isset($_COOKIE['quiz'])) {
    $id = $_COOKIE['quiz'];
} else {
    $id = 0;
}
$query = "SELECT * FROM sorular WHERE id='$id'";
$statement = $pdo->prepare($query);
$statement->execute();
$result = $statement->fetch();


if ($_SERVER['REQUEST_METHOD'] == 'GET' && (isset($_GET['a']) || isset($_GET['b']) || isset($_GET['c']) || isset($_GET['d']) || isset($_GET['e']) || isset($_GET['next']))) {  
    $cevap = $_GET['a'] ?? $_GET['b'] ?? $_GET['c'] ?? $_GET['d'] ?? $_GET['e'];
    $Dogru_cevap = $result['Dogru_Cevap'];
    $dogru_sayısı=(int)$result2['dogru_sayısı'];
    $yanlis_sayısı=(int)$result2['yanlıs_sayısı'];
    $soru_sayısı=(int)$result2['soru_sayısı'];
    $score=(int)$result2['score'];
    if ($cevap == $result[$Dogru_cevap]) {
        
        $dogru_sayısı += 1;
        $soru_sayısı += 1;
        $score += 5;
    }
    else {
        $yanlis_sayısı += 1;
        $soru_sayısı += 1;
    }
    $update="UPDATE Score_Log SET dogru_sayısı='$dogru_sayısı',yanlıs_sayısı='$yanlis_sayısı',soru_sayısı='$soru_sayısı',score='$score' WHERE id='$user_id'";
    $statment=$pdo->prepare($update);
    $statment->execute();
    ++$id;
    setcookie("quiz", $id, time() + 86400, "/");
}



header("Location: QuizPage.php");

