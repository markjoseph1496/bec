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
                        <h3>Brands</h3>
                    </div>
                </div>

                <div class="clearfix"></div>

                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Brands</h2>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <div class="col-lg-12">
                                    <div class="row">
                                        <table id="datatable" class="table table-striped table-bordered">
                                            <thead>
                                            <tr>
                                                <th>BrandCode</th>
                                                <th>Brand</th>
                                                <th width=12%>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $BrandQuery = db_select("SELECT * FROM brandtbl");
                                            foreach ($BrandQuery as $vBrand) {
                                                $BrandID = $vBrand['BrandID'];
                                                $BrandCode = $vBrand['BrandCode'];
                                                $Brand = $vBrand['Brand'];
                                                ?>
                                                <tr>
                                                    <td><?= @$BrandCode ?></td>
                                                    <td><?= @$Brand ?></td>
                                                    <td>
                                                        <button class="btn btn-dark" onclick="BrandDetails(this.value);" value="<?= @$BrandID; ?>" data-toggle="modal" data-target="#BrandUpdateModal"><i class="fa fa-eye"></i></button>
                                                        <button class="btn btn-danger" onclick="BrandDelete(this.value);" value="<?= @$BrandID; ?>" data-toggle="modal" data-target="#BrandDeleteModal"><i class="fa fa-trash"></i></button>
                                                    </td>
                                                </tr>

                                                <?php
                                            }
                                            ?>
                                            </tbody>
                                        </table>
                                        <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#AddBrandModal">Add Brand</button>
                                    </div>

                                    <!-- Delete Brand Modal -->
                                    <div class="modal fade" id="BrandDeleteModal">

                                    </div>
                                    <!-- /.modal -->

                                    <!-- Edit Brand Modal -->
                                    <div class="modal fade" id="BrandUpdateModal">

                                    </div>
                                    <!-- /.modal -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Add Brand Modal -->
                <div class="modal fade" id="AddBrandModal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form method="POST" name="AddBrand" id="AddBrand" autocomplete="off">
                                <div class="modal-header modal-header-dark">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">Add Area</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <?php
                                        $GeneratingBrandID = db_query("SELECT * FROM brandtbl");
                                        $num = mysqli_num_rows($GeneratingBrandID);
                                        $IdFormat = "BR-00";
                                        $start = '1';
                                        if ($num > 0) {
                                            while ($ID = mysqli_fetch_array($GeneratingBrandID)) {
                                                $brandID = $ID['BrandID'];
                                                $start++;
                                            }
                                            echo '<input type="hidden" readonly class="form-control" value="' . $IdFormat . '' . $start . '" name="AddBrandID" id="AddBrandID">';
                                        } else {
                                            echo '<input type="hidden" readonly class="form-control" value="' . $IdFormat . '' . $start . '" name="AddBrandID" id="AddBrandID">';
                                        }
                                        ?>
                                    </div>
                                    <div class="form-group">
                                        <label>Brand Code <span class="red">(*)</span></label>
                                        <input type="text" class="form-control" style="text-transform: uppercase" id="BrandCode" name="BrandCode">
                                    </div>
                                    <div class="form-group">
                                        <label>Brand <span class="red">(*)</span></label>
                                        <input type="text" class="form-control" style="text-transform: uppercase" id="AddBrand" name="AddBrand">
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
        $('#AddBrand').bootstrapValidator({
            message: 'This value is not valid',
            feedbackIcons: {
                valid: "glyphicon glyphicon-ok",
                invalid: "glyphicon glyphicon-remove",
                validating: "glyphicon glyphicon-refresh"
            },
            fields: {
                group: 'form-group',
                BrandCode: {
                    validators: {
                        notEmpty: {
                            message: 'Brand Code is required.'
                        }
                    }
                },
                AddBrand: {
                    validators: {
                        notEmpty: {
                            message: 'Brand is required.'
                        }
                    }
                }
            }
        }).on('success.form.bv', function (e) {
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: 'function/functions.php',
                data: $('#AddBrand').serialize(),
                success: function (data) {
                    if (data == "True") {
                        window.location.href = "brand.php";
                    }
                }
            })
        });
    });
</script>
<!-- /validator-->

</body>
</html>
