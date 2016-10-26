<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Administrator</title>
    <link rel="shortcut icon" href="../../img/B%20LOGO%20BLACK.png">

    <?php
    include_once('../css.html');
    ?>

</head>

<body class="nav-md">
<div class="container body">
    <div class="main_container">
        <?php
        include('navigation.php');
        include_once('../../functions/encryption.php');
        $hashTransactionID = substr($_GET['id'], 0, 32);
        $trnd = substr($_GET['id'], 32, 4);
        $TransactionID = $_GET['tid'];


        $BranchWQ = $BranchCode;
        $invtblname = $BranchWQ . "invtbl";
        $cashtblname = $BranchWQ . "cashtransactiontbl";
        $credittblname = $BranchWQ . "credittransactiontbl";
        $homecredittblname = $BranchWQ . "homecredittransactiontbl";
        $transtblname = $BranchWQ . "transactiontbl";
        $soldtblname = $BranchWQ . "soldunitstbl";
        $receivedtblname = $BranchWQ . "receivedtbl";
        ?>

        <!-- page content -->
        <div class="right_col" role="main">
            <div class="">
                <div class="page-title">
                    <div class="title_left">
                        <h3>Transaction</h3>
                    </div>
                </div>

                <div class="clearfix"></div>

                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Invoice</h2>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <?php
                                if (encrypt_decrypt_rnd('decrypt', $hashTransactionID, $trnd) == $TransactionID) {
                                    $transactionDetails = db_select("
                                    SELECT
                                    $transtblname.ORNumber,
                                    $transtblname._Date,
                                    $transtblname._Time,
                                    $transtblname.CustomerName,
                                    $transtblname.SalesClerk,
                                    $transtblname.Cashier,
                                    $transtblname.ModeOfPayment,
                                    $cashtblname.Amount Cash,
                                    $credittblname.Amount CreditCard,
                                    $credittblname.CreditCardNumber,
                                    $credittblname.CardHolderName,
                                    $credittblname.MID,
                                    $credittblname.BatchNum,
                                    $credittblname.ApprCode,
                                    $credittblname.Term,
                                    $credittblname.IDPresented,
                                    $homecredittblname.Amount HomeCredit,
                                    $homecredittblname.ReferenceNo
                                    FROM $transtblname
                                    LEFT JOIN $cashtblname ON $transtblname.TransactionID = $cashtblname.TransactionID
                                    LEFT JOIN $credittblname ON $transtblname.TransactionID = $credittblname.TransactionID
                                    LEFT JOIN $homecredittblname ON $transtblname.TransactionID = $homecredittblname.TransactionID
                                    WHERE $transtblname.TransactionID = $TransactionID ");

                                    $EmpSC = $transactionDetails[0]['SalesClerk'];
                                    $EmpCS = $transactionDetails[0]['Cashier'];
                                    $getSC = db_select("SELECT `Firstname`, `Lastname` FROM `employeetbl` WHERE `EmpID` = " . db_quote($EmpSC));
                                    $getCS = db_select("SELECT `Firstname`, `Lastname` FROM `employeetbl` WHERE `EmpID` = " . db_quote($EmpCS));
                                    $getBC = db_select("SELECT `BranchName` FROM `branchtbl` WHERE `BranchCode` = " . db_quote($BranchCode));
                                    $ORNumber = $transactionDetails[0]['ORNumber'];
                                    $_Date = $transactionDetails[0]['_Date'];
                                    $_Time = $transactionDetails[0]['_Time'];
                                    $CustomerName = $transactionDetails[0]['CustomerName'];
                                    $Branch = $getBC[0]['BranchName'];
                                    $SalesClerk = $getSC[0]['Firstname'] . " " . $getSC[0]['Lastname'];
                                    $Cashier = $getCS[0]['Firstname'] . " " . $getCS[0]['Lastname'];
                                    $ModeOfPayment = $transactionDetails[0]['ModeOfPayment'];
                                    $Cash = $transactionDetails[0]['Cash'];
                                    $CreditCard = $transactionDetails[0]['CreditCard'];
                                    $CreditCardNumber = $transactionDetails[0]['CreditCardNumber'];
                                    $CardHolderName = $transactionDetails[0]['CardHolderName'];
                                    $MID = $transactionDetails[0]['MID'];
                                    $BatchNum = $transactionDetails[0]['BatchNum'];
                                    $ApprCode = $transactionDetails[0]['ApprCode'];
                                    $Term = $transactionDetails[0]['Term'];
                                    $IDPresented = $transactionDetails[0]['IDPresented'];
                                    $HomeCredit = $transactionDetails[0]['HomeCredit'];
                                    $ReferenceNo = $transactionDetails[0]['ReferenceNo'];

                                    $MOD = "";
                                    if ($ModeOfPayment == "Cash") {
                                        $MOD = "Cash";
                                        $CreditCard = 0;
                                        $HomeCredit = 0;
                                    } elseif ($ModeOfPayment == "Credit Card") {
                                        $MOD = "Credit Card";
                                        $Cash = 0;
                                        $HomeCredit = 0;
                                    } elseif ($ModeOfPayment == "Home Credit") {
                                        $MOD = "Home Credit";
                                        $Cash = 0;
                                        $CreditCard = 0;
                                    } elseif ($ModeOfPayment == "HomeCredit Credit Card") {
                                        $MOD = "Credit Card, Home Credit";
                                        $Cash = 0;
                                    } elseif ($ModeOfPayment == "Cash CreditCard") {
                                        $MOD = "Cash, Credit Card";
                                        $Home = 0;
                                    } elseif ($ModeOfPayment == "Cash Home Credit") {
                                        $MOD = "Cash, Home Credit";
                                        $CreditCard = 0;
                                    } elseif ($ModeOfPayment == "Cash CreditCard Home Credit") {
                                        $MOD = "Cash, Credit Card, Home Credit";
                                    } else {
                                        $MOD = "Error";
                                    }

                                    $TotalAmountPaid = $Cash + $CreditCard + $HomeCredit;
                                    $Cash = number_format($Cash, 2, '.', ',');
                                    $CreditCard = number_format($CreditCard, 2, '.', ',');
                                    $HomeCredit = number_format($HomeCredit, 2, '.', ',');
                                    $TotalAmountPaid = number_format($TotalAmountPaid, 2, '.', ',');

                                } else {
                                    echo '<script type="text/javascript">window.location.href = "addtrans.php";</script>';
                                }
                                ?>
                                <section class="content invoice">
                                    <!-- title row -->
                                    <div class="row">
                                        <div class="col-xs-12 invoice-header">
                                            <label>Transaction # <?= @ str_replace("'", "", $TransactionID); ?></label>
                                            <label class="pull-right">Date: <?= @$_Date ?></label>
                                        </div>
                                        <!-- /.col -->
                                    </div>
                                    <!-- info row -->
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <b>OR # <?= @$ORNumber ?></b>
                                            <br>
                                            <b>Sales Clerk:</b> <?= @$SalesClerk ?>
                                            <br>
                                            <b>Cashier:</b> <?= @$Cashier ?>
                                            <br>
                                            <b>Time purchased:</b> <?= @$_Time ?>
                                            <br>
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-sm-4">
                                            From
                                            <address>
                                                <strong><?= @$BranchCode = str_replace("'", "", $BranchCode); ?></strong>
                                                <br>
                                                <strong><?= @$Branch ?></strong>
                                            </address>
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-sm-4">
                                            To
                                            <address>
                                                <strong><?= @$CustomerName ?></strong>
                                            </address>
                                        </div>
                                        <!-- /.col -->
                                    </div>
                                    <!-- /.row -->

                                    <!-- Table row -->
                                    <div class="row">
                                        <div class="col-xs-12 table">
                                            <table class="table table-striped">
                                                <thead>
                                                <tr>
                                                    <th>Qty</th>
                                                    <th>Item Name</th>
                                                    <th>IMEI / SN / PDC</th>
                                                    <th style="width: 30%">Description</th>
                                                    <th>SRP</th>
                                                    <th>Subtotal</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                $Items = db_select("
                                                SELECT
                                                $soldtblname.ItemColor,
                                                $soldtblname.imeisn,
                                                itemstbl.ModelName,
                                                itemstbl.ItemDescription,
                                                itemstbl.SRP
                                                FROM $soldtblname
                                                LEFT JOIN itemstbl ON $soldtblname.ItemCode = itemstbl.ItemCode
                                                WHERE $soldtblname.TransactionID = $TransactionID");

                                                echo db_error();
                                                foreach ($Items as $item) {
                                                    $ModelName = $item['ModelName'];
                                                    $ItemColor = $item['ItemColor'];
                                                    $ImeiSN = $item['imeisn'];
                                                    $ItemDescription = $item['ItemDescription'];
                                                    $SRP = $item['SRP'];


                                                    $countItem = db_select("SELECT * FROM `invtbl` WHERE `imeisn` = " . db_quote($ImeiSN) . " AND `Status` = 'Sold' AND `BranchCode` = " . db_quote($BranchCode));
                                                    $Qty = count($countItem);

                                                    $Total = $Qty * $SRP;
                                                    $Total = number_format($Total, 2, '.', ',');
                                                    $SRP = number_format($SRP, 2, '.', ',');
                                                    ?>
                                                    <tr>
                                                        <td><?= @$Qty ?></td>
                                                        <td><?= @$ModelName . " (" . $ItemColor . ")" ?></td>
                                                        <td><?= @$ImeiSN ?></td>
                                                        <td><?= @$ItemDescription ?> </td>
                                                        <td>&#x20B1; <?= @$SRP ?></td>
                                                        <td>&#x20B1; <?= @$Total ?></td>
                                                    </tr>
                                                    <?php
                                                }
                                                ?>

                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- /.col -->
                                    </div>
                                    <!-- /.row -->
                                    &nbsp;
                                    <div class="row">
                                        <!-- accepted payments column -->
                                        <div class="col-xs-6">
                                            <h2><b>Payment Method:</b> <?= @$MOD ?></h2>
                                            <?php
                                            if ($MOD == "Credit Card" || $MOD == "Credit Card, Home Credit" || $MOD == "Cash, Credit Card" || $MOD == "Cash, Credit Card, Home Credit") {
                                                ?>
                                                <div id="CreditCardDetails">
                                                    <h4><b>Credit Card Details</b></h4>
                                                    <strong>Cardholder Name:</strong> <?= @$CustomerName ?> <br>
                                                    <strong>Card #:</strong> <?= @$CreditCardNumber ?> <br>
                                                    <strong>MID:</strong> <?= @$MID ?> <br>
                                                    <strong>Batch #:</strong> <?= @$BatchNum ?> <br>
                                                    <strong>Appr Code:</strong> <?= @$ApprCode ?> <br>
                                                    <strong>Terms:</strong> <?= @$Terms ?> <br>
                                                </div>
                                                <br>
                                                <?php
                                            } elseif ($MOD == "Home Credit" || $MOD == "Credit Card, Home Credit" || $MOD == "Cash, Home Credit" || $MOD == "Cash, Credit Card, Home Credit") {
                                                ?>
                                                <div id="HomeCreditDetails">
                                                    <h4><b>Home Credit Details</b></h4>
                                                    <strong>Ref #:</strong> <?= @$HomeCredit ?><br>
                                                </div>
                                                <br>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-xs-6">
                                            <p class="lead">Total Amount Paid</p>
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <tbody>
                                                    <tr>
                                                        <th style="width:50%">Cash:</th>
                                                        <td align="right">&#x20B1; <?= @$Cash ?> </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Credit Card</th>
                                                        <td align="right">&#x20B1; <?= @$CreditCard ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Home Credit:</th>
                                                        <td align="right">&#x20B1; <?= @$HomeCredit ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Total:</th>
                                                        <td align="right">&#x20B1; <?= @$TotalAmountPaid ?></td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <!-- /.col -->
                                    </div>
                                    <!-- /.row -->
                                </section>
                                <a href="addtrans.php" style="float: right" class="btn btn-dark"><i class="fa fa-mail-reply"></i> Back</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
            <div class="pull-right">
                *Insert Footer Here*
            </div>
            <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
    </div>
</div>

<?php
include_once('../js.html');
?>

<script src="js/function.js"></script>
<script>
    new PNotify({
        title: 'Transaction Successful',
        type: 'success',
        styling: 'bootstrap3',
        delay: 5000
    });
</script>
</body>
</html>