<?php
session_start();

if (isset($_POST['checkout'])) {
    $link = mysqli_connect("localhost", "root", getenv('DB_PASSWORD') ?: '', "group_17") // 建立MySQL的資料庫連結
    or die("無法開啟MySQL資料庫連結!<br>");

    // 送出編碼的MySQL指令
    mysqli_query($link, 'SET CHARACTER SET utf8');
    mysqli_query($link, "SET collation_connection = 'utf8_unicode_ci'");

    $randomNumber = random_int(10000000, 20000000);
    $varcharValue = (string) $randomNumber;
    echo $varcharValue;
    foreach ($_SESSION['cart'] as $key)
    {
        $sql = "insert into cart values ('test','" . $key['language'] . "','" . $key['product_id'] . "','" . $key['quantity'] . "','".$randomNumber."')";
        if ($result = mysqli_query($link, $sql)) // 送出查詢的SQL指令
    {

    } else {

    }
    }
    session_unset();
}
?>

<?php

require_once ("CreateDb.php");
require_once ("component.php");

$db_c = new CreateDb("group_17", "chinese_album");
$db_e = new CreateDb("group_17", "english_album");
$db_j = new CreateDb("group_17", "japanese_album");

if (isset($_POST['remove'])) {
    if ($_GET['action'] == 'remove') {
        // echo "<script>alert('".$_GET['id'].",".$_GET['language']."')</script>";
        foreach ($_SESSION['cart'] as $key => &$item) {
            if ($item["product_id"] == $_GET['id'] && $item["language"] == $_GET['language']) {
                unset($_SESSION['cart'][$key]);
                echo "<script>alert('Product has been Removed...!')</script>";
                echo "<script>window.location = 'cart.php'</script>";
            }
        }
    }
}
if (isset($_POST['minus'])) {
        foreach ($_SESSION['cart'] as $key => &$item) {
            if ($item["product_id"] == $_GET['id'] && $item["language"] == $_GET['language'] && $item["quantity"]>1) {
                $item["quantity"]--;
            }
        }
}
if (isset($_POST['add'])) {
        // echo "<script>alert('".$_GET['id'].",".$_GET['language']."')</script>";
        foreach ($_SESSION['cart'] as $key => &$item) {
            if ($item["product_id"] == $_GET['id'] && $item["language"] == $_GET['language']) {
                $item["quantity"]++;
                // echo "<script>alert('Product has been Removed...!')</script>";
                // echo "<script>window.location = 'cart.php'</script>";
            }
        }
}



?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cart</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.css" />

    <!-- Bootstrap CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-light">
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Creative - Start Bootstrap Theme</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap Icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic"
        rel="stylesheet" type="text/css" />
    <!-- SimpleLightbox plugin CSS-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
    <link href="css/shop.css" rel="stylesheet" />
</head>

<body id="page-top">
    <!-- Navigation-->
    <?php include("nav.php"); ?>

   
</body>

</html>

<div class="container-fluid">
    <div class="row px-5">
        <div class="col-md-7">
            <div class="shopping-cart">
                <h6>My Cart</h6>
                <hr>

                <?php

                // foreach ($_SESSION['cart'] as $key => $value)
                // {
                //     var_dump($value['product_id'],$value['language'],'<br>');
                // }

                $total = 0;
                if (isset($_SESSION['cart'])){
                    $product_id = array_column($_SESSION['cart'], 'product_id');
                    $product_language = array_column($_SESSION['cart'], 'language');

                    $result = $db_c->getData();
                    while ($row = mysqli_fetch_assoc($result)){
                        foreach ($_SESSION['cart'] as $key)
                        {
                            if($key['product_id'] == $row['no'] && $key['language'] == 'chinese')
                            {
                                cartElement($row['img'], $row['name'],$row['price'], $row['no'],'chinese',$key['quantity']);
                                $total = $total + (int)$row['price']*$key['quantity'];
                            }
                        }
                    }
                    $result = $db_e->getData();
                    while ($row = mysqli_fetch_assoc($result)){
                        foreach ($_SESSION['cart'] as $key)
                        {
                            if($key['product_id'] == $row['no'] && $key['language'] == 'english')
                            {
                                cartElement($row['img'], $row['name'],$row['price'], $row['no'],'english',$key['quantity']);
                                $total = $total + (int)$row['price']*$key['quantity'];
                            }
                        }
                    }
                    $result = $db_j->getData();
                    while ($row = mysqli_fetch_assoc($result)){
                        foreach ($_SESSION['cart'] as $key)
                        {
                            if($key['product_id'] == $row['no'] && $key['language'] == 'japanese')
                            {
                                cartElement($row['img'], $row['name'],$row['price'], $row['no'],'japanese',$key['quantity']);
                                $total = $total + (int)$row['price']*$key['quantity'];
                            }
                        }
                    }

                    // $result = $db_c->getData();
                    // while ($row = mysqli_fetch_assoc($result)){                       
                    //     for ($i = 0; $i < count($product_id); $i++) {
                    //         // var_dump($row['no'], $product_id[$i], $product_language[$i]);
                    //         if (isset($product_id[$i]) && isset($product_language[$i])){
                    //         $id = $product_id[$i];
                    //         $language = $product_language[$i];
                    //         ;
                    //         }
                    //         if ($row['no'] == $id && $language == 'chinese'){
                    //             cartElement($row['img'], $row['name'],$row['price'], $row['no'],'chinese');
                    //             $total = $total + (int)$row['price'];
                    //         }
                    //     }
                    // }
                    // $result = $db_e->getData();
                    // while ($row = mysqli_fetch_assoc($result)){
                    //     for ($i = 0; $i < count($product_id); $i++) {
                    //         if (isset($product_id[$i]) && isset($product_language[$i])){
                    //             $id = $product_id[$i];
                    //             $language = $product_language[$i];
                    //             }
                    //         if ($row['no'] == $id && $language == "english"){
                    //             cartElement($row['img'], $row['name'],$row['price'], $row['no'],'english');
                    //             $total = $total + (int)$row['price'];
                    //         }
                    //     }
                    // }
                }else{
                    echo "<h5>Cart is Empty</h5>";
                }

                ?>

            </div>
        </div>
        <div class="col-md-4 offset-md-1 border rounded mt-5 bg-white h-25">

            <div class="pt-4">
            <form method="post" action="./cart.php">
                <h6>PRICE DETAILS</h6>
                <hr>
                <div class="row price-details">
                    <div class="col-md-6">
                        <?php
                            if (isset($_SESSION['cart'])){
                                $count  = count($_SESSION['cart']);
                                echo "<h6>Price ($count items)</h6>";
                            }else{
                                echo "<h6>Price (0 items)</h6>";
                            }
                        ?>
                        <h6>Delivery Charges</h6>
                        <hr>
                        <h6>Amount Payable</h6>
                    </div>
                    <div class="col-md-6">
                        <h6>$<?php echo $total; ?></h6>
                        <h6 class="text-success">FREE</h6>
                        <hr>
                        <h6>$<?php
                            echo $total;
                            ?></h6>
                    </div>
                </div>
                <button type="submit" class="btn btn-danger mx-2" name="checkout">结账</button>
                <input type="hidden" name="total" value="<?php $total ?>">
            </form>
            </div>

        </div>
    </div>
</div>



<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>