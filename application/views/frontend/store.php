<!-- background img & title -->
<div class="sub-banner back-cover clearfix" style="background-image: url(<?= base_url() ?>dist/img/step_banner1.jpg);"
     xmlns="https://www.w3.org/1999/html">
    <!-- background image. inline css 可用 php 設定背景 -->
    <div class="span-12">
        <h2>請選擇狗狗喜歡的品牌</h2>
    </div>
</div>

<!--subscribe info. main section -->
<div class="sub-flow tool-boxshadow clearfix">
    <div class="warper">
        <!-- multi step progress bar -->
<!--        <div class="row">-->
<!--            <div class="sub-flow_progbar small-span-10 small-offset-1 large-span-6 large-offset-3">-->
<!--                <img src="--><?//= base_url() ?><!--dist/img/step1.png" alt="">-->
                <!-- multi step progress bar -->
<!--            </div>-->
<!--        </div>-->
        <!-- Shopping Cart and Products info. -->
        <div class="sub-main row">

            <? if(is_mobile() AND $this->cart->total_items()>0)include "dist/cart.php"?>

            <!-- Products info. -->
            <div class="sub-info span-8 small-span-12">
                <!-- dropdown menu and search box -->
                <div class="row">
                    <!-- dropdown -->
                    <div class="sub-dropdown span-6 small-span-12">
                        <span class="button-dropdown" data-buttons="dropdown">
                            <a href="#" class="button button-rounded button-flat-action j_shadow wow pulse j_dropdown_text"> 　選擇其他品牌　 <span class="fa fa-chevron-circle-down j_draw_btn"></span> </a>
                            <ul class="button-dropdown-menu-below" style="height:315px;overflow-y: scroll;">

                                <? foreach ($brands AS $unit): ?>
                                    <li style="text-align:left;">
                                        <a href="<?=base_url()."store/".$unit['brand_hash_id'] ?>" ><?= $unit['brand_name'] ?></a>
                                    </li>
                                <? endforeach ?>
                            </ul>
                        </span>
                    </div>
                    <!-- search -->
                    <div class="sub-search span-6 small-span-12">
                        <?=validation_errors();?>
                        <?=form_open('store');?>
                            <input name="action" type="hidden" value="search">
                            <input class="search_text span-11 tbSearch" type="text" name="brand_part_text" placeholder="產品或品牌搜尋"/>
                            <input class="search_button button button-pill button-flat-action button-small" type="submit" value="搜尋"/>
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

                        <? foreach($products AS $unit):?>
                        <?=form_open('store/'.$brand['brand_hash_id'], array('id' => 'product_form_id_'.$unit['product_id']) );?>
                        <input type="hidden" name="action" value="cart">
                        <input type="hidden" name="product_id" value="<?=$unit['product_id']?>">
                        <input type="hidden" name="product_name" value="<?=urldecode($unit['product_name'])?>">
                        <input type="hidden" name="product_image" value="<?=urldecode($unit['product_image'])?>">
                        <input type="hidden" name="package_qty" value="1">
                        <!-- Product unit -->
                        <div class="sub-products span-12">
                            <!-- pics -->
                            <div class="span-3 small-span-10 small-offset-1">
                                <div class="sub-products_pic tool-imgInner">
                                    <a href="#pd<?=$unit['product_id']?>" class="openDetail">
                                        <img src="<?=urldecode($unit['product_image'])?>" alt="placeholder">
                                    </a>
                                </div>
                            </div>

                            <!-- title, radio, price, and buttons -->
                            <div class="span-9 small-span-12">
                                <!-- title -->
                                <div class="sub-products_title">
                                    <h3><a href="#pd<?=$unit['product_id']?>" class="openDetail"><?=urldecode($unit['product_name'])?></a></h3>
                                </div>
                                <!-- package select (with origin. price) -->
                                <div class="span-6 small-span-12">
                                    <div class="sub-products_pack">
                                        <table class="pack-table">
                                            <!-- loop for package size inset here -->
                                            <tbody>
                                            <? $having_package = false;
                                            foreach($unit['package'] AS $package):?>
                                            <tr>
                                                <td class="weight">
                                                    <input type="radio"
                                                           id="radio<?=$package['package_id']?>PID-<?=$unit['product_id']?>"
                                                           name="pack_<?=$unit['product_id']?>"
                                                           value="<?=$package['package_id'].";".$package['package_weight'].";".$package['package_price']?>"
                                                           class="css-checkbox"
                                                           onclick="$('#price<?=$unit['product_id']?>').html('<?=$package['package_price']?>')"
                                                           <?=$package['radio_option']?>
                                                        />
                                                    <label for="radio<?=$package['package_id']?>PID-<?=$unit['product_id']?>" <?=$package['radio_option']?> class="css-label">
                                                        <span><?=$package['package_lb']?> 磅 / <?=$package['package_kg']?> 公斤</span>
                                                    </label>
                                                </td>
                                                <td class="price">
                                                    <label for="radio<?=$package['package_id']?>PID-<?=$unit['product_id']?>">
                                                        <del> ＄ <span><?=$package['package_ori_price']?></span> 元</del>
                                                    </label>
                                                </td>
                                            </tr>
                                            <? $having_package = true; endforeach?>
                                            <!-- end loop -->
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

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
                                <div id="pd<?=$unit['product_id']?>" class="sub-products_detail">
                                    <h1><?=$unit['product_name']?></h1>
                                    <img src="<?=$unit['product_image']?>" class="img-responsive" style="width: 60%">
                                    <p><?=nl2br($unit['product_digest'])?></p>
                                    <?foreach($unit['package'] AS $package):?>
                                    <!--loop start-->
                                        <input type="radio" name="pack_<?=$unit['product_id']?>" value="<?=$package['package_id'].";".$package['package_weight'].";".$package['package_price']?>" onclick="$('#price<?=$unit['product_id']?>').html('<?=$package['package_price']?>')">
                                        <?=$package['package_lb']?> 磅 / <?=$package['package_kg']?> 公斤
                                    <!-- end loop -->
                                    <? endforeach?>
                                    <button class="button button-pill button-flat-primary closeDetail" onclick="document.forms.<?='product_form_id_'.$unit['product_id']?>.submit()">加入購物車</button>
                                </div>
                                <!--product panel-->
                                <!--product panel-->
                            </div>
                        </div>
                        <!-- END OF Product unit -->
                        </form>
                        <? endforeach?>

                    </div>
                    <!-- products list load by ajax-->

                </div>
                <!-- END OF info main section -->
            </div>

            <? if(!is_mobile())include "dist/cart.php";?>

            <div class="span-4 small-span-12" >
                <div>
                    <img src="<?=base_url()?>site_images/ssl.png" class="ssl">
                </div>
                <div class="ssl_text">
                    <p>
                        全天24小時處於256位元的<a href="http://zh.wikipedia.org/wiki/%E8%B6%85%E6%96%87%E6%9C%AC%E4%BC%A0%E8%BE%93%E5%AE%89%E5%85%A8%E5%8D%8F%E8%AE%AE" target="_blank" style="color:red">安全機制</a>下
                    </p>
                </div>
            </div>

        </div>
    </div>
</div>
<p id="back-top">
    <a href="#top"><i class="fa fa-paw"></i><span></span> 找購物車？或是找其他品牌？</a>
</p>


<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="<?=base_url()?>dist/js/vendor/jquery-1.11.0.min.js"><\/script>')</script>

<script src="<?= base_url() ?>dist/js/plugins.js"></script>
<script src="<?= base_url() ?>dist/js/main.js"></script>

<script>
    $(document).ready(function() {


        // hide #back-top first
        $("#back-top").hide();

        // fade in #back-top
        $(function () {
            $(window).scroll(function () {
                if ($(this).scrollTop() > 100) {
                    $('#back-top').fadeIn();
                } else {
                    $('#back-top').fadeOut();
                }
            });

            // scroll body to 0px on click
            $('#back-top a').click(function () {
                $('body,html').animate({
                    scrollTop: 0
                }, 800);
                return false;
            });
        });

    });

</script>