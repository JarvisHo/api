<link rel="stylesheet" href="<?= base_url() ?>dist/pickadate/themes/default.css" xmlns="https://www.w3.org/1999/html">
<link rel="stylesheet" href="<?= base_url() ?>dist/pickadate/themes/default.date.css">
<div id="container"></div><!--pickadate panel-->


<!-- background img & title -->
<div class="sub-banner back-cover clearfix" style="background-image: url(<?= base_url() ?>dist/img/step_banner3.jpg);"
     xmlns="https://www.w3.org/1999/html"><!-- background image. inline css 可用 php 設定背景 -->
    <div class="span-12">
        <h2>定期宅配服務管理</h2>
    </div>
</div>

<!--subscribe info. main section -->
<div class="sub-flow tool-boxshadow clearfix">
    <div class="warper">
        <!-- Shopping Cart and Products info. -->
        <div class="sub-main row">


            <? if(is_mobile()){?>

                <!-- shopping cart-->
                <!-- shopping cart-->
                <div class="span-4 small-span-12" id="sub-cart">
                    <div class="sub-cart_header center">
                        <p>您的購物車目前共有 <span><?= $this->cart->total_items(); ?></span> 項商品</p>
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
                                    <?=form_open('service', array('id' => 'form_id_'.$items['id']) )?>
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

                    <div class="sub-cart_body center" style="margin-top:-10px; ">
                        <?= form_open('service', array('id' => 'service', 'data-parsley-validate' => ''));
                        echo form_hidden(array('action' => 'service', 'member_id' => $this->session->all_userdata()['member_id'])); ?>
                        <div class="sub-cart_total" style="font-size: 0.8em">
                            <p>
                                <label for="nextdate">下次送貨日: </label>
                                <input class="datepicker" type="text" name="nextdate" style="width:120px;"
                                       data-parsley-trigger="change" id="nextdate" value="<?= $service_date_next ?>"
                                       placeholder="馬上寄出 (點我更改)">
                            </p>
                            <p>
                                <label for="frequency">送貨間隔日: </label>
                                <input name="frequency" type="text" style="width:120px;"
                                       data-parsley-trigger="change"
                                       data-parsley-type="integer"
                                       data-parsley-range="[7,120]" value="<? if(isset($service_frequency))echo $service_frequency?>"
                                       placeholder="7至120日" required="required" >
                            </p>

                            &nbsp;
                        </div>

                    </div>
                    <div class="sub-cart_footer center">
                        <div class="sub-cart_total">
                            <p>
                                <a href="<?= base_url() ?>membership?process=cancel" style="margin: 5px" class='button button-rounded pulse'>取消</a>
                                <button type="submit" style="margin: 5px"
                                        class='button button-highlight button-rounded wow pulse'>儲存 <span
                                        class='icon-checkbox-checked'></span></button>

                            </p>

                        </div>
                    </div>
                    </form>

                </div>
                <!-- shopping cart-->
                <!-- shopping cart-->

            <?}?>

            <!-- Products info. -->
            <div class="sub-info span-8 small-span-12">
                <!-- dropdown menu and search box -->
                <div class="row">
                    <!-- dropdown -->
                    <div class="sub-dropdown span-6 small-span-12">
                        <span class="button-dropdown" data-buttons="dropdown">
                            <a href="#" class="button button-rounded button-flat-action"> 　請依品牌選擇產品　 <span
                                    class="icon-arrow-down"></span> </a>
                            <ul class="button-dropdown-menu-below" style="height:315px;overflow-y: scroll;">
                                <? foreach ($brands AS $unit): ?>
                                    <li style="text-align:left;">
                                        <a href="<?= base_url() . "service/" . $unit['brand_hash_id'] ?>"><?= $unit['brand_name'] ?></a>
                                    </li>
                                <? endforeach ?>
                            </ul>
                        </span>
                    </div>
                    <!-- search -->
                    <div class="sub-search span-6 small-span-12">
                        <?= validation_errors(); ?>
                        <?= form_open('service'); ?>
                        <input name="action" type="hidden" value="search">
                        <input class="search_text span-11 tbSearch" type="text" name="brand_part_text"
                               placeholder="產品搜尋"/>
                        <input class="search_button button button-pill button-flat-action button-small" type="submit"
                               value="搜尋"/>
                        </form>
                    </div>
                </div>
                <!-- END OF dropdown menu and search box -->
                <!-- info main section -->
                <div class="row">
                    <!-- brand logo -->
                    <div class=" row">
                        <div class="sub-brandLogo span-12 small-span-12" id="brandImage">
                            <!-- Brand AJAX load-->
                            <img src="<?=$brand['brand_image'] ?>" alt="placeholder">
                            <!-- Brand AJAX load-->
                        </div>
                    </div>

                    <!-- products list load by ajax-->
                    <div class="row" id="products">

                        <? foreach ($products AS $unit): ?>
                            <?= form_open('service/' . $brand['brand_hash_id'], array('id' => 'product_form_id_' . $unit['product_id'])); ?>
                        <input type="hidden" name="action" value="cart">
                        <input type="hidden" name="product_id" value="<?= $unit['product_id'] ?>">
                        <input type="hidden" name="product_name" value="<?= urldecode($unit['product_name']) ?>">
                        <input type="hidden" name="product_image" value="<?= urldecode($unit['product_image']) ?>">
                        <input type="hidden" name="package_qty" value="1">
                        <!-- Product unit -->
                        <div class="sub-products span-12">
                            <!-- pics -->
                            <div class="span-3 small-span-10 small-offset-1">
                                <div class="sub-products_pic tool-imgInner">
                                    <a href="#pd<?= $unit['product_id'] ?>" class="openDetail">
                                        <img src="<?=urldecode($unit['product_image']) ?>" alt="placeholder">
                                    </a>
                                </div>
                            </div>

                            <!-- title, radio, price, and buttons -->
                            <div class="span-9 small-span-12">
                                <!-- title -->
                                <div class="sub-products_title">
                                    <h3><a href="#pd<?= $unit['product_id'] ?>" class="openDetail"><?= urldecode($unit['product_name']) ?></a></h3>
                                </div>
                                <!-- package select (with origin. price) -->
                                <div class="span-6 small-span-12">
                                    <div class="sub-products_pack">
                                        <table class="pack-table">
                                            <!-- loop for package size inset here -->
                                            <tbody>
                                            <? $having_package = false;
                                            foreach ($unit['package'] AS $package): ?>
                                                <tr>
                                                    <td class="weight">
                                                        <input type="radio"
                                                               id="radio<?= $package['package_id'] ?>PID-<?= $unit['product_id'] ?>"
                                                               name="pack_<?= $unit['product_id'] ?>"
                                                               value="<?= $package['package_id'] . ";" . $package['package_weight'] . ";" . $package['package_price'] ?>"
                                                               class="css-checkbox"
                                                               onclick="$('#price<?= $unit['product_id'] ?>').html('<?= $package['package_price'] ?>')"
                                                            <?= $package['radio_option'] ?>
                                                            />
                                                        <label
                                                            for="radio<?= $package['package_id'] ?>PID-<?= $unit['product_id'] ?>" <?= $package['radio_option'] ?>
                                                            class="css-label">
                                                            <span><?= $package['package_lb'] ?> 磅 / <?= $package['package_kg'] ?>
                                                                公斤</span>
                                                        </label>
                                                    </td>
                                                    <td class="price">
                                                        <label for="radio<?= $package['package_id'] ?>PID-<?= $unit['product_id'] ?>">
                                                            <del> ＄ <span><?= $package['package_ori_price'] ?></span> 元</del>
                                                        </label>
                                                    </td>
                                                </tr>
                                            <? $having_package = true; endforeach ?>
                                            <!-- end loop -->
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <!-- special price and buttons -->
                                <?if($having_package){?>
                                <!-- special price and buttons -->
                                <div class="sub-products_add span-6 small-span-12">
                                    <div class="price row" style="font-size:20px;">會員特價：<b id="price<?=$unit['product_id']?>"><?=$unit['default_price']?></b> 元
                                    </div>
                                    <div class="detail row">
                                        <a href="#pd<?=$unit['product_id']?>" class="openDetail button button-pill button-flat-primary" style="margin-right:2px;">產品資訊</a>
                                        <button type="submit" class="button button-pill button-flat-primary" style="height:30px;text-align: center;margin: 0 0 10px 0;">加入購物車</button>
                                    </div>
                                </div>
                                <?}else{?>
                                    <div class="sub-products_add span-6 small-span-12">
                                        <div class="price row" style="color:#999999;;font-size:20px;">敬請期待！
                                        </div>
                                        <div class="detail row">
                                        </div>
                                    </div>
                                <?}?>

                                <!--product panel-->
                                <!--product panel-->
                                <div id="pd<?= $unit['product_id'] ?>" class="sub-products_detail">
                                    <h1><?= $unit['product_name'] ?></h1>
                                    <p><?= $unit['product_description'] ?></p>
                                    <? foreach ($unit['package'] AS $package): ?>
                                <!--loop start-->
                                <input type="radio" name="pack_<?= $unit['product_id'] ?>"
                                       value="<?= $package['package_id'] . ";" . $package['package_weight'] . ";" . $package['package_price'] ?>"
                                       onclick="$('#price<?= $unit['product_id'] ?>').html('<?= $package['package_price'] ?>')">
                                <?= $package['package_lb'] ?> 磅 / <?= $package['package_kg'] ?> 公斤
                                <!-- end loop -->
                            <? endforeach ?>
                                    <button class="button button-pill button-flat-primary closeDetail" onclick="document.forms.<?= 'product_form_id_' . $unit['product_id'] ?>.submit()">加入購物車</button>
                                </div>
                                <!--product panel-->
                                <!--product panel-->
                            </div>
                        </div>
                        <!-- END OF Product unit -->
                        </form>
                        <? endforeach ?>

                    </div>
                    <!-- products list load by ajax-->
                </div>
                <!-- END OF info main section -->
            </div>

            <? if(!is_mobile()){?>

            <!-- shopping cart-->
            <!-- shopping cart-->
            <div class="span-4 small-span-12" id="sub-cart">
                <div class="sub-cart_header center">
                    <p>您的購物車目前共有 <span><?= $this->cart->total_items(); ?></span> 項商品</p>
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
                                <?=form_open('service', array('id' => 'form_id_'.$items['id']) )?>
                                <input type="hidden" name="action" value="cart">
                                <input type="hidden" name="package_id" value="<?=$items['id']?>">
                                <input type="hidden" name="package_qty" value="-1">
                                <div class="span-2">
                                    <a href="#" onclick="document.forms.<?='form_id_'.$items['id']?>.submit()" style="font-size: 1.5em;"><span class="icon-minus"></span></a>
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
                <div class="sub-cart_body center" style="margin-top:-10px; ">
                    <!--收件人資訊-->
                    <div class="row j_service_address service_version">
                        <div class="span-12 j_address_box">
                            <div class="span-11 ">
                                <div class="span-12">收件人：<?=$selected_receiver['receiver_name']?></div>
                                <div class="span-12">聯絡電話：<?=$selected_receiver['receiver_phone']?></div>
                                <div class="span-12">時段：<?=$selected_receiver['receiver_session_text']?></div>
                                <div class="span-12">地址：<?=$selected_receiver['receiver_address']?>
                                    <a style="float:right;margin-top: 5px" href="#receiver_selector" class="openDetail button button-pill button-flat-action button-small j_small_margin">變更 <span class="icon-location"></span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--receiver selector panel-->
                    <!--receiver selector panel-->
                    <div id="receiver_selector" class="sub-products_detail">

                        <h2 style="margin: 0px">變更收件人</h2><hr>

                        <?=form_open('service' ,array('style'=>'display:inline'))?>
                        <?=form_hidden('action','select_receiver')?>
                        <?foreach($receivers AS $unit): ?>

                            <!--收件人資訊-->
                            <div class="row j_margin_top">
                                <div class="span-12 j_address_box">
                                    <div class="span-1 j_bookmark">
                                        <input type="radio" name="receiver_id" value="<?=$unit['receiver_id']?>" <?if($selected_receiver['receiver_id']==$unit['receiver_id'])echo "checked"?>>
                                    </div>
                                    <div class="span-10">
                                        <div class="span-12">姓名：<?=$unit['receiver_name']?></div>
                                        <div class="span-12">電話：<?=$unit['receiver_phone']?></div>
                                        <div class="span-12">時段：<?=$unit['receiver_session_text']?></div>
                                        <div class="span-12">地址：<?=$unit['receiver_address']?></div>
                                    </div>
                                </div>
                            </div>

                        <?endforeach?>

                        <div class="j_receiver_row">
                            <div class="span-12">
                                <button type="submit" class="button button-pill button-flat-action button-small"> 確認 <i class="fa fa-check"></i></button>

                            </div>
                        </div>
                        </form>
                    </div>
                    <!--receiver selector panel-->
                    <!--receiver selector panel-->
                </div>
                <div class="sub-cart_body center" style="margin-top:-10px; ">
                    <?= form_open('service', array('id' => 'service', 'data-parsley-validate' => ''));
                    echo form_hidden(array('action' => 'service','member_id' => $this->session->all_userdata()['member_id']));
                    if($this->cart->total_items()==0) echo form_hidden(array('process' => 'delete_service', 'service_hash_id' => $this->session->all_userdata()['service_hash_id']));
                    else echo form_hidden('process', 'save_service');
                    echo form_hidden('service_receiver_id',$selected_receiver['receiver_id']);
                    ?>
                    <div class="sub-cart_total" style="font-size: 0.8em">
                        <p>
                            <label for="nextdate">下次送貨日: </label>
                            <input class="datepicker" type="text" name="nextdate" style="width:120px;"
                                   data-parsley-trigger="change" id="nextdate" value="<?= $service_date_next ?>"
                                   placeholder="馬上寄出 (點我更改)">
                        </p>
                        <p>
                            <label for="frequency">送貨間隔日: </label>
                            <input name="frequency" type="text" style="width:120px;"
                                   data-parsley-trigger="change"
                                   data-parsley-type="integer"
                                   data-parsley-range="[7,120]" value="<? if(isset($service_frequency))echo $service_frequency?>"
                                   placeholder="7至120日" required="required" >
                        </p>

                        &nbsp;
                    </div>

                </div>
                <div class="sub-cart_footer center">
                    <div class="sub-cart_total">
                        <p>
                            <a href="<?= base_url() ?>membership?process=cancel" style="margin: 5px" class='button button-rounded pulse'>取消</a>
                            <button type="submit" style="margin: 5px"
                                    class='button button-highlight button-rounded wow pulse'
                                    <?if($this->cart->total_items()==0){?>onclick="return confirm('您的宅配服務內沒有任何產品，請確認您要繼續，這動作將會停止這一筆宅配服務。')"<?}?>>儲存 <span
                                    class='icon-checkbox-checked'></span></button>

                        </p>

                    </div>
                </div>
                </form>

            </div>
            <!-- shopping cart-->
            <!-- shopping cart-->

            <?}?>

        </div>
    </div>
</div>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="<?=base_url()?>dist/js/vendor/jquery-1.11.0.min.js"><\/script>')</script>

<script src="<?= base_url() ?>dist/js/plugins.js"></script>
<script src="<?= base_url() ?>dist/js/main.js"></script>
<script src="<?= base_url() ?>dist/pickadate/picker.js"></script>
<script src="<?= base_url() ?>dist/pickadate/picker.date.js"></script>
<script src="<?= base_url() ?>dist/pickadate/legacy.js"></script>



<script>
    var $input = $('.datepicker').pickadate({
        format: 'yyyy-mm-dd',
        formatSubmit: 'yyyy-mm-dd',
        min: true,
        max: 121,
        container: '#container',
        // editable: true,
        closeOnSelect: true,
        closeOnClear: false
    });

    setTimeout(function(){
        $('.membership_link').attr("href", "<?=base_url()?>membership?process=cancel");
        $('.index_link').attr("href", "<?=base_url()?>?process=cancel");
        $('.faq_link').attr("href", "<?=base_url()?>faq?process=cancel");
        $('.contact_link').attr("href", "<?=base_url()?>contact?process=cancel");
    }, 500);

    $('#service').parsley();

</script>
