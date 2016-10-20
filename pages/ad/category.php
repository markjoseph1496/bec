<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Administrator</title>

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
                                                        <button class="btn btn-dark" onclick="CategoryDetails(this.value);" value="<?= @$CategoryID; ?>" data-toggle="modal" data-target="#CategoryUpdateModal"><i class="fa fa-eye"></i></button>
                                                        <button class="btn btn-danger" onclick="CategoryDelete(this.value);" value="<?= @$CategoryID; ?>" data-toggle="modal" data-target="#CategoryDeleteModal"><i class="fa fa-trash"></i></button>
                                                    </td>
                                                </tr>

                                                <?php
                                            }
                                            ?>
                                            </tbody>
                                        </table>
                                        <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#AddCategoryModal">Add Category</button>
                                    </div>

                                    <!-- Delete Category Modal -->
                                    <div class="modal fade" id="CategoryDeleteModal">

                                    </div>
                                    <!-- /.modal -->

                                    <!-- Edit Category Modal -->
                                    <div class="modal fade" id="CategoryUpdateModal">

                                    </div>
                                    <!-- /.modal -->

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
                                            echo '<input type="hidden" readonly class="form-control" value="' . $IdFormat . '' . $start . '" name="AddCategoryID" id="AddCategoryID">';
                                        } else {
                                            echo '<input type="hidden" readonly class="form-control" value="' . $IdFormat . '' . $start . '" name="AddCategoryID" id="AddCategoryID">';
                                        }
                                        ?>
                                    </div>
                                    <div class="form-group">
                                        <label>Category Code <span class="red">(*)</span></label>
                                        <input type="text" class="form-control" style="text-transform: capitalize" id="CategoryCode" name="CategoryCode">
                                    </div>
                                    <div class="form-group">
                                        <label>Category <span class="red">(*)</span></label>
                                        <input type="text" class="form-control" style="text-transform: capitalize" id="AddCategory" name="AddCategory">
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
