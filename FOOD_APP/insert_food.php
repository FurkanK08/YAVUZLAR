<?php 
session_start();
if(isset($_POST['name']) && isset($_POST['description']) && isset($_POST['price']) && isset($_FILES['image'])){
    include './functions/db.php';
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $target_dir = "./image/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $imageFileType= strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    if(move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)){
        echo "dosya yüklendi";
    }
    else{
        echo "dosya yüklemedi";
        exit();
    }
    $query = "SELECT * FROM users where id={$_SESSION['id']}";
    $statement = $pdo->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $company_id=$result[0]['company_id'];
    $query2 = "SELECT * FROM restaurant where id={$company_id}";
    $statement2 = $pdo->prepare($query2);
    $statement2->execute();
    $result2 = $statement2->fetchAll();
    $restaurant_id=$result2[0]['id'];
    $query3 = "INSERT INTO food(restaurant_id,name,description,price,image_path) VALUES('$restaurant_id','$name','$description','$price','$target_file')";
    $statement = $pdo->prepare($query3);
    $statement->execute();
    header("Location: company_panel.php?message=Yemek Eklendi!");
}
else{
    header("Location: company_panel.php?message=Yemek Eklenemedi!");
}
?>