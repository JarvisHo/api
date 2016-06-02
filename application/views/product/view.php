</nav>

<link rel="stylesheet" href="<?= base_url(); ?>dist/summernote/summernote.css">

<link rel="stylesheet" href="<?= base_url(); ?>dist/summernote/font-awesome.css">

<link rel="stylesheet" href="<?= base_url(); ?>dist/parsley/src/parsley.css">

<link rel="stylesheet" href="<?= base_url(); ?>dist/pickadate/themes/default.css">

<link rel="stylesheet" href="<?= base_url(); ?>dist/pickadate/themes/default.date.css">

<!-- Page Content -->
<div id="page-wrapper" style="margin-left: 0px; padding-top: 20px">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">

                <!--                <div class='alert alert-default'><img src="-->
                <? //=current($brand['brand_description_image_path'])?><!--" class="img-thumbnail"></div>-->

                <?= $msg; ?>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        編輯產品表單
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <?= validation_errors(); ?>
                                <? $attributes = array('id' => 'view', 'data-parsley-validate' => '', 'enctype' => 'multipart/form-data');
                                echo form_open('admin/product/view/' . $product_hash_id, $attributes); ?>
                                <input type="hidden" name="product_hash_id" value="<?= $product_hash_id; ?>">
                                <input type="hidden" name="product_id" value="<?= $product_id; ?>">
                                <input type="hidden" name="brand_hash_id" value="<?= $brand['brand_hash_id']; ?>">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>產品名稱</label>
                                    <textarea class="form-control" rows="2" name="product_name"
                                        ><?= $product_name; ?></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>產品摘要</label>
                                    <textarea class="form-control" rows="15" name="product_digest"
                                        ><?= $product_digest; ?></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>產品內文</label>
                                    <textarea class="form-control summernote" rows="15" name="product_description"
                                        ><?= $product_description; ?></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-4">


                                    <div class="form-group">
                                        <label>產品圖片</label><br>
                                        <img for="product_image" class="img-thumbnail"
                                             src="<? if(isset($product_image))echo $product_image;?>"
                                             style="width:100% ;margin-bottom: 10px">
                                        <input type="file" name="userfile">
                                    </div>
                                </div>
                                <div class="col-lg-8">

                                    <div class="form-group" >
                                        <label>產品包裝</label>
                                        <?php $i = 0;
                                        foreach ($package as $unit): ?>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group input-group">
                                                        <span class="input-group-addon">重量</span>
                                                        <input class="form-control" type="text" name="package_weight[]"
                                                               data-parsley-trigger="change"
                                                               data-parsley-maxlength="5"
                                                               data-parsley-type="integer"
                                                               value="<?= $unit['package_weight']; ?>"/>

                                                        <span class="input-group-addon">g</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group input-group">
                                                        <span class="input-group-addon">$</span>
                                                        <input class="form-control" type="text" name="package_price[]"
                                                               data-parsley-trigger="change"
                                                               data-parsley-maxlength="5"
                                                               data-parsley-type="integer"
                                                               value="<?= $unit['package_price']; ?>"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php $i++; endforeach ?>
                                        <?php for (; $i < 5; $i++) { ?>
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
                                        <? } ?>
                                    </div>
                                    <div class="form-group">
                                        <label>產品狀態：</label><br>
                                        <input type="radio" name="product_status"
                                                                     value="0" <? if ($product_status == 0) echo 'checked="checked"' ?>> 正常
                                        <input type="radio" name="product_status"
                                               value="1" <? if ($product_status == 1) echo 'checked="checked"' ?>> 隱藏
                                        <input type="radio" name="product_status"
                                               value="2" <? if ($product_status == 2) echo 'checked="checked"' ?>> 刪除
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
                                        <a href="<?= base_url() . "admin/product/new/".$brand['brand_hash_id'] ?>"
                                           class="btn btn-default btn-lg" style="float: left">繼續新增產品</a>
                                        <a href="<?= base_url() . "admin/dog/food/" . $brand['brand_hash_id']; ?>"
                                           class="btn btn-default btn-lg" style="float: right">返回產品列表</a>
                                    </div>
                                </div>

                                </form>
                                <!--                                <div class="form-group">-->
                                <!--                                    <label>圖文編輯器</label>-->
                                <!--                                    <p class="help-block">產品圖片與介紹請直接上傳到此編輯器</p>-->
                                <!--                                    <div class="form-group">-->
                                <!--                                        <textarea class="form-control" style="height:500px;" name="product_description">-->
                                <!--                                            --><? //=$product_description;?>
                                <!--                                        </textarea>-->
                                <!--                                    </div>-->
                                <!--                                </div>-->


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
<script src="<?= base_url(); ?>dist/bower_components/jquery/dist/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="<?= base_url(); ?>dist/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="<?= base_url(); ?>dist/bower_components/metisMenu/dist/metisMenu.min.js"></script>

<!-- Custom Theme JavaScript -->
<script src="<?= base_url(); ?>dist/js/sb-admin-2.js"></script>

<!-- DataTables JavaScript -->
<script src="<?= base_url(); ?>dist/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>

<script
    src="<?= base_url(); ?>dist/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>

<!-- Summernote JavaScript -->
<script src="<?= base_url(); ?>dist/summernote/summernote.js"></script>

<script src="<?= base_url(); ?>dist/summernote/summernote-zh-TW.js"></script>

<!-- parsley form validation JavaScript -->
<script src="<?= base_url(); ?>dist/parsley/dist/parsley.js"></script>

<script src="<?= base_url(); ?>dist/parsley/src/i18n/zh_tw.js"></script>

<!-- pickadate JavaScript -->
<script src="<?= base_url(); ?>dist/pickadate/picker.js"></script>

<script src="<?= base_url(); ?>dist/pickadate/picker.date.js"></script>

<script src="<?= base_url(); ?>dist/pickadate/legacy.js"></script>

<script>
    $(document).ready(function () {

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

    function sendFile(file, editor, welEditable) {

        data = new FormData();
        data.append("userfile", file);
        data.append("product_hash_id", '<?=$product_hash_id;?>');
        data.append("image_width", 450);

        $.ajax({
            data: data,
            type: "POST",
            url: "<?=base_url()?>admin/upload",
            cache: false,
            contentType: false,
            processData: false,
            success: function (url) {
                editor.insertImage(welEditable, url);
            }
        });
    }

</script>