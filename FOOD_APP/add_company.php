<?php 
session_start();
ob_start();
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
<div class="container bg-light  border border-2 rounded" style="margin-top: 100px">
    
    <div class="row d-flex justify-content-center "  >
    <h1 class="my-5 d-flex justify-content-center">Firma Ekle</h1>
    <div class="col-md-4 gap-2 d-md-flex justify-content-center">
        <figure class="figure">
  <img src="/YEMEKapp/image/user.png" class="figure-img img-fluid rounded" alt="..." width="300">
</figure>
</div>

        <div class="col-md-4 my-5">
            <form action="" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
            <label for="formFile" class="form-label">Resimi Değiştir</label>
            <input class="form-control" type="file" id="formFile" accept="/image/*" name="image">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Firma Adı</label>
            <input type="text" class="form-control" id="exampleFormControlInput1" name="name">
        </div>
        <div class="mb-3">
            <label for="decription" class="form-label">Firma Acıklaması</label>
            <input type="text" class="form-control" id="decription" name="description">
        </div>
        <button type="submit" class="btn btn-primary d-flex text-align-center">Firma Ekle</button>
    </form>

</div>
    </div>
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>   
   
</body>
</html>
<?php 
if($_SERVER['REQUEST_METHOD'] === 'POST' ){
if(isset($_POST['name']) && isset($_POST['description'])&& isset($_FILES['image'])){
    $company_id = $_GET['id'];
    include './functions/db.php';
    $name = $_POST['name'];
    $description = $_POST['description'];
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
   $query = "INSERT INTO company(name,description,logo_path) VALUES('$name','$description','$target_file')";
   $statement = $pdo->prepare($query);
   $statement->execute();
    header("Location: add_company.php?message=firma eklendi");
    ob_end_clean();
}
else{
    header("Location: add_company.php?message=firma eklenemedi!");
    ob_end_clean();
} }
?>