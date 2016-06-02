<style>
    input{
        margin-bottom: 5px;
    }
</style>

<!-- background img & title -->
<div class="sub-banner back-cover clearfix" style="background-image: url(<?= base_url() ?>dist/img/step_banner2.jpg);"
     xmlns="https://www.w3.org/1999/html" xmlns="https://www.w3.org/1999/html">
    <!-- background image. inline css 可用 php 設定背景 -->
    <div class="span-12">
        <h2>快速加入會員</h2>
    </div>
</div>

<!--subscribe info. main section -->
<div class="sub-flow tool-boxshadow clearfix">
    <div class="warper">
        <!-- multi step progress bar -->
<!--        <div class="row">-->
<!--            <div class="sub-flow_progbar small-span-10 small-offset-1 large-span-6 large-offset-3">-->
<!--                <img src="--><?//= base_url() ?><!--dist/img/step2.png" alt=""><!-- multi step progress bar -->
<!--            </div>-->
<!--        </div>-->
        <!-- Shopping Cart and Products info. -->
        <div class="sub-main row">
            <!-- Products info. -->
            <div class="sub-info span-8 small-span-12">

                <div class="sub-signup">
                    <h3>快速加入會員</h3>

                        <? echo form_open('register', array('id' => 'register','data-parsley-validate'=>''))?>
                        <?=form_hidden(array('action' => 'register'))?>
                        <?=form_hidden(array('source' => 'startup'))?>
                        <fieldset>
                            <legend>創立帳號</legend>
                            <table class="sub-signup_form span-12">
                                <tr>
                                    <td class="span-4 mt tar">
                                        <lable for="email">電子信箱：</lable>
                                    </td>
                                    <td class="span-7 mt">
                                        <input required="required" class="span-12" type="email" name="new_email" id="new_email"
                                               value="<?if(isset($member_account))echo $member_account;?>" placeholder="eg. service@pawmaji.com" data-parsley-type="email"
                                               data-parsley-trigger="change">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="span-4 mt tar">
                                        <lable for="password">設定密碼：</lable>
                                    </td>
                                    <td class="span-7 mt">
                                        <input required="required" class="span-12" type="password" name="new_password"
                                               id="new_password"
                                               placeholder="至少八個英文或數字" data-parsley-trigger="change"　
                                               data-parsley-length="[8, 20]">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="span-4 mt tar">
                                        <lable for="cpassword">確認密碼：</lable>
                                    </td>
                                    <td class="span-7 mt">
                                        <input required="required" class="span-12" type="password" name="verify_password"
                                               id="verify_password" value="" placeholder="請再輸入一次密碼確認"
                                               data-parsley-trigger="change" data-parsley-equalto="#new_password">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="span-12 mt tar" style="text-align: center">

                                        <button type="submit" class='button button-highlight button-rounded wow pulse' onclick="email_confirm(document.getElementById('new_email').value)" >下一步 NEXT <span class='icon-arrow-right-alt1'></span></button>

                                        <a href="<?=base_url()?>store" class="button button-highlight button-rounded disabled" style="color:#3c3c3c;border: solid 1px #3c3c3c; cursor: pointer">略過 SKIP</a>

                                    </td>
                                </tr>
                            </table>
                        </fieldset>
                        </form>

                        <?=form_open('login', array('id' => 'login','data-parsley-validate'=>''))?>
                        <?=form_hidden(array('action' => 'login'))?>
                        <?=form_hidden(array('source' => 'startup'))?>
                        <fieldset>
                            <legend>我是舊會員 - 登入帳號</legend>
                            <table class="sub-signup_form span-12">
                                <tr>
                                    <td class="span-4 mt tar">
                                        <lable for="email">電子信箱：</lable>
                                    </td>
                                    <td class="span-7 mt">
                                        <input required="required" class="span-12" type="email" name="email" id="email"
                                               value="<?if(isset($member_account))echo $member_account;?>" placeholder="eg. service@pawmaji.com" data-parsley-type="email"
                                               data-parsley-trigger="change">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="span-4 mt tar">
                                        <lable for="password">輸入密碼：</lable>
                                    </td>
                                    <td class="span-7 mt">
                                        <input required="required" class="span-12" type="password" name="password"
                                               id="password" placeholder="至少八個英文或數字" data-parsley-trigger="change"　
                                               data-parsley-length="[8, 20]">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="span-12 mt tar" style="text-align: center">

                                        <button class='button button-highlight button-rounded wow pulse' >登入帳號 <span class='icon-arrow-right-alt1'></span></button>

                                    </td>
                                </tr>
                            </table>
                        </fieldset>
                    </form>
                </div>

            </div>

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
                <div>
                    <img src="<?=base_url()?>site_images/ssl.png" style="width:75%;margin-top: 40px;margin-left: 35px">
                </div>
                <div style="text-align: center">
                    <p style="font-size:0.9em;">
                        本站全天24小時處於256位元的<a href="http://zh.wikipedia.org/wiki/%E8%B6%85%E6%96%87%E6%9C%AC%E4%BC%A0%E8%BE%93%E5%AE%89%E5%85%A8%E5%8D%8F%E8%AE%AE" target="_blank" style="color:red">安全機制</a>下
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
<script src="<?= base_url() ?>dist/js/ajax/getResponse.js"></script>

<script>

    $(document).ready(function() {

        $('#register').parsley();
        $('#login').parsley();

    });

</script>