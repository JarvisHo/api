<link rel="stylesheet" href="<?= base_url() ?>dist/pickadate/themes/default.css" xmlns="https://www.w3.org/1999/html">
<link rel="stylesheet" href="<?= base_url() ?>dist/pickadate/themes/default.date.css">
<div id="container"></div><!--pickadate panel-->

<style>


     p ul{
         display: inline;
     }
</style>

<!-- background img & title -->
<div class="sub-banner back-cover clearfix" style="background-image: url(<?= base_url() ?>dist/img/step_banner3.jpg);"
     xmlns="https://www.w3.org/1999/html" xmlns="https://www.w3.org/1999/html">
    <!-- background image. inline css 可用 php 設定背景 -->
    <div class="span-12">
        <h2>最後一步了！</h2>
    </div>
</div>

<!--subscribe info. main section -->
<div class="sub-flow tool-boxshadow clearfix">
    <div class="warper">
        <!-- multi step progress bar -->
<!--        <div class="row">-->
<!--            <div class="sub-flow_progbar small-span-10 small-offset-1 large-span-6 large-offset-3">-->
<!--                <img src="--><?//= base_url() ?><!--dist/img/step3.png" alt="">-->
                <!-- multi step progress bar -->
<!--            </div>-->
<!--        </div>-->
        <!-- Shopping Cart and Products info. -->
        <div class="sub-main row">
            <!-- Products info. -->
            <div class="sub-info span-8 small-span-12">

                <div class="sub-signup">
                    <h3>請填妥詳細訂購資訊</h3>
                    <? echo form_open('form', array('id' => 'form','data-parsley-validate'=>''));
                    echo form_hidden(array('action' => 'form'));
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
                                               value="<?=$member_name?>" placeholder="請填入您的大名 (限中英文,不接受數字)" data-parsley-pattern="^[^0-9]*[^0-9]$"
                                               data-parsley-trigger="change" data-parsley-minlength="2" data-parsley-error-message="請輸入中英文，不接受數字">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="span-4 mt tar">
                                        <lable for="address">收件地址：</lable>
                                    </td>
                                    <td class="span-7 mt">
                                        <input required="required" class="span-12" type="text" name="address" data-parsley-trigger="change"
                                               id="address" value="<?=$member_address?>" placeholder="請填入您的送貨地址" data-parsley-minlength="6">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="span-4 mt tar">
                                        <lable for="phone">聯絡電話：</lable>
                                    </td>
                                    <td class="span-7 mt">
                                        <input required="required" class="span-12" type="tel" name="cellphone"
                                               id="phone" value="<?=$member_phone?>" placeholder="請填入手機或電話號碼 (純數字例如：0223456789)"
                                               data-parsley-error-message="請輸入有效的電話號碼 (只接受數字)"
                                               data-parsley-pattern="[0]{1}[0-9]{9}"
                                               data-parsley-trigger="change" onchange="auto_fix(this.id)">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="span-4 mt tar">
                                        <lable for="phone">收件時間：</lable>
                                    </td>
                                    <td class="span-7 mt">
                                        <input required="required" type="radio" name="receiveTime" value="3" <?if($member_shipping==3 or $member_shipping=="")echo "checked='checked'"?>> 不限
                                        <input required="required" type="radio" name="receiveTime" value="1" <?if($member_shipping==1)echo "checked='checked'"?>> 下午
                                        <input required="required" type="radio" name="receiveTime" value="0" <?if($member_shipping==0 and $member_shipping!="")echo "checked='checked'"?>> 晚上
                                        <input required="required" type="radio" name="receiveTime" value="2" <?if($member_shipping==2)echo "checked='checked'"?>> 上午
                                    </td>
                                </tr>

                                <tr>
                                    <td class="span-4 mt tar">
                                        <lable for="phone" style="font-size: 0.9em">第一次送貨日：</lable>
                                    </td>
                                    <td class="span-7 mt">
                                        <input class="span-12 datepicker" type="text" name="nextdate"
                                               data-parsley-trigger="change" id="nextdate"
                                               value="<? if(!empty($member_date_next)){echo $member_date_next; }else{ echo date("Y-m-d",strtotime("today"));}?>" placeholder="馬上寄出 (點我更改)" >
                                        <p>送貨日當天才會完成刷卡交易, 可隨時登入更改送貨日.</p>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="span-4 mt tar">
                                        <lable for="name" style="font-size: 0.9em">送貨間隔天數：</lable>
                                    </td>

                                    <td class="span-7 mt">
                                        <input name="frequency" type="text" class="span-12"
                                               data-parsley-trigger="change" id="frequency"
                                               data-parsley-type="integer"
                                               data-parsley-range="[7,120]" value="<? if(isset($member_frequency))echo $member_frequency?>"
                                               placeholder="7~120 (單位：日；不需填單位，純數字即可)" required="required" onchange="auto_fix(this.id)">
                                        <p>第一次送貨後, 您希望每隔幾天送一次貨. (可隨時更改)</p>
                                    </td>
                                </tr>
                            </table>
                        </fieldset>
                   <div align ="center"> <b>我們在送貨<span class="j_highlight">五天前</span>會發e-mail通知確認, 屆時您可以再決定是否要出貨或變更設定</b></div>

                    <? if($this->session->all_userdata()['member_id']!="" AND empty($member_last4) AND !empty($member_name)) {?>
                        <fieldset style="background: rgba(220%,0%,0%,0.15);">
                            <table >
                                <tr>
                                    <td class="span-12 " >
                                        <div class="panel panel-default">
                                            <div class="panel-body" >
                                                <i class="fa fa-credit-card" style="margin: 0px 10px"></i> 您過去的信用卡號已經失效，請輸入新的信用卡號。
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </fieldset>
                        <? } ?>

                        <fieldset>
                            <legend>信用卡資料</legend>
                            <table class="sub-signup_form span-12">
                                <tr>
                                    <td class="span-4 mt tar">
                                        <lable for="address">信用卡別：</lable>
                                    </td>
                                    <td class="span-7" align="left" >
                                        <p style="margin-top: 4px">
                                            <img src="<?=base_url()?>site_images/all_cc_c.jpg"
                                                 style="height: 35px;margin-right: 5px">
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="span-4 mt tar">
                                        <lable for="phone">信用卡號：</lable>
                                    </td>
                                    <td class="span-7" align="left">
                                        <p style="margin-top: 12px">
                                            <!--input name="card1" type="text" class="number"> - <input name="card2" type="text" class="number"> -
                                            <input name="card3" type="text" class="number"> - <input name="card4" type="text" class="number"-->
                                            <input name="cardNumber" id="cardNumber" type="text"
                                                   style='width:150px;margin-bottom: 5px;' onchange="auto_fix(this.id)"
                                                   data-parsley-type="integer" required
                                                   data-parsley-trigger="change"
                                                   maxlength="16" minlength="13"> <span class='info'></span>
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="span-4 mt tar">
                                        <lable for="name">有效期限：</lable>
                                    </td>
                                    <td class="span-7" align="left">
                                        <p style="margin-top: 12px">
                                            <select name="month">
                                                <option value="01">1</option>
                                                <option value="02">2</option>
                                                <option value="03">3</option>
                                                <option value="04">4</option>
                                                <option value="05">5</option>
                                                <option value="06">6</option>
                                                <option value="07">7</option>
                                                <option value="08">8</option>
                                                <option value="09">9</option>
                                                <option value="10">10</option>
                                                <option value="11">11</option>
                                                <option value="12">12</option>
                                            </select> 月
                                            <select name="year" >
                                                <option value="15">2015</option>
                                                <option value="16">2016</option>
                                                <option value="17">2017</option>
                                                <option value="18">2018</option>
                                                <option value="19">2019</option>
                                                <option value="20">2020</option>
                                                <option value="21">2021</option>
                                                <option value="22">2022</option>
                                            </select> 年
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="span-4 mt tar">
                                        <lable for="name"><br>認證碼：</lable>
                                    </td>
                                    <td class="span-7" align="left">
                                        <p><img src="<?=base_url()?>dist/img/vvcode.png">
                                            <input required maxlength="5" minlength="3" data-parsley-type="integer"
                                                   data-parsley-trigger="change" name="ccv" type="text" class="form_card_ccv_number"
                                                   required="required" onchange="auto_fix(this.id)">
                                        </p>

                                    </td>
                                </tr>
                            </table>
                            <? if(!is_mobile()){?>
                            <div class="j_shield_box"><img src="<?=base_url()?>site_images/safe.png" class="j_shield"><p>您的資訊安全與個人隱私<br>是我們最大的責任</p></div>
                            <?}?>
                        </fieldset>

                        <center>
                            <? if(!is_mobile()){?><img src="<?=base_url()?>site_images/stock_lock.png" style="width: 30px; margin-right: 6px" ><?}?>
                            <button id="finish_btn" type="submit" class="button button-highlight button-rounded wow pulse form_complete"> 完成訂單 <span class='icon-checkbox-checked'></span></button></center>

                    <? if(is_mobile()){?>
                        <div class="j_shield_box"><img src="<?=base_url()?>site_images/safe.png" class="j_shield"><p>您的資訊安全與個人隱私<br>是我們最大的責任</p></div>
                    <?}?>
                </div>

            </div>
            </form>

            <!-- shopping cart-->
            <!-- shopping cart-->
            <div class="span-4 small-span-12" id="sub-cart">
                <div class="sub-cart_header center">
                    <p>您的購物車目前共有 <span><?=$this->cart->total_items();?></span> 項商品</p>
                </div>
                <div class="sub-cart_body center clearfix">
                    <?$i = 1;
                    foreach ($this->cart->contents() as $items):
                        unset($product);
                        $product = $this->model_product->get_product($items['product']);
                        ?>
                        <!-- cart item unit -->
                        <div class="row">
                            <div class="sub-cart_item">
                                <div class="span-2">
                                    <img src="<?= $product['product_image'];?>" alt="">
                                </div>
                                <div class="span-8">
                                    <div class="span-12"><h5><?=$product['product_name']?></h5>
                                        <?php if ($this->cart->has_options($items['rowid']) == TRUE): ?>
                                            <p>
                                                <?php foreach ($this->cart->product_options($items['rowid']) as $option_name => $option_value): ?>

                                                    <strong><?php echo $option_name; ?>:</strong> <?php echo $option_value; ?><br />

                                                <?php endforeach; ?>
                                            </p>
                                        <?php endif; ?>
                                    </div>
                                    <div class="span-6"><p style="height: 18px;padding-top: 1px">單價：<span><?=$items['price']; ?>元</span></p></div>
                                    <div class="span-6"><p>數量：<span><?=$items['qty']; ?><?//=form_input(array('name' => $i.'[qty]', 'value' => $items['qty'], 'maxlength' => '3', 'size' => '5')); ?></span></p></div>
                                </div>
                                <?=form_open('store', array('id' => 'form_id_'.$items['id']) )?>
                                <input type="hidden" name="action" value="cart">
                                <input type="hidden" name="package_id" value="<?=$items['id']?>">
                                <input type="hidden" name="package_qty" value="-1">
                                <div class="span-2">
                                    <a href="#" onclick="document.forms.<?='form_id_'.$items['id']?>.submit()"><span class="icon-minus"></span></a>
                                </div>
                                </form>
                            </div>
                        </div>
                        <!-- END OF cart item unit-->
                        <?php $i++; ?>
                    <?endforeach?>
                </div>
                <div class="sub-cart_footer center">
                    <div class="sub-cart_total">
                        <p>合計 Total：<span><?= substr($this->cart->format_number($this->cart->total()),0,-3); ?></span> 元</p>
                    </div>

                </div>

            </div>
            <!-- shopping cart-->
            <!-- shopping cart-->

            <div class="span-4 small-span-12" >
                <div style="text-align: center">
                    <img src="<?=base_url()?>site_images/ssl.png" style="width:75%;margin-top: 40px;">
                </div>
                <div style="text-align: center">
                    <p style="font-size:0.9em;">
                        本站全天24小時處於256位元的<span class="j_highlight">安全機制</span>下
                    </p>
                </div>
                <div style="text-align: center">
                    <img src="<?=base_url()?>site_images/godaddy_verified_and_secured_1.png" style="width: 230px">
                </div>
                <div style="text-align: center">
                    <p style="font-size:0.9em;">
                        <span style="margin-left: 10px">美國Godaddy.com頒發的資安認證</span>
                    </p>
                </div>

            </div>

        </div>
    </div>
