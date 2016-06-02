</nav>
<!-- Page Content -->
<div id="page-wrapper" style="margin-left: 0px">
<div class="row">
    <div class="col-lg-12">
        <h2>Member info</h2>
        <div class="table-responsive" >
            <?=$msg;?>
            <table class='table table-hover' style='width:85%;'>
                <?php echo validation_errors(); ?>
                <?php echo form_open('admin/member/view/'.$member_item['member_hash_id']) ?>
                    <input name='member_id' value='<?echo $member_item['member_id'] ?>' type='hidden'>
                    <tr><th style="width:20%">帳號：</th><td><input name='account' value='<?echo $member_item['member_account'] ?>' type='text' class='form-control' readonly></td></tr>
                    <tr><th style="width:20%">姓名：</th><td><input name='fullname' value='<?echo $member_item['member_name']?>' type='text' class='form-control' ></td></tr>
                    <tr><th style="width:20%">地址：</th><td><input name='address' value='<?echo $member_item['member_address']?>' type='text' class='form-control'></td></tr>
                    <tr><th style="width:20%">電話：</th><td><input name='cellphone' value='<?echo $member_item['member_phone']?>' type='text' class='form-control'></td></tr>
                    <tr><th style="width:20%">收貨時間：</th><td>
                            <input required="required" type="radio" name="receiveTime" value="2" <?if($member_item['member_shipping']==2)echo "checked='checked'"?>> 上午
                            <input required="required" type="radio" name="receiveTime" value="1" <?if($member_item['member_shipping']==1)echo "checked='checked'"?>> 下午
                            <input required="required" type="radio" name="receiveTime" value="0" <?if($member_item['member_shipping']==0)echo "checked='checked'"?>> 晚上
                        </td></tr>
                    <tr><th style="width:20%"><input value="送出修改" type="submit" class="btn btn-primary">
                            <a href="<?= base_url();?>admin/member" class='btn btn-primary'>返回</a></th>
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
                responsive: true
            });
        }

        $("#left_navigation").css("display","none");
        $("#page-wrapper").css("margin","0 0 0 0px");
    });
</script>