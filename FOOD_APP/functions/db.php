<?php 
try{
    
    $pdo = new PDO('sqlite:/var/www/html/db/db.db'); 
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    
}
catch(\Throwable $th){ 
 echo "hata" . $th;
}


?>