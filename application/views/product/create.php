</nav>

<link rel="stylesheet" href="<?= base_url();?>dist/summernote/font-awesome.css">

<!-- Page Content -->
<div id="page-wrapper" style="margin-left: 0px; padding-top: 20px">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">

                <?=$msg;?>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <?=$brand['brand_name']?> - 新增產品表單
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <?= validation_errors(); ?>
                                <? $attributes = array('id' => 'new_article','data-parsley-validate'=>'', 'enctype' => 'multipart/form-data');
                                echo form_open('admin/product/new/'.$product_brand_id, $attributes);?>
                                <input type="hidden" name="product_hash_id" value="<?=$hash_id;?>">
                                <input type="hidden" name="product_brand_id" value="<?=$brand['brand_id'];?>">
                                <input type="hidden" name="brand_hash_id" value="<?=$brand['brand_hash_id'];?>">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>產品名稱</label>
                                        <textarea class="form-control" rows="2" name="product_name" ></textarea>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>產品摘要</label>
                                    <textarea class="form-control" rows="15" name="product_digest"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-4">

                                    <div class="form-group">
                                        <label>產品圖片</label><br>
                                        <img for="product_image" class="img-thumbnail"
                                             src="http://placehold.it/600"
                                             style="width:100% ;margin-bottom: 10px">
                                        <input type="file" name="userfile">
                                    </div>

                                </div>
                                <div class="col-lg-8">
                                <div class="form-group" style="padding-left: 10px">
                                    <label>產品包裝</label>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group input-group">
                                                <span class="input-group-addon">重量</span>
                                                <input class="form-control" type="text" name="package_weight[]"
                                                       data-parsley-trigger="change"
                                                       data-parsley-maxlength="5"
                                                       data-parsley-type="integer"/>
                                                <span class="input-group-addon">g</span>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group input-group">
                                                <span class="input-group-addon">$</span>
                                                <input class="form-control" type="text" name="package_price[]"
                                                       data-parsley-trigger="change"
                                                       data-parsley-maxlength="5"
                                                       data-parsley-type="integer"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group input-group">
                                                <span class="input-group-addon">重量</span>
                                                <input class="form-control" type="text" name="package_weight[]"
                                                       data-parsley-trigger="change"
                                                       data-parsley-maxlength="5"
                                                       data-parsley-type="integer"/>
                                                <span class="input-group-addon">g</span>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group input-group">
                                                <span class="input-group-addon">$</span>
                                                <input class="form-control" type="text" name="package_price[]"
                                                       data-parsley-trigger="change"
                                                       data-parsley-maxlength="5"
                                                       data-parsley-type="integer"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group input-group">
                                                <span class="input-group-addon">重量</span>
                                                <input class="form-control" type="text" name="package_weight[]"
                                                       data-parsley-trigger="change"
                                                       data-parsley-maxlength="5"
                                                       data-parsley-type="integer"/>
                                                <span class="input-group-addon">g</span>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group input-group">
                                                <span class="input-group-addon">$</span>
                                                <input class="form-control" type="text" name="package_price[]"
                                                       data-parsley-trigger="change"
                                                       data-parsley-maxlength="5"
                                                       data-parsley-type="integer"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group input-group">
                                                <span class="input-group-addon">重量</span>
                                                <input class="form-control" type="text" name="package_weight[]"
                                                       data-parsley-trigger="change"
                                                       data-parsley-maxlength="5"
                                                       data-parsley-type="integer"/>
                                                <span class="input-group-addon">g</span>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group input-group">
                                                <span class="input-group-addon">$</span>
                                                <input class="form-control" type="text" name="package_price[]"
                                                       data-parsley-trigger="change"
                                                       data-parsley-maxlength="5"
                                                       data-parsley-type="integer"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group input-group">
                                                <span class="input-group-addon">重量</span>
                                                <input class="form-control" type="text" name="package_weight[]"
                                                       data-parsley-trigger="change"
                                                       data-parsley-maxlength="5"
                                                       data-parsley-type="integer"/>
                                                <span class="input-group-addon">g</span>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group input-group">
                                                <span class="input-group-addon">$</span>
                                                <input class="form-control" type="text" name="package_price[]"
                                                       data-parsley-trigger="change"
                                                       data-parsley-maxlength="5"
                                                       data-parsley-type="integer"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>產品狀態：</label><br>
                                        <input type="radio" name="product_status"
                                               value="0" > 正常
                                        <input type="radio" name="product_status"
                                               value="1" checked="checked"> 隱藏
                                    </div>
                                </div>
                            </div>
                                <div class="col-lg-12">
                                    <div class="form-group">

                                        <button type="submit" class="btn btn-primary btn-lg" style="width:100%;"> 送出並儲存
                                        </button>

                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <a href="<?= base_url() . "admin/dog/food/" . $brand['brand_hash_id']; ?>"
                                           class="btn btn-default btn-lg" style="float: right">返回產品列表</a>
                                    </div>
                                </div>
                            <!-- /.col-lg-6 (nested) -->
                        </div>
                            </form>
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

        $('#new_article').parsley();

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
        data.append("article_hash_id", '<?=$hash_id;?>');
        data.append("image_width", 500);

        $.ajax({
            data: data,
            type: "POST",
            url: "<?=base_url()?>admin/upload",
            cache: false,
            contentType: false,
            processData: false,
            success: function(url) {
//                alert(url);
                editor.insertImage(welEditable, url);
            }
        });
    }
</script>