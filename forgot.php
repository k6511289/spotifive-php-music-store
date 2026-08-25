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
        <link href="css/login.css" rel="stylesheet" />
        <link href="css/nav.css" rel="stylesheet" />

        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
        <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.14.0/jquery.validate.min.js"></script>
        <!--additional method - for checkbox .. ,require_from_group method ...-->
        <script src="http://jqueryvalidation.org/files/dist/additional-methods.min.js"></script>
        <!--中文錯誤訊息-->
        <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/localization/messages_zh_TW.js "></script>
    </head>
<?php
$data=null;
session_start();
$link = mysqli_connect('localhost', 'root', getenv('DB_PASSWORD') ?: '', 'group_17');
mysqli_query($link, 'SET CHARACTER SET utf8');
mysqli_query($link, "SET collation_connection = 'utf8_unicode_ci'");
if (!$link) {
    echo '<script>alert("資料庫連結失敗！");</script>';
    echo "連結錯誤代碼: " . mysqli_connect_errno() . "<br>"; //顯示錯誤代碼
    echo "連結錯誤訊息: " . mysqli_connect_error() . "<br>"; //顯示錯誤訊息
    exit();
} 
if (isset($_POST['username']) && isset($_POST['password'])) {
    $un = $_POST['username'];
    $pad = $_POST['password'];
    $result = null; 
    if ($un && $pad) {
        $result = mysqli_query($link, "SELECT * FROM logintest WHERE email = '$un' AND password = '$pad'");
        echo '<script>alert("SQL已經執行！");</script>';
        if ($result) {
            $rows = mysqli_num_rows($result);
            
            if ($rows == 1) {
              $row = mysqli_fetch_assoc($result);
              var_dump($row);
                $data = $row['authority'];
                $_SESSION['authority'] = $data;
                $_SESSION['is_login'] = TRUE;
                $_SESSION['username'] = $un;
                echo '<script>alert("登入成功！");</script>';
                mysqli_free_result($result); //釋放佔用的記憶體空間
                mysqli_close($link); //結束資料庫連線
                echo '<script>window.location.href = "index.php";</script>'; // 使用 JavaScript 進行客戶端導向
                exit(); // 確保程式停止執行以防止意外行為
            } else {
                $_SESSION['is_login'] = FALSE;
                $_SESSION['authority'] = '0';
                //在session 存一個 msg 變數
                $_SESSION['msg'] = '登入失敗，請確認帳號密碼!!';
                echo '<script>alert("登入失敗！");</script>';
            }
        } else {
            echo '<script>alert("資料庫連結成功！");</script>';
        }
    }
}

mysqli_close($link); //結束資料庫連線
?>
    
    <style type="text/css">
        .error {
             color: #D82424;
             font-weight: bold;
             font-family: "微軟正黑體";
             display: inline;
             padding: 1px;
        }
        </style>
    <script>
        $(document).ready(function($){
          $.validator.addMethod("notEqualsto", function(value, element, arg) {
            return arg != value;
        }, "您尚未選擇!");
        $("#form1").validate({
        submitHandler: function(form) {
            form.submit();
        },
        rules: {         
            password:{
              required:true,
              minlength:6,
              maxlength:12
            },
            username:{
              required:true,
              minlength:3,
              maxlength:10
            },
        },
        messages: {
            password:{
              required:"請輸入密碼",
              minlength:"最少6個字",
              maxlength:"最多12個字"
            },
          username:{
            required:"此欄不可為空"
          },
        }
        });
        });
      </script>
    
    <body id="page-top">
        <!-- Navigation-->
        <?php include("nav.php"); ?>

        <header class="masthead">
            <div class="container px-4 px-lg-5 h-100 d-flex align-items-center justify-content-center">
                <div class="row gx-4 gx-lg-5 align-items-center justify-content-center text-center">
                    <div class="col-lg-9">
                        <h2 class="text-white font-weight-bold">忘記密碼</h2>
                        <hr class="divider" />
                    </div>
                    <section>
                        <div class="log-container" style="border-radius: 10px;">
                            <form action="login.php" method="post" style="padding-top: 50px;" id="form1" name="form1">
                                <label for="username" style="font-size: 50px;">您將會在信箱收到您的密碼</label>
                                <div class="log-element">
                                    <label for="username">電子郵件:</label>
                                    <input type="text" id="username" name="username" required>
                                </div>
                                <label id="username-error" class="error" for="username"></label> <!-- Move error message here -->
                                <label id="password-error" class="error" for="password"></label> <!-- Move error message here -->
                                <div class="button_container">
                                    <button type="submit">傳送</button>
                                </div>
                            </form>
                        </div>
                    </section>
                </div>
            </div>
        </header>
        <!-- Contact-->
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
