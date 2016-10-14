<?php
include('../../functions/encryption.php');
$hashPRNumber = $_GET['id'];
$PONumber = $_GET['pr'];

if (encrypt_decrypt('decrypt', $hashPRNumber) != $PONumber) {
    header('location: po.php?error');
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

    <!-- Bootstrap -->
    <link href="../../src/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../../src/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../../src/nprogress/nprogress.css" rel="stylesheet">

    <!-- PNotify -->
    <link href="../../src/pnotify/dist/pnotify.css" rel="stylesheet">
    <link href="../../src/pnotify/dist/pnotify.buttons.css" rel="stylesheet">
    <link href="../../src/pnotify/dist/pnotify.nonblock.css" rel="stylesheet">

    <!-- Datatables -->
    <link href="../../src/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="../../src/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="../../src/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="../../src/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="../../src/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../../build/css/custom.min.css" rel="stylesheet">


</head>

<body class="nav-md" onload="addItemsToModify()">
<div class="container body">
    <div class="main_container">
        <?php
        include('navigation.php');
        $PRDetails = db_select("
        SELECT
        areatbl.Area,
        branchtbl.BranchCode,
        brandtbl.Brand,
        brandtbl.BrandID,
        employeetbl.Firstname,
        employeetbl.Lastname,
        purchaserequeststbl._Date,
        purchaserequeststbl.LastModified,
        purchaserequeststbl.ModifiedBy,
        purchaserequeststbl._Time,
        purchaserequeststbl.ModifyCode
        FROM purchaserequeststbl
        LEFT JOIN employeetbl ON purchaserequeststbl.EmpID = employeetbl.EmpID
        LEFT JOIN branchtbl ON purchaserequeststbl.BranchCode = branchtbl.BranchCode
        LEFT JOIN brandtbl ON purchaserequeststbl.BrandID = brandtbl.BrandID
        LEFT JOIN areatbl ON branchtbl.AreaID = areatbl.AreaID
        WHERE purchaserequeststbl.PONumber =" . db_quote($PONumber)
        );

        $Area = $PRDetails[0]['Area'];
        $Branch = $PRDetails[0]['BranchCode'];
        $Brand = $PRDetails[0]['Brand'];
        $BrandID = $PRDetails[0]['BrandID'];
        $OrderedBy = $PRDetails[0]['Firstname'] . " " . $PRDetails[0]['Lastname'];
        $DateOrdered = new DateTime($PRDetails[0]['_Date']);
        $ModifiedByID = db_quote($PRDetails[0]['ModifiedBy']);
        $TimeModified = $PRDetails[0]['_Time'];
        $LastModified = new DateTime($PRDetails[0]['LastModified']);
        $getName = db_select("SELECT `Firstname` ,`Lastname` FROM `employeetbl` WHERE `EmpID` = $ModifiedByID");
        $ModifiedBy = $getName[0]['Firstname'] . " " . $getName[0]['Lastname'];
        $ModifyCode = $PRDetails[0]['ModifyCode'];

        ?>
        <!-- page content -->
        <div class="right_col" role="main">
            <div class="">
                <div class="page-title">
                    <div class="title_left">
                        <h3>Purchase Order</h3>
                    </div>
                </div>

                <div class="clearfix"></div>

                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Modify Purchase Request</h2>
                                <div class="clearfix"></div>
                            </div>
                            <form method="POST" name="frmPurchaseOrder" id="frmPurchaseOrder" action="php/function.php">
                                <input type="hidden" name="aEmpID" value="<?= @$EmpID ?>">
                                <input type="hidden" name="HashPRNumber" value="<?= @$hashPRNumber ?>">
                                <input type="hidden" name="PRNumber" value="<?= @$PONumber ?>">
                                <input type="hidden" name="BrandID" value="<?= @$BrandID ?>">
                                <input type="hidden" name="Branch" value="<?= @$Branch ?>">
                                <div class="x_content">
                                    <div class="col-lg-12">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <label>PR Number: <?= @$PONumber ?></label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <label>Last Modified by: <?= @$ModifiedBy . " / " . date_format($LastModified, "F j, Y") . " / " . $TimeModified ?></label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <label>Area: <?= @$Area ?></label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <label>Branch: <?= @$Branch ?></label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <label>Brand: <?= @ $Brand ?></label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <label>Ordered By: <?= @$OrderedBy ?></label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <label>Date Ordered: <?= @ date_format($DateOrdered, "F j, Y"); ?></label>
                                            </div>
                                        </div>
                                    </div>
                                    &nbsp;
                                    <div class="row">
                                        <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#AddItemModal"><i class="fa fa-plus-circle"></i> Add Item</button>
                                        <!-- Panel -->
                                        <div class="panel panel-info">
                                            <div class="panel-heading">
                                                <i class="fa fa-table fa-fw"></i> Items to order
                                            </div>
                                            <?php
                                            $OrderedItems = db_select(
                                                "SELECT
                                                    purchaserequestsitemstbl.ItemCode,
                                                    purchaserequestsitemstbl.Qty,
                                                    purchaserequestsitemstbl.Color,
                                                    itemstbl.ModelName,
                                                    itemstbl.SRP,
                                                    brandtbl.Brand
                                                    FROM purchaserequestsitemstbl
                                                    LEFT JOIN itemstbl ON purchaserequestsitemstbl.ItemCode = itemstbl.ItemCode
                                                    LEFT JOIN brandtbl ON itemstbl.BrandID = brandtbl.BrandID
                                                    WHERE purchaserequestsitemstbl.PONumber = " . db_quote($PONumber) . "
                                                    AND purchaserequestsitemstbl.ModifyCode = ". db_quote($ModifyCode)."
                                                    ORDER BY itemstbl.ModelName ASC");
                                            echo db_error();
                                            $TotalItems = 0;
                                            foreach ($OrderedItems as $item) {
                                                $ItemCode = $item['ItemCode'];
                                                $Qty = $item['Qty'];
                                                $ModelName = $item['ModelName'];
                                                $Color = $item['Color'];
                                                $Brand = $item['Brand'];
                                                $SRP = $item['SRP'];
                                                $TotalItems = $TotalItems + ($Qty * $SRP);
                                                $Total = number_format($Qty * $SRP, 2, '.', ',');
                                                $SRP = number_format($SRP, 2, '.', ',');
                                                ?>
                                                <input type="hidden" name="aItemCode[]" value="<?= @$ItemCode ?>">
                                                <input type="hidden" name="aModelName[]" value="<?= @$ModelName ?>">
                                                <input type="hidden" name="aColor[]" value="<?= @$Color ?>">
                                                <input type="hidden" name="aBrand[]" value="<?= @$Brand ?>">
                                                <input type="hidden" name="aSRP[]" value="<?= @$SRP ?>">
                                                <input type="hidden" name="aQty[]" value="<?= @$Qty ?>">
                                                <input type="hidden" name="aTotalPrice[]" value='<?= @$Total ?>'>
                                                <?php
                                            }
                                            ?>
                                            <!-- /.panel-heading -->
                                            <div class="panel-body" style="height: 400px; overflow-y: scroll;" id="testssss">
                                                <table id="ItemsToOrder" class="table table-striped table-bordered">
                                                    <thead>
                                                    <tr>
                                                        <th>Item Code</th>
                                                        <th>Item Name</th>
                                                        <th>Brand</th>
                                                        <th>SRP</th>
                                                        <th width="5%">Qty.</th>
                                                        <th width="10%">Total</th>
                                                        <th width="5%">Delete</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <!-- /.panel-body -->
                                            <div class="panel-footer">
                                                <b>Total Price: <label id="sPrice">0.00</label></b>
                                            </div>
                                        </div>
                                        <!-- End Panel -->
                                        <button type="button" onclick="UpdatePurchaseOrder();" class="btn btn-dark" style="float: right">Save</button>
                                        <a href="po.php" class="btn btn-dark" style="float: right">Cancel</a>
                                    </div>
                                </div>
                                <!-- Add Item Modal -->
                                <div class="modal fade" id="AddItemModal">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header modal-header-dark">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title">Add Item</h4>
                                            </div>
                                            <div class="modal-body">
                                                <table id="datatable" class="table table-striped table-bordered">
                                                    <thead>
                                                    <tr>
                                                        <th>Item Code</th>
                                                        <th>Model</th>
                                                        <th>Color</th>
                                                        <th>Description</th>
                                                        <th>Brand</th>
                                                        <th>Category</th>
                                                        <th>SRP</th>
                                                        <th width="5%">Qty.</th>
                                                        <th width="5%">Add</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php
                                                    $itemstbl = db_select("
                                                    SELECT 
                                                        itemstbl.ItemCode,
                                                        itemstbl.ModelName,
                                                        itemstbl.ItemDescription,
                                                        itemstbl.Category,
                                                        itemstbl.SRP,
                                                        brandtbl.Brand
                                                        FROM itemstbl
                                                        LEFT JOIN brandtbl ON itemstbl.BrandID = brandtbl.BrandID
                                                        WHERE itemstbl.BrandID = " . db_quote($BrandID));

                                                    foreach ($itemstbl as $item) {
                                                        $ItemCode = $item['ItemCode'];
                                                        $Model = $item['ModelName'];
                                                        $Description = $item['ItemDescription'];
                                                        $Brand = $item['Brand'];
                                                        $Category = $item['Category'];
                                                        $SRP = number_format($item['SRP'], 2, ".", ",");
                                                        ?>
                                                        <tr>
                                                            <td>
                                                                <?= @$ItemCode ?>
                                                                <input type="hidden" disabled name="tItemCode[]" value="<?= @$ItemCode ?>">
                                                            </td>
                                                            <td>
                                                                <?= @$Model ?>
                                                                <input type="hidden" disabled name="tModelName[]" value="<?= @$Model ?>">
                                                            </td>
                                                            <td>
                                                                <select class="form-control" name="tColor[]">
                                                                    <option value="">- Select Color -</option>
                                                                    <?php
                                                                    $colortbl = db_select("SELECT `Color` FROM `colortbl`");

                                                                    foreach($colortbl as $color){
                                                                        $Color = $color['Color'];
                                                                        ?>
                                                                        <option value="<?= @$Color ?>"><?= @$Color ?></option>
                                                                        <?php
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <?= @$Description ?>
                                                                <input type="hidden" disabled name="tDescription[]" value="<?= @$Description ?>">
                                                            </td>
                                                            <td>
                                                                <?= @$Brand ?>
                                                                <input type="hidden" disabled name="tBrand[]" value="<?= @$Brand ?>">
                                                            </td>
                                                            <td>
                                                                <?= @$Category ?>
                                                                <input type="hidden" disabled name="tCategory[]" value="<?= @$Category ?>">
                                                            </td>
                                                            <td>
                                                                <?= @$SRP ?>
                                                                <input type="hidden" disabled name="tSRP[]" value="<?= @$SRP ?>">
                                                            </td>
                                                            <td>
                                                                <input type="number" name="tQty[]" id="tQty" max="1000" min="0" class="form-control" style="width: 80px;" value="0">
                                                            </td>
                                                            <td>
                                                                <a class="btn btn-success" onclick="addItemToOrder(this);"><i class="fa fa-plus-circle"></i></a>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                    }
                                                    ?>
                                                    </tbody>
                                                </table>
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

                                <!-- Item Exists Modal -->
                                <div class="modal fade" id="itemExists">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header modal-header-danger">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title">Item Already exists</h4>
                                            </div>
                                            <div class="modal-body">
                                                <p>Please select other item.</p>
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

                                <!-- Check Before Submit Modal -->
                                <div class="modal fade" id="CheckItems">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header modal-header-dark">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title">Send Purchase Order?</h4>
                                            </div>
                                            <div class="modal-body">
                                                <p>Please review selected items before submit.</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-dark" data-dismiss="modal">Review items</button>
                                                <button type="submit" class="btn btn-danger">Submit</button>
                                            </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                                <!-- /.modal -->
                            </form>
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
<!-- jQuery -->
<script src="../../src/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="../../src/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="../../src/fastclick/lib/fastclick.js"></script>
<!-- NProgress -->
<script src="../../src/nprogress/nprogress.js"></script>
<!-- PNotify -->
<script src="../../src/pnotify/dist/pnotify.js"></script>
<script src="../../src/pnotify/dist/pnotify.buttons.js"></script>
<script src="../../src/pnotify/dist/pnotify.nonblock.js"></script>

<!-- Datatables -->
<script src="../../src/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../../src/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="../../src/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="../../src/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
<script src="../../src/datatables.net-buttons/js/buttons.flash.min.js"></script>
<script src="../../src/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="../../src/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="../../src/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
<script src="../../src/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
<script src="../../src/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="../../src/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
<script src="../../src/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
<script src="../../src/jszip/dist/jszip.min.js"></script>
<script src="../../src/pdfmake/build/pdfmake.min.js"></script>
<script src="../../src/pdfmake/build/vfs_fonts.js"></script>
<!-- Custom Theme Scripts -->
<script src="../../build/js/custom.min.js"></script>
<!-- Accounting JS -->
<script src="../../src/accountingjs/accounting.min.js"></script>
<!-- Function JS -->
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