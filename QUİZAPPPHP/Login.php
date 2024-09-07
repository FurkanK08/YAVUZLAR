<?php 
  session_start();
  if (isset($_SESSION['id']) && isset($_SESSION['username']) ) {
    header("Location:index.php?message=You are already logged in!");
  }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>  
    <div class="container">
        <div class="login">
                <h1>LOGİN</h1>
                <form action="LoginQuery.php" method="post">
                <input class="loginInput" type="text" name="username" placeholder="Kullanıcı adı" required>
                <input class="loginInput" type="password" name="password" placeholder="Sifre" required>
                <button id="login-btn"  >Giriş yap</button>
                </form>
      
        </div>
    </div>
</body>
</html>