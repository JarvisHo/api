</nav>
<!-- Page Content -->
    <div id="page-wrapper" style="margin-left: 0px">
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            品牌資訊
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="panel panel-success">
                                <div class="panel-heading">
                                    產品列表
                                </div>
                                <div class="panel-body">
                                    <?php foreach ($products as $product_item): ?>
                                    <div class="row" style="border-bottom: #d6e9c6 solid 1px">
                                        <div class="col-lg-3">
                                            <img src="<?=current($product_item['product_description_image_path'])?>" class="img-responsive center-block" style="margin: 15px auto">
                                        </div>
                                        <div class="col-lg-8">
                                            <h3 <?if($product_item['product_status']!=0)echo "style='color:#DDDDDD;'"?>><?= $product_item['product_name']?></h3>
                                            <div>
                                                <?= $product_item['product_digest']?>
                                            </div>
                                            <p>
                                                <blockquote style="margin: 0;padding-bottom: 0;">
                                                    <?php foreach ($product_item['package'] as $package): ?><small><?= $package['package_weight'];?>克  <p class="fa fa-money"> <?= $package['package_price'];?>元</p></small><?php endforeach ?>
                                                </blockquote>
                                            </p>
                                            <p>
                                                <a href="<?= base_url() ?>admin/product/view/<?= $product_item['product_hash_id']?>" style="margin-bottom: 6px" class="btn btn-primary btn-circle pull-right">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                            </p>
                                        </div>
                                    </div>
                                    <?php endforeach ?>
                                </div>
                            </div>
                        <!-- /.panel-body -->
                        </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="<?php echo base_url();?>dist/bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url();?>dist/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo base_url();?>dist/bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?php echo base_url();?>dist/js/sb-admin-2.js"></script>

    <!-- DataTables JavaScript -->
    <script src="<?php echo base_url();?>dist/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>

    <script src="<?php echo base_url();?>dist/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>

    <!-- Bootstrap datepicker JavaScript -->
    <script src="<?php echo base_url();?>dist/js/bootstrap-datepicker.js"></script>

    <script>

        $(document).ready(function() {

            $('#startDate').datepicker({ format: 'yyyy-mm-dd'});
            $('#endDate').datepicker({format: 'yyyy-mm-dd'});

            if ( $( "#dataTables" ).length ) {
                $('#dataTables').DataTable({
                    order: [[ 0, "desc" ]],
                    responsive: true
                });
            }


            $("#left_navigation").css("display","block");

        });


    </script>
