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
                    <?=form_open('store/'.$brand['brand_hash_id'], array('id' => 'form_id_'.$items['id']) )?>
                    <input type="hidden" name="action" value="cart">
                    <input type="hidden" name="package_id" value="<?=$items['id']?>">
                    <input type="hidden" name="package_qty" value="-1">
                    <div class="span-2">
                        <a href="#" onclick="document.forms.<?='form_id_'.$items['id']?>.submit()" w><span class="icon-minus"></span></a>
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
    <div class="sub-buttons span-12" style="margin-top: 15px">
        <?=$next_step;?>
    </div>
</div>
<!-- shopping cart-->
<!-- shopping cart-->