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
                        <h3>Category</h3>
                    </div>
                </div>

                <div class="clearfix"></div>

                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Category</h2>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <div class="col-lg-12">
                                    <div class="row">
                                        <table id="datatable" class="table table-striped table-bordered">
                                            <thead>
                                            <tr>
                                                <th>Category Code</th>
                                                <th>Category</th>
                                                <th width=12%>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $CategoryQuery = db_select("SELECT * FROM categorytbl");
                                            foreach ($CategoryQuery as $Categ) {
                                                $CategoryID = $Categ['CategoryID'];
                                                $CategoryCode = $Categ['CategoryCode'];
                                                $Category = $Categ['Category'];
                                                ?>
                                                <tr>
                                                    <td><?php echo $CategoryCode ?></td>
                                                    <td><?= @$Category; ?></td>
                                                    <td>
                                                        <button class="btn btn-dark" data-target='#EditCategoryModal<?= @$CategoryID; ?>' data-toggle='modal'><i class="fa fa-eye"></i></button>
                                                        <button class="btn btn-danger" data-toggle="modal" data-target="#DeleteCategoryModal<?= @$CategoryID; ?>"><i class="fa fa-trash"></i></button>
                                                    </td>
                                                </tr>

                                                <!-- Delete Category Modal -->
                                                <div class="modal fade" id="DeleteCategoryModal<?= @$CategoryID; ?>">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <form action="function/admin-delete.php" method="POST" name="DeleteCategory" id="DeleteCategory">
                                                                <div class="modal-header modal-header-danger">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                    <h4 class="modal-title">Delete Category</h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <label>Do you want to delete this Category "<?= @$Category; ?>"</label>
                                                                    <div class="form-group"></div>
                                                                </div>
                                                                <input type="hidden" name="CategoryID" value="<?= @$CategoryID; ?>">
                                                                <div class="modal-footer">
                                                                    <button class="btn btn-danger" name="btndeleteCategory" id="btndeleteCategory">Delete</button>
                                                                    <button class="btn btn-dark" data-dismiss="modal">Cancel</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <!-- /.modal-content -->
                                                    </div>
                                                    <!-- /.modal-dialog -->
                                                </div>
                                                <!-- /.modal -->

                                                <!-- Edit Category Modal -->
                                                <div class="modal fade" id="EditCategoryModal<?= @$CategoryID; ?>">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <form action="function/functions.php" method="POST" name="UpdateCategory" id="UpdateCategory" autocomplete="off">
                                                                <div class="modal-header modal-header-dark">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                    <h4 class="modal-title">Edit Category</h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="form-group">
                                                                        <label>AreaID <span class="red">(*)</span></label>
                                                                        <input type="text" class="form-control" readonly id="EditCategoryID" name="EditCategoryID" value="<?php echo $CategoryID; ?>">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Category Code <span class="red">(*)</span></label>
                                                                        <input type="text" class="form-control" style="text-transform: uppercase" id="EditCategoryCode" name="EditCategoryCode" value="<?= @$CategoryCode; ?>">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Area <span class="red">(*)</span></label>
                                                                        <input type="text" class="form-control" style="text-transform: uppercase" id="EditCategory" name="EditCategory" value="<?php echo $Category; ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button class="btn btn-dark" id="btnupdateCategory" name="btnupdateCategory">Update</button>
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
                                        <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#AddCategoryModal">Add Category</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Add Category Modal -->
                <div class="modal fade" id="AddCategoryModal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form method="POST" name="AddCategory" id="AddCategory" autocomplete="off">
                                <div class="modal-header modal-header-dark">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">Add Category</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <?php
                                        $GeneratingCategoryID = db_query("SELECT * FROM `categorytbl`");
                                        $num = mysqli_num_rows($GeneratingCategoryID);
                                        $IdFormat = "CT-00";
                                        $start = '1';
                                        if ($num > 0) {
                                            while ($ID = mysqli_fetch_array($GeneratingCategoryID)) {
                                                $areaID = $ID['CategoryID'];
                                                $start++;
                                            }
                                            echo '<input type="hidden" readonly class="form-control" value="' . $IdFormat . '' . $start . '" name="CategoryID" id="CategoryID">';
                                        } else {
                                            echo '<input type="hidden" readonly class="form-control" value="' . $IdFormat . '' . $start . '" name="CategoryID" id="CategoryID">';
                                        }
                                        ?>
                                    </div>
                                    <div class="form-group">
                                        <label>Category Code <span class="red">(*)</span></label>
                                        <input type="text" class="form-control" style="text-transform: uppercase" id="CategoryCode" name="CategoryCode">
                                    </div>
                                    <div class="form-group">
                                        <label>Category <span class="red">(*)</span></label>
                                        <input type="text" class="form-control" style="text-transform: uppercase" id="AddCategory" name="AddCategory">
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
        $('#AddCategory').bootstrapValidator({
            message: 'This value is not valid',
            feedbackIcons: {
                valid: "glyphicon glyphicon-ok",
                invalid: "glyphicon glyphicon-remove",
                validating: "glyphicon glyphicon-refresh"
            },
            fields: {
                group: 'form-group',
                CategoryCode: {
                    validators: {
                        notEmpty: {
                            message: 'Category Code is required.'
                        }
                    }
                },
                AddCategory: {
                    validators: {
                        notEmpty: {
                            message: 'Category is required.'
                        }
                    }
                }
            }
        }).on('success.form.bv', function (e) {
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: 'function/functions.php',
                data: $('#AddCategory').serialize(),
                success: function (data) {
                    if (data == "True") {
                        window.location.href = "category.php";
                    }
                }
            })
        });
    });
</script>
<!-- /validator-->

</body>
</html>
