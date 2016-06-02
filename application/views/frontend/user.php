<link rel="stylesheet" href="<?= base_url() ?>dist/pickadate/themes/default.css" xmlns="https://www.w3.org/1999/html">
<link rel="stylesheet" href="<?= base_url() ?>dist/pickadate/themes/default.date.css">
<div id="container"></div><!--pickadate panel-->

<link rel="stylesheet" href="<?= base_url() ?>dist/parsley/src/parsley.css">

<style>
    input{
        margin-bottom: 5px;
    }
    .number{
        width: 20%;
    }
</style>

<!-- background img & title -->
<div class="sub-banner back-cover clearfix" style="background-image: url(<?= base_url() ?>dist/img/step_banner3.jpg);"><!-- background image. inline css 可用 php 設定背景 -->
    <div class="span-12">
        <h2>會員資料</h2>
    </div>
</div>

<!--subscribe info. main section -->
<div class="sub-flow tool-boxshadow clearfix">
    <div class="warper">
        <!-- multi step progress bar -->
        <!-- Shopping Cart and Products info. -->
        <div class="sub-main row">
            <!-- Products info. -->
            <div class="sub-info span-8 small-span-12">

                <div class="sub-signup">
                    <h3>請填妥詳細訂購資訊</h3>
                    <? echo form_open('user', array('id' => 'user','data-parsley-validate'=>''));
                    echo form_hidden(array('action' => 'user'));
                    echo form_hidden(array('member_id' => $this->session->all_userdata()['member_id']));
                    ?>
                        <fieldset>
                            <legend>訂購資訊</legend>
                            <table class="sub-signup_form span-12">
                                <tr>
                                    <td class="span-4 mt tar">
                                        <lable for="name">收件人姓名：</lable>
                                    </td>
                                    <td class="span-7 mt">
                                        <input required="required" class="span-12" type="text" name="fullname" id="name"
                                               value="<?=$member_name?>" placeholder="請填入您的大名 (限中文字)"
                                               data-parsley-trigger="change" data-parsley-minlength="2">
                                    </td>
                                    <!-- data-parsley-pattern="^[\u4E00-\u9FA5]*[\u4E00-\u9FA5]$" -->
                                </tr>
                                <tr>
                                    <td class="span-4 mt tar">
                                        <lable for="address">收件地址：</lable>
                                    </td>
                                    <td class="span-7 mt">
                                        <input required="required" class="span-12" type="text" name="address" data-parsley-trigger="change"
                                               id="address" value="<?=$member_address?>" placeholder="請填入您的收件地址" data-parsley-minlength="6">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="span-4 mt tar">
                                        <lable for="phone">聯絡電話：</lable>
                                    </td>
                                    <td class="span-7 mt">
                                        <input required="required" class="span-12" type="tel" name="cellphone"
                                               id="phone" value="<?=$member_phone?>" placeholder="請填入您的聯絡電話 (需10個號碼)"
                                               data-parsley-pattern="[0]{1}[0-9]{9}" onchange="auto_fix(this.id)"
                                               data-parsley-trigger="change">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="span-4 mt tar">
                                        <lable for="phone">收件時間：</lable>
                                    </td>
                                    <td class="span-7 mt">
                                        <input required="required" type="radio" name="receiveTime" value="2" <?if($member_shipping==2)echo "checked='checked'"?>> 上午
                                        <input required="required" type="radio" name="receiveTime" value="1" <?if($member_shipping==1)echo "checked='checked'"?>> 下午
                                        <input required="required" type="radio" name="receiveTime" value="0" <?if($member_shipping==0)echo "checked='checked'"?>> 晚上
                                    </td>
                                </tr>

                            </table>
                        </fieldset>

                        <center><button type="submit" class='button button-highlight button-rounded wow pulse' >確認變更 <span class='icon-checkbox-checked'></span></button></center>
                </div>

            </div>
            </form>
        </div>
    </div>
</div>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="<?=base_url()?>dist/js/vendor/jquery-1.11.0.min.js"><\/script>')</script>

<script src="<?= base_url() ?>dist/js/plugins.js"></script>
<script src="<?= base_url() ?>dist/js/main.js"></script>
<script src="<?= base_url() ?>dist/js/jquery.creditCardValidator.js"></script>
<script src="<?= base_url() ?>dist/parsley/dist/parsley.js"></script>
<script src="<?= base_url() ?>dist/parsley/src/i18n/zh_tw.js"></script>
<script src="<?= base_url() ?>dist/pickadate/picker.js"></script>
<script src="<?= base_url() ?>dist/pickadate/picker.date.js"></script>
<script src="<?= base_url() ?>dist/pickadate/legacy.js"></script>


<!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
<script>

    $('#user').parsley();

    var $input = $( '.datepicker' ).pickadate({
        format: 'yyyy-mm-dd',
        formatSubmit: 'yyyy-mm-dd',
        min: 1,
        max: 121,
        container: '#container',
        // editable: true,
        closeOnSelect: true,
        closeOnClear: false
    });

    $('#cardNumber').change(function() {
        $('#cardNumber').validateCreditCard(function (result) {
            if (result.valid == true) {
                $('.info').html(' 卡別: ' + (result.card_type == null ? '-' : result.card_type.name));
                // + '<br>Valid: ' + result.valid
                // + '<br>Length valid: ' + result.length_valid
                // + '<br>Luhn valid: ' + result.luhn_valid);
            } else {
                $('.info').html('目前仍無法辨識您的卡別，可能會導致刷卡失敗。');
            }
        });
    });

    function auto_fix(x)
    {
        var s=document.getElementById(x).value;
        var pattern = new RegExp("[-`~!@#$^&*()=|{}':;',\\[\\].<>/?~！@#￥……&*（）——|{}【】‘；：”“'。，、？]");
        var rs = "";
        for (var i = 0; i < s.length; i++) {
            rs = rs+s.substr(i, 1).replace(pattern, '');
        }
        document.getElementById(x).value=rs;
    }

</script>