</nav>

<link type="text/css" rel="stylesheet" href="<?=base_url()?>dist/summernote_ori/summernote.css">

<link type="text/css" rel="stylesheet" href="<?= base_url();?>dist/parsley/src/parsley.css">

<!-- Page Content -->
<div id="page-wrapper" style="margin-left: 0px; padding-top: 20px">
<div class="container">
    <div class="row">
        <div class="col-lg-12">

            <?=$msg;?>

            <div class="panel panel-default">
                <div class="panel-heading">Email Content</div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <?= validation_errors(); ?>
                            <? $attributes = array('id' => 'article','data-parsley-validate'=>'');
                               echo form_open('admin/email/update/'.$article_hash_id, $attributes);?>
                                <input type="hidden" name="article_hash_id" value="<?=$article_hash_id;?>">
                                <div class="form-group">
                                    <label>信件標題</label>
                                    <input class="form-control" type="text" name="article_title"
                                           data-parsley-trigger="change" value="<?=$article_title?>"
                                           data-parsley-required
                                           data-parsley-maxlength="100"/>
                                    <p class="help-block">限定長度100字以內</p>
                                </div>
                                <div class="form-group">
                                    <label>寄送信件的時機</label>：
                                    <input type="radio" name="article_task_category" value="0" <?if($article_task_category==0)echo "checked='checked'"?>> 訂單自動建立 &nbsp;
                                    <input type="radio" name="article_task_category" value="1" <?if($article_task_category==1)echo "checked='checked'"?>> 商品寄出時 &nbsp;
                                    <input type="radio" name="article_task_category" value="2" <?if($article_task_category==2)echo "checked='checked'"?>> 手動發動退款時 &nbsp;
                                    <input type="radio" name="article_task_category" value="3" <?if($article_task_category==3)echo "checked='checked'"?>> 客戶刷卡失敗時 &nbsp;
                                    <input type="radio" name="article_task_category" value="4" <?if($article_task_category==4)echo "checked='checked'"?>> 手動暫停客戶服務時 &nbsp;
                                    <input type="radio" name="article_task_category" value="5" <?if($article_task_category==5)echo "checked='checked'"?>> 訂單創立前五天 &nbsp;
                                </div>
                                <div class="form-group">
                                    <label>會被系統自動取代的會員資料關鍵字</label><br>
                                    <table class="table">
                                        <tr>
                                            <th>會員姓名</th><th>會員住址</th>
                                            <th>訂單編號</th><th>訂單日期</th><th>訂單的購物內容</th>
                                            <th>服務下次出單日期</th><th>服務的購物內容</th>
                                            <th>購物車總金額</th><th>退款金額</th>
                                        </tr>
                                        <tr style="color:blue">
                                            <td>{name}</td><td>{address}</td><td>{order_no}</td><td>{order_data}</td>
                                            <td>{order_cart}</td><td>{service_next_date}</td><td>{service_cart}</td>
                                            <td>{cart_total}</td><td>{refund_amount}</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="form-group">
                                    <label>內文編輯器</label>
                                    <div class="form-group">
                                        <textarea class="summernote" name="article_content"><?=$article_content?></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>本文狀態</label>：
                                    <input type="radio" name="article_status" value="0" <?if($article_status==0)echo "checked='checked'"?>> Active &nbsp;
                                    <input type="radio" name="article_status" value="1" <?if($article_status==1)echo "checked='checked'"?>> Disable &nbsp;
                                    <input type="radio" name="article_status" value="2" <?if($article_status==2)echo "checked='checked'"?>> Delete &nbsp;
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-lg" style="width: 100%">送出</button>

                                    <a href="<?=base_url()."admin/email/"?>" class="btn btn-default btn-lg" style="margin-top: 10px; float: right">返回</a>
                                </div>
                            </form>
                        </div>
                        <!-- /.col-lg-6 (nested) -->
                    </div>
                    <!-- /.row (nested) -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
</div>
<!-- /.row -->

</div>
<!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<!-- jQuery -->
<script src="<?=base_url();?>dist/bower_components/jquery/dist/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="<?=base_url();?>dist/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="<?=base_url();?>dist/bower_components/metisMenu/dist/metisMenu.min.js"></script>

<!-- Custom Theme JavaScript -->
<script src="<?=base_url();?>dist/js/sb-admin-2.js"></script>

<!-- summernote JavaScript -->
<script src="<?=base_url();?>dist/summernote_ori/summernote.js"></script>

<script src="<?=base_url();?>dist/summernote/summernote-zh-TW.js"></script>

<!-- parsley form validation JavaScript -->
<script src="<?=base_url();?>dist/parsley/dist/parsley.js"></script>

<script src="<?=base_url();?>dist/parsley/src/i18n/zh_tw.js"></script>


<script>
    $(document).ready(function() {

        $('#article').parsley();

        $(function() {
            $('.summernote').summernote({
                height: 420
            });
        });


    });

</script>