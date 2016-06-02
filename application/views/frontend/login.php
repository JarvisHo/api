<link href="<?=base_url()?>dist\parsley\src\parsley.css" rel="stylesheet">

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
        <h2>會員登入</h2>
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
                    <h3 style="color:darkred; font-size: 1.5em;"><?=$msg?></h3>

                        <?=form_open('login', array('id' => 'login','data-parsley-validate'=>''))?>
                        <?=form_hidden(array('action' => 'login'))?>
                        <?$count = $this->cart->total_items(); if($count == 0)echo form_hidden(array('source' => 'startup'))?>
                        <fieldset>
                            <legend>登入帳號</legend>
                            <table class="sub-signup_form span-12">
                                <tr>
                                    <td class="span-4 mt tar">
                                        <lable for="email">電子信箱：</lable>
                                    </td>
                                    <td class="span-7 mt">
                                        <input required="required" class="span-12" type="email" name="email" id="email"
                                               placeholder="eg. service@pawmaji.com" data-parsley-type="email"
                                               data-parsley-trigger="change" value="<?=$member_account?>">
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

                                        <button class='button button-highlight button-rounded wow pulse' >登入帳號 <span class='icon-arrow-right-alt1'></span></button> <a href="reset" style="margin-left: 10px">忘記密碼</a>

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

        </div>
    </div>
</div>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="<?=base_url()?>dist/js/vendor/jquery-1.11.0.min.js"><\/script>')</script>

<script src="<?= base_url() ?>dist/js/plugins.js"></script>
<script src="<?= base_url() ?>dist/js/main.js"></script>
<script src="<?= base_url() ?>dist/parsley/dist/parsley.js"></script>
<script src="<?= base_url() ?>dist/parsley/src/i18n/zh_tw.js"></script>

<!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
<script>
    $(document).ready(function() {

        $('#register').parsley();
        $('#login').parsley();

    });

</script>