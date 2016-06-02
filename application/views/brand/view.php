</nav>

<link rel="stylesheet" href="<?= base_url();?>dist/summernote/summernote.css">

<link rel="stylesheet" href="<?= base_url();?>dist/summernote/font-awesome.css">

<link rel="stylesheet" href="<?= base_url();?>dist/parsley/src/parsley.css">

<link rel="stylesheet" href="<?= base_url();?>dist/pickadate/themes/default.css">

<link rel="stylesheet" href="<?= base_url();?>dist/pickadate/themes/default.date.css">

<!-- Page Content -->
<div id="page-wrapper" style="margin-left: 0px; padding-top: 20px">
    <div class="container">
        <div class="row">
            <div class="col-lg-10">

                <?=$msg;?>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        編輯品牌表單
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <?= validation_errors(); ?>
                                <? $attributes = array('id' => 'view','data-parsley-validate'=>'');
                                echo form_open('admin/brand/view/'.$brand_hash_id, $attributes);?>
                                <input type="hidden" name="brand_hash_id" value="<?=$brand_hash_id;?>">
                                <div class="form-group">
                                    <label>品牌名稱</label>
                                    <input class="form-control" type="text" name="brand_name"
                                           value="<?=$brand_name;?>"
                                           data-parsley-trigger="change"
                                           data-parsley-required
                                           data-parsley-maxlength="100"
                                           data-parsley-pattern='/^[^\"?]+$/'/>
                                    <p class="help-block">限定長度100字以內</p>
                                </div>
                                <div class="form-group">
                                    <label>品牌排序</label>
                                    <input class="form-control" type="text" name="brand_sort"
                                           value="<?=$brand_sort;?>"
                                           data-parsley-trigger="change"
                                           data-parsley-type="integer"
                                           data-parsley-required/>
                                    <p class="help-block">限定長度100字以內</p>
                                </div>
                                <div class="form-group">
                                    <label>品牌狀態</label>
                                    <input type="radio" name="brand_status" value="0" <?if($brand_status==0)echo 'checked="checked"'?>> 正常
                                    <input type="radio" name="brand_status" value="1" <?if($brand_status==1)echo 'checked="checked"'?>> 隱藏
                                </div>
                                <div class="form-group">
                                    <label>品牌摘要</label>
                                    <textarea class="form-control" rows="4" name="brand_digest"
                                              data-parsley-trigger="change"
                                              data-parsley-maxlength="150"
                                              data-parsley-pattern='/^[^\"?]+$/'><?=$brand_digest;?></textarea>
                                    <p class="help-block">限定長度150字以內</p>
                                </div>
                                <div class="form-group">
                                    <label>圖文編輯器</label>
                                    <p class="help-block">品牌橫幅與介紹請直接上傳到此編輯器</p>
                                    <div class="form-group">
                                        <textarea class="summernote" name="brand_description">
                                            <?=$brand_description;?>
                                        </textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-default">送出</button>
                                    <a href="<?=base_url()."admin/dog/food/".$brand_hash_id?>" onclick="return confirm('請再次確認，返回後所有圖文不會儲存。')" class="btn btn-default">返回</a>
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

<div id="pickadate_container"></div>
<!-- jQuery -->
<script src="<?=base_url();?>dist/bower_components/jquery/dist/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="<?=base_url();?>dist/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="<?=base_url();?>dist/bower_components/metisMenu/dist/metisMenu.min.js"></script>

<!-- Custom Theme JavaScript -->
<script src="<?=base_url();?>dist/js/sb-admin-2.js"></script>

<!-- DataTables JavaScript -->
<script src="<?=base_url();?>dist/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>

<script src="<?=base_url();?>dist/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>

<!-- Summernote JavaScript -->
<script src="<?=base_url();?>dist/summernote/summernote.js"></script>

<script src="<?=base_url();?>dist/summernote/summernote-zh-TW.js"></script>

<!-- parsley form validation JavaScript -->
<script src="<?=base_url();?>dist/parsley/dist/parsley.js"></script>

<script src="<?=base_url();?>dist/parsley/src/i18n/zh_tw.js"></script>

<!-- pickadate JavaScript -->
<script src="<?=base_url();?>dist/pickadate/picker.js"></script>

<script src="<?=base_url();?>dist/pickadate/picker.date.js"></script>

<script src="<?=base_url();?>dist/pickadate/legacy.js"></script>

<script>
    $(document).ready(function() {

        $('#view').parsley();

        jQuery('.summernote').summernote({
            lang: 'zh-TW',
            height: "500px",
            tabsize: 4,
            codemirror: {
                theme: 'monokai'
            },
            onImageUpload: function(files, editor, welEditable) {

                var lenth = files.length;

                for (var i = 0; i < lenth; i++) {
                    sendFile(files[i],editor,welEditable);
                }
            }

        });

    });

    function sendFile(file,editor,welEditable) {

        data = new FormData();
        data.append("userfile", file);
        data.append("brand_hash_id", '<?=$brand_hash_id;?>');
        data.append("image_width", 640);

        $.ajax({
            data: data,
            type: "POST",
            url: "<?=base_url()?>admin/upload",
            cache: false,
            contentType: false,
            processData: false,
            success: function(url) {
                    editor.insertImage(welEditable, url);
            }
        });
    }

</script>