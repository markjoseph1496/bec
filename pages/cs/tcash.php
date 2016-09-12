<?php
include('../../connection.php');

$BranchCode = "'B009'";
$Cashier = "'MFC'";
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Transactions</title>

    <!-- Bootstrap Core CSS -->
    <link href="../../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../../dist/css/sb-admin-2.css" rel="stylesheet">

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
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Unit Sales Transaction</h1>
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="row">
                                <div class="col-lg-3 col-xs-8">
                                    <input type="date" class="form-control" value="<?php echo date("Y-m-d"); ?>">
                                </div>
                                <div class="col-lg-3">
                                    <button class="btn btn-primary">View</button>
                                </div>
                            </div>
                            <br>
                            <div class="panel panel-info">
                                <div class="panel-heading">
                                    <span class="fa fa-list-alt"> <?php echo date("F j, Y"); ?></span>
                                    <span style="float:right"><b>Grand Total: 9,998.00</b></span>
                                </div>
                                <div class="panel-body">
                                    <!-- Nav tabs -->
                                    <ul class="nav nav-tabs">
                                        <li class="active"><a href="#home" data-toggle="tab">Cash</a>
                                        </li>
                                        <li><a href="#profile" data-toggle="tab">Credit Card</a>
                                        </li>
                                        <li><a href="#messages" data-toggle="tab">Home Credit</a>
                                        </li>
                                    </ul>

                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                        <div class="tab-pane fade in active" id="home">
                                            <h4>Cash Transactions</h4>
                                            <div class="table-responsive">
                                                <table class="table table-hover">
                                                    <thead>
                                                    <tr>
                                                        <th width="15%">Transaction ID</th>
                                                        <th width="10%">Time</th>
                                                        <th width="10%">OR Number</th>
                                                        <th width="25%">Customer Name</th>
                                                        <th width="15%">Item(s)</th>
                                                        <th width="15%">Amount Tendered</th>
                                                        <th width="10%">Subtotal</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php
                                                    $tblTransaction = db_select("
                                                    SELECT 
                                                    unitsalestransactiontbl.TransactionID,
                                                    unitsalestransactiontbl._Time,
                                                    unitsalestransactiontbl.ORNumber,
                                                    unitsalestransactiontbl.CustomerName,
                                                    unitsalestransactiontbl.Total,
                                                    cashtransactiontbl.Amount
                                                    FROM unitsalestransactiontbl
                                                    INNER JOIN cashtransactiontbl ON unitsalestransactiontbl.ORNumber = cashtransactiontbl.ORNumber
                                                    WHERE unitsalestransactiontbl._Date = " . db_quote(date("Y-m-d")) . " 
                                                    AND unitsalestransactiontbl.BranchCode = " . $BranchCode . " 
                                                    AND unitsalestransactiontbl.Cashier = " . $Cashier . "
                                                    ORDER BY unitsalestransactiontbl.ORNumber ASC");


                                                    foreach ($tblTransaction as $transaction) {
                                                        $TransactionID = $transaction['TransactionID'];
                                                        $_Time = $transaction['_Time'];
                                                        $ORNumber = $transaction['ORNumber'];
                                                        $CustomerName = $transaction['CustomerName'];
                                                        $AmountTendered = $transaction['Amount'];
                                                        $Total = $transaction['Total'];

                                                        $SoldUnitstbl = db_select("
                                                        SELECT
                                                        unitstbl.Model
                                                        FROM soldunits
                                                        INNER JOIN unitstbl ON soldunits.IMEISN = unitstbl.IMEISN
                                                        WHERE soldunits.ORNumber = " . $ORNumber);

                                                        ?>
                                                        <tr>
                                                            <td width="15%" align="center"><?php echo $TransactionID ?></td>
                                                            <td width="10%" align="left"><?php echo $_Time ?></td>
                                                            <td width="10%" align="left"><?php echo $ORNumber ?></td>
                                                            <td width="25%" align="left"><?php echo $CustomerName ?></td>
                                                            <td width="15%" align="left">
                                                                <?php
                                                                foreach ($SoldUnitstbl as $soldunits) {
                                                                    $Model = $soldunits['Model'];
                                                                    echo $Model . "<br>";
                                                                }
                                                                ?>
                                                            </td>
                                                            <td width="15%" align="center"><?php echo $AmountTendered ?></td>
                                                            <td width="10%" align="center"><?php echo $Total ?></td>
                                                        </tr>
                                                        <?php
                                                    }
                                                    ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <!-- /.table-responsive -->
                                        </div>
                                        <div class="tab-pane fade" id="profile">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum
                                                dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                                        </div>
                                        <div class="tab-pane fade" id="messages">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum
                                                dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->
</body>
</html>
