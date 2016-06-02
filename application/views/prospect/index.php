</nav>
<!-- Page Content -->
    <div id="page-wrapper" style="margin-left: 0px">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Prospect</h1>
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
                                            <?php echo form_open('prospect') ?>

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
                                        <th>加入日期</th>
                                        <th>功能</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($member as $member_item): ?>

                                        <tr class="odd gradeX">
                                            <td><?= $member_item['member_account'];?></td>
                                            <td><?= $member_item['member_name'] ?></td>
                                            <td><?= $member_item['member_stamp'] ?></td>
                                            <td><a class="btn btn-primary"
                                                   href="<?= base_url();?>admin/prospect/view/<?= $member_item['member_hash_id'] ?>">編輯</a>
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

        });

        $( "#reset" ).click(function() {
            $( '.search_input' ).attr("value",'');
        });
    </script>
