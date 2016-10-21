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
                                                <div class="col-md-4">
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
                                                            transactiontbl.TransactionID,
                                                            transactiontbl._Time,
                                                            transactiontbl.ORNumber,
                                                            transactiontbl.CustomerName,
                                                            transactiontbl.SalesClerk,
                                                            transactiontbl.Cashier,
                                                            transactiontbl.Status,
                                                            cashtransactiontbl.Amount Cash,
                                                            credittransactiontbl.Amount CreditCard,
                                                            homecredittransactiontbl.Amount HomeCredit
                                                            FROM transactiontbl
                                                            LEFT JOIN cashtransactiontbl ON transactiontbl.TransactionID = cashtransactiontbl.TransactionID
                                                            LEFT JOIN credittransactiontbl ON transactiontbl.TransactionID = credittransactiontbl.TransactionID
                                                            LEFT JOIN homecredittransactiontbl ON transactiontbl.TransactionID = homecredittransactiontbl.TransactionID
                                                            WHERE transactiontbl._Date = " . db_quote($CurrentDate) . "
                                                            AND transactiontbl.BranchCode = " . db_quote($decryptBranch) . "
                                                            ORDER BY transactiontbl._Time ASC
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