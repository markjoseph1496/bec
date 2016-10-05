<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Administrator</title>

    <!-- Bootstrap -->
    <link href="../../src/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../../src/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../../src/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="../../src/animate.css/animate.min.css" rel="stylesheet">
    <!-- Bootstrap Validator -->
    <link href="../../src/validator/bootstrapValidator.min.css">
    <!-- Select2 -->
    <link href="../../src/select2/dist/css/select2.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../../build/css/custom.min.css" rel="stylesheet">
    <!-- Datatables -->
    <link href="../../src/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="../../src/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="../../src/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="../../src/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="../../src/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
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
                        <h3>Items</h3>
                    </div>
                </div>

                <div class="clearfix"></div>

                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Items</h2>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <div class="col-lg-12">
                                    <div class="row">
                                        <table id="datatable" class="table table-striped table-bordered">
                                            <thead>
                                            <tr>
                                                <th>Item Code</th>
                                                <th>Model Name</th>
                                                <th>Item Description</th>
                                                <th>Brand</th>
                                                <th>Category</th>
                                                <th>SRP</th>
                                                <th>DP</th>
                                                <th width=12%>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $ItemsQuery = db_select("SELECT itemstbl.ItemCode,itemstbl.ModelName,itemstbl.ItemDescription,
                                                                      brandtbl.BrandCode,brandtbl.Brand,categorytbl.CategoryCode,categorytbl.Category,
                                                                      itemstbl.SRP,itemstbl.DP
                                                                      FROM itemstbl
                                                                      LEFT JOIN brandtbl ON itemstbl.BrandID = brandtbl.BrandID
                                                                      LEFT JOIN categorytbl ON itemstbl.CategoryID = categorytbl.CategoryID
                                                                     ");
                                            foreach ($ItemsQuery as $Items) {
                                                $ItemCode = $Items['ItemCode'];
                                                $ModelName = $Items['ModelName'];
                                                $ItemDescription = $Items['ItemDescription'];
                                                $BrandCode = $Items['BrandCode'];
                                                $Brand = $Items['Brand'];
                                                $CategoryCode = $Items['CategoryCode'];
                                                $Category = $Items['Category'];
                                                $SRP = $Items['SRP'];
                                                $DP = $Items['DP'];
                                                $SRP = number_format($SRP, 2, '.', ',');
                                                $DP = number_format($DP, 2, '.', ',');

                                                ?>
                                                <tr>
                                                    <td><?php echo $ItemCode ?></td>
                                                    <td><?php echo $ModelName ?></td>
                                                    <td><?php echo $ItemDescription ?></td>
                                                    <td><?php echo $Brand ?></td>
                                                    <td><?php echo $Category ?></td>
                                                    <td><?= @$SRP; ?></td>
                                                    <td><?= @$DP; ?></td>
                                                    <td>
                                                        <button class="btn btn-dark" data-target='#EditItemsModal<?= @$ItemCode; ?>' data-toggle='modal'><i class="fa fa-eye"></i></button>
                                                        <button class="btn btn-danger" data-toggle="modal" data-target="#DeleteItemModal<?= @$ItemCode; ?>" );
                                                        "><i class="fa fa-trash"></i></button>
                                                    </td>
                                                </tr>

                                                <!-- Delete Items Modal -->
                                                <div class="modal fade" id="DeleteItemModal<?= @$ItemCode; ?>">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <form action="function/admin-delete.php" method="POST" name="DeleteItems" id="DeleteItems">
                                                                <div class="modal-header modal-header-danger">
                                                                    <button type="button" class="close" data-dissmiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                    <h4 class="modal-title">Delete Item</h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <label>Do you want to delete this Account "<?= @$ModelName; ?>"</label>
                                                                    <div class="form-group"></div>
                                                                </div>
                                                                <input type="hidden" name="aEmpID" value="<?= @$ItemCode; ?>">
                                                                <div class="modal-footer">
                                                                    <button class="btn btn-danger" name="btndeleteItems" id="btndeleteItems">Delete</button>
                                                                    <button class="btn btn-dark" data-dismiss="modal">Cancel</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Edit Items Modal -->
                                                <div class="modal fade" id="EditItemsModal<?= @$ItemCode; ?>">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <form action="function/functions.php" method="POST" name="UpdateItems" id="UpdateItems" autocomplete="off">
                                                                <div class="modal-header modal-header-dark">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                    <h4 class="modal-title">Edit Item</h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="form-group">
                                                                        <label>Category <span class="red">(*)</span></label>
                                                                        <input type="text" readonly class="form-control" id="EditCategory" name="EditCategor" value="<?php echo $Category; ?>">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Brand <span class="red">(*)</span></label>
                                                                        <input type="text" readonly class="form-control" id="EditBrand" name="EditBrand" value="<?php echo $Brand; ?>">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Item Code <span class="red">(*)</span></label>
                                                                        <input type="text" class="form-control" readonly id="EditItemCode" name="EditItemCode" value="<?php echo $ItemCode; ?>">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Model Name <span class="red">(*)</span></label>
                                                                        <input type="text" class="form-control" style="text-transform: uppercase" id="EditModelName" name="EditModelName" value="<?php echo $ModelName; ?>">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Item Description <span class="red">(*)</span></label>
                                                                        <input type="text" class="form-control" id="EditItemDescription" name="EditItemDescription" value="<?php echo $ItemDescription; ?>">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>SRP <span class="red">(*)</span></label>
                                                                        <input type="text" class="form-control" id="EditSRP" name="EditSRP" value="<?= @$SRP; ?>">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Dealer's Price<span class="red">(*)</span></label>
                                                                        <input type="text" class="form-control" id="EditDP" name="EditDP" value="<?= @$DP; ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button class="btn btn-dark" id="btnupdateItems" name="btnupdateItems">Update</button>
                                                                    <button class="btn btn-default" data-dismiss="modal">Cancel</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <!-- /.modal-content -->
                                                    </div>
                                                    <!-- /.modal-dialog -->
                                                </div>
                                                <!-- /.modal -->

                                                <?php
                                            }
                                            ?>
                                            </tbody>
                                        </table>
                                        <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#AddItemsModal">Add Items</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Add Items Modal -->
                <div class="modal fade" id="AddItemsModal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="function/functions.php" method="POST" name="AddItems" id="AddItems" autocomplete="off">
                                <div class="modal-header modal-header-dark">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">Add Item</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label>Category <span class="red">(*)</span></label>
                                        <select class="form-control" name="Category" id="Category">
                                            <option value=""> - Please Select Category - </option>
                                            <?php
                                            $Categorytbl = db_select("SELECT * FROM `categorytbl`");

                                            foreach ($Categorytbl as $ValueCateg) {
                                                $CategoryID = $ValueCateg['CategoryID'];
                                                $CategoryCode = $ValueCateg['CategoryCode'];
                                                $Category = $ValueCateg['Category'];
                                            ?>
                                            <option value="<?=@$CategoryID; ?>">(<?=@$CategoryCode; ?>) <?=@$Category; ?></option>
                                            <?php
                                            }
                                            ?>
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Brand <span class="red">(*)</span></label>
                                        <select class="form-control" name="ItemBrand" id="ItemBrand">
                                            <option value=""> - Please Select Brand - </option>
                                            <?php
                                            $Brandtbl = db_select("SELECT * FROM `brandtbl`");

                                            foreach ($Brandtbl as $valueBrand) {
                                                $BrandID = $valueBrand['BrandID'];
                                                $BrandCode = $valueBrand['BrandCode'];
                                                $Brand = $valueBrand['Brand'];
                                            ?>
                                            <option value="<?=@$BrandID; ?>">(<?=@$BrandCode; ?>) <?=@$Brand; ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Item Code <span class="red">(*)</span></label>
                                        <?php
                                        $GeneratingItemsCode = db_query("SELECT * FROM itemstbl");
                                        $num = mysqli_num_rows($GeneratingItemsCode);
                                        $IDFormat = "101000";
                                        $Start = '1';
                                        if ($num > 0 ){
                                            while ($ID = mysqli_fetch_array($GeneratingItemsCode)) {
                                                $ItemCode = $ID['ItemCode'];
                                                $Start++;
                                            }
                                            echo '<input type="text" readonly class="form-control" value="' . $IDFormat . '' . $Start . '" name="ItemCode" id="ItemCode">';
                                        } else {
                                            echo '<input type="text" readonly class="form-control" value="' . $IDFormat . '' . $Start . '" name="ItemCode" id="ItemCode">';
                                        }
                                        ?>
                                    </div>
                                    <div class="form-group">
                                        <label>Model Name <span class="red">(*)</span></label>
                                        <input type="text" class="form-control" style="text-transform: uppercase" id="ModelName" name="ModelName" >
                                    </div>
                                    <div class="form-group">
                                        <label>Item Description <span class="red">(*)</span></label>
                                        <input type="text" class="form-control" style="text-transform: uppercase" id="ItemDescription" name="ItemDescription">
                                    </div>
                                    <div class="form-group">
                                        <label>SRP <span class="red">(*)</span></label>
                                        <input type="text" class="form-control" id="SRP" name="SRP">
                                    </div>
                                    <div class="form-group">
                                        <label>Dealer's Price<span class="red">(*)</span></label>
                                        <input type="text" class="form-control" id="DP" name="DP">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-dark">Add</button>
                                    <button class="btn btn-default" data-dismiss="modal">Cancel</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->


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
<!-- validator -->
<script src="../../src/validator/bootstrapValidator.min.js"></script>
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

<!-- validator -->
<script type="text/javascript">
    $(document).ready(function () {
        $('#AddItems').bootstrapValidator({
            message: 'This value is not valid',
            feedbackIcons: {
                valid: "glyphicon glyphicon-ok",
                invalid: "glyphicon glyphicon-remove",
                validating: "glyphicon glyphicon-refresh"
            },
            fields: {
                group: 'form-group',
                Category: {
                    validators: {
                        notEmpty: {
                            message: 'Category is required.'
                        }
                    }
                },
                ItemBrand: {
                    validators: {
                        notEmpty: {
                            message: 'Brand is required.'
                        }
                    }
                },
                ModelName: {
                    validators: {
                        notEmpty: {
                            message: 'Model Name is required.'
                        }
                    }
                },
                ItemDescription: {
                    validators: {
                        notEmpty: {
                            message: 'Item Description is required.'
                        }
                    }
                },
                SRP: {
                    validators: {
                        notEmpty: {
                            message: 'SRP is required.'
                        }
                    }
                },
                DP: {
                    validators: {
                        notEmpty: {
                            message: 'DP is required.'
                        }
                    }
                }
            }
        });
    });
</script>
<!-- /validator-->

</body>
</html>
