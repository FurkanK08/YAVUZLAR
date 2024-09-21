<?php
$dbFile = 'db/db.db';
$db = new PDO('sqlite:' . $dbFile);


$username = 'admin';
$password = 'admin';
$password =password_hash($password, PASSWORD_ARGON2ID);

$statement = $db->prepare("SELECT COUNT(*) FROM users WHERE username = :username");
$statement->execute([':username' => $username]);

if ($statement->fetchColumn() == 0) {
    $db->exec("INSERT INTO users (username, password,name,surname,role) VALUES ('$username', '$password','admin','admin,'admin')");
    echo "Varsayılan kullanıcı eklendi.";
} else {
    echo "Varsayılan kullanıcı zaten mevcut.";
}
?>