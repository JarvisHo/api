<link href="<?=base_url()?>dist\parsley\src\parsley.css" rel="stylesheet">
<!-- LandingPage Main Section -->
<div class="lp-main back-cover clearfix" style="background-image: url(<?=base_url()?>dist/img/lp_bg_poodle.jpg);">
    <!-- background image. inline css 可用 php 設定背景 -->
    <div class="lp-main_inner"><!-- black overlay (備而不用)-->
        <div class="row">
            <div class="warper">
                <div class="lp-main_core span-12"><!-- 簡單的標語 底色可在 head>style 設定 -->

                    <h2 class="j_index_h2_color-write"><!-- inline css 控制文字顏色 -->
                        狗食太重搬的很累? 買大包吃太久發霉? <br>生活太忙碌沒時間去買? <br><br>
                        試試我們的 [狗食定期宅配] 服務
                    </h2>
                </div>
                <div class="lp-main_des txt-bold span-6 large-offset-3 small-span-10 small-offset-1 wow tada j_slogan_merge"
                     data-wow-delay="2.7s"><!-- 服務核心簡短敘述 -->
                    <div>
                      會員費: <span class="strikeout">$197/月</span><br/>
                        現在加入,<b><span class="j_doubleUnderline">終身免會員費,免運費</span>!!</b>
                    </div>
                </div>
                <div class="span-6 small-hide large-offset-3 small-span-12 lp-main_c2a"><!-- call to action button -->
                    <a class="button small-hide glow button-action button-jumbo" href="<?=base_url()?>startup">馬上行動　Do It <span
                            class="icon-arrow-right"></span></a>
                </div>
                <div class="span-6 large-hide large-offset-3 small-span-12 lp-main_c2a"><!-- call to action button -->
                    <a class="button small-hide glow button-action" href="<?=base_url()?>startup">馬上行動　Do It <span
                            class="icon-arrow-right"></span></a>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- landingPage fold section -->
<div class="lp-fold clearfix tool-boxshadow">
    <div class="warper">
        <div class="row">
            <div class="span-12">
                <h2>簡單三個步驟</h2>
            </div>
            <div class="span-12">
                <div class="span-14 small-span-12 lp-fold_item wow fadeInUp">
                    <div class="lp-fold_img center">
                        <div class="tool-imgInner">
                            <img src="site_images/1px.gif" alt="第一步">
                            <img class="arrow-right small-hide" src="site_images/ru.gif" alt="arrow" height="42" width="42">
                        </div>
                    </div>
                    <h3>步驟一 : 選擇狗食品牌</h3>

                    <p>我們有最完整的品牌選擇跟最合理的價錢</p>
                </div>
                <div class="span-14 small-span-12 lp-fold_item wow fadeInUp" data-wow-delay="0.2s">
                    <div class="lp-fold_img center">
                        <div class="tool-imgInner">
                            <img src="site_images/2px.gif" alt="第二步">
                            <img class="arrow-right small-hide"  src="site_images/ru.gif" alt="arrow" height="42" width="42">
                        </div>
                    </div>
                    <h3>步驟二 : 設定送貨週期</h3>

                    <p>設定一個送貨週期, 隨時可以上網更改, 取消</p>
                </div>
                <div class="span-14 small-span-12 lp-fold_item wow fadeInUp" data-wow-delay="0.4s">
                    <div class="lp-fold_img center">
                        <div class="tool-imgInner">
                            <img src="site_images/3px.gif" alt="第三步">
                        </div>
                    </div>
                    <h3>步驟三 : 剩下我們搞定</h3>

                    <p>
                        您從此以後輕輕鬆鬆, 狗狗吃的健健康康</p>
                </div>
            </div>
        </div>

    </div><br>
    <div class="index_text_box" align = "center">
        <h3>養中大型犬? 再也不需要扛笨重的狗食, 再也不需要擔心狗食吃完. <br />養小型犬? 再也不需要買最大包, 再也不會看到狗食因放太久而發霉.</h3>
    </div>
    <div align ="center" style="cursor: pointer">
        <a  alt="馬上開始" href="<?= base_url() ?>store"><img class="img-box" src="site_images/bo.png"></a>
    </div>
</div>


<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="<?=base_url()?>dist/js/vendor/jquery-1.11.0.min.js"><\/script>')</script>

<script src="<?=base_url()?>dist/js/plugins.js"></script>
<script src="<?=base_url()?>dist/js/main.js"></script>


<!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
<script>
    (function (b, o, i, l, e, r) {
        b.GoogleAnalyticsObject = l;
        b[l] || (b[l] =
            function () {
                (b[l].q = b[l].q || []).push(arguments)
            });
        b[l].l = +new Date;
        e = o.createElement(i);
        r = o.getElementsByTagName(i)[0];
        e.src = '//www.google-analytics.com/analytics.js';
        r.parentNode.insertBefore(e, r)
    }(window, document, 'script', 'ga'));
    ga('create', 'UA-XXXXX-X');
    ga('send', 'pageview');

    $(document).ready(function() {

        $('#register').parsley();
        $('#login').parsley();

    });


</script>