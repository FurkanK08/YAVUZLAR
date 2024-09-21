<?php 
session_start();
if($_SESSION['username']!=null || $_SESSION['role']=="firma") {
}
else{
    header("Location: index.php?message=yetki yok!");
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
    <h1 class="my-5 d-flex justify-content-center">Yemek Ekle</h1>
    <div class="col-md-4 gap-2 d-md-flex justify-content-center">
        <figure class="figure">
  <img src="/YEMEKapp/image/user.png" class="figure-img img-fluid rounded" alt="..." width="300">
</figure>
</div>

        <div class="col-md-4 my-5">
            <form action="insert_food.php" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
            <label for="formFile" class="form-label">Resimi ekle</label>
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
        <button type="submit" class="btn btn-primary d-flex text-align-center">Yemek Ekle</button>
    </form>

</div>
    </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>   
    
</body>
</html>
