<?php
session_start();
include 'functions/functions.php';
if (!isset($_SESSION['id']) && !isset($_SESSION['username'])) {
  header("Location: login.php?message=You are not logged in!");
} 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Quiz</title>
</head>
<body>
    <div class="container">
         
    <div class="Admin-Panel" >
    <button id="logout" onclick="location.href='logout.php'">Logout</button>
        <button id="adminPanel"onclick="location.href='AdminPanel.php'">Admin Panel</button>
    </div>
    <div class="Quiz-panel" >
        <button  id="quizPanel" onclick="location.href='QuizPage.php'">Quiz Panel</button>
        <button id="Skore" onclick="location.href='ScoreBoard.php'">Skor</button>
    </div>

</div>
</body>
</html>