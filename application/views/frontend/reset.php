
<link rel="stylesheet" href="<?= base_url() ?>dist/parsley/src/parsley.css">

        <?=form_open('reset', array('id' => 'user','data-parsley-validate'=>''));?>
        <div class="sub-banner back-cover clearfix" style="background-image: url(<?= base_url() ?>dist/img/step_banner3.jpg);"><!-- background image. inline css 可用 php 設定背景 -->
            <div class="span-12">
                <h2>忘記密碼</h2>
            </div>
        </div>
        <!--membership. main section 沿用 subscribe flow template-->
        <div class="membership sub-flow tool-boxshadow clearfix">
            <div class="warper">

                <!-- members' info & subscribed products list -->
                <div class="sub-main row">

                    <!-- members' info -->
                    <div class="sub-info span-11 small-span-12" style="margin-left: 30px">

                        <div class="sub-signup">
                            <h3>請填寫您的帳號資訊</h3>
                            <fieldset>
                                <legend>帳號資訊</legend>
                                <table class="sub-signup_form span-12">
                                    <tr>
                                        <td class="span-4 mt tar">
                                            <lable for="name">電子郵件信箱：</lable>
                                        </td>
                                        <td class="span-7 mt">

                                            <input required="required" class="span-12" name="email" value="<?=$email?>"
                                                   style="margin-bottom: 10px" placeholder="E-mail" type="email" data-parsley-trigger="change" >
                                            <p>我們將會將重設密碼信件送到您的信箱</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="span-4 mt tar">
                                            <lable for="name">圖形驗證器：</lable>
                                        </td>
                                        <td class="span-7 mt">
                                            <?=$image?><br>
                                            <input type="text" name="captcha" required="required" data-parsley-minlength="8" class="span-12" value="" data-parsley-trigger="change" style=";margin: 6px 0" />
                                            <p>請協助我們排除進擊的機器人，謝謝！</p>
                                        </td>

                                </table>
                                <center><?=$msg?></center>
                            </fieldset>

                            <center><button type="submit" class='button button-highlight button-rounded wow pulse' >確認送出 <span class='icon-arrow-right-alt1'></span></button></center>
                        </div>

                    </div>
                </div><!-- END of sub-main -->
            </div>
        </div>
        </form>


        <script src="<?= base_url() ?>dist/js/plugins.js"></script>
        <script src="<?= base_url() ?>dist/js/main.js"></script>

        <script>

            $(document).ready(function() {
                $('#user').parsley();
            }
        </script>