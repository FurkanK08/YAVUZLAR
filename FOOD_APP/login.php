<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href='css/login.css'></link>
</head>
<body>
    <div class="container">
        
        <form action="loginQuery.php" method="POST"  >
        <h1>login</h1>  
            <input type="text" name="username" id="username" placeholder="username" required>
            <input type="password" name="password" id="password" placeholder="password" required>
            <button type="submit" name="login">login</button>
        </form>
    </div>
    
</body>
</html>