
</nav>
    <!-- Page Content -->
    <div id="page-wrapper" style="margin-left: 0px">

            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Order</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Search Function
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <div class="table-responsive">

                                        <table class="table table-hover" style="margin-bottom: 10px;">
                                            <?php echo validation_errors(); ?>
                                            <?php $attributes = array( 'id' => 'search');
                                                  echo form_open('admin/order', $attributes); ?>
                                            <tr>
                                                <td><label>Order ID</label></td>
                                                <td>
                                                    <input type='text' value='<? if(isset($order_search))echo $order_search['ID'] ?>' name='ID' class='search_input form-control'>
                                                </td>
                                                <td><label>Customer ID</label></td>
                                                <td>
                                                    <input type='text' value='<? if(isset($order_search))echo $order_search['MID'] ?>' name='MID' class='search_input form-control'>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><label>Name</label></td><td>
                                                    <input type='text' value='<? if(isset($order_search))echo $order_search['FULLNAME'] ?>' name='FULLNAME' class='search_input form-control'></td>
                                                <td><label>Order Status</label></td><td>
                                                    <select name='STATUS' class='form-control STATUS'>
                                                        <option value=''>Select status</option>
                                                        <option value='0'  <? if(isset($order_search)){ if($order_search['STATUS']==0 AND $order_search['STATUS']!='')echo "selected='selected'"; } ?>>等待自動刷卡</option>
                                                        <option value='1'  <? if(isset($order_search)){ if($order_search['STATUS']==1)echo "selected='selected'"; } ?> >已成功付款</option>
                                                        <option value='2'  <? if(isset($order_search)){ if($order_search['STATUS']==2)echo "selected='selected'"; } ?> >付款失敗</option>
                                                        <option value='3'  <? if(isset($order_search)){ if($order_search['STATUS']==3)echo "selected='selected'"; } ?> >已出貨</option>
                                                        <option value='4'  <? if(isset($order_search)){ if($order_search['STATUS']==4)echo "selected='selected'"; } ?> >等待自動退款</option>
                                                        <option value='5'  <? if(isset($order_search)){ if($order_search['STATUS']==5)echo "selected='selected'"; } ?> >已退款</option>
                                                        <option value='6'  <? if(isset($order_search)){ if($order_search['STATUS']==6)echo "selected='selected'"; } ?> >退款失敗</option>
                                                        <option value='7'  <? if(isset($order_search)){ if($order_search['STATUS']==7)echo "selected='selected'"; } ?> >已出貨已退款</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><label>Address</label></td><td>
                                                    <input type='text' value='<? if(isset($order_search))echo $order_search['ADDRESS'] ?>' name='ADDRESS' class='search_input form-control'></td>
                                                <!--td><label>Shipping Status</label></td><td>
                                                    <select name='shippingStatus' class='form-control'>
                                                        <option value=''>Select status</option>
                                                        <option value='0' <? if(isset($order_search)){ if($order_search['shippingStatus']==0)echo "selected='selected"; } ?>>Unshiped</option>
                                                        <option value='1' <? if(isset($order_search)){ if($order_search['shippingStatus']==1)echo "selected='selected"; } ?>>Shipped</option>
                                                    </select>
                                                </td-->
                                                <td><label>Email</label></td><td>
                                                    <input type='text' value='<? if(isset($order_search))echo $order_search['ACCOUNT'] ?>' name='ACCOUNT' class='account_input search_input form-control'>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td ><label>Period</label></td>
                                                <td colspan='3'>
                                                    <input type='text' name='startDate' id='startDate' class='form-control search_input datepicker'
                                                           style="width:45%;display:inline;" placeholder="Start date"
                                                           value='<? if(isset($order_search))echo $order_search['startDate'] ?>'> ~
                                                    <input type='text' name='endDate' id='endDate' class='form-control search_input datepicker'
                                                           style="width:45%;display:inline;" placeholder="End date"
                                                           value='<? if(isset($order_search))echo $order_search['endDate'] ?>'>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan='4'>
                                                    <input type="reset" class='btn btn-primary' value='清除' id="reset">
                                                    <input type='submit'  class='btn btn-primary'  value='搜尋'>
                                                </td>
                                            </tr>
                                            </form>
                                        </table>
                                </div>
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                    <div class="col-lg-12">
                        <ol class="breadcrumb">
                            <!-- <li><a href='#'  class='btn btn-primary'>啟動Autoship</a></li>
                            <li><a href='#'  class='btn btn-primary'>暫停Autoship</a></li> -->
                            <li><button class='btn btn-primary' id="all">All orders</button></li>
