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
        <link href="css/register.css" rel="stylesheet" />
        <link href="nav/register.css" rel="stylesheet" />


        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
        <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.14.0/jquery.validate.min.js"></script>
        <!--additional method - for checkbox .. ,require_from_group method ...-->
        <script src="http://jqueryvalidation.org/files/dist/additional-methods.min.js"></script>
        <!--中文錯誤訊息-->
        <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/localization/messages_zh_TW.js "></script>
    </head>
    <script>
    $(function() { //網頁完成後才會載入
      $('#username').keyup(function() {
          $.ajax({
              url: "check_account_jquery_ajax.php",
              data: $('#sentToBack').serialize(),
              type: "POST",
              dataType: 'text',
              success: function(msg) {
                  $("#show_msg").html(msg);//顯示訊息
                  //document.getElementById('show_msg').innerHTML= msg ;
              },
              error: function(xhr, ajaxOptions, thrownError) {
                  alert(xhr.status);
                  alert(thrownError);
              }
          });
      });
  });
</script>
    <?php
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
if (isset($_POST['registerPassword'])&&isset($_POST['username'])&&isset($_POST['registerName'])) {
  $rem = $_POST['username'];
  $repad = $_POST['registerPassword'];
  $rergn = $_POST['registerName'];
    $result = null; 
    if ($rem && $repad && $rergn) {
        $result = mysqli_query($link, "SELECT * FROM logintest WHERE email = '$rem' AND password = '$repad'");
        echo '<script>alert("SQL已經執行！");</script>';
        if ($result) {
            $rows = mysqli_num_rows($result);
            
            if ($rows == 1) {
                echo '<script>alert("帳號已經存在！");</script>';

            } else {
	mysqli_query($link, "INSERT INTO logintest (email, password, name)VALUES ('$rem', '$repad', ' $rergn')");
                echo '<script>alert("帳號註冊成功！");</script>';
            }
            
            mysqli_free_result($result); //釋放佔用的記憶體空間
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
           font-weight: normal;
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
    $("#sentToBack").validate({
    submitHandler: function(form) {
        form.submit();
    },
    rules: {         
        registerPassword:{
          required:true,
          minlength:6,
          maxlength:12
        },
        registerPassword2:{
          required:true,
          minlength:6,
          maxlength:12,
          notEqualsto: $("#registerPassword").val() // 使用notEqualsto验证方法
        },
        registerEmail:{
          required:true
        },
        registerName:{
          required:true,
          minlength:3,
          maxlength:10
        },
        username:{
          required:true,
        },
        loginPassword: {
            required: true,
            minlength:"6",
            maxlength: "12"
        },
    },
    messages: {
      registerPassword:{
          required:"請輸入密碼",
          minlength:"最少6個字",
          maxlength:"最多12個字"
        },
        registerPassword2:{
          required:"請輸入密碼",
          minlength:"最少6個字",
          maxlength:"最多12個字",
          notEqualsto:"怪怪的"
        },
      registerName:{
        required:"此欄不可為空"
      },
      loginPassword: {
            required: "帳號為必填欄位",
            minlength: "帳號最少要4個字",
            maxlength: "帳號最長10個字"
        },
        registerEmail: {
            required:"請填寫信箱"
        },
    }
    });
    });
  </script>
    <body id="page-top">
        <!-- Navigation-->
        <?php include("nav.php"); ?>
        <header class="masthead">
            <div class="container px-4 px-lg-5 h-100" style="display: flex;justify-content: center;align-items: center;">
                <div class="row gx-4 gx-lg-5 h-100 align-items-center justify-content-center text-center"style="display: flex;justify-content: center;align-items: center;">
                    <div class="col-lg-9_2 align-self-end">
                        <h3 class="text-white font-weight-bold">註冊帳號</h3>
                        <hr class="divider" />
                    </div>
                    <section>
                        <div class="log-container">
                            <form action="" method="post" style="padding-top: 50px; width: 100%;" id="sentToBack" name="form1"> <!--login php-->
                              <table style="width: 100%; padding-bottom: 20px;">
                                <tr>
                                  <td>
                                    <label for="email">Email:</label>
                                  </td>
                                  <td>
                                    <input type="email" id="username" name="username">
                                    <span id="show_msg" style="color:red"></span>
                                  </td>
                                </tr>
                                <tr>
                                  <td>
                                    <label for="registerName">帳號:</label>
                                  </td>
                                  <td>
                                    <input type="text" id="registerName" name="registerName">
                                  </td>
                                </tr>
                                <tr>
                                  <td>
                                    <label for="registerPassword">密碼:</label>
                                  </td>
                                  <td>
                                    <input type="registerPassword" id="registerPassword" name="registerPassword">
                                  </td>
                                </tr>
                                <tr>
                                  <td>
                                    <label for="registerpassword2">再次輸入密碼:</label>
                                  </td>
                                  <td>
                                    <input type="password" id="registerPassword2" name="registerPassword2">
                                  </td>
                                </tr>
                              </table>
                              <input type="submit" value="註冊">
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