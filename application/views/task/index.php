</nav>
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
<!-- Page Content -->
<div id="page-wrapper" style="margin-left: 0px">

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Email Article <a href="<?= base_url() ?>admin/email/create" style="margin-bottom: 6px"
                                               class="btn btn-primary btn-circle"><i
                        class="glyphicon glyphicon-plus"></i></a></h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    電子郵件模板列表
                </div>
                <!-- .panel-heading -->
                <div class="panel-body">
                    <div class="panel-group" id="accordion">
                        <!--panel unit-->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#" aria-expanded="true" class=""></a>
                                </h4>
                            </div>
                            <div id="" >
                                <div class="panel-body">
                                    <!-- data table -->
                                    <div class="dataTable_wrapper">
                                        <table class="table table-striped table-bordered table-hover" id="dataTables-">
                                            <thead>
                                            <tr>
                                                <th>類別</th>
                                                <th>標題</th>
                                                <th>狀態</th>
                                                <th style="width:120px;">功能</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php if(isset($article)){ foreach ($article as $unit): ?>
                                                <tr class="odd gradeX">
                                                    <td><?= $category[$unit['article_task_category']]?></td>
                                                    <td><?= $unit['article_title'] ?></td>
                                                    <td><?= $status[$unit['article_status']] ?></td>
                                                    <td>
                                                        <a href="<?php echo base_url(); ?>admin/email/update/<?= $unit['article_hash_id'] ?>"
                                                           class="btn btn-primary btn-circle"><i class="fa fa-edit"></i></a>
                                                    </td>
                                                </tr>
                                            <?php  endforeach; } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- data table -->
                                </div>
                            </div>
                        </div>

                     <!--panel unit-->

                    </div>
                </div>
                <!-- .panel-body -->
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
<script src="<?php echo base_url(); ?>dist/bower_components/jquery/dist/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="<?php echo base_url(); ?>dist/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="<?php echo base_url(); ?>dist/bower_components/metisMenu/dist/metisMenu.min.js"></script>

<!-- Custom Theme JavaScript -->
<script src="<?php echo base_url(); ?>dist/js/sb-admin-2.js"></script>

<!-- DataTables JavaScript -->
<script src="<?php echo base_url(); ?>dist/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>

<script src="<?php echo base_url(); ?>dist/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>

<!-- Bootstrap datepicker JavaScript -->
<script src="<?php echo base_url(); ?>dist/js/bootstrap-datepicker.js"></script>


<script>
    $(document).ready(function () {


    });
</script>