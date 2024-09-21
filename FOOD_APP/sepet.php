<?php 
session_start();
ob_start();
if($_SESSION['username']==null){
    header("Location: login.php?message=Lütfen Giriş Yapın!");
}
$user_id=$_SESSION['id'];
include './functions/db.php';
$query = "SELECT * FROM basket WHERE user_id = {$_SESSION['id']}";
$statement = $pdo->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
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
    <div class="container my-5">
        <h2>Sepetim</h2>
        <table class="table table-striped table-hover aling-middle">
            <thead>
                <tr>
                <th scope="col">Sil</th>
                    <th scope="col">#</th>
                    <th scope="col">Ürün Adı</th>
                    <th scope="col">Ürün Adedi</th>
                    <th scope="col">Fiyat</th>
                    <th scope="col">not</th>
                    <th colspan="1"></th>
                    
                </tr>
            </thead>
            
            <tbody class="table-group-divider">
                
                
                <?php
           
                foreach($result as $row){
                    $query = "SELECT * FROM food WHERE id = {$row['food_id']}";
                    $statement2 = $pdo->prepare($query);
                    $statement2->execute();
                    $result2 = $statement2->fetchAll();
                    echo' <tr>
                <td>
                <form action="delete_sepet_items.php" method="POST">
                <button class="btn  btn-sm btn-outline-danger" name="sil" value="'.$row['id'].'"  >sil</button>
                </form>
                <form action="" method="POST">
                    </td>
                    <th scope="row"><img src="'.$result2[0]['image_path'].'" alt="Makarna" width="50" height="50"></th>
                    <td>'.$result2[0]['name'].'</td>
                    <td>
                        <div class="input-group d-flex justify-content-center  " style="max-width: 120px;">
                            <button class="btn btn-outline-danger btn-sm" type="button" id="azalt">-</button>
                            <input type="text" class="form-control text-center" id="adet" value="'.$row['quantity'].'" readonly>
                            <button class="btn btn-outline-success btn-sm" type="button" id="arttir">+</button>
                        </div>
                    </td>';
                    if($result2[0]['discount']!=0){
                       $indirimli_tutar=$result2[0]['price']-($result2[0]['discount']);
                       echo '<td>'.$indirimli_tutar.'$</td>'; 
                    }
                    else{
                        echo '<td>'.$result2[0]['price'].'$</td>';
                    }
                    echo '
                    <td><input class="form-control  " type="text" name="note_'.$row['id'].'" placeholder="'.$row['note'].'" ></td>
                    <td ><button class="btn btn-md btn-warning" name="sipariş_ver" value="'.$row['id'].'">sipariş ver</button></td>
                    
                 

                    </td>
                    </form>
                </tr>'; 
                if(isset($_POST['sipariş_ver'])&& $_POST['sipariş_ver'] == $row['id']){
                    if(isset($_POST['note_'.$row['id']])){ 
                    $note = $_POST['note_'.$row['id']];
                    $query4 = "UPDATE basket SET note = '$note' WHERE id = {$row['id']}";
                    $statement4 = $pdo->prepare($query4);
                    $statement4->execute();
                    $query9="SELECT * FROM restaurant WHERE id = {$result2[0]['restaurant_id']}";
                    $statement9 = $pdo->prepare($query9);
                    $statement9->execute();
                    $result9 = $statement9->fetchAll();
                    if($result2[0]['discount']!=0){
                        $indirimli_tutar=$result2[0]['price']-($result2[0]['discount']);
                        $query5 = "UPDATE 'order' SET total_price = total_price + {$indirimli_tutar} , company_id = {$result9[0]['company_id']}  WHERE user_id = $user_id";
                        $statement5 = $pdo->prepare($query5);
                        $statement5->execute();
                    }
                    else{
                    $query5 = "UPDATE 'order' SET total_price = total_price + {$result2[0]['price']} , company_id = {$result9[0]['company_id']}  WHERE user_id = $user_id";
                    $statement5 = $pdo->prepare($query5);
                    $statement5->execute();
                    }
                    $query7="SELECT * FROM 'order' WHERE user_id = {$_SESSION['id']}";
                    $statement7 = $pdo->prepare($query7);
                    $statement7->execute();
                    $result7 = $statement7->fetchAll();
                    $query6="INSERT INTO order_items (food_id,order_id,quantity,price) VALUES ({$result2[0]['id']},{$result7[0]['id']},{$row['quantity']},'{$result2[0]['price']}')";
                    $statement6 = $pdo->prepare($query6);
                    $statement6->execute();
                    $query7="DELETE FROM basket WHERE id = {$row['id']}";
                    $statement7 = $pdo->prepare($query7);
                    $statement7->execute();
                    ob_end_clean();
                    header("Location: sepet.php?message=Sipariş verildi!");
                 }
                 

                }      

                }

                ?>
                </form>
            </tbody>
            <tfoot>
                <td colspan="6"></td>
            </tfoot>
        </table>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script>
    const AzaltButton = document.getElementById('azalt');
    const AdetButton = document.getElementById('adet');
    const arttirInput = document.getElementById('arttir');

    AzaltButton.addEventListener('click', () => {
        if (AdetButton.value > 1) {
            AdetButton.value--;
        }
    });

    arttirInput.addEventListener('click', () => {
        AdetButton.value++;
    });
</script>
</body>
</html>