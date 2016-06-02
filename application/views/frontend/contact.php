
<!-- membership -->
        <!-- background img & title -->
<style xmlns="http://www.w3.org/1999/html">

        </style>

        <div class="sub-banner back-cover clearfix" style="background-image: url(<?= base_url() ?>dist/img/step_banner3.jpg);"><!-- background image. inline css 可用 php 設定背景 -->
            <div class="span-12">
                <h2>聯絡我們</h2>
            </div>
        </div>
        <!--membership. main section 沿用 subscribe flow template-->
        <div class="membership sub-flow tool-boxshadow clearfix">
            <div class="warper">

                <!-- members' info & subscribed products list -->
                <div class="sub-main row">

                    <!-- members' info -->
                    <div class="sub-info span-11 small-span-12" style="margin-left: 30px">
                        <div class="sub-signup">
                            <h3><?=$msg?></h3>
        
                            <?= form_open('contact', array('id' => 'contact','data-parsley-validate'=>''));?>
                            <fieldset>
                                <legend>聯絡資訊</legend>
                                <table class="sub-signup_form span-12">
                                    <tr>
                                        <td class="span-4 mt tar">
                                            <lable for="email">您的聯絡信箱：</lable>
                                        </td>
                                        <td class="span-7 mt">
                                            <input type="email" id="email" name="email" class="span-12" placeholder="example@gmail.com" required="required">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="span-4 mt tar">
                                            <lable for="name">您的姓名：</lable>
                                        </td>
                                        <td class="span-7 mt">
                                            <input type="text" id="name" name="name" class="span-12" placeholder="請填入您的大名(選填)">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="span-4 mt tar">
                                            <lable for="phone">您的聯絡電話：</lable>
                                        </td>
                                        <td class="span-7 mt">
                                            <input type="text" id="phone" name="phone" class="span-12" placeholder="(選填)">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="span-4 mt tar">
                                            <lable for="email">您想說的話：</lable>
                                        </td>
                                        <td class="span-7 mt">
                                            <textarea class="span-12" rows="4" name="message"></textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                    <td class="span-4 mt tar">
                                    </td>
                                    <td class="span-7 mt">
                                        <input type="submit" class="button button-highlight button-rounded wow pulse" value="送出">
                                    </td>
                                    </tr>
                                </table>
                            </fieldset>
                            </form>
                        </div>

                    </div>
                </div><!-- END of sub-main -->
            </div>
        </div>


        <script src="<?= base_url() ?>dist/js/plugins.js"></script>
        <script src="<?= base_url() ?>dist/js/main.js"></script>