</div>


<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="<?=base_url()?>dist/js/vendor/jquery-1.11.0.min.js"><\/script>')</script>

<script src="<?= base_url() ?>dist/js/plugins.js"></script>
<script src="<?= base_url() ?>dist/js/main.js"></script>
<script src="<?= base_url() ?>dist/js/jquery.creditCardValidator.js"></script>
<script src="<?= base_url() ?>dist/pickadate/picker.js"></script>
<script src="<?= base_url() ?>dist/pickadate/picker.date.js"></script>
<script src="<?= base_url() ?>dist/pickadate/legacy.js"></script>


<!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
<script>
    $(document).ready(function() {

        $('#final').parsley();

        var $input = $( '.datepicker' ).pickadate({
            format: 'yyyy-mm-dd',
            formatSubmit: 'yyyy-mm-dd',
            min: true,
            max: 121,
            container: '#container',
            // editable: true,
            closeOnSelect: true,
            closeOnClear: false
        });

        $('#cardNumber').change(function() {
            $('#cardNumber').validateCreditCard(function (result) {
                if (result.valid == true) {
                    $('.info').html(' ' + (result.card_type == null ? '' : " <i class='fa fa-check j_pass'></i>"));
                    $('#finish_btn').attr("disabled", false);
                    // + '<br>Valid: ' + result.valid
                    // + '<br>Length valid: ' + result.length_valid
                    // + '<br>Luhn valid: ' + result.luhn_valid);
                } else {
                    $('.info').html('<span class="j_blocker j_highlight">無法辨識您的卡別，請確認。</span>');
                    $('#finish_btn').attr("disabled", true);
                }
            });
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

    setTimeout(function(){
        $('.form_operation').fadeOut();
        $('.form_logo').attr("href", "<?= base_url() ?>");
    }, 500);
</script>