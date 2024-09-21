<?php
session_start();
if($_SESSION['username']!=null || $_SESSION['role']=="firma") {
}
else{
    header("Location: index.php?message=yetki yok!");
}
if(isset($_GET['id'])){
    $id = $_GET['id'];
}
else{
    header("Location: company_panel.php?message=yemek bulunamadı!");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    </head>
<body>
<?php include 'navbar.php'; ?>
<div class="container bg-light  border border-2 rounded" style="margin-top: 50px">
    
    <div class="row d-flex justify-content-center "  >
    <h1 class="my-5 d-flex justify-content-center">Yemek Güncelle</h1>
    <div class="col-md-4 gap-2 d-md-flex justify-content-center">
        <figure class="figure">
  <img src="/YEMEKapp/image/user.png" class="figure-img img-fluid rounded" alt="..." width="300">
</figure>
</div>

        <div class="col-md-4 my-5">
            <form action="" method="POST" enctype="multipart/form-data" >
            <div class="mb-3">
            <label for="formFile" class="form-label">Resimi değiştir</label>
            <input class="form-control" type="file" id="formFile" accept="/image/*" name="image">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Yemek Adı:</label>
            <input type="text" class="form-control" id="exampleFormControlInput1" name="name">
        </div>
        <div class="mb-3">
            <label for="decription" class="form-label">Yemek Acıklaması</label>
            <input type="text" class="form-control" id="decription" name="description">
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Fiyat</label>
            <input type="number" class="form-control" id="price" name="price">
        </div>
        <button type="submit" class="btn btn-primary d-flex text-align-center">güncelle</button>
    </form>
    <?php 
if(isset($_POST['name']) && isset($_POST['description'])&&isset($_POST['price'])&& isset($_FILES['image'])){
    include './functions/db.php';
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $target_dir = "./image/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    if(move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)){
        echo "dosya yüklendi";
    }
    else{
        echo "dosya yüklemedi";
        exit();
    }

    $query = "UPDATE food SET name = '$name', description = '$description', price = '$price', image_path = '$target_file' WHERE id = $id";
    $statement = $pdo->prepare($query);
    $statement->execute();
    header("Location: company_panel.php?message=Yemek güncellendi!");
}
?>

</div>
    </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>   

</body>
</html>
