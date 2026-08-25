<?php
if(isset($_POST['search']))
    $search = $_POST['search'];
else if(isset($_GET['$search']))
    $search = $_GET['$search'];
else    
    $search = "";

$data = "";
$pdata = "";
$link = mysqli_connect('localhost', 'root', getenv('DB_PASSWORD') ?: '', 'group_17');
    if (!$link) {
        echo "連結錯誤代碼: " . mysqli_connect_errno() . "<br>"; //顯示錯誤代碼
        echo "連結錯誤訊息: " . mysqli_connect_error() . "<br>"; //顯示錯誤訊息
        exit();
    }
    mysqli_query($link, 'SET CHARACTER SET utf8');
    mysqli_query($link, "SET collation_connection = 'utf8_unicode_ci'");
    if ($result = mysqli_query($link, "SELECT * FROM chinese_album WHERE name LIKE '%". $search ."%'")) {
        while ($row = mysqli_fetch_assoc($result)) {
            $data .= '<div class="col mb-5">
                        <div class="card h-100">
                            <!-- Product image-->
                            <a href="product.php?name='.$row['name']. '&description='.$row['description'].'&price='.$row['price'].'&image=chinese_album_each_page/photo/'.$row['img'].'&music='.$row['music'].' ?>">
                                <img class="card-img-top" src="chinese_album_each_page\photo\\'.$row['img'].'" alt="..." />
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
                                <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">加入購物車</a></div>
                            </div>
                        </div>
                    </div>';

        }
        mysqli_free_result($result);
    }
    if ($result = mysqli_query($link, "SELECT * FROM japanese_album WHERE name LIKE '%". $search ."%'")) {
        while ($row = mysqli_fetch_assoc($result)) {
            $data .= '<div class="col mb-5">
                        <div class="card h-100">
                            <!-- Product image-->
                            <a href="product.php?name='.$row['name']. '&description='.$row['description'].'&price='.$row['price'].'&image=japanese_album_each_page/photo/'.$row['img'].'&music='.$row['music'].' ?>">
                                <img class="card-img-top" src="japanese_album_each_page\photo\\'.$row['img'].'" alt="..." />
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
                                <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">加入購物車</a></div>
                            </div>
                        </div>
                    </div>';

        }
        mysqli_free_result($result);
    }
    if ($result = mysqli_query($link, "SELECT * FROM english_album WHERE name LIKE '%". $search ."%'")) {
        while ($row = mysqli_fetch_assoc($result)) {
            $data .= '<div class="col mb-5">
                        <div class="card h-100">
                            <!-- Product image-->
                            <a href="product.php?name='.$row['name']. '&description='.$row['description'].'&price='.$row['price'].'&image=english_album_each_page/photo/'.$row['img'].'&music='.$row['music'].' ?>">
                                <img class="card-img-top" src="english_album_each_page\photo\\'.$row['img'].'" alt="..." />
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
                                <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">加入購物車</a></div>
                            </div>
                        </div>
                    </div>';

        }
        mysqli_free_result($result);
    }
    mysqli_close($link);
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

    <header class="masthead" style="max-height: 300px; overflow: hidden; min-height: 150px;">
        <div class="container px-4 px-lg-5 h-100" style="max-height: 300px; overflow: hidden;">
            <div class="row gx-4 gx-lg-5 h-50 align-items-center justify-content-center text-center">
                <div class="col-lg-9_2 align-self-end">
                    <h1 class="text-white font-weight-bold">商品</h1>
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