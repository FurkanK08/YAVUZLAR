<?php
function login($username,$password){
    include "db.php";
    $query="SELECT *,COUNT(1) as count  FROM users WHERE username='$username' AND password='$password'";
    $statement=$pdo->prepare($query);
    $statement->execute();
$result = $statement->fetch();
return $result;
}
