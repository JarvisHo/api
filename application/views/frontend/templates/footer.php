
<footer class="footer clearfix">
    <div class="row">
        <div class="warper tool-mtb">
            <!-- space for logo -->
            <div class="span-2 small-hide">
                <a href="#"><img class="footer-logo" src="<?=base_url()?>dist/img/logo_footer.png" alt=""></a>
            </div>
            <!-- space for some description -->
            <div class="span-7 small-hide">
                <p align="center">
                  Copyright @ PawMaji 2015. <br />寵物商品定期宅配服務. <br />版權所有 轉載必究, <br />客服專線 0972 953 966
                </p>
            </div>
            <!-- space for links (ex. social media) -->
            <div class="links span-2 small-span-12">
                <a href="https://www.facebook.com/PawMaji"><span class="footer-icon icon-facebook2"></span></a><!-- facebook link -->
                <a href="<?=base_url()?>contact"><span class="footer-icon icon-envelope"></span></a><!-- email link or contact form -->
            </div>
        </div>
    </div>
</footer>

<div id="login-form" class="login"><!-- for big screen -->
    <h1>歡迎來到 PawMaji</h1>
    <p>請輸入您的帳號密碼</p>
    <?=form_open('login', array('id' => 'loginForm'));?>
    <?=form_hidden(array('action' => 'login'))?>
    <?=form_hidden(array('source' => 'header'))?>
    <div class="input">
        <div class="blockinput">
            <i class="icon-envelope-alt"></i><input type="email" id="email" name="email" placeholder="帳號（email）">
        </div>
        <div class="blockinput">
            <i class="icon-unlock"></i><input type="password" name="password" placeholder="密碼" >

        </div>

    </div>
    <div class="span-12" style="text-align: right"><a href="<?=base_url()?>reset" style="font-size: 0.9em">忘記密碼？</a></div>


    <div class="span-12"><input type="submit" value="馬上登入" class="submit button button-rounded button-flat-primary" style="width:100%;"></div>

    <div class="span-12"><input type="button" value="建立新帳號" class="submit button button-rounded button-flat-primary" style="width:100%;" onclick="window.location='<?=base_url()?>startup'" ></div>


    </form>
    <a href="<?=base_url()?>" class="fancybox-close"></a>
</div>
<div id="login-form-small" class="login-small"><!-- for mobile -->

    <h1>歡迎回來 PawMaji</h1>

    <p>請輸入您的帳號密碼登入</p>
    <?=form_open('login', array('id' => 'loginForms'));?>
    <?=form_hidden(array('action' => 'login'))?>
    <?=form_hidden(array('source' => 'header'))?>
    <div class="input">
        <div class="blockinput">
            <i class="icon-envelope-alt"></i><input type="email" id="email" name="email" placeholder="帳號（email）">
        </div>
        <div class="blockinput">
            <i class="icon-unlock"></i><input type="password" name="password" placeholder="密碼" >
        </div>
    </div>
    <input type="submit" value="馬上登入 / 建立新帳號" class="submit button button-rounded button-flat-primary" style="width: 100%">

    <a href="<?=base_url()?>reset" class="submit button button-rounded button-flat-primary" style="width: 100%;padding: 2px 0px;margin-top:10px; background-color: #dfdfdf; color:#333333">忘記密碼？</a>

    </form>
    <a href="<?=base_url()?>" class="fancybox-close"></a>
</div>

</body>
</html>
<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-62466458-1', 'auto');
    ga('send', 'pageview');



</script>
<script src="<?= base_url() ?>dist/parsley/dist/parsley.js"></script>
<script src="<?= base_url() ?>dist/parsley/src/i18n/zh_tw.js"></script>