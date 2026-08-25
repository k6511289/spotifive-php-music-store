<?php
session_start();
if (isset($_POST['add'])){
    echo "<script>alert('Product is already added in the cart..!')</script>";
    if(isset($_SESSION['cart'])){

        $item_array_id = array_column($_SESSION['cart'], "product_id");
        $item_array_language = array_column($_SESSION['cart'], "language");

        $test = 0;
        foreach ($_SESSION['cart'] as &$key)
        {
            if(($_POST['add'] == $key['product_id']) && ($_POST['language'] == $key['language']))
            {
                $test = 1;
                $key['quantity'] = $key['quantity']+1;
            }
        }
        if($test == 1){
            
        }else{

            $count = count($_SESSION['cart']);
            $item_array = array(
                'product_id' => $_POST['add'],
                'language' => 'japanese',
                'quantity' => 1
            );

            $_SESSION['cart'][$count] = $item_array;
        }

    }else{

        $item_array = array(
                'product_id' => $_POST['add'],
                'language' => 'japanese',
                'quantity' => 1
        );

        // Create new session variable
        $_SESSION['cart'][0] = $item_array;
        print_r($_SESSION['cart']);
    }

}
?>

<?php
$data = "";
$pdata = "";
if(isset($_GET['page']))
$page = $_GET['page'];
else
$page = 1;
$total_pages = 0;
$link = mysqli_connect('localhost', 'root', getenv('DB_PASSWORD') ?: '', 'group_17');
    if (!$link) {
        echo "連結錯誤代碼: " . mysqli_connect_errno() . "<br>"; //顯示錯誤代碼
        echo "連結錯誤訊息: " . mysqli_connect_error() . "<br>"; //顯示錯誤訊息
        exit();
    }
    mysqli_query($link, 'SET CHARACTER SET utf8');
    mysqli_query($link, "SET collation_connection = 'utf8_unicode_ci'");
    if ($result = mysqli_query($link, "SELECT * FROM japanese_album ORDER BY no")) {
        $total_record = mysqli_num_rows($result);
        $total_pages = ceil($total_record / 16);

        mysqli_data_seek($result, ($_GET['page'] - 1)*16);

        for ($j = 1; $j <= 16; $j++) {
            $row = mysqli_fetch_assoc($result);
            if ($row == null) {
                break;
            }

            if ($_SESSION['authority'] == '0') {
                $blink = '<button type="button" class="btn btn-outline-dark mt-auto" onclick="location.href=\'warn.php\'">加入購物車</button>';
            } else if ($_SESSION['authority'] == '1' || $_SESSION['authority'] == '2') {
                $blink = '<button type="submit" class="btn btn-outline-dark mt-auto" name="add" value="'.$row['no'].'">加入購物車</button>';
            }
            
            $data .= '<div class="col mb-5">
                        <div class="card h-100">
                            <!-- Product image-->
                            <a href="product.php?name='.$row['name'].'&description='.$row['description'].'&price='.$row['price'].'&image=japanese_album_each_page/photo/'.$row['img'].'&id='.$row['no'].'&music=jp_music/'.$row['music'].'&language=japanese">
                                <img class="card-img-top" src="japanese_album_each_page/photo/'.$row['img'].'" alt="..." />
                            </a>
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder">'.$row['name'].'</h5>
                                    <!-- Product price-->
                                    '.$row['price'].'$
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center">
                                    <form method="POST" action="'. $_SERVER['PHP_SELF'].'?page='.$page.'">
                                        '.$blink.'
                                        <input type="hidden" name="language" value="japanese">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>';
        }
    mysqli_free_result($result);
}
mysqli_close($link);
    for($i = 1; $i <= $total_pages; $i++)
    {
        if($i == $_GET['page'])
        {
            $pdata .= "$i&nbsp;&nbsp";
        }
        else
        {
            $pdata .= "<a href='" . $_SERVER['PHP_SELF'] . "?page=$i'> $i </a>&nbsp;&nbsp;";
        }
    }
?>
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
    <link href="css/nav.css" rel="stylesheet" />

</head>

<body id="page-top">
    <!-- Navigation-->
    <?php include("nav.php"); ?>

    <header class="masthead" style="max-height: 300px; overflow: hidden; min-height: 150px; background: url(assets/img/LiSA_YouTube.jpg) 0% 0% / cover, rgba(92, 77, 66, 0.8);">
        <div class="container px-4 px-lg-5 h-100" style="max-height: 300px; overflow: hidden;">
            <div class="row gx-4 gx-lg-5 h-50 align-items-center justify-content-center text-center">
                <div class="col-lg-9_2 align-self-end">
                    <h1 class="text-white font-weight-bold">日文</h1>
                </div>
            </div>
        </div>
    </header>
    <!--test starts here-->
    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                <?php
                echo $data;
                ?>
            </div>
        </div>
        <div style="text-align: center;">
            <?php
            echo $pdata;
            ?>
        </div>
    </section>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- SimpleLightbox plugin JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
    <!-- * *                               SB Forms JS                               * *-->
    <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
    <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
</body>

</html>