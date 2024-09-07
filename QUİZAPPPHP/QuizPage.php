<?php
session_start();
include '/functions/functions.php';
if (!isset($_SESSION['id']) && !isset($_SESSION['username'])) {
  header("Location: login.php?message=You are not logged in!");
} 
?>
<?php 

         $id=$_COOKIE['quiz'];
         include '\functions\db.php';
         $query="SELECT * FROM sorular WHERE id='$id'"; 
         $statement=$pdo->prepare($query);
         $statement->execute();
         $result = $statement->fetch(); 
         if (!$result) {
            $id = 0; 
            setcookie("quiz", $id, time() + 86400, "/");
            header("Location: index.php");
        }
     
     
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    
<div class="app">
    <h1>Quiz</h1>
    <div class="quiz">
        <h2 id="soru" >Soru: <?php echo $result['soru']; ?> </h2> 
       <form action="Quiz.php" method="GET">
        <input type="submit" id="cevap" name="a" value="<?php echo $result['a']; ?>"  >
        <input type="submit" id="cevap" name="b" value="<?php echo $result['b']; ?>" >
        <input type="submit" id="cevap" name="c" value="<?php echo $result['c']; ?>">
        <input type="submit" id="cevap" name="d" value="<?php echo $result['d']; ?>" >
        <input type="submit" id="cevap" name="e" value="<?php echo $result['e']; ?>" >
        <button id="sonraki" >Boş Bırak</button>
       </form>
    </div>
</div>

</body>
</html>