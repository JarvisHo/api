<link rel="stylesheet" href="<?= base_url() ?>dist/pickadate/themes/default.css" xmlns="http://www.w3.org/1999/html">
<link rel="stylesheet" href="<?= base_url() ?>dist/pickadate/themes/default.date.css">
<div id="container"></div><!--pickadate panel-->
</nav>
<div id="page-wrapper" style="margin-left: 0px">

<div class="row">
    <div class="col-lg-12">
        <h2>Single sales order info</h2>
        <div class="table-responsive" >


            <table class='table table-hover' style='width:85%;'>
                <?=validation_errors(); ?>
                <?=form_open('admin/sales/view/'.$order_item['single_id']) ?>
                <tr><th style="width:20%">單號：</th><td><input name='single_id' value='<?echo $order_item['single_id'] ?>' type='text' class='form-control' readonly></td></tr>
                <tr><th style="width:20%">帳號：</th><td><input name='single_email' value='<?echo $order_item['single_email'] ?>' type='text' class='form-control' readonly></td></tr>
                <tr><th style="width:20%">姓名：</th><td><input name='single_name' value='<?echo $order_item['single_name']?>' type='text' class='form-control' ></td></tr>
                <tr><th style="width:20%">地址：</th><td><input name='single_address' value='<?echo $order_item['single_address']?>' type='text' class='form-control'></td></tr>
                <tr><th style="width:20%">電話：</th><td><input name='single_phone' value='<?echo $order_item['single_phone']?>' type='text' class='form-control'></td></tr>
                <tr><th style="width:20%">狀態：</th>
                    <td>
                        <?=$order_item['single_status_select']?>
                    </td>
                </tr>
                <tr><th style="width:20%"><input value="送出修改" type="submit" class="btn btn-primary">
                        <a href="<?= base_url();?>admin/sales/" class='btn btn-primary'>返回</a></th>
                    <td><?=$msg;?></td></tr>
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

<!-- Bootstrap pickadate JavaScript -->
<script src="<?=base_url() ?>dist/pickadate/picker.js"></script>
<script src="<?=base_url() ?>dist/pickadate/picker.date.js"></script>
<script src="<?=base_url() ?>dist/pickadate/legacy.js"></script>

<script>
    $(document).ready(function() {

        $( "select" ).addClass( "form-control " );

        if ( $( "#dataTables-example" ).length ) {
            $('#dataTables-example').DataTable({
                responsive: true
            });
        }

        var $input = $( '.datepicker' ).pickadate({
            format: 'yyyy-mm-dd',
            formatSubmit: 'yyyy-mm-dd',
            min: true,
            max: 121,
            container: '#container',
            // editable: true,
            closeOnSelect: true,
            closeOnClear: false
        });
    });
</script>