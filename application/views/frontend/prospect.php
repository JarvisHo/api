<link rel="stylesheet" href="<?= base_url() ?>dist/parsley/src/parsley.css">
<link rel="stylesheet" href="<?= base_url() ?>dist/pickadate/themes/default.css" xmlns="https://www.w3.org/1999/html">
<link rel="stylesheet" href="<?= base_url() ?>dist/pickadate/themes/default.date.css">
<div id="container"></div><!--pickadate panel-->

<!-- membership -->
        <!-- background img & title -->

        <div class="sub-banner back-cover clearfix" style="background-image: url(<?= base_url() ?>dist/img/step_banner3.jpg);"><!-- background image. inline css 可用 php 設定背景 -->
            <div class="span-12">
                <h2>會員管理中心</h2>
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
                            <h3>您的會員資料</h3>

                            <fieldset style="border: dotted 2px #adadad">
                                <legend><span class="icon-location"></span>定期宅配服務</legend>
                                <div class=" span-12 j_center">
                                    <div class=" j_center">
                                        <h1>您沒有任何正在進行的定期宅配服務</h1>
                                        <a href="<?=base_url()?>store"
                                           class="j_center j_w80 j_btn_big button button-pill button-flat-action button-large"
                                           >馬上開始 <span class="icon-cart"></span></a>
                                    </div>
                                </div>
                            </fieldset>

                            <div class="clearfix"></div>

                            <fieldset>
                                <legend><span class="icon-location"></span>會員資訊</legend>
                                <table class="sub-signup_form span-12">
                                    <tr>
                                        <th class="span-4 mt tar">
                                            <lable for="email">您的帳號：</lable>
                                        </th>
                                        <td class="span-7" align="left">
                                            <p><?=$this->session->all_userdata()['email']?></p>
                                        </td>
                                    </tr>
                                </table>
                            </fieldset>

                        </div>

                    </div>
                </div><!-- END of sub-main -->
            </div>
        </div>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="<?=base_url()?>dist/js/vendor/jquery-1.11.0.min.js"><\/script>')</script>

        <script src="<?= base_url() ?>dist/js/plugins.js"></script>
        <script src="<?= base_url() ?>dist/js/main.js"></script>
        <script src="<?= base_url() ?>dist/pickadate/picker.js"></script>
        <script src="<?= base_url() ?>dist/pickadate/picker.date.js"></script>
        <script src="<?= base_url() ?>dist/pickadate/legacy.js"></script>
        <script src="<?= base_url() ?>dist/parsley/dist/parsley.js"></script>
        <script src="<?= base_url() ?>dist/parsley/src/i18n/zh_tw.js"></script>


        <script>


            var $input = $('.datepicker').pickadate({
                format: 'yyyy-mm-dd',
                formatSubmit: 'yyyy-mm-dd',
                min: 1,
                max: 121,
                container: '#container',
                // editable: true,
                closeOnSelect: true,
                closeOnClear: false
            });
        </script>