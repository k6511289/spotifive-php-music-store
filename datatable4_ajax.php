
<?php

$link = mysqli_connect("localhost", "root", getenv('DB_PASSWORD') ?: '', "group_17") // 建立MySQL的資料庫連結
or die("無法開啟MySQL資料庫連結!<br>");

mysqli_query($link, 'SET CHARACTER SET utf8');
mysqli_query($link, "SET collation_connection = 'utf8_unicode_ci'");

$arr_sex = array('F' => '女', 'M' => '男');
$arr_oper = array("insert" => "新增", "update" => "修改", "delete" => "刪除");
$oper = $_POST['oper'];

if ($oper == "query") {
      $sql = "select * from cart";
      if ($result = mysqli_query($link, $sql)) {
            while ($row = mysqli_fetch_assoc($result)) {
                  $a['data'][] = array($row["serial"], $row["language"], $row["no"],$row['quantity'],$row['user_name'], "<button type='button' class='btn btn-warning btn-xs' id='btn_update'><i class='glyphicon glyphicon-pencil'></i>修改</button> <button type='button' class='btn btn-danger btn-xs' id='btn_delete'><i class='glyphicon glyphicon-remove'></i>刪除</button>");
            }
            mysqli_free_result($result); // 釋放佔用的記憶體
      }
      mysqli_close($link); // 關閉資料庫連結

      echo json_encode($a);
      exit;
}

if ($oper == "insert") {
      $sql = "insert into cart(user_name,language,no,quantity,serial) values ('" . $_POST['stud_no'] . "','" . $_POST['stud_name'] . "','" . $_POST['no'] . "','" . $_POST['stud_addr'] .  "','" . $_POST['serial'] . "')";
}

if ($oper == "update") {
    $sql = "UPDATE cart SET user_name='" . $_POST['stud_no'] . "', language='" . $_POST['stud_name'] . "', no='" . $_POST['no'] . "', quantity='" . $_POST['stud_addr'] . "' WHERE serial='" . $_POST['stud_no_old'] . "'";
}

if ($oper == "delete") {
      $sql = "delete from cart where serial='" . $_POST['serial'] . "'";
}

if (strlen($sql) > 10) {
      if ($result = mysqli_query($link, $sql)) {
            $a["code"] = 0;
            $a["message"] = "資料" . $arr_oper[$oper] . "成功!";
      } else {
            $a["code"] = mysqli_errno($link);
            $a["message"] = "資料" . $arr_oper[$oper] . "失敗! <br> 錯誤訊息: " . mysqli_error($link);
      }
      mysqli_close($link); // 關閉資料庫連結

      echo json_encode($a);
      exit;
}
?>