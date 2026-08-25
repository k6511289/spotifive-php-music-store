<?php
session_start();
    $name = $_GET['name'];
    $description = $_GET['description'];
    $price = $_GET['price'];
    $image = $_GET['image'];
    $music = $_GET['music']; 
    $id = $_GET['id'];   
    $language = $_GET['language'];
    // echo "<script>alert('".$language.",".$id."')</script>";
    $comment_data="";
    echo $music;
?>
<?php
    if (isset($_POST['add'])) {
        // echo "<script>alert('test');</script>";
        $quantity = (int)$_POST['inputQuantity'];
        if(isset($_SESSION['cart'])){
            
            $item_array_id = array_column($_SESSION['cart'], "product_id");
            $item_array_language = array_column($_SESSION['cart'], "language");
    
            // echo "<script>alert('".$quantity."')</script>";

            $test = 0;
            foreach ($_SESSION['cart'] as &$key)
            {
                if(($id == $key['product_id']) && ($language == $key['language']))
                {
                    $test = 1;
                    $key['quantity'] = $key['quantity']+$quantity;
                }
            }
            if($test == 1){
                
            }else{
    
                $count = count($_SESSION['cart']);
                $item_array = array(
                    'product_id' => $id,
                    'language' => $language,
                    'quantity' => $quantity
                );
    
                $_SESSION['cart'][$count] = $item_array;
            }
    
        }else{
    
            $item_array = array(
                    'product_id' => $id,
                    'language' => $language,
                    'quantity' => $quantity
            );
    
            // Create new session variable
            $_SESSION['cart'][0] = $item_array;
            print_r($_SESSION['cart']);
        }
    }
?>
<?php
    $link = mysqli_connect('localhost', 'root', getenv('DB_PASSWORD') ?: '','group_17');
    if(!$link)
    {
        echo "連結錯誤代碼: ".mysqli_connect_errno()."<br>";//顯示錯誤代碼
        echo "連結錯誤訊息: ".mysqli_connect_error()."<br>";//顯示錯誤訊息
        exit();
    }
    mysqli_query($link,'SET CHARACTER SET utf8');
    mysqli_query($link,"SET collation_connection = 'utf8_unicode_ci'");
    if(isset($_SESSION['username']) && isset($_POST['comment']))
    {
        $username = $_SESSION['username'];
        if(isset($_GET['name']))
        {
            $source = $_GET['name'];
        }
        else
        {
            $source = "main";
        }
        $content = nl2br($_POST['comment']);
        $sql = "INSERT INTO comment (source, username, time, content) VALUES ('" . $source . "', '" . $username . "', NOW(), '" . $content . "')";


        if ($result = mysqli_query($link, $sql)) {
            echo "<script>alert('資料新增成功!');location.href='". $_SERVER['PHP_SELF']."';</script>";
        } else {
            echo "<font color=red>SQL指令執行失敗！<br>錯誤訊息：" . mysqli_error($link) . "(代碼：" . mysqli_errno($link) . ")</font>";
        }
        mysqli_close($link); // 關閉資料庫連結
    }
?>

