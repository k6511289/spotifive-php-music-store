<?php
if(isset($_SESSION['authority']))
{
    echo '<nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">';
    echo '    <div class="container px-4 px-lg-5">';
    echo '        <a class="navbar-brand" href="index.php">SPOTIFIVE</a>';
    echo '        <button class="navbar-toggler navbar-toggler-right" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>';
    echo '        <div class="collapse navbar-collapse" id="navbarResponsive">';
    echo '            <ul class="navbar-nav ms-auto my-2 my-lg-0" style="align-items: center;">';
    echo '                <li class="nav-item left-aligned">';
    echo '                    <a class="">';
    echo '                        <div class="search-form">';
    echo '                            <form name="search-form" action="search_shop.php?page=1" method="POST" style="width: 100%;">';
    echo '                                <input type="text" name="search" class="search-input" placeholder="Search..." />';
    echo '                                <button type="submit" class="search-button" style="display: inline-block; margin-left: -4px;">';
    echo '                                    <i class="bi bi-search"></i>';
    echo '                                </button>';
    echo '                            </form>';
    echo '                        </div>';
    echo '                    </a>';
    echo '                </li>';
    echo '                <li class="left-aligned">';
    if($_SESSION['authority'] == '0')
        echo '<a class="a-nav" href="index.php">主頁</a>';
    else if($_SESSION['authority'] == '1')
        echo '<a class="a-nav" href="index.php">主頁</a>';
    else if($_SESSION['authority'] == '2')
        echo '<a class="a-nav" href="index.php">主頁</a><a class="a-nav" href="comment.php">管理留言</a>';
    echo '                </li>';
    echo '                <li class="left-aligned">';
    if($_SESSION['authority'] == '0')
    echo '<li class="dropdown left-aligned">
            <a class="dropdown-toggle a-nav" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                商店
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="JP_shop.php?page=1">日本語</a>
                <a class="dropdown-item" href="CH_shop.php?page=1">中文</a>
                <a class="dropdown-item" href="EN_shop.php?page=1">English</a>
            </div>
        </li>';
    else if($_SESSION['authority'] == '1')
    echo '<li class="dropdown left-aligned">
            <a class="dropdown-toggle a-nav" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                商店
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="JP_shop.php?page=1">日本語</a>
                <a class="dropdown-item" href="CH_shop.php?page=1">中文</a>
                <a class="dropdown-item" href="EN_shop.php?page=1">English</a>
            </div>
            </li>';
    else if($_SESSION['authority'] == '2')
    echo '<li class="dropdown left-aligned">
            <a class="dropdown-toggle a-nav" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                管理商品
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="new_jpalbum.php">日本語-新增</a>
                <a class="dropdown-item" href="jpm.php">日本語-刪除</a>
                <a class="dropdown-item" href="new_chalbum.php">中文-新增</a>
                <a class="dropdown-item" href="cnm.php">中文-刪除</a>
                <a class="dropdown-item" href="new_enalbum.php">English-新增</a>
                <a class="dropdown-item" href="enm.php">English-刪除</a>
            </div>
            </li>';
    echo '                </li>';
    echo '                <li>';
    if($_SESSION['authority'] == '0')
        echo '<a class="a-nav" href="login.php">登入</a>';
    else if($_SESSION['authority'] == '1')
        echo '<a class="a-nav" href="forget.php">我的帳號</a>';
    else if($_SESSION['authority'] == '2')
        echo '<a class="a-nav" href="account.php">管理帳號</a>';  
    echo '                </li>';
    echo '                <li>';
    if($_SESSION['authority'] == '0')
        echo '<a class="a-nav" href="login.php">購物車</a>';
    else if($_SESSION['authority'] == '1')
        echo '<a class="a-nav" href="cart.php">購物車</a>';
    else if($_SESSION['authority'] == '2')
        echo '<a class="a-nav" href="cart2.php">管理訂單</a>';  
    echo '                </li>';
    echo '                <li>';
    if($_SESSION['authority'] == '0')
        echo '';
    else if($_SESSION['authority'] == '1')
        echo '<a class="a-nav" href="logout.php">登出</a>';
    else if($_SESSION['authority'] == '2')
        echo '<a class="a-nav" href="logout.php">登出</a>';  
    echo '                </li>';
    echo '            </ul>';
    echo '        </div>';
    echo '    </div>';
    echo '</nav>';
}
?>
