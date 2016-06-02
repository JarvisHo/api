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
                    <div class="sub-info span-12 small-span-12" >

                        <div class="sub-signup">
                            <h3>您的會員帳號: <?=$member_account?>  <br> 姓名: <?=$member_name?> | 電話: <?=$member_phone?> </h3>

                            <?
                            //====================================================================
                            //如果有選購東西的話，顯示購物車
                            //====================================================================
                            if(count($this->cart->contents())>0){?>
                            <fieldset style="border: dotted 2px #adadad">
                                <legend><span class="icon-location"></span>您剛選購完成的購物車</legend>
                                <div class="span-12" id="customer_cart">
                                    <?php $total=0;
                                    foreach ($this->cart->contents() as $items):

                                        $product = $this->model_product->get_product($items['product']);?>

                                        <!--product panel-->
                                        <!--product panel-->
                                        <div id="pd<?=$product['product_id']?>" class="sub-products_detail">
                                            <h1><?=$product['product_name']?></h1>
                                            <img src="<?=$product['product_image']?>" class="img-responsive" style="width: 60%">
                                            <p><?=nl2br($product['product_digest'])?></p>
                                        </div>
                                        <!--product panel-->
                                        <!--product panel-->

                                        <div class="row cart_unit">
                                            <div class="span-4 j_right">
                                                <a href="#pd<?=$product['product_id']?>" class="openDetail">
                                                    <img src="<?=$product['product_image']?>" class="img-thumbnail product-img cart_image_padding" >
                                                </a>
                                            </div>
                                            <div class="span-8" align="left">
                                                <div class="row">
                                                    <a href="#pd<?=$product['product_id']?>" class="openDetail">
                                                        <div class="span-12"><?=$product['product_name']?></div>
                                                    </a>
                                                </div>
                                                <div class="row" style="margin-top: 15px">
                                                    <div class="span-2 small-span-12">數量：<span style="font-size: 1.5em"><?=$items['qty']; ?></span></div>
                                                    <div class="span-4 small-span-12" style="margin-top: 8px">重量：<?=$items['options']['重量']?></span></div>
                                                    <div class="span-4 small-span-8" style="margin-top: 8px">單價：<?=$items['price']; ?> 元</div>
                                                    <div class="span-1 small-span-4">
                                                        <?=form_open('membership', array('id' => 'form_id_'.$items['id']) )?>
                                                        <input type="hidden" name="action" value="cart">
                                                        <input type="hidden" name="package_id" value="<?=$items['id']?>">
                                                        <input type="hidden" name="package_qty" value="-1">
                                                        <div class="sub-cart_item" style="margin-left: 15px; margin-top: -9px" >
                                                            <a href="#" onclick="document.forms.<?='form_id_'.$items['id']?>.submit()" style="font-size: 1.5em"><span class="icon-minus"></span></a>
                                                        </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <? $total = $total + $items['qty']*$items['price']; unset($product); endforeach;?>

                                </div>

                                <div>
                                    <a href="<?=base_url()?>service/new" class="button button-pill button-flat-action button-small"
                                       style="margin-left: 40px;margin-top: 10px">選購其他產品 <i class="fa fa-cart-plus"></i></a>

                                </div>

                                <?if(!empty($member_last4) AND $member_last4!="")$destination = 'membership'; else $destination = 'form';
                                echo form_open($destination, array('id' => 'service','data-parsley-validate'=>'')); ?>
                                <?=form_hidden(array('action' => 'service', 'member_id' => $this->session->all_userdata()['member_id']));?>
                                <?=form_hidden('receiver_id',$this->session->all_userdata()['selected_receiver'])?>
                                <div class="row ">
                                    <div class="span-12">
                                        <div class="span-8 small-span-12">
                                            <!--收件人資訊-->
                                            <div class="row j_default_address">
                                                <div class="span-12 j_address_box">
                                                    <div class="span-11 j_receiver_padding">
                                                        <div class="span-12">收件人：<?=$selected_receiver['receiver_name']?> | 聯絡電話：<?=$selected_receiver['receiver_phone']?></div>
                                                        <div class="span-12">地址：<?=$selected_receiver['receiver_address']?></div>
                                                        <div class="span-12">時段：<?=$selected_receiver['receiver_session_text']?></div>
                                                        <div class="span-12">
                                                            <a style="float:right;" href="#receiver_selector" class="openDetail button button-pill button-flat-action button-small j_small_margin">變更收件地址 <span class="icon-location"></span></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="span-4 small-span-12" align="right">
                                            <div class="row" style=" margin-top: 10px">
                                                <div class="span-12 j_address_box">
                                                    <div class="span-1 j_bookmark">
                                                    </div>
                                                    <div class="span-10">
                                                        <div class="span-12">出貨日：<input style="width:120px;" class="form-control datepicker" name="nextdate" data-parsley-trigger="change" required="required" value="<?=date('Y-m-d')?>"></div>
                                                        <div class="span-12">定期出貨間隔日：<input style="width:120px;" name="frequency" type="text" class="form-control" data-parsley-trigger="change" data-parsley-type="integer" data-parsley-range="[7,120]" placeholder="7至120日" required="required"></div>
                                                        <div class="span-12">總金額：<?= substr($this->cart->format_number($this->cart->total()),0,-3); ?>元</div>
                                                        <div class="span-12"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
								<div class="mem-editButtons">
                                        <button type="submit" class="button button-pill button-flat-action button-small j_small_margin">新增定期宅配 <span class="icon-calendar"></span></button>
                                </div>
                                </form>
                            </fieldset>
                                <!--receiver selector panel-->
                                <!--receiver selector panel-->
                                <div id="receiver_selector" class="sub-products_detail">

                                    <?=form_open('membership#customer_cart' ,array('style'=>'display:inline'))?>
                                    <?=form_hidden('action','select_receiver')?>
                                    <h2 style="margin: 0px">變更收件人</h2><hr>

                                    <?foreach($receivers AS $unit): ?>


                                    <!--收件人資訊-->
                                    <div class="row j_margin_top">
                                        <div class="span-12 j_address_box">
                                            <div class="span-1 j_bookmark">
                                                <input type="radio" name="receiver_id" value="<?=$unit['receiver_id']?>" <?if($selected_receiver['receiver_id']==$unit['receiver_id'])echo "checked"?>>
                                            </div>
                                            <div class="span-10">
                                                <div class="span-12">姓名：<?=$unit['receiver_name']?> | 電話：<?=$unit['receiver_phone']?></div>
                                                <div class="span-12">地址：<?=$unit['receiver_address']?></div>
                                                <div class="span-12">時段：<?=$unit['receiver_session_text']?></div>
                                            </div>
                                        </div>
                                    </div>

                                    <?endforeach?>

                                    <div class="j_receiver_row">
                                        <div class="span-12">
                                            <button type="submit" class="button button-pill button-flat-action button-small">儲存 <i class="fa fa-floppy-o"></i></button>

                                        </div>
                                    </div>

                                    </form>
                                </div>
                                <!--receiver selector panel-->
                                <!--receiver selector panel-->
                            <? }else{
                                //====================================================================
                                //未選購東西，購物車是空的情況下：顯示兩個大按鈕
                                //====================================================================
                                ?>
                                <fieldset style="border: dotted 2px #adadad">
                                    <legend><span class="icon-location"></span>請選擇</legend>
                                    <div class="row ">
                                        <div class="span-12" align="center" id="service">
                                                <a href="<?=base_url()?>service/new?process=first" c
                                                   class="button button-pill button-flat-action button-large span-12"
                                                   style="padding: 10px 0;margin-bottom: 15px">新增定期宅配訂單 <span class="icon-cart"></span></a>
                                        </div>
                                        <div class="span-12" align="center">
                                            <a href="#service" class="button button-pill button-flat-action button-large span-12"
                                               style="padding: 10px 0;margin-bottom: 15px">變更現有的定期宅配 <span class="icon-calendar"></span></a>
                                        </div>
                                    </div>
                                </fieldset>

                            <? }?>

                            <? if($this->session->all_userdata()['member_status']>0 AND !empty($member_name) AND !empty($member_address) AND empty($member_last4)) {?>
                                <fieldset style="background: rgba(220%,0%,0%,0.15);">
                                    <div class=" span-12 panel panel-default">
                                        <div class="panel-body" >
                                            <i class="fa fa-credit-card" style="margin: 0px 10px"></i> 您過去的信用卡號已經失效，請聯絡客戶服務專線：0972-953-966。
                                        </div>
                                    </div>
                                </fieldset>
                            <? } ?>

                            <div class="clearfix"></div>

                            <fieldset style="border: solid 1px #bebebe" >
                                <legend><span class="icon-location"></span>您正在進行的定期宅配服務</legend>

                                <? $i=0; foreach($services AS $unit): ?>

                                    <div class="row j_w95 <?=$unit['service_status_class'];//table-active?>">

                                        <div class="j_center"><h3>定期宅配服務 <?if($unit['service_status']==0){?>#<?=++$i?><?}?></h3></div>
                                        <div class="">
                                            <?php $total=0;
                                            foreach($unit['service_cart'] AS $cart):
                                                $product = $this->model_product->get_product($cart['cart_product_id']);?>

                                                <!--product panel-->
                                                <!--product panel-->
                                                <div id="pd<?=$product['product_id']?>" class="sub-products_detail">
                                                    <h1><?=$product['product_name']?></h1>
                                                    <img src="<?=$product['product_image']?>" class="img-responsive" style="width: 60%">
                                                    <p><?=nl2br($product['product_digest'])?></p>
                                                </div>
                                                <!--product panel-->
                                                <!--product panel-->

                                                <div class="row cart_unit">

                                                    <div class="span-4 j_right">
                                                        <a href="#pd<?=$product['product_id']?>" class="openDetail">
                                                            <img src="<?=$product['product_image']?>" class="img-thumbnail product-img cart_image_padding" >
                                                        </a>
                                                    </div>
                                                    <div class="span-8" align="left">
                                                        <div class="row">
                                                            <a href="#pd<?=$product['product_id']?>" class="openDetail">
                                                                <div class="span-12"><?=$product['product_name']?></div>
                                                            </a>
                                                        </div>
                                                        <div class="row" style="margin-top: 15px">
                                                            <div class="span-3 small-span-12">數量：<span style="font-size: 1.5em"><?=$cart['cart_package_qty']?></span></div>
                                                            <div class="span-6 small-span-12" style="margin-top: 8px">重量：<?= $weight = "".number_format($cart['cart_package_weight']*0.00221,1)."磅 / ".number_format($cart['cart_package_weight']/1000,1)." 公斤";?></div>
                                                            <div class="span-3 small-span-12" style="margin-top: 8px">單價：<?=$cart['cart_package_price']?>元</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <? $total = $total + $cart['cart_package_qty']*$cart['cart_package_price']; unset($product); endforeach?>
                                        </div>
                                        <div class="span-12" style="margin-bottom: 10px">
                                            <div class="span-4 r_border" align="center" style="padding-top: 11px">
                                                <div>下次送貨日</div>
                                                <?if($unit['service_status']==0){?>
                                                <div><div><?=$unit['service_date_next_year']?></div></div>
                                                <div><div ><?=$unit['service_date_next_date']?><?if(strtotime($unit['service_date_next']) < strtotime("yesterday") AND $unit['service_date_next_date']!="-")echo "<br>(已過期)";?></div></div>
                                                <?}else{
                                                    echo "<div style='color:#888;margin-top: 30px'> 暫停中 </div>";
                                                }?>
                                            </div>
                                            <div class="span-4 r_border" align="center" style="padding-top: 11px">
                                                <div>間隔天數</div>
                                                <div class="row"><div class="sapn-12" style="margin-top: 14px"><span style="font-size: 2em"><?=$unit['service_frequency']?></span>日</div></div>

                                            </div>
                                            <div class="span-4" align="center" style="padding-top: 11px">
                                                <div>總金額</div>
                                                <div class="row"><div class="sapn-12" style="margin-top: 14px"><span style="font-size: 2em;"><?=$total?></span>元</div></div>

                                            </div>
                                        </div>

                                        <!--收件人資訊-->
                                        <div class="row" style="padding: 0px 25px;margin-top: 10px">
                                            <div class="span-12 j_address_box">

                                                <div class="span-10 j_receiver_padding">
                                                    <div class="span-12">收件人：<?=$unit['receiver_name']?> | 電話：<?=$unit['receiver_phone']?></div>
                                                    <div class="span-12">地址：<?=$unit['receiver_address']?></div>
                                                    <div class="span-12">送貨時段：<?=$unit['receiver_session_text']?></div>

                                            </div>
                                        </div>


                                        <div class="span-12 service_ctrl">
                                            <?=form_open('service',array('style'=>'display:inline'))?>
                                            <?=form_hidden('service_hash_id',$unit['service_hash_id'])?>
                                            <button type="submit" class="button button-pill button-flat-action button-small" style="margin-left: 40px">內容更改 <span class="icon-calendar"></span></button>&nbsp;
                                            </form>
                                            <?=form_open('membership',array('style'=>'display:inline'))?>
                                            <?=form_hidden('action','suspend')?>
                                            <?=form_hidden('service_hash_id',$unit['service_hash_id'])?>
                                            <button type="submit" class="button button-pill button-flat-action button-small" <?if($unit['service_status']==0){?>onclick="return confirm('請確認是否暫停這筆定期服務？')"<?}?> style="margin-right: 3px"><?if($unit['service_status']==0)echo "暫停 <span class='fa fa-pause'></span>"; else echo "啟動宅配 <span class='fa fa-play'></span>"; ?> </button>
                                            </form>
                                            <?=form_open('membership',array('style'=>'display:inline'))?>
                                            <?=form_hidden('action','delete')?>
                                            <?=form_hidden('service_hash_id',$unit['service_hash_id'])?>
                                            <button type="submit" class="button button-pill button-flat-action button-small" onclick="return confirm('請確認是否刪除這筆定期服務？')" style="margin-right: 5px"> 刪除 <span class="fa fa-trash-o"></span></button>
                                            </form>
                                        </div>

                                    </div>
                                </div>

                                <? endforeach?>

                                <table class="sub-signup_form span-12"></table>
                                <div class="mem-editButtons">&nbsp;</div>
                            </fieldset>

                            <fieldset>
                                <legend id="receiver"><span class="icon-location"></span>收件人資訊</legend>

                                <? foreach($receivers AS $unit): ?>

                                <div class="row j_default_address">
                                    <div class="span-12 j_address_box">
                                        <div class="span-1 j_bookmark">
                                            <?if($unit['receiver_status']!=0){?> <a href="<?=base_url()?>membership/receiver/default/<?=$unit['receiver_hash_id']?>#receiver"><img src="<?=base_url()?>site_images/star_empty.png" class="img-responsive j_pointer" onclick="return confirm('請確認是否將此收件人設定為預設？')"></a> <? }else{ ?><img src="<?=base_url()?>site_images/star.png" class="img-responsive"><? } ?>
                                        </div>
                                        <div class="span-10">
                                            <div class="span-12">收件人：<?=$unit['receiver_name']?> | 電話：<?=$unit['receiver_phone']?></div>
                                            <div class="span-12">地址：<?=$unit['receiver_address']?></div>
                                            <div class="span-12">送貨時段：<?=$unit['receiver_session_text']?></div>
                                                <a style="float: right" href="#re<?=$unit['receiver_id']?>" class="openDetail button button-pill button-flat-action button-small">編輯 <span class="fa fa-pencil-square-o"></span></a>
                                                <?if($unit['receiver_status']!=0)
                                                {
                                                    if($unit['receiver_used_count']==0){?>
                                                        <a style="margin-right:5px;float: right;" href="<?=base_url()?>membership/receiver/delete/<?=$unit['receiver_hash_id']?>" style="margin-right:5px " class="button button-pill button-flat-action button-small" onclick="return confirm('請確認是否刪除這筆收件人資訊？')">刪除 <span class="fa fa-trash-o"></span></a>
                                                    <?}else{?>
                                                        <button style="margin-right:5px;float: right" class="button button-pill button-flat-action button-small" onclick="alert('有服務正在使用此地址！請先變更定期宅配服務的設定！');return false">刪除 <span class="fa fa-trash-o"></span></button>
                                                    <?}
                                                }?>
                                        </div>
                                    </div>
                                </div>

                                <!--receiver editor panel-->
                                <!--receiver editor panel-->
                                <div id="re<?=$unit['receiver_id']?>" class="sub-products_detail">
                                    <?=form_open('membership#receiver' ,array('style'=>'display:inline'))?>
                                    <?=form_hidden('action','update_receiver')?>
                                    <?=form_hidden('receiver_id',$unit['receiver_id'])?>

                                    <h2 style="margin: 0px">變更收件人資料</h2><hr>

                                    <div class="j_receiver_row">
                                        <div class="span-12">
                                            <b><label>收件人姓名：</label></b>
                                        </div>
                                        <div class="span-12">
                                            <input class="j_max_width" name="receiver_name" value="<?=$unit['receiver_name']?>">
                                        </div>
                                    </div>
                                    <div class="j_receiver_row">
                                        <div class="span-12">
                                            <b><label>聯絡電話：</label></b>
                                        </div>
                                        <div class="span-12">
                                            <input class="j_max_width" name="receiver_phone" value="<?=$unit['receiver_phone']?>">
                                        </div>
                                    </div>
                                    <div class="j_receiver_row">
                                            <div class="span-12">
                                                <b><label>收件時段：</label></b>
                                            </div>
                                            <div class="span-12">
                                                <input type="radio" name="receiver_session" value="3" <?if($unit['receiver_session']==3)echo "checked"?>> 不限
                                                <input type="radio" name="receiver_session" value="1" <?if($unit['receiver_session']==1)echo "checked"?>> 下午
                                                <input type="radio" name="receiver_session" value="0" <?if($unit['receiver_session']==0)echo "checked"?>> 晚上
                                                <input type="radio" name="receiver_session" value="2" <?if($unit['receiver_session']==2)echo "checked"?>> 早上
                                            </div>
                                    </div>
                                    <div class="j_receiver_row">
                                        <div class="span-12">
                                            <b><label>收件人地址：</label></b>
                                        </div>
                                        <div class="span-12">
                                            <input class="j_max_width" name="receiver_address" value="<?=$unit['receiver_address']?>">
                                        </div>
                                    </div>

                                    <div class="j_receiver_row">
                                        <div class="span-12">
                                            <button type="submit" class="button button-pill button-flat-action button-small">儲存 <i class="fa fa-floppy-o"></i></button>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                                <!--receiver editor panel-->
                                <!--receiver editor panel-->

                                <? endforeach?>

                                <div class="mem-editButtons">
                                  <div align="center"> <a href="#receiver_new" class="openDetail button button-pill button-flat-action button-small j_data_box_btn_plus">新增收件人 <span class="fa fa-plus"></span></a></div>
                                </div>
                            </fieldset>

                            <!--receiver new panel-->
                            <!--receiver new panel-->
                            <div id="receiver_new" class="sub-products_detail">
                                <?=form_open('membership#receiver',array('style'=>'display:inline'))?>
                                <?=form_hidden('action','create_receiver')?>

                                <h2 style="margin: 0px">新增收件人資料</h2><hr>

                                <div class="j_receiver_row">
                                    <div class="span-12">
                                        <label>收件人姓名：</label>
                                    </div>
                                    <div class="span-12">
                                        <input class="j_max_width" name="receiver_name">
                                    </div>
                                </div>
                                <div class="j_receiver_row">
                                    <div class="span-12">
                                        <label>聯絡電話：</label>
                                    </div>
                                    <div class="span-12">
                                        <input class="j_max_width" name="receiver_phone">
                                    </div>
                                </div>
                                <div class="j_receiver_row">
                                    <div class="span-12">
                                        <label>收件時段：</label>
                                    </div>
                                    <div class="span-12">
                                        <input type="radio" name="receiver_session" value="3" checked> 不限
                                        <input type="radio" name="receiver_session" value="1" > 下午
                                        <input type="radio" name="receiver_session" value="0" > 晚上
                                        <input type="radio" name="receiver_session" value="2" > 早上
                                    </div>
                                </div>
                                <div class="j_receiver_row">
                                    <div class="span-12">
                                        <label>收件人地址：</label>
                                    </div>
                                    <div class="span-12">
                                        <input class="j_max_width" name="receiver_address">
                                    </div>
                                </div>

                                <div class="j_receiver_row">
                                    <div class="span-12">
                                        <input type="submit" class="button button-pill button-flat-action button-small" value="新增">
                                    </div>
                                </div>

                                </form>

                            </div>
                            <!--receiver editor panel-->
                            <!--receiver editor panel-->

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