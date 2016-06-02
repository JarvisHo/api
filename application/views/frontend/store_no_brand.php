<!-- background img & title -->
<div class="sub-banner back-cover clearfix" style="background-image: url(<?= base_url() ?>dist/img/step_banner1.jpg);"
     xmlns="https://www.w3.org/1999/html" xmlns="https://www.w3.org/1999/html">
    <!-- background image. inline css 可用 php 設定背景 -->
    <div class="span-12">
        <h2>STEP1：請選擇狗狗喜歡的品牌</h2>
    </div>
</div>

<div class="sub-flow tool-boxshadow clearfix">
    <div class="warper">
        <!-- multi step progress bar -->
        <div class="row">
            <div class="sub-flow_progbar small-span-10 small-offset-1 large-span-6 large-offset-3">
                <img src="<?= base_url() ?>dist/img/step1.png" alt=""><!-- multi step progress bar -->
            </div>
        </div>
        <!-- Shopping Cart and Products info. -->
        <div class="sub-main row">
            <!-- Products info. -->
            <div class="sub-info span-8 small-span-12">
                <!-- dropdown menu and search box -->
                <div class="row">
                    <!-- dropdown -->
                    <div class="sub-dropdown span-6 small-span-12">
                        <span class="button-dropdown" data-buttons="dropdown">
                            <a href="#" class="button button-rounded button-flat-action"> 　請依品牌選擇產品　 <span class="icon-arrow-down"></span> </a>
                            <ul class="button-dropdown-menu-below" style="height:315px;overflow-y: scroll;">
                                <? foreach ($brands AS $unit): ?>
                                    <li style="text-align:left;">
                                        <a href="<?=base_url().$direction."/".$unit['brand_hash_id'] ?>" ><?= $unit['brand_name'] ?></a>
                                    </li>
                                <? endforeach ?>
                            </ul>
                        </span>
                    </div>
                    <!-- search -->
                    <div class="sub-search span-6 small-span-12">
                        <?=validation_errors();?>
                        <?=form_open($direction);?>
                        <input name="action" type="hidden" value="search">
                        <input class="search_text span-11 tbSearch" type="text" name="brand_part_text" placeholder="產品搜尋"/>
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
                            <img src="http://placehold.it/640x145&text=NO+BRAND" alt="placeholder">
                            <!-- Brand AJAX load-->
                        </div>
                    </div>

                    <!-- products list load by ajax-->
                    <div class="row" id="products">


                        <!-- Product unit -->
                        <div class="sub-products span-12">
                            <!-- pics -->
                            <div class="span-3 small-span-10 small-offset-1">
                                <div class="sub-products_pic tool-imgInner">
                                    <a href="#pd<?//=$unit['product_id']?>" class="">
                                        <img src="http://placehold.it/300x300&text=no+product" alt="placeholder">
                                    </a>
                                </div>
                            </div>

                            <!-- title, radio, price, and buttons -->
                            <div class="span-9 small-span-12">
                                <!-- title -->
                                <div class="sub-products_title">
                                    <h3><a href="#pd<?//=$unit['product_id']?>" class="">
                                            搜尋不到品牌或是產品，請輸入其他關鍵字試試！</a></h3>
                                </div>
                                <!-- package select (with origin. price) -->
                                <div class="span-6 small-span-12">
                                    <div class="sub-products_pack">
                                        <table class="pack-table">
                                            <!-- loop for package size inset here -->
                                            <tbody>
                                            <!-- end loop -->
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="sub-products_add span-6 small-span-12">
                                    <div class="price row" style="color:#999999;;font-size:20px;">
                                    </div>
                                    <div class="detail row">
                                    </div>
                                </div>

                                <!--product panel-->
                                <!--product panel-->
                                <div id="pd<?//=$unit['product_id']?>" class="sub-products_detail">
                                    <h1><?//=$unit['product_name']?></h1>
                                    <p><?//=$unit['product_description']?></p>
                                <!-- end loop -->
                                </div>
                                <!--product panel-->
                                <!--product panel-->
                            </div>
                        </div>
                        <!-- END OF Product unit -->

                    </div>
                    <!-- products list load by ajax-->
                </div>
                <!-- END OF info main section -->
            </div>

            <!-- shopping cart-->
            <!-- shopping cart-->
            <div class="span-4 small-span-12" id="sub-cart">
                <div class="sub-cart_header center">
                    <p>您的購物車目前共有 <span><?=$this->cart->total_items();?></span> 項商品</p>
                </div>
                <div class="sub-cart_body center clearfix">
                    <?$i = 1; ?>
                    <?foreach ($this->cart->contents() as $items): ?>
                        <!-- cart item unit -->
                        <div class="row">
                            <div class="sub-cart_item">
                                <div class="span-2">
                                    <img src="<?=$items['image']; ?>" alt="">
                                </div>
                                <div class="span-8">
                                    <div class="span-12"><h5><?php echo $items['name']; ?></h5>
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
                                <?=form_open('store/', array('id' => 'form_id_'.$items['id']) )?>
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
                    <? endforeach?>
                </div>
                <div class="sub-cart_footer center">
                    <div class="sub-cart_total">
                        <p>合計 Total：<span><?=$this->cart->format_number($this->cart->total()); ?></span> 元</p>
                    </div>

                </div>
                <div class="sub-buttons span-12" style="margin-top: 15px">
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
