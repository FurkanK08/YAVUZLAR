<?php 
try{
    $pdo = new PDO('sqlite:C:\XAMPP\htdocs\PHPÖDEV2\db\db.db');
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
}
catch(\Throwable $th){ 
 echo "hata" . $th;
}


?>