<link rel="stylesheet" href="<?= base_url() ?>dist/parsley/src/parsley.css">

        <?=form_open('verify', array('id' => 'user','data-parsley-validate'=>''));?>
        <div class="sub-banner back-cover clearfix" style="background-image: url(<?= base_url() ?>dist/img/step_banner3.jpg);"><!-- background image. inline css 可用 php 設定背景 -->
            <div class="span-12">
                <h2>忘記密碼</h2>
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
                            <h3>請填寫新的密碼</h3>
                            <fieldset>
                                <legend>帳號資訊</legend>
                                <table class="sub-signup_form span-12">
                                    <tr>
                                        <td class="span-4 mt tar">
                                            <lable for="name">新的密碼：</lable>
                                        </td>
                                        <td class="span-7 mt">
                                            <input name="Edsa63fdeDqwspo9dKjd4" type="hidden" value="<?=$member_hash_id?>">
                                            <input required="required" class="span-12" name="password" id="new_password"
                                                   style="margin-bottom: 10px" type="password" placeholder="至少八個英文或數字"
                                                   data-parsley-trigger="change" data-parsley-length="[8, 20]">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="span-4 mt tar">
                                            <lable for="name">請再輸入一次相同密碼：</lable>
                                        </td>
                                        <td class="span-7 mt">
                                            <input required="required" class="span-12" name="verify_password"
                                                   style="margin-bottom: 10px" placeholder="密碼二次確認" type="password" data-parsley-trigger="change"
                                                   data-parsley-equalto="#new_password" >
                                        </td>
                                    </tr>

                                </table>
                            </fieldset>

                            <center><button type="submit" class='button button-highlight button-rounded wow pulse' >確認送出 <span class='icon-arrow-right-alt1'></span></button></center>
                        </div>

                    </div>
                </div><!-- END of sub-main -->
            </div>
        </div>
        </form>


        <script src="<?= base_url() ?>dist/js/plugins.js"></script>
        <script src="<?= base_url() ?>dist/js/main.js"></script>


<script>

    $('#user').parsley();

</script>