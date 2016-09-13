<?php
include('../../connection.php');

$BranchCode = "'B009'";
$Cashier = "'MFC'";
$_Date = db_quote(date("Y-m-d"));

$qryGrandTotal = db_select("SELECT `Total` FROM `unitsalestransactiontbl` WHERE _Date =" . $_Date . "AND `BranchCode` = " . $BranchCode);
$GrandTotal = 0;
foreach ($qryGrandTotal as $GT) {
    $Amount = $GT['Total'];
    $Amount = str_replace(',', '', $Amount);
    $GrandTotal = $Amount + $GrandTotal;
}
$GrandTotal = number_format($GrandTotal, 2, '.', ',');
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
                                    <span style="float:right"><b>Grand Total: <?php echo $GrandTotal; ?></b></span>
                                </div>
                                <div class="panel-body">
                                    <!-- Nav tabs -->
                                    <ul class="nav nav-tabs">
                                        <li class="active">
                                            <a href="#CashTransactions" data-toggle="tab">Cash</a>
                                        </li>
                                        <li>
                                            <a href="#CreditCardTransactions" data-toggle="tab">Credit Card</a>
                                        </li>
                                        <li>
                                            <a href="#HomeCreditTransactions" data-toggle="tab">Home Credit</a>
                                        </li>
                                        <li>
                                            <a href="#Summary" data-toggle="tab">Summary</a>
                                        </li>
                                    </ul>

                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                        <!-- Cash Transactions -->
                                        <div class="tab-pane fade in active" id="CashTransactions">
                                            <h4>Cash Transactions</h4>
                                            <div class="table-responsive">
                                                <table class="table table-hover">
                                                    <thead>
                                                    <tr>
                                                        <th>Transaction ID</th>
                                                        <th>Time</th>
                                                        <th>OR Number</th>
                                                        <th>Customer Name</th>
                                                        <th>Item(s)</th>
                                                        <th>Sales Clerk</th>
                                                        <th>Amount Tendered</th>
                                                        <th>Subtotal</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php
                                                    $tblCashTransaction = db_select("
                                                    SELECT 
                                                    unitsalestransactiontbl.TransactionID,
                                                    unitsalestransactiontbl._Time,
                                                    unitsalestransactiontbl.ORNumber,
                                                    unitsalestransactiontbl.CustomerName,
                                                    unitsalestransactiontbl.Total,
                                                    unitsalestransactiontbl.SalesClerk,
                                                    cashtransactiontbl.Amount
                                                    FROM unitsalestransactiontbl
                                                    INNER JOIN cashtransactiontbl ON unitsalestransactiontbl.ORNumber = cashtransactiontbl.ORNumber
                                                    WHERE unitsalestransactiontbl._Date = " . $_Date . " 
                                                    AND unitsalestransactiontbl.BranchCode = " . $BranchCode . " 
                                                    AND unitsalestransactiontbl.Cashier = " . $Cashier . "
                                                    ORDER BY unitsalestransactiontbl.ORNumber ASC");


                                                    foreach ($tblCashTransaction as $transaction) {
                                                        $TransactionID = $transaction['TransactionID'];
                                                        $_Time = $transaction['_Time'];
                                                        $ORNumber = $transaction['ORNumber'];
                                                        $CustomerName = $transaction['CustomerName'];
                                                        $AmountTendered = $transaction['Amount'];
                                                        $Total = $transaction['Total'];
                                                        $SalesClerk = $transaction['SalesClerk'];

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
                                                            <td width="10%" align="center"><?php echo $SalesClerk ?></td>
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
                                        <!-- End of Cash Transactions -->

                                        <!-- Credit Card Transactions -->
                                        <div class="tab-pane fade" id="CreditCardTransactions">
                                            <h4>Credit Card Transactions</h4>
                                            <div class="table-responsive">
                                                <table class="table table-hover">
                                                    <thead>
                                                    <tr>
                                                        <th width="15%">Transaction ID</th>
                                                        <th width="10%">Time</th>
                                                        <th width="15%">OR Number</th>
                                                        <th width="20%">Customer Name</th>
                                                        <th width="10%">Card Number</th>
                                                        <th width="10%">Terms</th>
                                                        <th width="10%">Item(s)</th>
                                                        <th width="10%">Sales Clerk</th>
                                                        <th width="10%">Amount Tendered</th>
                                                        <th width="10%">Subtotal</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php
                                                    $tblCreditCardTransaction = db_select("
                                                    SELECT 
                                                    unitsalestransactiontbl.TransactionID,
                                                    unitsalestransactiontbl._Time,
                                                    unitsalestransactiontbl.ORNumber,
                                                    unitsalestransactiontbl.CustomerName,
                                                    unitsalestransactiontbl.Total,
                                                    unitsalestransactiontbl.SalesClerk,
                                                    creditcardtransactiontbl.CreditCardNumber,
                                                    creditcardtransactiontbl.CardHolderName,
                                                    creditcardtransactiontbl.Term,
                                                    creditcardtransactiontbl.Amount
                                                    FROM unitsalestransactiontbl
                                                    INNER JOIN creditcardtransactiontbl ON unitsalestransactiontbl.ORNumber = creditcardtransactiontbl.ORNumber
                                                    WHERE unitsalestransactiontbl._Date = " . $_Date . " 
                                                    AND unitsalestransactiontbl.BranchCode = " . $BranchCode . " 
                                                    AND unitsalestransactiontbl.Cashier = " . $Cashier . "
                                                    ORDER BY unitsalestransactiontbl.ORNumber ASC");


                                                    if ($tblCreditCardTransaction === false) {
                                                        echo db_error();
                                                    }

                                                    foreach ($tblCreditCardTransaction as $transaction) {
                                                        $TransactionID = $transaction['TransactionID'];
                                                        $_Time = $transaction['_Time'];
                                                        $ORNumber = $transaction['ORNumber'];
                                                        $CustomerName = $transaction['CustomerName'];
                                                        $CardNumber = $transaction['CreditCardNumber'];
                                                        $Terms = $transaction['Term'];
                                                        $AmountTendered = $transaction['Amount'];
                                                        $Total = $transaction['Total'];
                                                        $SalesClerk = $transaction['SalesClerk'];

                                                        $SoldUnitstbl = db_select("
                                                        SELECT
                                                        unitstbl.Model
                                                        FROM soldunits
                                                        INNER JOIN unitstbl ON soldunits.IMEISN = unitstbl.IMEISN
                                                        WHERE soldunits.ORNumber = " . $ORNumber);

                                                        ?>
                                                        <tr>
                                                            <td align="center"><?php echo $TransactionID ?></td>
                                                            <td><?php echo $_Time ?></td>
                                                            <td><?php echo $ORNumber ?></td>
                                                            <td><?php echo $CustomerName ?></td>
                                                            <td><?php echo $CardNumber ?></td>
                                                            <td><?php echo $Terms ?></td>
                                                            <td>
                                                                <?php
                                                                foreach ($SoldUnitstbl as $soldunits) {
                                                                    $Model = $soldunits['Model'];
                                                                    echo $Model . "<br>";
                                                                }
                                                                ?>
                                                            </td>
                                                            <td><?php echo $SalesClerk ?></td>
                                                            <td><?php echo $AmountTendered ?></td>
                                                            <td><?php echo $Total ?></td>
                                                        </tr>
                                                        <?php
                                                    }
                                                    ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <!-- /.table-responsive -->
                                        </div>
                                        <!-- End of Credit Card transactions -->

                                        <!-- Home Credit Transactions -->
                                        <div class="tab-pane fade" id="HomeCreditTransactions">
                                            <h4>Home Credit Transactions</h4>
                                            <div class="table-responsive">
                                                <table class="table table-hover">
                                                    <thead>
                                                    <tr>
                                                        <th>Transaction ID</th>
                                                        <th>Time</th>
                                                        <th>OR Number</th>
                                                        <th>Customer Name</th>
                                                        <th>Item(s)</th>
                                                        <th>Sales Clerk</th>
                                                        <th>Amount Tendered</th>
                                                        <th>Subtotal</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php
                                                    $tblHomeCreditTransaction = db_select("
                                                    SELECT 
                                                    unitsalestransactiontbl.TransactionID,
                                                    unitsalestransactiontbl._Time,
                                                    unitsalestransactiontbl.ORNumber,
                                                    unitsalestransactiontbl.CustomerName,
                                                    unitsalestransactiontbl.Total,
                                                    unitsalestransactiontbl.SalesClerk,
                                                    homecredittransactiontbl.Amount
                                                    FROM unitsalestransactiontbl
                                                    INNER JOIN homecredittransactiontbl ON unitsalestransactiontbl.ORNumber = homecredittransactiontbl.ORNumber
                                                    WHERE unitsalestransactiontbl._Date = " . $_Date . " 
                                                    AND unitsalestransactiontbl.BranchCode = " . $BranchCode . " 
                                                    AND unitsalestransactiontbl.Cashier = " . $Cashier . "
                                                    ORDER BY unitsalestransactiontbl.ORNumber ASC");

                                                    if($tblHomeCreditTransaction === false) {
                                                        echo db_error();
                                                    }


                                                    foreach ($tblHomeCreditTransaction as $transaction) {
                                                        $TransactionID = $transaction['TransactionID'];
                                                        $_Time = $transaction['_Time'];
                                                        $ORNumber = $transaction['ORNumber'];
                                                        $CustomerName = $transaction['CustomerName'];
                                                        $AmountTendered = $transaction['Amount'];
                                                        $Total = $transaction['Total'];
                                                        $SalesClerk = $transaction['SalesClerk'];

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
                                                            <td width="10%" align="center"><?php echo $SalesClerk ?></td>
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
                                        <!-- End of Home Credit Transactions -->

                                        <!-- Summary -->
                                        <div class="tab-pane fade" id="Summary">
                                            <h4>Summary</h4>
                                            <div class="table-responsive">
                                                <table class="table table-hover">
                                                    <thead>
                                                    <tr>
                                                        <th>Transaction ID</th>
                                                        <th>OR / SI / CI</th>
                                                        <th>Cash</th>
                                                        <th>Credit Card</th>
                                                        <th>Home Credit</th>
                                                        <th>Total Amount Paid</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php
                                                    $summarytbl = db_select("
                                                    SELECT
                                                    unitsalestransactiontbl.TransactionID,
                                                    unitsalestransactiontbl.ORNumber,
                                                    unitsalestransactiontbl.Total,
                                                    cashtransactiontbl.Amount AS CAmount,
                                                    creditcardtransactiontbl.Amount as CCAmount,
                                                    homecredittransactiontbl.Amount as HCAmount
                                                    FROM unitsalestransactiontbl
                                                    LEFT JOIN cashtransactiontbl ON unitsalestransactiontbl.ORNumber = cashtransactiontbl.ORNumber
                                                    LEFT JOIN homecredittransactiontbl ON unitsalestransactiontbl.ORNumber = homecredittransactiontbl.ORNumber
                                                    LEFT JOIN creditcardtransactiontbl ON unitsalestransactiontbl.ORNumber = creditcardtransactiontbl.ORNumber
                                                    
                                                    WHERE unitsalestransactiontbl._Date = ". $_Date ."
                                                    AND unitsalestransactiontbl.Cashier = ". $Cashier ."
                                                    AND unitsalestransactiontbl.BranchCode = " . $BranchCode
                                                    );

                                                    if($summarytbl === false){
                                                        echo db_error();
                                                    }

                                                    foreach($summarytbl as $summary){
                                                        $TransactionID = $summary['TransactionID'];
                                                        $ORNumber = $summary['ORNumber'];
                                                        $Cash = $summary['CAmount'];
                                                        $CreditCard = $summary['CCAmount'];
                                                        $HomeCredit = $summary['HCAmount'];
                                                        $Total = $summary['Total'];

                                                        $Cash = str_replace(',', '', $Cash);
                                                        $CreditCard = str_replace(',', '', $CreditCard);
                                                        $HomeCredit = str_replace(',', '', $HomeCredit);
                                                        $Total = str_replace(',', '', $Total);

                                                        $Cash = (float)$Cash;
                                                        $CreditCard = (float)$CreditCard;
                                                        $HomeCredit = (float)$HomeCredit;

                                                        $Cash = number_format($Cash,2,'.',',');
                                                        $CreditCard = number_format($CreditCard,2,'.',',');
                                                        $HomeCredit = number_format($HomeCredit,2,'.',',');

                                                        $Total = number_format($Total,2,'.',',');



                                                        if($Cash == null){
                                                            $Cash = "0.00";
                                                        }
                                                        if($CreditCard == null){
                                                            $CreditCard = "0.00";
                                                        }
                                                        if($HomeCredit == null){
                                                            $HomeCredit = "0.00";
                                                        }


                                                        ?>
                                                        <tr>
                                                            <td align="center"><?php echo $TransactionID; ?></td>
                                                            <td><?php echo $ORNumber; ?></td>
                                                            <td><?php echo $Cash; ?></td>
                                                            <td><?php echo $CreditCard; ?></td>
                                                            <td><?php echo $HomeCredit; ?></td>
                                                            <td><?php echo $Total; ?></td>
                                                        </tr>
                                                    <?php
                                                    }
                                                    ?>

                                                    </tbody>
                                                </table>
                                            </div>
                                            <!-- /.table-responsive -->
                                        </div>
                                        <!-- End of Cash Transactions -->
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
