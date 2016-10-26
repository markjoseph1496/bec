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
        $getBranches = db_select("SELECT `BranchCode` FROM `branchtbl` WHERE `AreaID` = " . db_quote($AreaID));

        if (isset($_GET['id'])) {
            $CurrentDate = $_GET['id'];
            $CurrentBranch = substr($_GET['br'], 0, 32);
            $Currentrnd = substr($_GET['br'], 32, 4);
            $decryptBranch = encrypt_decrypt_rnd('decrypt', $CurrentBranch, $Currentrnd);
        } else {
            $CurrentDate = date("Y-m-d");
            $CurrentBranch = "";
            $decryptBranch = $getBranches[0]['BranchCode'];
        }

        $BranchWQ = $decryptBranch;
        $invtblname = $BranchWQ . "invtbl";
        $cashtblname = $BranchWQ . "cashtransactiontbl";
        $credittblname = $BranchWQ . "credittransactiontbl";
        $homecredittblname = $BranchWQ . "homecredittransactiontbl";
        $transtblname = $BranchWQ . "transactiontbl";
        $soldtblname = $BranchWQ . "soldunitstbl";
        $receivedtblname = $BranchWQ . "receivedtbl";

        $TotalCash = 0;
        $TotalCredit = 0;
        $TotalHomeCredit = 0;

        $getCash = db_select("
        SELECT
        $cashtblname.TransactionID,
        $cashtblname.Amount Cash,
        $transtblname.TransactionID
        FROM $cashtblname, $transtblname
        WHERE $cashtblname.TransactionID = $transtblname.TransactionID
        AND $transtblname._Date = " . db_quote($CurrentDate)
        );


        foreach ($getCash as $CashValue) {
            $Cash = $CashValue['Cash'];
            $TotalCash = $TotalCash + $Cash;
        }

        $getCreditCard = db_select("
        SELECT
        $credittblname.TransactionID,
        $credittblname.Amount Credit,
        $transtblname.TransactionID
        FROM $credittblname, $transtblname
        WHERE $credittblname.TransactionID = $transtblname.TransactionID
        AND $transtblname._Date = " . db_quote($CurrentDate));

        foreach ($getCreditCard as $CreditValue) {
            $Credit = $CreditValue['Credit'];
            $TotalCredit = $TotalCredit + $Credit;
        }

        $getHomeCredit = db_select("
        SELECT
        $homecredittblname.TransactionID,
        $homecredittblname.Amount HomeCredit,
        $transtblname.TransactionID
        FROM $homecredittblname, $transtblname
        WHERE $homecredittblname.TransactionID = $transtblname.TransactionID
        AND $transtblname._Date = " . db_quote($CurrentDate)
        );

        foreach ($getHomeCredit as $HomeCreditValue) {
            $HomeCredit = $HomeCreditValue['Credit'];
            $TotalHomeCredit = $TotalHomeCredit + $HomeCredit;
        }

        $getTransactions = db_select("SELECT * FROM $transtblname WHERE `_Date` = " . db_quote($CurrentDate));

        $CountTransactions = count($getTransactions);
        $GrandTotal = $TotalCash + $TotalCredit + $TotalHomeCredit;
        $GrandTotal = number_format($GrandTotal, 2, ".", ",");
        $TotalCash = number_format($TotalCash, 2, ".", ",");
        $TotalCredit = number_format($TotalCredit, 2, ".", ",");
        $TotalHomeCredit = number_format($TotalHomeCredit, 2, ".", ",");
        ?>

        <!-- page content -->
        <div class="right_col" role="main">
            <div class="">
                <div class="page-title">
                    <div class="title_left">
                        <h3>Transactions</h3>
                    </div>
                </div>

                <div class="clearfix"></div>

                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Transaction History</h2>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <div class="col-lg-12">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="row">
                                                <div class="col-md-12 col-lg-4">
                                                    <form id="frmDate" method="GET" autocomplete="off">
                                                        <label for="_Date">Branch</label>
                                                        <select class="form-control" name="br" id="br" onchange="$('#frmDate').submit();">
                                                            <?php
                                                            foreach ($getBranches as $branch) {
                                                                $BranchCode = $branch['BranchCode'];
                                                                $rnd = rand(1000, 9999);
                                                                $hashBranchCode = encrypt_decrypt_rnd('encrypt', $BranchCode, $rnd);
                                                                ?>
                                                                <option value="<?= @ $hashBranchCode . $rnd ?>" <?php if ($BranchCode == $decryptBranch) echo "selected='selected'" ?>><?= @$BranchCode ?></option>
                                                                <?php
                                                            }
                                                            ?>
                                                        </select>
                                                        <br>
                                                        <label for="_Date">Date</label>
                                                        <input type="date" class="form-control" name="id" id="id" value="<?= @$CurrentDate ?>" onchange="$('#frmDate').submit();" onkeydown="return false" required="required">
                                                    </form>
                                                </div>
                                                <div class="col-md-7">
                                                    <h2>Total Transactions: <?= @$CountTransactions ?></h2>
                                                    <h2>Total Cash: <?= @$TotalCash ?></h2>
                                                    <h2>Total Credit Card: <?= @$TotalCredit ?></h2>
                                                    <h2>Total Home Credit: <?= @$TotalHomeCredit ?></h2>
                                                    <h2><b>Grand Total: <?= @$GrandTotal ?></b></h2>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <!-- Panel -->
                                                <div class="panel panel-info">
                                                    <div class="panel-heading">
                                                        <i class="fa fa-table fa-fw"></i> <b><?php echo date("F j, Y", strtotime($CurrentDate)); ?></b>
                                                    </div>
                                                    <!-- /.panel-heading -->
                                                    <div class="panel-body">
                                                        <table id="datatable" class="table table-striped table-bordered">
                                                            <thead>
                                                            <tr>
                                                                <th>Time</th>
                                                                <th>OR / SI / CI</th>
                                                                <th>Customer Name</th>
                                                                <th>Sales Clerk</th>
                                                                <th>Cashier</th>
                                                                <th>Amount Tendered</th>
                                                                <th>Remarks</th>
                                                                <th>View</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php
                                                            $Transactiontbl = db_select("
                                                            SELECT
                                                            $transtblname.TransactionID,
                                                            $transtblname._Time,
                                                            $transtblname.ORNumber,
                                                            $transtblname.CustomerName,
                                                            $transtblname.SalesClerk,
                                                            $transtblname.Cashier,
                                                            $transtblname.Status,
                                                            $cashtblname.Amount Cash,
                                                            $credittblname.Amount CreditCard,
                                                            $homecredittblname.Amount HomeCredit
                                                            FROM $transtblname
                                                            LEFT JOIN $cashtblname ON $transtblname.TransactionID = $cashtblname.TransactionID
                                                            LEFT JOIN $credittblname ON $transtblname.TransactionID = $credittblname.TransactionID
                                                            LEFT JOIN $homecredittblname ON $transtblname.TransactionID = $homecredittblname.TransactionID
                                                            WHERE $transtblname._Date = " . db_quote($CurrentDate) . "
                                                            ORDER BY $transtblname._Time ASC
                                                            ");

                                                            foreach ($Transactiontbl as $Transaction) {
                                                                $TransactionID = $Transaction['TransactionID'];
                                                                $_Time = $Transaction['_Time'];
                                                                $ORNumber = $Transaction['ORNumber'];
                                                                $CustomerName = $Transaction['CustomerName'];
                                                                $SalesClerk = $Transaction['SalesClerk'];
                                                                $Cashier = $Transaction['Cashier'];
                                                                $Cash = $Transaction['Cash'];
                                                                $CreditCard = $Transaction['CreditCard'];
                                                                $HomeCredit = $Transaction['HomeCredit'];
                                                                $Status = $Transaction['Status'];

                                                                $trnd = rand(1000, 9999);
                                                                $hashTID = encrypt_decrypt_rnd('encrypt', $TransactionID, $trnd);

                                                                if ($Status == "Cancelled") {
                                                                    $Status = "Cancelled";
                                                                } else {
                                                                    $Status = "";
                                                                }

                                                                $InitialsSC = db_select("SELECT `Initials` FROM `employeetbl` WHERE `EmpID` = " . db_quote($SalesClerk));
                                                                $InitialsCS = db_select("SELECT `Initials` FROM `employeetbl` WHERE `EmpID` = " . db_quote($Cashier));

                                                                $AmountTendered = $Cash + $CreditCard + $HomeCredit;
                                                                $AmountTendered = number_format($AmountTendered, 2, '.', ',');

                                                                ?>
                                                                <tr>
                                                                    <td><?= @$_Time ?></td>
                                                                    <td><?= @$ORNumber ?></td>
                                                                    <td><?= @$CustomerName ?></td>
                                                                    <td><?= @$InitialsSC[0]['Initials']; ?></td>
                                                                    <td><?= @$InitialsCS[0]['Initials']; ?></td>
                                                                    <td align="right">&#x20B1; <?= @$AmountTendered ?></td>
                                                                    <td><?= @$Status ?></td>
                                                                    <td>
                                                                        <button class="btn btn-dark" onclick="TransactionDetails(this.value, '<?= @$hashTID ?>', '<?= @$trnd ?>','<?= @$CurrentBranch . $Currentrnd ?>');" value="<?= @$TransactionID ?>"><i class="fa fa-eye"></i></button>
                                                                    </td>
                                                                </tr>
                                                                <?php

                                                            }
                                                            ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <!-- /.panel-body -->
                                                </div>
                                                <!-- End Panel -->
                                            </div>
                                        </div>
                                        <!-- Transaction Details Modal -->
                                        <div class="modal fade" id="TDetails">

                                        </div>
                                        <!-- /.modal -->
                                    </div>
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
</div>

<?php
include_once('../js.html');
?>

<script src="js/function.js"></script>

<?php
if (isset($_GET['error'])) {
    echo "<script type='text/javascript'>
         new PNotify({
         title: 'Error :(',
         text: 'There was an error, Please try again.',
         type: 'error',
         styling: 'bootstrap3',
         delay:3000
         });
         </script>";
} elseif (isset($_GET['success'])) {
    echo "<script type='text/javascript'>
         new PNotify({
         title: 'Success',
         text: 'Purchase Request Updated',
         type: 'success',
         styling: 'bootstrap3',
         delay:3000
         });
         </script>";
}
?>

<!-- Datatables -->
<script>
    $(document).ready(function () {
        var handleDataTableButtons = function () {
            if ($("#datatable-buttons").length) {
                $("#datatable-buttons").DataTable({
                    dom: "Bfrtip",
                    buttons: [
                        {
                            extend: "copy",
                            className: "btn-sm"
                        },
                        {
                            extend: "csv",
                            className: "btn-sm"
                        },
                        {
                            extend: "excel",
                            className: "btn-sm"
                        },
                        {
                            extend: "pdfHtml5",
                            className: "btn-sm"
                        },
                        {
                            extend: "print",
                            className: "btn-sm"
                        }
                    ],
                    responsive: true
                });
            }
        };

        TableManageButtons = function () {
            "use strict";
            return {
                init: function () {
                    handleDataTableButtons();
                }
            };
        }();

        $('#datatable').dataTable();

        $('#datatable-keytable').DataTable({
            keys: true
        });

        $('#datatable-responsive').DataTable();

        $('#datatable-scroller').DataTable({
            ajax: "js/datatables/json/scroller-demo.json",
            deferRender: true,
            scrollY: 380,
            scrollCollapse: true,
            scroller: true
        });

        $('#datatable-fixed-header').DataTable({
            fixedHeader: true
        });

        var $datatable = $('#datatable-checkbox');

        $datatable.dataTable({
            'order': [[1, 'asc']],
            'columnDefs': [
                {orderable: false, targets: [0]}
            ]
        });
        $datatable.on('draw.dt', function () {
            $('input').iCheck({
                checkboxClass: 'icheckbox_flat-green'
            });
        });

        TableManageButtons.init();
    });
</script>
<!-- /Datatables -->
</body>
</html>