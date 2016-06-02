</nav>
<!-- Page Content -->
    <div id="page-wrapper" style="margin-left: 0px">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Dashboard</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->


            <div class="row">
                <!-- /.col-lg-12 -->
                <div class="col-lg-9">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-truck fa-fw"></i> 待出貨清單
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="list-group">
                                <?if(count($order)==0){?>

                                <a href="#" class="list-group-item" style="background-color: rgba(0, 220, 0, 0.05);">
                                    <p style="margin-top: 8px;"><i class="fa fa-rocket fa-fw"></i> 太棒了！今天的訂單都出貨了！繼續往前邁進吧！</p>
                                </a>
                                <?}?>
                                <? foreach($order AS $unit):?>
                                <a href="#" class="list-group-item">
                                    <p><i class="fa fa-paw fa-fw"></i> 訂單編號：<?=substr($unit['order_paynow_OrderNo'],-6)?></p>
                                    <p><i class="fa fa-user fa-fw"></i> 會員姓名：<?=$unit['order_member_name']?></p>
                                    <p><i class="fa fa-phone fa-fw"></i> 會員電話：<?=$unit['order_member_phone']?></p>
                                    <p><i class="fa fa-location-arrow fa-fw"></i> 收件地址：<?=$unit['order_member_address']?></p>
                                    <p><i class="fa fa-clock-o"></i> 收貨時間：<?=$unit['member_shipping_text']?></p>
                                    <p><i class="fa fa-shopping-cart fa-fw"></i> 購物車內容：</p>
                                    <ol style="margin-top: 10px">
                                        <? foreach($unit['order_cart'] AS $cart):?>
                                            <li><?=$cart['cart_product_name']?> <div class="btn btn-default disabled"><i class="fa fa-tag fa-fw"></i><?=$cart['cart_package_weight_text']?> </div> <div class="btn btn-default disabled"><i class="fa fa-cube fa-fw"></i> <?=$cart['cart_package_qty']?> 包</div>  <div class="btn btn-default disabled"><i class="fa fa-dollar fa-fw"></i><?=$cart['cart_package_price']?>元</div></li>
                                        <? endforeach?>
                                    </ol>
                                </a>
                                <? endforeach?>

                                <? foreach($recent_services AS $unit):?>
                                    <a href="#" class="list-group-item" style="background-color: hsla(120, 100%, 20%, 0.05)">
                                        <p><i class="fa fa-calendar fa-fw"></i> 預備下單日：<?=$unit['service_date_next']?></p>
<!--                                        <p><i class="fa fa-user fa-fw"></i> 會員姓名：--><?//=$unit['member_name']?><!--</p>-->
<!--                                        <p><i class="fa fa-phone fa-fw"></i> 會員電話：--><?//=$unit['member_phone']?><!--</p>-->
<!--                                        <p><i class="fa fa-location-arrow fa-fw"></i> 收件地址：--><?//=$unit['member_address']?><!--</p>-->
<!--                                        <p><i class="fa fa-clock-o"></i> 收貨時間：--><?//=$unit['member_shipping_text']?><!--</p>-->
                                        <p><i class="fa fa-shopping-cart fa-fw"></i> 購物車內容：</p>
                                        <ol style="margin-top: 10px">
                                            <? foreach($unit['service_cart'] AS $cart):?>
                                                <li><?=$cart['cart_product_name']?> <div class="btn btn-default disabled"><i class="fa fa-tag fa-fw"></i><?=$cart['cart_package_weight_text']?> </div> <div class="btn btn-default disabled"><i class="fa fa-cube fa-fw"></i> <?=$cart['cart_package_qty']?> 包</div>  <div class="btn btn-default disabled"><i class="fa fa-dollar fa-fw"></i><?=$cart['cart_package_price']?>元</div></li>
                                            <? endforeach?>
                                        </ol>
                                    </a>
                                <? endforeach?>
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>

                </div>


                <div class="col-lg-3">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <i class="fa fa-bell fa-fw"></i> 系統資訊
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div class="list-group">
<!--                                    <a href="#" class="list-group-item">-->
<!--                                        <i class="fa fa-eye fa-fw"></i> 本日瀏覽-->
<!--                                    <span class="pull-right text-muted small"><em>27</em>-->
<!--                                    </span>-->
<!--                                    </a>-->

                                    <a href="#" class="list-group-item">
                                        <i class="fa fa-leaf fa-fw"></i> 準會員數
                                    <span class="pull-right text-muted small"><em><?=$prospect?></em>
                                    </span>
                                    </a>

                                    <a href="#" class="list-group-item">
                                        <i class="fa fa-user fa-fw"></i> 會員人數
                                    <span class="pull-right text-muted small"><em><?=$member?></em>
                                    </span>
                                    </a>

                                    <a href="#" class="list-group-item">
                                        <i class="fa fa-repeat fa-fw"></i> 定期服務
                                    <span class="pull-right text-muted small"><em><?=$active_service_counter?></em>
                                    </span>
                                    </a>

                                    <a href="#" class="list-group-item">
                                        <i class="fa fa-calendar fa-fw"></i> 即將下單
                                    <span class="pull-right text-muted small"><em><?=count($recent_services)?></em>
                                    </span>
                                    </a>
                                </div>
                            </div>
                            <!-- /.panel-body -->
                        </div>

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
    <script src="<?php echo base_url();?>bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url();?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo base_url();?>bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?php echo base_url();?>dist/js/sb-admin-2.js"></script>

    <!-- DataTables JavaScript -->
    <script src="<?php echo base_url();?>bower_components/datatables/media/js/jquery.dataTables.min.js"></script>

    <script src="<?php echo base_url();?>bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>

    <script>
        $(document).ready(function() {

            if ( $( "#dataTables-example" ).length ) {
              $('#dataTables-example').DataTable({
                      responsive: true
              });
            }

        });

        $( "#reset" ).click(function() {
            $( '.search_input' ).attr("value",'');
        });
    </script>
