<?php
include_once('../../functions/encryption.php');
if (isset($_GET['id'])) {
    $CurrentDate = $_GET['id'];
} else {
    $CurrentDate = date("Y-m-d");
}
?>
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

    <link rel="import" href="../css.html">

</head>

<body class="nav-md">
<div class="container body">
    <div class="main_container">
        <?php
        include('navigation.php');
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
                                                        <label for="_Date">Select Date</label>
                                                        <input type="date" class="form-control" name="id" id="id" value="<?= @$CurrentDate ?>" onchange="$('#frmDate').submit();">
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
                                                            AND transactiontbl.BranchCode = " . db_quote($BranchCode) . "
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
                                                                    <td align="right"><?= @$AmountTendered ?></td>
                                                                    <td><?= @$Status ?></td>
                                                                    <td><a data-toggle="modal" data-target="#TDetails" class="btn btn-success" onclick=""><i class="glyphicon glyphicon-eye-open"></i></a></td>
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
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header modal-header-dark">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                        <h4 class="modal-title"><i class="fa fa-globe"></i> Invoice</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <section class="content invoice">
                                                            <!-- title row -->
                                                            <div class="row">
                                                                <div class="col-xs-12 invoice-header">
                                                                    <h2>
                                                                        Transaction ID: B1071018-0001
                                                                        <div class="pull-right">Date: 16/08/2016</div>
                                                                    </h2>
                                                                </div>
                                                                <!-- /.col -->
                                                            </div>
                                                            <!-- info row -->
                                                            <div class="row invoice-info">
                                                                <div class="col-sm-4 invoice-col">
                                                                    From
                                                                    <address>
                                                                        <strong>Iron Admin, Inc.</strong>
                                                                        <br>795 Freedom Ave, Suite 600
                                                                        <br>New York, CA 94107
                                                                        <br>Phone: 1 (804) 123-9876
                                                                        <br>Email: ironadmin.com
                                                                    </address>
                                                                </div>
                                                                <!-- /.col -->
                                                                <div class="col-sm-4 invoice-col">
                                                                    To
                                                                    <address>
                                                                        <strong>John Doe</strong>
                                                                        <br>795 Freedom Ave, Suite 600
                                                                        <br>New York, CA 94107
                                                                        <br>Phone: 1 (804) 123-9876
                                                                        <br>Email: jon@ironadmin.com
                                                                    </address>
                                                                </div>
                                                                <!-- /.col -->
                                                                <div class="col-sm-4 invoice-col">
                                                                    <b>Invoice #007612</b>
                                                                    <br>
                                                                    <br>
                                                                    <b>Order ID:</b> 4F3S8J
                                                                    <br>
                                                                    <b>Payment Due:</b> 2/22/2014
                                                                    <br>
                                                                    <b>Account:</b> 968-34567
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
                                                                            <th>Product</th>
                                                                            <th>Serial #</th>
                                                                            <th style="width: 59%">Description</th>
                                                                            <th>Subtotal</th>
                                                                        </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                        <tr>
                                                                            <td>1</td>
                                                                            <td>Call of Duty</td>
                                                                            <td>455-981-221</td>
                                                                            <td>El snort testosterone trophy driving gloves handsome gerry Richardson helvetica tousled street art master testosterone trophy driving gloves handsome gerry Richardson
                                                                            </td>
                                                                            <td>$64.50</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>1</td>
                                                                            <td>Need for Speed IV</td>
                                                                            <td>247-925-726</td>
                                                                            <td>Wes Anderson umami biodiesel</td>
                                                                            <td>$50.00</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>1</td>
                                                                            <td>Monsters DVD</td>
                                                                            <td>735-845-642</td>
                                                                            <td>Terry Richardson helvetica tousled street art master, El snort testosterone trophy driving gloves handsome letterpress erry Richardson helvetica tousled</td>
                                                                            <td>$10.70</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>1</td>
                                                                            <td>Grown Ups Blue Ray</td>
                                                                            <td>422-568-642</td>
                                                                            <td>Tousled lomo letterpress erry Richardson helvetica tousled street art master helvetica tousled street art master, El snort testosterone</td>
                                                                            <td>$25.99</td>
                                                                        </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                                <!-- /.col -->
                                                            </div>
                                                            <!-- /.row -->

                                                            <div class="row">
                                                                <!-- accepted payments column -->
                                                                <div class="col-xs-6">
                                                                    <p class="lead">Payment Methods:</p>
                                                                    <img src="images/visa.png" alt="Visa">
                                                                    <img src="images/mastercard.png" alt="Mastercard">
                                                                    <img src="images/american-express.png" alt="American Express">
                                                                    <img src="images/paypal.png" alt="Paypal">
                                                                    <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                                                                        Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem plugg dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
                                                                    </p>
                                                                </div>
                                                                <!-- /.col -->
                                                                <div class="col-xs-6">
                                                                    <p class="lead">Amount Due 2/22/2014</p>
                                                                    <div class="table-responsive">
                                                                        <table class="table">
                                                                            <tbody>
                                                                            <tr>
                                                                                <th style="width:50%">Subtotal:</th>
                                                                                <td>$250.30</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>Tax (9.3%)</th>
                                                                                <td>$10.34</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>Shipping:</th>
                                                                                <td>$5.80</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>Total:</th>
                                                                                <td>$265.24</td>
                                                                            </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                                <!-- /.col -->
                                                            </div>
                                                            <!-- /.row -->

                                                            <!-- this row will not appear when printing -->
                                                            <div class="row no-print">
                                                                <div class="col-xs-12">
                                                                    <button class="btn btn-default" onclick="window.print();"><i class="fa fa-print"></i> Print</button>
                                                                    <button class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Submit Payment</button>
                                                                    <button class="btn btn-primary pull-right" style="margin-right: 5px;"><i class="fa fa-download"></i> Generate PDF</button>
                                                                </div>
                                                            </div>
                                                        </section>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-dark" data-dismiss="modal">Review items</button>
                                                        <button type="submit" class="btn btn-danger">Save</button>
                                                    </div>
                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
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

<link rel="import" href="../js.html">
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