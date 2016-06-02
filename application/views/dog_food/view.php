<!-- Page Content -->
<div id="page-wrapper" style="margin-left: 0px">

<div class="row">
    <div class="col-lg-12">
        <h2>Order info</h2>
        <div class="table-responsive" >

            <table class='table table-hover' style='width:85%;'>
                <?php echo validation_errors(); ?>
                <?php echo form_open('order/view/'.$order_item['ID']) ?>
                <tr><th style="width:20%">單號：</th><td><input name='ID' value='<?echo $order_item['ID'] ?>' type='text' class='form-control' readonly></td></tr>
                <tr><th style="width:20%">帳號：</th><td><input name='ACCOUNT' value='<?echo $order_item['ACCOUNT'] ?>' type='text' class='form-control' readonly></td></tr>
                <tr><th style="width:20%">姓名：</th><td><input name='FULLNAME' value='<?echo $order_item['FULLNAME']?>' type='text' class='form-control' ></td></tr>
                <tr><th style="width:20%">地址：</th><td><input name='ADDRESS' value='<?echo $order_item['ADDRESS']?>' type='text' class='form-control'></td></tr>
                <tr><th style="width:20%">電話：</th><td><input name='CELLPHONE' value='<?echo $order_item['CELLPHONE']?>' type='text' class='form-control'></td></tr>
                <tr><th style="width:20%">總價：</th><td><input name='AMOUNT' value='<?echo $order_item['AMOUNT']?>' type='text' class='form-control'></td></tr>
                <tr><th style="width:20%">狀態：</th>
                    <td>
                        <?echo $order_item['STATUS_SELECT']?>
                    </td>
                </tr>
                <tr><th style="width:20%"><input value="送出修改" type="submit" class="btn btn-primary"> <a href="<?= base_url();?>order/" class='btn btn-primary'>返回</a></th>
                    <td><?php echo $msg;?></td></tr>
                </form>
            </table>
        </div>
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

        $( "select" ).addClass( "form-control " );
        if ( $( "#dataTables-example" ).length ) {
            $('#dataTables-example').DataTable({
                responsive: true
            });
        }
    });
</script>