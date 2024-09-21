<?php
function login($username){
    include './functions/db.php';
    $query="SELECT *,COUNT(1) as count  FROM users WHERE username='$username'";
    $statement=$pdo->prepare($query);
    $statement->execute();
$result = $statement->fetch();
return $result;
}
