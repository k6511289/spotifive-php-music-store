<?php
session_start();

// 检查会话是否已启用
if (isset($_SESSION)) {
    // 销毁特定的会话变量
    unset($_SESSION['authority']);
    unset($_SESSION['is_login']);
    unset($_SESSION['username']);
    echo "<script> window.location.href = 'index.php'; </script>";
    // 可选：销毁整个会话
    // session_destroy();

    // 其他操作...
}
?>