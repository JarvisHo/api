<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>PawMaji Admin</title>

    <!-- Bootstrap Core CSS-->
    <link href="<?= base_url();?>dist/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- MetisMenu CSS -->
    <link href="<?= base_url();?>dist/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?= base_url();?>dist/css/sb-admin-2.css" rel="stylesheet">

    <link href="<?= base_url();?>dist/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- hint CSS -->
    <link href="<?= base_url();?>dist/css/hint.css" rel="stylesheet"  type="text/css">
    <!-- datepicker CSS -->
    <link href="<?= base_url();?>dist/css/datepicker3.css" rel="stylesheet"  type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
     <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
     <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?= base_url();?>">PawMaji Admin v2.1</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">

                <li class="dropdown">
                    <a href="<?= base_url();?>admin/dashboard">
                        <i class="fa fa-dashboard fa-fw"></i>Dashboard
                    </a>
                    <!-- /.dropdown-user -->
                </li>
                <li class="dropdown">
                    <a href="<?= base_url();?>admin/dog/food">
                        <i class="fa fa-table fa-fw"></i>Dog Food
                    </a>
                    <!-- /.dropdown-user -->
                </li>
                <li class="dropdown">
                    <a href="<?= base_url();?>admin/order">
                        <i class="fa fa-table fa-fw"></i>Orders
                    </a>
                </li>
                <li class="dropdown">
                    <a href="<?= base_url();?>admin/sales">
                        <i class="fa fa-table fa-fw"></i>Sales
                    </a>
                </li>
                <li class="dropdown">
                    <a href="<?= base_url();?>admin/member">
                        <i class="fa fa-table fa-fw"></i>Members
                    </a>
                </li>
                <li class="dropdown">
                    <a href="<?= base_url();?>admin/prospect">
                        <i class="fa fa-table fa-fw"></i>Prospects
                    </a>
                </li>
                <li class="dropdown">
                    <a href="<?= base_url();?>admin/email">
                        <i class="fa fa-table fa-fw"></i>Email
                    </a>
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> <?=$this->session->userdata('username');?></a>
                        </li>
<!--                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>-->
<!--                        </li>-->
                        <li class="divider"></li>
                        <li><a href="<?= base_url();?>admin/login"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->



