<?php
session_start();
    if (isset($_SESSION['is_login']) &&$_SESSION['is_login']) {
        if($_SESSION['authority']=='1')
        {
                   //echo '<script>alert("歡迎回來！ , ' . $_SESSION['authority'] . '");</script>';
                  // echo '<script>alert("歡迎回來！' . $_SESSION['username'] . ' , ' . $_SESSION['authority'] . '");</script>';
        }
        if($_SESSION['authority']=='2')
        {
                 //echo '<script>alert("歡迎回來！ , ' . $_SESSION['authority'] . '");</script>';
                //echo '<script>alert("歡迎回來！' . $_SESSION['username'] . ' , ' . $_SESSION['authority'] . '");</script>';
        }
    }else{
        $_SESSION['authority']='0';
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
            echo "<script>alert('資料新增成功!');location.href='index.php';</script>";
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
        if ($result = mysqli_query($link, "SELECT * FROM comment WHERE source = 'main'")) {
            $comment_data = "";
            $formattedDate = "";
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
                $formattedDate = date('F j, Y, g:i a',  strtotime($row['time']));

                $comment_data .= '<div class="comment">
                <div class="author">'. $row['username'] .'</div>
                <div class="timestamp">'. $formattedDate .'</div>
                <div class="content">'. $row['content'] .'</div>
                </div>';
            }
        }
        $pdata = "";
        if(isset($_GET['page']))
            $page =  $_GET['page'];
        else
            $page = 1;
        mysqli_free_result($result);
        for($i = 1; $i <= $total_pages; $i++)
        {
            if($i == $page)
            {
                $pdata .= "$i&nbsp;&nbsp";
            }
            else
            {
                $pdata .= "<a onclick='return scrollToSamePosition(event)' href='" . $_SERVER['PHP_SELF'] . "?page=$i'> $i </a>&nbsp;&nbsp;";
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
        <link href="https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic" rel="stylesheet" type="text/css" />
        <!-- SimpleLightbox plugin CSS-->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
        <link href="css/comment.css" rel="stylesheet" />
        <link href="css/shop_select.css" rel="stylesheet" />
        <link href="css/nav.css" rel="stylesheet" />
    </head>
    <body id="page-top">
        <?php include("nav.php"); ?>
        <!-- Masthead-->
        <header class="masthead">
            <div class="container px-4 px-lg-5 h-100">
                <div class="row gx-4 gx-lg-5 h-100 align-items-center justify-content-center text-center">
                    <div class="col-lg-9_2 align-self-end">
                        <h1 class="text-white font-weight-bold">透過SPOTIFIVE購買您喜愛的音樂</h1>
                        <hr class="divider" />
                    </div>
                    <div class="col-lg-8 align-self-baseline">
                        <p class="text-white-75 mb-5">死巴特five是一個專門販售音樂專輯及數位音樂的網路商店，提供多種音樂類型供顧客選擇。我們與各大音樂公司合作，提供最新最熱門的音樂作品，並提供安全便捷的付款方式及快速的商品配送服務。歡迎來到死巴特five，與我們一同享受音樂的魅力。</p>
                        <a class="btn btn-primary btn-xl" href="#about">開始購物</a>
                    </div>
                </div>
            </div>
        </header>
        <!-- About-->
        <section class="page-section bg-primary" id="about">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-lg-8 text-center">
                        <?php
                        
                            if ($_SESSION['authority'] == '0') {
                                echo '<h2 class="text-white mt-0">加入我們</h2>
                                        <p class="text-white-75 mb-4">您需要登入才能開始購物</p>
                                        <a class="btn btn-light btn-xl" href="#services">登入</a>';
                            } else if ($_SESSION['authority'] == '1') {
                                echo '<h2 class="text-white mt-0">開始購物</h2>
                                        <p class="text-white-75 mb-4">尋找您喜歡的音樂</p>';
                            } else if ($_SESSION['authority'] == '2') {
                                echo '<h2 class="text-white mt-0">你是管理者</h2>';
                            }
                        ?>
                    </div>
                </div>
            </div>
        </section>
        <!-- Portfolio-->
        <div id="portfolio">
            <div class="container-fluid p-0">
                <div class="row g-0">
                    <div class="col-lg-4 col-sm-6">
                        <div class="image-container_c" style="width: 100%;">
                            <img class="img-fluid" src="assets\img\JP.png" alt="Your Image">
                            <div class="overlay-text">
                            <a href="JP_shop.php?page=1" style="width = 100%">日文</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="image-container_c" style="width: 100%;">
                            <img class="img-fluid" src="assets\img\CH.jpg" alt="Your Image">
                            <div class="overlay-text">
                            <a href="CH_shop.php?page=1" style="width = 100%">中文</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="image-container_c" style="width: 100%;">
                            <img class="img-fluid" src="assets\img\EN.jpg" alt="Your Image">
                            <div class="overlay-text">
                            <a href="EN_shop.php?page=1" style="width = 100%">英文</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Services-->
        <section class="page-section" id="services">
            <div class="container px-4 px-lg-5">
                <h2 class="text-center mt-0" style="font-weight: bold;" style="font-family:Microsoft JhengHei;">為什麼要選擇我們?</h2>
                <div class="row gx-4 gx-lg-5">
                    <div class="col-lg-3 col-md-6 text-center">
                        <div class="mt-5">
                            <div class="mb-2"><i class="bi bi-currency-exchange fs-1 text-primary"></i></div>
                            <h3 class="h4 mb-2">便宜的價格</h3>
                            <p class="text-muted mb-0">我們提供市場上最具競爭力的價格，讓您以最便宜的方式滿足您的需求。</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 text-center">
                        <div class="mt-5">
                            <div class="mb-2"><i class="bi bi-music-note-list fs-1 text-primary"></i></div>
                            <h3 class="h4 mb-2">最新的音樂</h3>
                            <p class="text-muted mb-0">。我們提供最新的音樂，讓您保持與時俱進。定期更新，提供熱門單曲和專輯。讓您享受豐富的音樂體驗。</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 text-center">
                        <div class="mt-5">
                            <div class="mb-2"><i class="bi bi-headset fs-1 text-primary"></i></div>
                            <h3 class="h4 mb-2">良好的體驗</h3>
                            <p class="text-muted mb-0">我們提供優質客服，確保您獲得卓越的支援和滿意的服務體驗。</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 text-center">
                        <div class="mt-5">
                            <div class="mb-2"><i class="bi-heart fs-1 text-primary"></i></div>
                            <h3 class="h4 mb-2">我們很窮</h3>
                            <p class="text-muted mb-0">在這裡購物等於做慈善，好棒棒。</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Portfolio-->
        <!-- Contact-->
        <section class="page-section" id="contact">
            <div class="container px-4 px-lg-5 align-items-center">
                    <h2 class="mt-0 align-self-center text-center">留個言吧</h2>
                    <hr class="divider" />
                    <div style="padding: 1rem;">
                        <div class="comment-form" style="width: 100%;">
                            <form name="comment-form" action="" method="POST" style="width: 100%;">
                                <textarea name="comment" placeholder="Write a comment" rows="5"></textarea>
                                <?php
                                    if ($_SESSION['authority'] == '0') {
                                        echo '<button type="button" class="btn btn-outline-dark mt-auto" onclick="location.href=\'warn.php\'">Post Comment</button>';
                                    } else if ($_SESSION['authority'] == '1' || $_SESSION['authority'] == '2') {
                                        echo '<button type="submit">Post Comment</button>';
                                    }
                                ?>
                            <form>
                        </div>
                        <div class="comment-section">
                            <?php
                                echo $comment_data;
                            ?>
                            <div class = "page_sel" style="text-align: center;">
                            <?php
                                echo $pdata;
                            ?>
                            </div>
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