<!--                            <li><button class='btn btn-primary' id="waiting">Waiting</button></li>-->
                            <li><button class='btn btn-primary' id="approved">Approved</button></li>
                            <li><button class='btn btn-primary' id="declined">Declined</button></li>
                            <li><button class='btn btn-primary' id="shipped">Shipped</button></li>
                            <li><button class='btn btn-primary' id="refunded">Refund</button></li>
                        </ol>
                    </div>
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            DataTables
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">

                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                  <thead>
                                      <tr>
                                          <th>訂單編號</th>
                                          <th>時間</th>
                                          <th>姓名</th>
<!--                                      <th>帳號</th>-->
                                          <th>總價</th>
                                          <th>地址</th>
                                          <th>下次送貨日</th>
                                          <th>狀態</th>
                                          <th>功能</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                    <?php foreach ($order as $order_item): ?>
                                        <tr class="odd gradeX">
                                            <td><?= $order_item['order_paynow_OrderNo'] ?></td>
                                            <td><?= $order_item['order_stamp'] ?></td>
                                            <td>
                                                <span class="hint-bottom" data-hint="<?=$order_item['order_member_account']?>">
                                                    <?= $order_item['order_member_name'] ?>
                                                </span>
                                            </td>
<!--                                            <td>--><?//= $order_item['order_member_account'] ?><!--</td>-->
                                            <td>
                                                <span class="hint-bottom" data-hint="<?php foreach ($order_item['order_cart'] as $order_cart): ?><?= $order_cart['cart_product_name'];?> $<?= $order_cart['cart_package_price'];?> x <?= $order_cart['cart_package_qty'];?> &#10;&#10;<?php endforeach ?>">
                                                    $<?= $order_item['order_cart_total'] ?>
                                                </span>
                                            </td>
                                            <td><?= $order_item['order_member_address'] ?></td>
                                            <td <?if($order_item['service_status']!=0)echo "style='color:#dddddd;'"?>><?= $order_item['service_date_next']?></td>
                                            <td><span style="display: none"><?= $order_item['order_member_status'] ?></span>
                                                    <?= $order_item['STATUS_IMAGE'] ?>
                                            </td>
                                            <td><a class="btn btn-primary" href="<?= base_url();?>admin/order/view/<?= $order_item['order_id'] ?>">編輯</a>
                                                <a class="btn btn-danger" onclick="return confirm('請再次確認，無法取消退款。')"
                                                   href="<?= base_url();?>admin/order/refund/<?= $order_item['order_id'] ?>"
                                                    >退款</a>
                                                <a class="btn <?if($order_item['service_status']==0)echo "btn-danger"; else echo "btn-success";?>"
                                                   onclick="return confirm('請再次確認，進行暫停該筆訂單服務。')"
                                                   href="<?= base_url();?>admin/order/suspend/<?= $order_item['order_service_id'] ?>"><?if($order_item['service_status']==0)echo "暫停服務"; else echo "重啟服務";?></a>

                                                    <a class="btn btn-primary" href="<?= base_url();?>admin/order/shipped/<?= $order_item['order_id'] ?>"
                                                    <?if($order_item['order_status']!=1)echo "disabled";?>>出貨</a>

                                            </td>
                                        </tr>
                                    <?php endforeach ?>
                                  </tbody>
                                </table>
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


    <script>


        $(document).ready(function() {

            if ( $( "#dataTables-example" ).length ) {
                $('#dataTables-example').DataTable({
                    order: [[ 0, "desc" ]],
                    responsive: true
                });
            }

            $( "#reset" ).click(function() {
                $( '.search_input' ).attr("value",'');
                $( "#search" ).submit();
            });

            $( "#all" ).click(function() {
                $( '.search_input' ).attr("value",'');
                $( '.STATUS' )[0].selectedIndex = 0;
                $( "#search" ).submit();
            });

            $( "#approved" ).click(function() {
                $( '.STATUS' )[0].selectedIndex = 2;
                $( "#search" ).submit();
            });
            $( "#declined" ).click(function() {
                $( '.STATUS' )[0].selectedIndex = 3;
                $( "#search" ).submit();
            });

            $( "#shipped" ).click(function() {
                $( '.STATUS' )[0].selectedIndex = 4;
                $( "#search" ).submit();
            });

            $( "#refunded" ).click(function() {
                $( '.STATUS' )[0].selectedIndex = 6;
                $( "#search" ).submit();
            });
        });


    </script>
