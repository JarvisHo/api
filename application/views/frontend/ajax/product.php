<!-- Product unit -->
<div class="sub-products span-12">
    <!-- pics -->
    <div class="span-3 small-span-10 small-offset-1">
        <div class="sub-products_pic tool-imgInner">
            <a href="#pd" class="openDetail"><!-- link 預留給詳細資料，不需要可拿掉 -->
                <img src="http://placehold.it/400x400&amp;text=pics" alt="placeholder">
            </a>
        </div>
    </div>
    <!-- title, radio, price, and buttons -->
    <div class="span-9 small-span-12">
        <!-- title -->
        <div class="sub-products_title">
            <h3>
                <a href="#pd"
                   class="openDetail">卡比Canidae頂級無穀系列-鮭魚 高質量OMEGA3強化腦力成長配方</a>
            </h3>
        </div>

        <!-- package select (with origin. price) -->
        <div class="span-6 small-span-12" style="width: 48%">
            <div class="sub-products_pack">
                <table class="pack-table">
                    <!-- loop for package size inset here -->
                    <tr>
                        <td class="weight">
                            <input type="radio" id="radio" name="pack" value="" class="css-checkbox" checked='checked' onclick="$('#price').html('')">
                            <label for="radioPID-"checked='checked' class="css-label"> <span>4 lb / 1.8 kg</span> </label>
                        </td>
                        <td class="price">
                            <label for="radioPID-"> <del> ＄999 <span></span> 元</del> </label>
                        </td>
                    </tr>
                    <!-- end loop -->
                    <!-- loop for package size inset here -->
                    <tr>
                        <td class="weight">
                            <input type="radio" id="radio" name="pack" value="" class="css-checkbox" checked='checked' onclick="$('#price').html('')">
                            <label for="radioPID-"checked='checked' class="css-label"> <span>4 lb / 1.8 kg</span> </label>
                        </td>
                        <td class="price">
                            <label for="radioPID-"> <del> ＄999 <span></span> 元</del> </label>
                        </td>
                    </tr>
                    <!-- end loop -->
                    <!-- loop for package size inset here -->
                    <tr>
                        <td class="weight">
                            <input type="radio" id="radio" name="pack" value="" class="css-checkbox" checked='checked' onclick="$('#price').html('')">
                            <label for="radioPID-"checked='checked' class="css-label"> <span>4 lb / 1.8 kg</span> </label>
                        </td>
                        <td class="price">
                            <label for="radioPID-"> <del> ＄999 <span></span> 元</del> </label>
                        </td>
                    </tr>
                    <!-- end loop -->
                </table>
            </div>
        </div>

        <!-- special price and buttons -->
        <div class="sub-products_add span-6 small-span-12">
            <div class="price row" style="font-size:20px;">會員特價： <b id="price">783</b> 元
            </div>
            <div class="detail row">
                <a href="#pd"
                   class="openDetail button button-pill button-flat-primary" style="margin-right:2px;">產品資訊</a>
                <a href="#" class="button button-pill button-flat-primary"
                   onclick="addToCart()">加入購物車</a>
            </div>
            <!--div class="cart row">

            </div-->
        </div>

        <!-- description -->
        <!-- productID 為產品 data table 的 ID -->
        <div id="pd" class="sub-products_detail">
            <h1></h1>

            <div class="pic">
                <img src="http://placehold.it/400x400&amp;text=pics" alt="placeholder">
            </div>
            <p></p>
            <input type="radio" name="pack_" value="">
            <!-- end loop -->
            <a href="#" class="button button-pill button-flat-primary closeDetail"onclick="addToCart()">加入購物車</a>
        </div>
    </div>
</div><!-- END OF Product unit -->