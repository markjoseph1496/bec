<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Dashboard</title>

    <!-- Bootstrap Core CSS -->
    <link href="../../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="../../vendor/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- jQuery -->
    <script src="../../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="../../vendor/raphael/raphael.min.js"></script>
    <script src="../../vendor/morrisjs/morris.min.js"></script>
    <script src="../../data/morris-data.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../../dist/js/sb-admin-2.js"></script>

</head>

<body>

<div id="wrapper">

    <?php
    include('navigation.html');
    ?>
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Sales Report</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <i class="fa fa-bar-chart-o fa-fw"></i> Running Sales Month of August
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div id="morris-area-chart"></div>
                    </div>
                    <!-- /.panel-body -->
                </div>

                <!-- /.panel -->
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <i class="fa fa-bar-chart-o fa-fw"></i> Daily Staff Performance
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="col-lg-3">
                            <input type="date" class="form-control" value="<?php echo date("Y-m-d"); ?>">
                        </div>
                        <div class="col-md-1">
                            <button type="button" class="btn btn-primary">View</button>
                        </div>
                        <div class="row">
                            <!-- /.col-lg-4 (nested) -->
                            <div class="col-lg-12">
                                <div id="morris-bar-chart"></div>
                            </div>
                            <!-- /.col-lg-8 (nested) -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.panel-body -->
                </div>

                <div class="panel panel-green">
                    <div class="panel-heading">
                        <i class="fa fa-book"></i> Inventory as of <?php echo date("F j, Y"); ?>
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th width="30%">Brand</th>
                                    <th width="40%">Unit/Model</th>
                                    <th width="30%">Stocks on hand</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>Cherry Mobile</td>
                                    <td>Flare S4 Lite</td>
                                    <td>300</td>
                                </tr>
                                <tr>
                                    <td>Cherry Mobile</td>
                                    <td>Flare S3 Lite</td>
                                    <td>367</td>
                                </tr>
                                <tr>
                                    <td>Cherry Mobile</td>
                                    <td>Flare S2 Lite</td>
                                    <td>256</td>
                                </tr>
                                <tr>
                                    <td>Cherry Mobile</td>
                                    <td>MAIA Smart tab</td>
                                    <td>369</td>
                                </tr>
                                <tr>
                                    <td>Cherry Mobile</td>
                                    <td>Mark</td>
                                    <td>482</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.table-responsive -->
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.col-lg-4 -->


                <div class="panel panel-green">
                    <div class="panel-heading">
                        <i class="fa fa-bar-chart-o fa-fw"></i> Fast Moving Units
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">

                    </div>
                    <!-- /.panel-body -->
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
</body>
</html>
