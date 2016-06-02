<?php echo form_open('cart/update'); ?>
<div class="sub-cart_header center">
    <p>您的購物車目前共有 <span></span> 項商品</p>
</div>
<div class="sub-cart_body center clearfix">
    <?php $i = 1; ?>

    <?php foreach ($this->cart->contents() as $items): ?>

    <?php echo form_hidden($i.'[rowid]', $items['rowid']); ?>

        <!-- cart item unit -->
        <div class="row">
            <div class="sub-cart_item">
                <div class="span-2">
                    <img src="/admin/dist/brand_dog/product/" alt="">
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
                    <div class="span-6"><p>單價：<span><?php echo $this->cart->format_number($items['price']); ?></span></p></div>
                    <div class="span-6"><p>數量：<?php echo form_input(array('name' => $i.'[qty]', 'value' => $items['qty'], 'maxlength' => '3', 'size' => '5')); ?></p></div>
                </div>
                <div class="span-2">
                    <a href="#" id="delete"><span class="icon-minus"></span></a>
                </div>
            </div>
        </div>
        <!-- END OF cart item unit-->

    <?php $i++; ?>

    <?php endforeach; ?>
</div>
<div class="sub-cart_footer center">
    <div class="sub-cart_total">
        <p>合計 Total：<span><?php echo $this->cart->format_number($this->cart->total()); ?></span> 元</p>
    </div>
</div>