<?php
    $link = mysqli_connect('localhost', 'root', getenv('DB_PASSWORD') ?: '', 'group_17');
        if (!$link) {
            echo "連結錯誤代碼: " . mysqli_connect_errno() . "<br>"; //顯示錯誤代碼
            echo "連結錯誤訊息: " . mysqli_connect_error() . "<br>"; //顯示錯誤訊息
            exit();
        }
        mysqli_query($link, 'SET CHARACTER SET utf8');
        mysqli_query($link, "SET collation_connection = 'utf8_unicode_ci'");
        if ($result = mysqli_query($link, "SELECT * FROM comment WHERE source = '$name'")) {
            $total_record = mysqli_num_rows($result);
            $total_pages = ceil($total_record / 10);
            if(isset($_GET['page']))
            {
                mysqli_data_seek($result, ($_GET['page'] - 1)*10);
            }
            for ($j = 1; $j <= 10; $j++) {
                $row = mysqli_fetch_assoc($result);
                if ($row == null) {
                    break;
                }
                $formattedDate = date('F j, Y, g:i a', $row['time']);

                $comment_data .= '<div class="comment">
                <div class="author">'. $row['username'] .'</div>
                <div class="timestamp">'. $formattedDate .'</div>
                <div class="content">'. $row['content'] .'</div>
                </div>';
            }
        }
        mysqli_free_result($result);
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
        <link href="https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic" rel="stylesheet" type="text/css" />
        <!-- SimpleLightbox plugin CSS-->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
        <link href="css/product.css" rel="stylesheet" />
        <link href="css/banner.css" rel="stylesheet" />
        <link href="css/comment.css" rel="stylesheet" />
        <link href="css/player.css" rel="stylesheet" />
        <link href="css/nav.css" rel="stylesheet" />
        <!--js-->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="js\scripts.js"></script>
        <script src="js\player.js"></script>
    </head>
    <body id="page-top">
        <!-- Navigation-->
        <?php include("nav.php"); ?>

        <header class="masthead" style="max-height: 300px; overflow: hidden; min-height: 150px;">
            <div class="container px-4 px-lg-5 h-100" style="max-height: 300px; overflow: hidden;">
                <div class="row gx-4 gx-lg-5 h-50 align-items-center justify-content-center text-center">
                    <div class="col-lg-9_2 align-self-end">
                        <h1 class="text-white font-weight-bold">日文</h1>
                    </div>
                </div>
            </div>
        </header>
        <!-- Product section-->
        <section class="py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="row gx-4 gx-lg-5 align-items-top">
                    <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0" src="<?php echo $image; ?>" alt="..." />
                        <div id="audio-player">
                            <div id="player-controls">
                              <button id="play-pause-btn"><i class="bi bi-play-fill"></i></button>
                              <div id="timeline">
                                <div id="playhead"></div>
                              </div>
                              <div id="time">
                                <span id="current-time">00:00</span>
                                <span id="duration">00:00</span>
                              </div>
                            </div>
                            <audio id="audio" preload="metadata">
                              <source src="<?php echo $music;?>" type="audio/mp3">
                            </audio>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="small mb-1">SKU: BST-498</div>
                        <h1 class="display-5 fw-bolder"><?php echo $name; ?></h1>
                        <div class="fs-5 mb-5">
                            <span><?php echo $price;?>$</span>
                        </div>
                        <p class="lead"><?php echo $description; ?></p>
                        <div class="d-flex">
                        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']?>?name=<?php echo $name?>&description=<?php echo $description?>&price=<?php echo $price?>&image=<?php echo $image?>&music=<?php echo $music?>&id=<?php echo $id?>&language=<?php echo $language?>">
                            <input class="form-control text-center me-3" name="inputQuantity" type="number" value="1" style="max-width: 3rem" />
                            <button class="btn btn-outline-dark flex-shrink-0" type="submit" name="add">
                                <i class="bi-cart-fill me-1"></i>
                                Add to cart
                            </button>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Contact-->
       
            <section class="page-section" id="contact">
                <div class="container px-4 px-lg-5 align-items-center " >
                        <h2 class="mt-0 align-self-center text-center">留個言吧</h2>
                        <hr class="divider" />
                        <div style="padding: 1rem;">
                            <div class="comment-form">
                                <form name="comment-form" action="" method="POST" style="width: 100%;">
                                    <textarea name="comment" placeholder="Write a comment" rows="5"></textarea>
                                    <?php
                                    if ( isset( $_SESSION['authority']) && $_SESSION['authority'] == '0') {
                                        echo '<button type="button" class="btn btn-outline-dark mt-auto" onclick="location.href=\'warn.php\'">Post Comment</button>';
                                    } else if (isset( $_SESSION['authority']) &&($_SESSION['authority'] == '1' || $_SESSION['authority'] == '2')) {
                                        echo '<button type="submit">Post Comment</button>';
                                    }
                                    ?>
                                <form>
                            </div>
                            <div class="comment-section">
                                <?php
                                echo $comment_data;
                                ?>
                            </div>
                        </div>
                    <div class="row gx-4 gx-lg-5 justify-content-center">
                        <div class="col-lg-4 text-center mb-5 mb-lg-0">
                            <i class="bi-phone fs-2 mb-3 text-muted"></i>
                            <div>+1 (555) 123-4567</div>
                        </div>
                    </div>
                </div>
            </section>
        <!-- Footer-->
        <footer class="bg-light py-5">
            <div class="container px-4 px-lg-5"><div class="small text-center text-muted">Copyright &copy; 2023 - Company Name</div></div>
        </footer>
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