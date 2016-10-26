<?php
include_once('../../functions/encryption.php');
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

    <?php
    include_once('../css.html');
    ?>

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
                        <h3>Inventory</h3>
                    </div>
                </div>

                <div class="clearfix"></div>

                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Stocks On Hand</h2>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <div class="col-lg-12">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <?php
                                            $invtblname = strtolower($BranchCode . "invtbl");
                                            $itemstbl = db_select("
                                            SELECT 
                                            itemstbl.ItemCode,
                                            itemstbl.ModelName,
                                            itemstbl.ItemDescription,
                                            itemstbl.Category,
                                            itemstbl.CriticalLevel,
                                            brandtbl.Brand
                                            FROM itemstbl
                                            LEFT JOIN brandtbl ON itemstbl.BrandID = brandtbl.BrandID
                                            WHERE itemstbl.BrandID = $sBrandID
                                             ");
                                            $CountItems = count($itemstbl);
                                            $CriticalCount = 0;
                                            foreach ($itemstbl as $count) {
                                                $countItemCode = $count['ItemCode'];
                                                $countCriticalLevel = $count['CriticalLevel'];
                                                $countItem = db_select("SELECT * FROM $invtblname WHERE `ItemCode` = " . db_quote($countItemCode));

                                                if (count($countItem) <= $countCriticalLevel) {
                                                    $CriticalCount++;
                                                }
                                            }
                                            ?>
                                            <label>Total Items: <?= @$CountItems; ?></label>
                                            <br>
                                            <label>Total Items on Critical Level: <span class="red"><?= @$CriticalCount ?></span> </label>
                                            <!-- Panel -->
                                            <div class="panel panel-info">
                                                <div class="panel-heading">
                                                    <i class="fa fa-table fa-fw"></i> <b>Items</b>
                                                </div>
                                                <!-- /.panel-heading -->
                                                <div class="panel-body">
                                                    <table id="datatable" class="table table-striped table-bordered">
                                                        <thead>
                                                        <tr>
                                                            <th>Item Code</th>
                                                            <th>Model Name</th>
                                                            <th>Item Description</th>
                                                            <th>Brand</th>
                                                            <th>Category</th>
                                                            <th>Stocks On Hand</th>
                                                            <th></th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php
                                                        foreach ($itemstbl as $item) {
                                                            $ItemCode = $item['ItemCode'];
                                                            $ModelName = $item['ModelName'];
                                                            $Description = $item['ItemDescription'];
                                                            $Category = $item['Category'];
                                                            $Brand = $item['Brand'];
                                                            $CriticalLevel = $item['CriticalLevel'];
                                                            $LowLevel = "●";
                                                            $rand = rand(1000, 9999);
                                                            $hashItemCode = encrypt_decrypt_rnd('encrypt', $ItemCode, $rand);

                                                            $countItem = db_select("SELECT * FROM $invtblname WHERE `ItemCode` = " . db_quote($ItemCode));
                                                            $StockOnHand = count($countItem);

                                                            ?>
                                                            <tr <?php if ($StockOnHand <= $CriticalLevel) echo "class='red'" ?>>
                                                                <td><?php if ($StockOnHand <= $CriticalLevel) echo $LowLevel; ?>
                                                                    <?= @$ItemCode ?></td>
                                                                <td><?= @$ModelName ?></td>
                                                                <td><?= @$Description ?></td>
                                                                <td><?= @$Brand ?></td>
                                                                <td><?= @$Category ?></td>
                                                                <td><?= @$StockOnHand ?></td>
                                                                <td>
                                                                    <button class="btn btn-dark" onclick="ItemDetails(this.value,'<?= @$hashItemCode ?>', '<?= @$rand ?>')" value="<?= @$ItemCode ?>"><i class="fa fa-eye"></i></button>
                                                                </td>
                                                            </tr>
                                                            <?php
                                                        }
                                                        ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <!-- End Panel -->
                                        </div>
                                        <!-- Add Item Modal -->
                                        <div class="modal fade" id="ViewItemDetails">

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