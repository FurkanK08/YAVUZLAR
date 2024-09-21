<?php

include './functions/db.php';
if(isset($_POST['sil'])){
    $id = $_POST['sil'];
    $query = "DELETE FROM basket WHERE id = {$id}";
    $statement = $pdo->prepare($query);
    $statement->execute();
    header("Location: sepet.php?message=Urun sepetten silindi!");
}


?>