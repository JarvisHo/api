<style>
    #panel-title {
        background: #7db500;
        color: #ffffff;
        font-weight: 300;
        font-size: 14px;
        font-family: "Helvetica Neue Light", "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif;
    }

    .bottom-text {
        font-size: 24px;
    }
</style>

<!-- Bootstrap Core CSS-->
<link href="<?= base_url(); ?>dist/bower_components/bootstrap/dist/css/bootstrap.min.custom.css" rel="stylesheet">

<div id="container"></div><!--pickadate panel-->

<!-- membership -->
<!-- background img & title -->
<style>

</style>

<div class="sub-banner back-cover clearfix" style="background-image: url(<?= base_url() ?>dist/img/step_banner3.jpg);">
    <!-- background image. inline css 可用 php 設定背景 -->
    <div class="span-12">
        <h2>常見問題</h2>
    </div>
</div>
<!--membership. main section 沿用 subscribe flow template-->
<div class="membership sub-flow tool-boxshadow clearfix">
    <div class="warper">

        <!-- members' info & subscribed products list -->
        <div class="sub-main row">

            <!-- members' info -->
            <div class="sub-info span-11 small-span-12" style="margin-left: 30px">

                <div class="sub-faq">
                    <div class="panel panel-default">
                        <div class="panel-heading" id="panel-title">
                            服務相關問題
                        </div>
                        <!-- .panel-heading -->
                        <div class="panel-body">
                            <div class="panel-group" id="accordion">
                                <div class="panel panel-default">
                                    <div class="panel-heading" role="tab" id="headingOne" data-toggle="collapse"
                                         data-parent="#accordion" href="#collapseOne" aria-expanded="true"
                                         aria-controls="collapseOne" style="cursor: pointer">
                                        <h4 class="panel-title" id="-collapsible-group-item-#1-">
                                            PawMaji的服務是什麼?
                                            <a class="anchorjs-link" href="#-collapsible-group-item-#1-"><span
                                                    class="anchorjs-icon"></span></a></h4>
                                    </div>
                                    <div id="collapseOne" class="panel-collapse collapse" role="tabpanel"
                                         aria-labelledby="headingOne">
                                        <div class="panel-body">
                                            PawMaji 是為您家狗狗量身定做的狗食定時宅配服務. 用最便宜的價格與方式, 為您減輕飼料太重或難以保鮮的負擔與麻煩
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading" data-toggle="collapse" data-parent="#accordion"
                                         href="#collapseTwo" class="collapsed" aria-expanded="false"
                                         style="cursor: pointer">
                                        <h4 class="panel-title">
                                            如何參加PawMaji的服務
                                        </h4>
                                    </div>
                                    <div id="collapseTwo" class="panel-collapse collapse" aria-expanded="false">
                                        <div class="panel-body">
                                            <p>參加我們的服務很簡單, 只要以下三個步驟即可<br/>
                                                1. 選一個狗食的品牌<br/>
                                                2. 選個宅配日期跟間隔天數<br/>
                                                3. 完成結帳</p>

                                            <p>剩下的就全部交給我們處理摟</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">


                                    <div class="panel-heading" data-toggle="collapse" data-parent="#accordion"
                                         href="#collapseThree" class="collapsed" aria-expanded="false"
                                         style="cursor: pointer">
                                        <h4 class="panel-title"> 我要如何暫停/更改我的定期宅配內容 (包括下次送貨日跟間隔日)?</h4>
                                    </div>
                                    <div id="collapseThree" class="panel-collapse collapse" aria-expanded="false">
                                        <div class="panel-body">
                                            <p>1. 到右上角登入<br/>
                                                2. 剩下應該就一目了然摟~~</p>

                                            <p><img src="<?= base_url() ?>images/membership_details.png" alt=""
                                                    width="900" height="700"/></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">


                                    <div class="panel-heading" data-toggle="collapse" data-parent="#accordion"
                                         href="#collapseFour" class="collapsed" aria-expanded="false"
                                         style="cursor: pointer">


                                        <h4 class="panel-title">會有會員費或是其他的額外費用嗎?</h4>
                                    </div>
                                    <div id="collapseFour" class="panel-collapse collapse" aria-expanded="false">
                                        <div class="panel-body">
                                            <p>現在加入我們會員的人, 可以享受終身免會員費, 免運費!</p>

                                            <p>&nbsp;</p>
                                        </div>
                                    </div>
                                </div>


                                <div class="panel panel-default">


                                    <div class="panel-heading" data-toggle="collapse" data-parent="#accordion"
                                         href="#collapseFive" class="collapsed" aria-expanded="false"
                                         style="cursor: pointer">
                                        <h4 class="panel-title">你們接受什麼樣的付款方式?</h4>
                                    </div>
                                    <div id="collapseFive" class="panel-collapse collapse" aria-expanded="false">
                                        <div class="panel-body">
                                            <p>目前我們只接受信用卡付費</p>

                                            <p>&nbsp;</p>
                                        </div>
                                    </div>
                                </div>


                                <div class="panel panel-default">


                                    <div class="panel-heading" data-toggle="collapse" data-parent="#accordion"
                                         href="#collapseSix" class="collapsed" aria-expanded="false"
                                         style="cursor: pointer">
                                        <h4 class="panel-title">我要如何更改帳戶綁定的信用卡?</h4>
                                    </div>
                                    <div id="collapseSix" class="panel-collapse collapse" aria-expanded="false">
                                        <div class="panel-body">
                                            <p>為了安全起見, 如果您需要更改會員帳戶的信用卡內容, <a href="<?= base_url() ?>contact">請聯絡我們客服</a>
                                            </p>

                                            <p>&nbsp;</p>
                                        </div>
                                    </div>
                                </div>


                                <div class="panel panel-default">


                                    <div class="panel-heading" data-toggle="collapse" data-parent="#accordion"
                                         href="#collapseSeven" class="collapsed" aria-expanded="false"
                                         style="cursor: pointer">
                                        <h4 class="panel-title">我可以退貨退費嗎?</h4>
                                    </div>
                                    <div id="collapseSeven" class="panel-collapse collapse" aria-expanded="false">
                                        <div class="panel-body">
                                            <p>當然可以, <a href="<?= base_url() ?>contact">請聯絡我們客服</a>, 我們專人會為您解決退貨跟退費的問題<a
                                                    href="<?= base_url() ?>contact"></a></p>

                                            <p>&nbsp;</p>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                        <div
                        = align="center">
                        <p class="bottom-text">還有其他疑問嗎? </p>

                        <p class="bottom-text"><a href="<?= base_url() ?>contact">聯絡我們客服</a></p>
                    </div>
                    <p>
                </div>
                </p>
                <p>
            </div>
            <!-- .panel-body -->
        </div>
    </div>
    <!-- .panel-body -->
</div>


</div>

</div>
</div><!-- END of sub-main -->
</div>
</div>

<script src="<?= base_url(); ?>dist/bower_components/jquery/dist/jquery.min.js"></script>
<script src="<?= base_url(); ?>dist/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="<?= base_url(); ?>dist/bower_components/metisMenu/dist/metisMenu.min.js"></script>
<script src="<?= base_url(); ?>dist/js/sb-admin-2.js"></script>
<script src="<?= base_url() ?>dist/js/plugins.js"></script>
<script src="<?= base_url() ?>dist/js/main.js"></script>
