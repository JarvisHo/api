</nav>
<style>
    .table-active {
        background-color: rgba(0, 220, 0, 0.05);
    }

    .table-disabled {
        background-color: rgba(220, 0, 0, 0.05);
    }
</style>
<!-- Page Content -->
    <div id="page-wrapper" style="margin-left: 0px">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Member</h1>
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


                                        <table class='table table-hover' style="margin-bottom: 10px;">

                                            <?php echo validation_errors(); ?>
                                            <?php echo form_open('admin/member') ?>

                                                <input type='hidden' name='function' value='search'>
                                            <tr>
                                                <td><label>Customer ID</label></td>
                                                <td><input name='id' value='<? if(isset($member_search))echo $member_search['id'] ?>' type='text' class='search_input form-control'></td>
                                                <td><label>Cellphone</label></td>
                                                <td><input type='text' value='<? if(isset($member_search))echo $member_search['cellphone'] ?>' name='cellphone' class='search_input form-control'></td>
                                            </tr>
                                            <tr>
                                                <td><label>Name</label></td>
                                                <td><input type='text' value='<? if(isset($member_search))echo $member_search['fullname'] ?>' name='fullname' class='search_input form-control'></td>
                                                <td><label>Address</label></td>
                                                <td><input type='text' value='<? if(isset($member_search))echo $member_search['address'] ?>' name='address' class='search_input form-control'></td>
                                            </tr>
                                            <tr>
                                                <td><label>Email</label></td><td><input type='text' value='<? if(isset($member_search))echo $member_search['account'] ?>' name='account' class='search_input form-control'></td>
                                                <td></td><td>
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
                <!-- /.col-lg-12 -->
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
                                        <th>帳號</th>
                                        <th>姓名</th>
                                        <th>手機</th>
                                        <th>地址</th>
                                        <th>收貨時間</th>
                                        <th>信用卡後4碼</th>
                                        <th>功能</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($member as $member_item): ?>

                                        <tr class="odd gradeX">
                                            <td><?= $member_item['member_account']; ?></td>
                                            <td><?= $member_item['member_name'] ?></td>
                                            <td><?= $member_item['member_phone'] ?></td>
                                            <td><?= $member_item['member_address'] ?></td>
                                            <td><sapn style='display: none'><?=$member_item['member_shipping']?></sapn><?= $member_item['member_receive'] ?></td>
                                            <td><?= $member_item['member_last4'] ?></td>
                                            <td><a class="btn btn-primary"
                                                   href="<?= base_url();?>admin/member/view/<?php echo $member_item['member_hash_id'] ?>">編輯</a>
                                                <button class="btn btn-default" onclick="toggleContent('<?=$member_item['member_hash_id']?>')">服務</button>
                                            </td>
                                        </tr>
                                        <tr class="odd gradeX">
                                            <td colspan="7" >
                                                <table class="table table-bordered" style="<? if($member_item['member_id']!=$operation_member_id){ ?> <?php }?>width: 100%" id="<?=$member_item['member_hash_id']?>">
                                                    <? foreach($member_item['member_service'] AS $unit): ?>
                                                        <tr>
                                                            <th>
                                                                定期宅配項目
                                                            </th>
                                                            <th style="width: 120px">
                                                                上次送貨日
                                                            </th>
                                                            <th style="width: 120px">
                                                                下次送貨日
                                                            </th>
                                                            <th style="width: 120px">
                                                                間隔天數
                                                            </th>
                                                            <th style="width: 120px">
                                                                功能選項
                                                            </th>
                                                        </tr>
                                                    <tr class="<?=$unit['service_status_class']?>">
                                                        <td >
                                                        <?$cart_total=0; foreach($unit['service_cart'] AS $cart): $product = $this->model_product->get_product($cart['cart_product_id']);?>
                                                            <div class="row" style=" padding: 10px ">
                                                                <?
                                                                if(is_file($product['product_image']))$product['product_image'] = "//placehold.it/30";
                                                                ?>
                                                                <div class="col-md-1"><img src="<?=$product['product_image']?>" class="img-thumbnail"></div>
                                                                <div class="col-md-11">
                                                                    <div>
                                                                        <div><?=$product['product_name']?></div>
                                                                    </div>
                                                                    <div>
                                                                        <div>數量：<?=$cart['cart_package_qty']?></div>
                                                                        <div>單價：<?=$cart['cart_package_price']?></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <? $cart_total += $cart['cart_package_qty']*$cart['cart_package_price']; unset($product); endforeach?>
                                                            <div style="text-align: right"><i class="fa fa-shopping-cart"></i> <?=$cart_total?>元</div>
                                                        </td>
                                                        <td style="color:#999999"><?=$unit['service_date_last']?></td>
                                                        <?if( strtotime($unit['service_date_next'])< strtotime("today")){?>
                                                            <td style="color:#999999"><?=$unit['service_date_next']?></td>
                                                        <?}else{?>
                                                            <td><?=$unit['service_date_next']?><br><span>剩餘</span><span style="font-size: 2em"><?=$unit['service_date_left']?></span><span>天</span></td>
                                                        <?}?>
                                                        <td><?=$unit['service_frequency']?></td>
                                                        <td>
                                                            <a class="btn <?if($unit['service_status']==0)echo "btn-danger"; else echo "btn-success";?>"
                                                               onclick="return confirm('請再次確認，是否重新啟動或暫停該筆定期宅配服務。')"
                                                               href="<?= base_url();?>admin/member/suspend/<?= $unit['service_id'] ?>"><?if($unit['service_status']==0)echo "暫停服務"; else echo "重啟服務";?></a>

                                                        </td>
                                                    </tr>
                                                    <? endforeach?>

                                                </table>

                                            </td>
                                        </tr>

                                    <?php endforeach ?>

                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->

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


            $( "#reset" ).click(function() {
                $( '.search_input' ).attr("value",'');
            });
        });

        function toggleContent(id) {
            // Get the DOM reference
            var contentId = document.getElementById(id);
            contentId.style.display == "" ? contentId.style.display = "none" :
                contentId.style.display = "";
        }


    </script>
