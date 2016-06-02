</nav>

<link rel="stylesheet" href="<?= base_url();?>dist/parsley/src/parsley.css">

<!-- Page Content -->
<div id="page-wrapper" style="margin-left: 0px; padding-top: 20px">
    <div class="container">
        <div class="row">
            <div class="col-lg-10">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        新增橫幅
                    </div>
                    <?= validation_errors(); ?>
                    <? $attributes = array('id' => 'new_banner','data-parsley-validate'=>'' ,'enctype' => 'multipart/form-data');
                    echo form_open('admin/upload', $attributes);?>
                    <input type="hidden" name="hash_id" value="<?=sha1(rand());?>">
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs">
                            <li class="col-lg-5 active"><a href="#home" data-toggle="tab" aria-expanded="false">橫幅圖片上傳</a>
                            </li>
                            <li class="col-lg-5 "><a href="#profile" data-toggle="tab" aria-expanded="true">Youtube影片連結</a>
                            </li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane fade active in" id="home">
                                <h3> </h3>
                                <p>
                                <div class="form-group">
                                    <label>請選擇圖片來源：</label>
                                    <input type="file" name="userfile" class="form-control">
                                </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-default">送出</button>
                            <a href="<?=base_url()?>article" class="btn btn-default">返回</a>
                        </div>
                    </div>
                    <!-- /.panel-body -->
                    </form>
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
<script src="<?php echo base_url();?>dist/bower_components/jquery/dist/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="<?php echo base_url();?>dist/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="<?php echo base_url();?>dist/bower_components/metisMenu/dist/metisMenu.min.js"></script>

<!-- Custom Theme JavaScript -->
<script src="<?php echo base_url();?>dist/js/sb-admin-2.js"></script>

<!-- parsley form validation JavaScript -->
<script src="<?php echo base_url();?>dist/parsley/dist/parsley.js"></script>

<script src="<?php echo base_url();?>dist/parsley/src/i18n/zh_tw.js"></script>

<script>
    $(document).ready(function() {

        $('#new_banner').parsley();

    });

</script>