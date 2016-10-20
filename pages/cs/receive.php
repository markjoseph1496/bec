<?php
include('../../functions/encryption.php');
$hashItemCode = substr($_GET['id'], 0, 32);
$ItemCode = $_GET['itemcode'];
$hashPRNumber = substr($_GET['pid'], 0, 32);
$PRNumber = $_GET['prnumber'];
$Itemrnd = substr($_GET['id'], 32, 4);
$Color = substr($_GET['id'], 36, 30);
$random = $Itemrnd . $Color;
$prnd = substr($_GET['pid'], 32, 36);


if (encrypt_decrypt_rnd('decrypt', $hashItemCode, $random) != $ItemCode) {
    header('location: receiving.php?error');
}
if (encrypt_decrypt_rnd('decrypt', $hashPRNumber, $prnd) != $PRNumber) {
    header('location: receiving.php?error');
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

    <title>Purchase Request</title>
    <link rel="shortcut icon" href="../../img/B%20LOGO%20BLACK.png">

    <link rel="import" href="../css.html">

</head>

<body class="nav-md" onload="$('#ImeiSN').focus();">
<div class="container body">
    <div class="main_container">
        <?php
        include('navigation.php');

        $getModifyCode = db_select("SELECT `ModifyCode` FROM `purchaserequeststbl` WHERE `PONumber` = " . db_quote(encrypt_decrypt_rnd('decrypt', $hashPRNumber, $prnd)));
        $ModifyCode = $getModifyCode [0]['ModifyCode'];

        $getItemDetails = db_select("SELECT 
        itemstbl.ModelName, 
        brandtbl.Brand
        FROM itemstbl
        LEFT JOIN brandtbl ON itemstbl.BrandID = brandtbl.BrandID
        WHERE itemstbl.ItemCode = " . db_quote(encrypt_decrypt_rnd('decrypt', $hashItemCode, $random)));

        $getPRDetails = db_select("
        SELECT `Received` , `Qty`
        FROM purchaserequestsitemstbl 
        WHERE `ItemCode` = " . db_quote(encrypt_decrypt_rnd('decrypt', $hashItemCode, $random)) . "
        AND `Color` = " . db_quote($Color) . "
        AND `ModifyCode` = " . db_quote($ModifyCode) . "
        AND `PONumber` = " . db_quote(encrypt_decrypt_rnd('decrypt', $hashPRNumber, $prnd)));

        echo db_error();
        $Qty = $getPRDetails[0]['Qty'];
        $Received = $getPRDetails[0]['Received'];
        $ModelName = $getItemDetails[0]['ModelName'];
        $Brand = $getItemDetails[0]['Brand'];
        ?>
        <!-- page content -->
        <div class="right_col" role="main">
            <div class="">
                <div class="page-title">
                    <div class="title_left">
                        <h3>Purchase Requests</h3>
                    </div>
                </div>

                <div class="clearfix"></div>

                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Item Receiving</h2>
                                <div class="clearfix"></div>
                            </div>
                            <form method="POST" name="frmReceiveItem" id="frmReceiveItem" action="php/function.php" autocomplete="off" onkeypress="return noenter(event)">
                                <input type="hidden" id="rItemCode" name="rItemCode" value="<?= @$ItemCode ?>">
                                <input type="hidden" id="rItemName" name="rItemName" value="<?= @$ModelName ?>">
                                <input type="hidden" id="rBrand" name="rBrand" value="<?= @$Brand ?>">
                                <input type="hidden" id="rColor" name="rColor" value="<?= @$Color ?>">
                                <input type="hidden" id="rPRNumber" name="rPRNumber" value="<?= @$PRNumber ?>">
                                <input type="hidden" id="rhashPRNumber" name="rhashPRNumber" value="<?= @$hashPRNumber ?>">
                                <input type="hidden" id="rhashItemCode" name="rhashItemCode" value="<?= @$hashItemCode ?>">
                                <input type="hidden" id="rItemRND" name="rItemRND" value="<?= @$Itemrnd ?>">
                                <input type="hidden" id="rPRRND" name="rPRRND" value="<?= @$prnd ?>">
                                <input type="hidden" id="rQty" name="rQty" value="<?= @$Qty ?>">
                                <input type="hidden" id="rReceived" name="rReceived" value="<?= @$Received ?>">

                                <input type="hidden">
                                <div class="x_content">
                                    <div class="col-lg-12">
                                        <label>Item Code: <?= @$ItemCode ?></label>
                                        <br>
                                        <label>Item Name: <?= @$ModelName ?></label>
                                        <br>
                                        <label>Item Color: <?= @$Color ?></label>
                                        <div class="row">
                                            <br>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <label>IMEI / SN</label>
                                                        <input type="text" class="form-control" name="ImeiSN" id="ImeiSN" onkeypress="return AddItem(event)">
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Panel -->
                                            <div class="panel panel-info">
                                                <div class="panel-heading">
                                                    <i class="fa fa-table fa-fw"></i> <b>Items: <label id="sQty"><?= @$Received . " / " . @$Qty ?></label></b>
                                                </div>
                                                <!-- /.panel-heading -->
                                                <div class="panel-body" style="height: 400px; overflow-y: scroll;">
                                                    <table id="ItemsToOrder" class="table table-striped table-bordered">
                                                        <thead>
                                                        <tr>
                                                            <th>Item Code</th>
                                                            <th>Item Name</th>
                                                            <th>Brand</th>
                                                            <th>IMEI / SN</th>
                                                            <th width="5%">Delete</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <!-- /.panel-body -->
                                                <div class="panel-footer">

                                                </div>
                                            </div>
                                            <!-- End Panel -->
                                            <a onclick="ReceiveItems();" class="btn btn-dark" style="float: right">Save</a>
                                            <a href="receiving.php" class="btn btn-dark" style="float: right">Cancel</a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Check Before Submit Modal -->
                                <div class="modal fade" id="CheckItems">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header modal-header-dark">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title">Save?</h4>
                                            </div>
                                            <div class="modal-body">
                                                <p>Please review received items before save.</p>
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
                            </form>

                            <!-- Item Exists Modal -->
                            <div class="modal fade" id="itemExists">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header modal-header-danger">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title">Item Already exists</h4>
                                        </div>
                                        <div class="modal-body">
                                            <p>Please enter other item.</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            <!-- /.modal -->

                            <!-- No Item Modal -->
                            <div class="modal fade" id="NoItem">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header modal-header-danger">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title">No Item</h4>
                                        </div>
                                        <div class="modal-body">
                                            <p>Please enter IMEI or Serial Number</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            <!-- /.modal -->

                            <!-- Item Limit Modal -->
                            <div class="modal fade" id="itemLimit">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header modal-header-danger">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title">Items Completed</h4>
                                        </div>
                                        <div class="modal-body">
                                            <p>Items Completed. Please check items before save</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            <!-- /.modal -->

                            <!-- No Item Modal -->
                            <div class="modal fade" id="noItemModal">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header modal-header-danger">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title">No items added.</h4>
                                        </div>
                                        <div class="modal-body">
                                            <p>Please add item(s) before you can purchase order.</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            <!-- /.modal -->

                            <!-- Error Modal -->
                            <div class="modal fade" id="ErrorModal">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header modal-header-danger">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title">Error</h4>
                                        </div>
                                        <div class="modal-body">
                                            <p>Error! Please contact administrator about this problem.</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                            </div>
                            <!-- /.modal-dialog -->
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

<link rel="import" href="../js.html">
<script src="js/function.js"></script>

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