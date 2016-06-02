</nav>
<!-- Page Content -->
<div id="page-wrapper" style="margin-left: 0px">
<!--<div class="row">-->
<!--    <div class="col-lg-12">-->
<!--        <h2>Functions</h2>-->
<!--        <ol class="breadcrumb">-->
<!--            <!-- <li><a href='#'  class='btn btn-primary'>啟動Autoship</a></li>-->
<!--            <li><a href='#'  class='btn btn-primary'>暫停Autoship</a></li> -->
<!--            <li><input type="button" class='btn btn-primary ' disabled="disabled" value="Export CSV"></li>-->
<!--        </ol>-->
<!--    </div>-->
<!--</div>-->
<!-- /.row -->




<div class="row">
    <div class="col-lg-12">
        <h2>Prospect info</h2>
        <?php echo $msg;?>
        <div class="table-responsive" >
            <table class='table table-hover' style='width:85%;'>
                <?php echo validation_errors(); ?>
                <?php echo form_open('admin/prospect/view/'.$member_item['member_hash_id']) ?>
                    <input name='mid' value='' type='hidden'>
                    <tr><th style="width:20%">帳號：</th><td><input name='account' value='<?echo $member_item['member_account'] ?>' type='text' class='form-control' readonly></td></tr>
                    <tr><th style="width:20%">姓名：</th><td><input name='fullname' value='<?echo $member_item['member_name']?>' type='text' class='form-control' ></td></tr>
                    <tr><th style="width:20%">地址：</th><td><input name='address' value='<?echo $member_item['member_address']?>' type='text' class='form-control'></td></tr>
                    <tr><th style="width:20%">電話：</th><td><input name='cellphone' value='<?echo $member_item['member_phone']?>' type='text' class='form-control'></td></tr>
                    <tr><th style="width:20%"><input value="送出修改" type="submit" class="btn btn-primary"> <a href="<?= base_url();?>admin/prospect/" class='btn btn-primary'>返回</a></th>
                        <td></td></tr>
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

        if ( $( "#dataTables-example" ).length ) {
            $('#dataTables-example').DataTable({
                responsive: true
            });
        }

    });
</script>