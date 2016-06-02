<!DOCTYPE html>
<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>
<html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js"> <!--<![endif]-->
<head>
    <META HTTP-EQUIV="Pragma" CONTENT="no-cache">

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>PawMaji.com</title>
    <meta name="description" content="Wellcome to PawMaji.com">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?= base_url() ?>dist/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="<?= base_url() ?>dist/favicon.ico" type="image/x-icon">

    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>dist/css/normalize.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>dist/css/main.css">
    <link rel="stylesheet" href="<?= base_url() ?>dist/css/customize.css">

    <!-- animetion -->
    <link rel="stylesheet" href="<?= base_url() ?>dist/css/animate.css">

    <!-- verification -->
    <link rel="stylesheet" href="<?= base_url() ?>dist/parsley/src/parsley.css">



    <script src="<?= base_url() ?>dist/js/vendor/modernizr-2.6.2.min.js"></script>
    <script src="https://code.jquery.com/jquery-latest.min.js"></script>

</head>
<body>
<!--[if lt IE 9]>
<p class="browsehappy">您正在使用的瀏覽器<strong>過於老舊</strong>. 為了您的安全、與更好的瀏覽體驗，建議您 <a href="https://browsehappy.com/">升級</a>
    至最新版本的現代瀏覽器.</p>
<![endif]-->

<nav class="nav pos-fixed tool-boxshadow clearfix">
    <div class="row">
        <div class="warper tool-mtb">
            <!-- Logo @ left -->
            <div class="span-2 small-span-6 mid-span-6">
                <div class="logo wow fadeInDown">
                    <h1 class="hidden">PawMaji.com</h1><!-- sitename -->
                    <a href="<?=base_url()?>" class="form_logo index_link">
                        <img class="nav-logo" src="<?= base_url() ?>dist/img/logo_nav.png" alt="PawMaji">
                    </a><!-- logo img -->
                </div>
            </div>
            <!-- menu @ right -->
            <div class="span-7 large-offset-3 small-span-6 mid-span-6 j_mobile_vertical">
                <ul>
<!--                    <li class="span-13 small-hide"><a href="introduction">服務介紹</a></li>-->
                    <li class="span-13 small-hide"><a class="faq_link" href="<?=base_url()?>faq">常見問題</a></li>
                    <li class="span-13 small-hide" ><a class="contact_link" href="<?=base_url()?>contact">聯絡客服</a></li>

                    <?$user_data = $this->session->all_userdata();
                    if(!isset($user_data['logged_in'])){?>
                    <li class="span-3 small-hide " >
                        <a rel="modal" class="button button-pill button-primary button-tiny" style="margin-top: 0px" href="#login-form">會員登入</a></li>
                    <!-- for big screen device -->
                    <li class="span-3 large-hide small-span-12 ">
                        <a rel="modal-high" class="button button-pill button-primary button-tiny" style="margin-top: 0px" href="#login-form-small">會員登入</a>
                    </li>
                    <?}else{?>
                    <!-- for mobile -->
                    <li class="span-6 small-hide">
                        <a class="button button-pill button-primary button-tiny membership_link form_operation" href="<?=base_url()?>membership" >會員專頁</a>
                        <a class="button button-pill button-caution button-tiny form_operation" href="<?=base_url()?>logout">會員登出</a>
                    </li>
                    <li class="span-3 large-hide small-span-12">
                        <a class="button button-pill button-primary button-tiny membership_link form_operation" href="<?=base_url()?>membership" >會員專頁</a>
                    </li>
                    <!-- for mobile -->
                    <li class="span-3 large-hide small-span-12">
                        <a class="button button-pill button-caution button-tiny form_operation" href="<?=base_url()?>logout">會員登出</a>
                    </li>
                    <!-- for mobile -->
                    <?}?>
                </ul>
            </div>
        </div>
    </div>
</nav>