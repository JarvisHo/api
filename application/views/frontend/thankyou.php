<div id="fb-root"></div>
<script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.3";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
        <!-- membership -->
        <!-- background img & title -->
        <style>
            .table-title{
                font-size: 1.3em;
            }
        </style>

        <div class="sub-banner back-cover clearfix" style="background-image: url(<?= base_url() ?>dist/img/step_banner3.jpg);"><!-- background image. inline css 可用 php 設定背景 -->
            <div class="span-12">
                <h2>非常感謝您的訂購</h2>
            </div>
        </div>
        <!--membership. main section 沿用 subscribe flow template-->
        <div class="membership sub-flow tool-boxshadow clearfix">
            <div class="warper">

                <!-- members' info & subscribed products list -->
                <div class="sub-main row">

                    <!-- members' info -->
                    <div class="sub-info span-12 small-span-12">

                        <div class="sub-signup">

                            <h3>
                                <div class="row thankyou_info">

                                    <div class="span-1 info_margin"><i class="fa fa-info-circle"></i></div>
                                    <div class="span-11 info_left info_margin">我們會在送貨前五天發通知e-mail到 <span class="j_highlight"><?=$member_account?></span> 跟您確認</div>

                                    <div class="span-1 info_margin"><i class="fa fa-info-circle"></i></div>
                                    <div class="span-11 info_left info_margin">您會再送貨日的三個工作天內收到您訂購的產品</div>

                                    <div class="span-1 info_margin"><i class="fa fa-info-circle"></i></div>
                                    <div class="span-11 info_left info_margin">您也可以隨時登入調整下次送貨日期與間隔天數</div>

                                </div>
                            </h3>
                            <fieldset>
                                <legend><span class="icon-location"></span>宅配訂單資訊</legend>

                                <div class="row j_w95 table-active">

                                    <div class="j_center"><h3>宅配產品</h3></div>
                                    <div class="">
                                        <?php $total=0;
                                        foreach($service['service_cart'] AS $cart):
                                            $product = $this->model_product->get_product($cart['cart_product_id']);?>
                                            <div class="row cart_unit">

                                                <div class="span-4 j_right"><img src="<?=$product['product_image']?>" class="img-thumbnail product-img cart_image_padding" ></div>
                                                <div class="span-8" align="left">
                                                    <div class="row">
                                                        <div class="span-12"><?=$product['product_name']?></div>
                                                    </div>
                                                    <div class="row" style="margin-top: 15px">
                                                        <div class="span-6">數量：<?=$cart['cart_package_qty']?></div><div class="span-6">單價：<?=$cart['cart_package_price']?></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <? $total = $total + $cart['cart_package_qty']*$cart['cart_package_price']; unset($product); endforeach?>
                                    </div>

                                    <div class="span-4 r_border" align="center" style="padding-top: 11px">
                                        <div class=" j_center thank_title">下次送貨日</div>
                                        <div class="row"><div class="sapn-12"><?=$service['service_date_next_year']?></div></div>
                                        <div class="row"><div class="sapn-12" ><?=$service['service_date_next_date']?><?if(strtotime($service['service_date_next']) < strtotime("yesterday") AND $service['service_date_next_date']!="-")echo "<br>(已過期)";?></div></div>
                                    </div>
                                    <div class="span-4 r_border" align="center" style="padding-top: 11px">
                                        <div class=" j_center thank_title">間隔天數</div>
                                        <div class="row"><div class="sapn-12" style="margin-top: 14px">每隔<span style="font-size: 2em"><?=$service['service_frequency']?></span>日</div></div>

                                    </div>
                                    <div class="span-4" align="center" style="padding-top: 11px">
                                        <div class=" j_center thank_title">總金額</div>
                                        <div class="row"><div class="sapn-12" style="margin-top: 14px"><span style="font-size: 2em;"><?=$total?></span>元</div></div>

                                    </div>

                                </div>

                            </fieldset>

                            <fieldset>
                                <legend><span class="icon-location"></span>物流資訊</legend>

                                <div class="row j_user_info j_div_center">
                                    <div class="small-span-12 span-3 j_label ">會員帳號：</div>
                                    <div class="small-span-12 span-7 j_left thank_member"><?=$member_account?></div>
                                </div>
                                <div class="row j_user_info j_div_center">
                                    <div class="small-span-12 span-3  j_label">收件人姓名：</div>
                                    <div class="small-span-12 span-7 j_left thank_member"><?=$member_name?></div>
                                </div>
                                <div class="row j_user_info j_div_center">
                                    <div class="small-span-12 span-3  j_label">聯絡電話：</div>
                                    <div class="small-span-12 span-7 j_left thank_member"><?=$member_phone?></div>
                                </div>
                                <div class="row j_user_info j_div_center">
                                    <div class="small-span-12 span-3  j_label">收件地址：</div>
                                    <div class="small-span-12 span-7 j_left thank_member"><?=$member_address?></div>
                                </div>
                                <div class="row j_user_info j_div_center">
                                    <div class="small-span-12 span-3  j_label">收件時間：</div>
                                    <div class="small-span-12 span-7 j_left thank_member"><?=$member_receive?></div>
                                </div>
                                <pre>
                                    <?//print_r($order);?>
                                    </pre>
                                <div class="mem-editButtons">
                                    <a href="<?=base_url()?>membership" class="button button-pill button-flat-action button-small">前往會員專頁 <span class="icon-location"></span></a>
                                </div>
                            </fieldset>
                            <div class="info_fb">
                                <div class="fb-like" data-href="http://facebook.com/pawmaji" data-layout="standard" data-action="recommend" data-show-faces="true" data-share="true"></div><br>
                                <h2>客服專線 : 0972 953 966</h2>
                            </div>

                        </div>
                    </div>
                </div><!-- END of sub-main -->
            </div>
        </div>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="<?=base_url()?>dist/js/vendor/jquery-1.11.0.min.js"><\/script>')</script>

        <script src="<?= base_url() ?>dist/js/plugins.js"></script>
        <script src="<?= base_url() ?>dist/js/main.js"></script>
        <script src="<?= base_url() ?>dist/js/ajax/getResponse.js"></script>
        <script>
            $( document ).ready(function() {
                paid_confirm('<?=$this->session->all_userdata()['email']?>');
            });
        </script>
