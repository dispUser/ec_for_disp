<?php
    session_start();
    session_regenerate_id(true);
    
    require_once "../../common/Function.php";
    
    if(isset($_SESSION[SESSION_CON::$FRONT_LOGIN])){
        $user_name = "MyPage";
        $url = "mypage.php";
    }else{
        $user_name = "Login";
        $url = "member_login.php";
    }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gamz Watch Online</title>

    <!-- font awesome -->
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">

    <!-- google font -->
    <link href="https://fonts.googleapis.com/css?family=Pacifico&display=swap" rel="stylesheet">

    <!-- style sheet -->
    <link rel="stylesheet" href="/gamz_watch/src/front/css/common.css">
    <link rel="stylesheet" href="/gamz_watch/src/front/css/style.css">
    <link rel="stylesheet" href="/gamz_watch/src/front/css/index.css">
    <link rel="stylesheet" href="/gamz_watch/src/front/css/pages/faq/index.css">
    <link rel="stylesheet" href="/gamz_watch/src/front/css/css/search/search.css">
    <link rel="stylesheet" href="/gamz_watch/src/front/css/css/shop_product/shop_product.css">
    <link rel="stylesheet" href="/gamz_watch/src/front/css/css/shop_cartin/shop_cartin.css">
    <link rel="stylesheet" href="/gamz_watch/src/front/css/css/shop_form/shop_form.css">
    <link rel="stylesheet" href="/gamz_watch/src/front/css/css/shop_form_check/shop_form_check.css">
    <link rel="stylesheet" href="/gamz_watch/src/front/css/css/shop_kantan_check/shop_kantan_check.css">
    <link rel="stylesheet" href="/gamz_watch/src/front/css/css/member_login/member_login.css">
    <link rel="stylesheet" href="/gamz_watch/src/front/css/css/mypage/mypage.css">
    <link rel="stylesheet" href="/gamz_watch/src/front/css/css/history/history_list.css">
    <link rel="stylesheet" href="/gamz_watch/src/front/css/css/history_disp/history_disp.css">
    <link rel="stylesheet" href="/gamz_watch/src/front/css/css/member_logout/member_logout.css">
    <link rel="stylesheet" href="/gamz_watch/src/front/css/css/member_info/member_info.css">
    <link rel="stylesheet" href="/gamz_watch/src/front/css/css/member_info_edit/member_info_edit.css">
    <link rel="stylesheet" href="/gamz_watch/src/front/css/css/member_info_edit_check/member_info_edit_check.css">
    <link rel="stylesheet" href="/gamz_watch/src/front/css/css/member_info_edit_done/member_info_edit_done.css">
    <link rel="stylesheet" href="/gamz_watch/src/front/css/css/shop_kantan_done/shop_kantan_done.css">
    <link rel="stylesheet" href="/gamz_watch/src/front/css/css/history_disp_payment/history_disp_payment.css">
    <link rel="stylesheet" href="/gamz_watch/src/front/css/css/history_disp_payment_done/history_disp_payment_done.css">
    <link rel="stylesheet" href="/gamz_watch/src/front/css/css/history_disp_cancel/history_disp_cancel.css">
    <!-- <link rel="stylesheet" href="/gamz_watch/src/front/css/css/history_disp_cancel_done/history_disp_cancel_done.css"> -->
    <link rel="stylesheet" href="/gamz_watch/src/front/css/css/shop_form_done/shop_form_done.css">
    <link rel="stylesheet" href="/gamz_watch/src/front/css/css/shop_cartlook/shop_cartlook.css">
</head>
<body>
    <header class="front-header">
        <h1 class="front-header__title">
            <a class="front-header__link" href="/gamz_watch/src/front/shop/shop_list.php">
                Gamz Watch Online
            </a>
        </h1>
        <div class="front-header__image-box">
            <img class="front-header__img" src="/gamz_watch/src/front/img/common/hinamatsuri.png" alt="ヘッダーイメージ">
        </div>
        <div class="clear"></div>
        <nav class="front-header__nav">
            <ul class="front-header__nav-list">
                <li class="front-header__nav-list-item">
                    <a class="front-header__nav-list-item-link" href="/gamz_watch/src/front/shop/search.php">
                        Search
                    </a>
                </li>
                <li class="front-header__nav-list-item">
                    <a class="front-header__nav-list-item-link" href="faq.php">
                        FAQ
                    </a>
                </li>
                <li class="front-header__nav-list-item">
                    <a class="front-header__nav-list-item-link" href="<?php print $url ?>">
                        <?php print $user_name?>
                    </a>
                </li>
                <li class="front-header__nav-list-item">
                    <a class="front-header__nav-list-item-link" href="shop_cartlook.php">
                        Cart
                    </a>
                </li>
                <div class="clear"></div>
            </ul>
        </nav>
    </header>