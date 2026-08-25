<?php
    $link = mysqli_connect("localhost", "root", getenv('DB_PASSWORD') ?: '', "group_17") // 建立MySQL的資料庫連結
    or die("無法開啟MySQL資料庫連結!<br>");

    // 送出編碼的MySQL指令
    mysqli_query($link, 'SET CHARACTER SET utf8');
    mysqli_query($link, "SET collation_connection = 'utf8_unicode_ci'");

   
    if (isset($_POST['add'])) {
        $name = $_POST['name'];
        $content = $_POST['content'];
        $price = $_POST['price'];

        $result = mysqli_query($link, "SELECT COUNT(*) AS total FROM japanese_album");
        $totalRecords = 0;
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            $totalRecords = $row['total'];

            // echo "数据库中共有 " . $totalRecords . " 条记录。";
        } else {
            // echo "查询失败。";
        }
        $totalRecords = $totalRecords+1;

        $mypath = './japanese_album_each_page/photo/';
                if (move_uploaded_file($_FILES['Myfile']['tmp_name'], $mypath.(string)$totalRecords.".jpg")) {
                    // echo "success";
                }
                else {
                    // echo "fail";
                }

        $sql = "INSERT INTO japanese_album (no, name, price,description,img) VALUES ('".$totalRecords."','".$name."','".$price."','".$content."','".$totalRecords.".jpg')";
        if ($result = mysqli_query($link, $sql));

        
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    
    <script>
    $(document).ready(function($) {
        
    });
    </script>
    <style type="text/css">
    .error {
        color: red;
        font-weight: normal;
    }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-offset-4 col-sm-4 col-sm-offset-4">
                <h2>新增商品</h2>
                <form method="POST" action="<?php $_SERVER['PHP_SELF']?>" enctype='multipart/form-data'>>
                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="account">名稱</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="name" name="name" placeholder="限4-10個字">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">敘述</label>
                        <div class="col-sm-8">
                            <textarea name="content" rows="5" cols="40"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">價格</label>
                        <div class="col-sm-8">
                        <input type="number" class="form-control" id="price" name="price" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">圖片</label>
                        <div class="col-sm-8">
                        <!-- <form action='upload_single.php' method='POST' enctype='multipart/form-data'> -->
                        <input type='hidden' name='MAX_FILE_SIZE' value='1024000'>
                        請選擇要上傳的檔案：
                        <input type='file' name='Myfile'><br>
                        <!-- <input type='submit' value='上傳檔案'> -->
                        <!-- </form> -->
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-7s col-sm-offset-5">
                            <label>
                                <button type="submit" class="btn btn-primary" name="add">送　出</button>
                                <button type="reset" class="btn btn-primary">重　填</button>
                            </label>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>