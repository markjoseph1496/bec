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
                        <h3>Branch Page</h3>
                    </div>
                </div>

                <div class="clearfix"></div>

                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Branches</h2>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <div class="col-lg-12">
                                    <div class="row">
                                        <table id="datatable" class="table table-striped table-bordered">
                                            <thead>
                                            <tr>
                                                <th>Branch Code</th>
                                                <th>Branch Name</th>
                                                <th>Brand</th>
                                                <th>Branch Area</th>
                                                <th>Branch Type</th>
                                                <th width=12%>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $BranchQuery = db_select("SELECT * FROM `branchtbl`");
                                            foreach ($BranchQuery as $Branch) {
                                                $BranchCode = $Branch['BranchCode'];
                                                $BranchName = $Branch['BranchName'];
                                                $Brand = $Branch['Brand'];
                                                $BranchArea = $Branch['Area'];
                                                $BranchType = $Branch['BranchType'];
                                                ?>
                                                <tr>
                                                    <td><?php echo $BranchCode ?></td>
                                                    <td><?php echo $BranchName ?></td>
                                                    <td><?php echo $Brand ?></td>
                                                    <td><?php echo $BranchArea ?></td>
                                                    <td><?php echo $BranchType ?></td>
                                                    <td>
                                                        <button class="btn btn-dark" data-toggle="modal" data-target="#PODetails"><i class="fa fa-eye"></i></button>
                                                        <button class="btn btn-danger" data-toggle="modal" data-target="#PODetails"><i class="fa fa-trash"></i></button>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                            ?>
                                            </tbody>
                                        </table>
                                        <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#myModal">Add Branch</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <form id="AddBranch" method="POST" autocomplete="off">
                    <!-- Modal add branch-->
                    <div class="modal fade" id="myModal" role="dialog">
                        <div class="modal-dialog">
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header modal-header-dark">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Add Branch</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>Branch Code <span class="red">(*)</span></label>
                                                <input type="text" class="form-control" style="text-transform: uppercase" id="BranchCode" name="BranchCode">
                                            </div>
                                            <div class="form-group">
                                                <label>Branch Name <span class="red">(*)</span></label>
                                                <input type="text" class="form-control" id="BranchName" name="BranchName">
                                            </div>
                                            <div class="form-group">
                                                <label>Brand <span class="red">(*)</span></label>
                                                <select class="form-control" name="bBrand" id="bBrand">
                                                    <option selected="selected" value=""> - Please Select one -</option>
                                                    <option value="Berlein Mobile">Berlein Mobile</option>
                                                    <option value="Cherry Mobile">Cherry Mobile</option>
                                                    <option value="MyPhone">MyPhone</option>
                                                    <option value="Oppo">Oppo</option>
                                                    <option value="Huawei">Huawei</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Branch Area <span class="red">(*)</span></label>
                                                <select class="form-control" name="BranchArea" id="BranchArea">
                                                    <option selected="selected" value=""> - Please Select one -</option>
                                                    <option value="North Luzon">North Luzon</option>
                                                    <option value="Central Luzon">Central Luzon</option>
                                                    <option value="NCR North">NCR North</option>
                                                    <option value="NCR Central">NCR Central</option>
                                                    <option value="NCR Central">NCR Mandaluyong</option>
                                                    <option value="NCR South">NCR South</option>
                                                    <option value="Cebu">Cebu</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Branch Type <span class="red"> (*)</span></label>
                                                <select class="form-control" name="BranchType" id="BranchType">
                                                    <option selected="selected" value=""> - Please Select one -</option>
                                                    <option value="Inline">Inline</option>
                                                    <option value="Kiosk">Kiosk</option>
                                                    <option value="Concept">Concept</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-dark">Save</button>
                                    <button class="btn btn-dark" data-dismiss="modal">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Modal addbranch-->
                </form>
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
        $('#AddBranch').bootstrapValidator({
            message: 'This value is not valid',
            feedbackIcons: {
                invalid: 'glyphicon glyphicon-remove'
            },
            fields: {
                group: 'form-group',
                BranchCode: {
                    validators: {
                        notEmpty: {
                            message: 'Branch Code is required.'
                        }
                    }
                },
                BranchName: {
                    validators: {
                        notEmpty: {
                            message: 'Branch Name is required.'
                        }
                    }
                },
                BranchArea: {
                    validators: {
                        notEmpty: {
                            message: 'Branch Area is required.'
                        }
                    }
                },
                BranchType: {
                    validators: {
                        notEmpty: {
                            message: 'Branch Type is required.'
                        }
                    }
                },
                bBrand: {
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
                url: 'function/admin-add.php',
                data: $('#AddBranch').serialize(),
                success: function (data) {
                    if (data == "True") {
                        $('#BranchCode').val("");
                        $('#BranchName').val("");
                        $('#BranchArea').val("");
                        $('#bBrand').val("");
                        $('#BranchType').val("");
                        $('#LoginError').show();
                        $("#LoginError").fadeTo(5000, 500).slideUp(500, function () {

                        });

                        RefreshTable();

                    }
                }
            })
        });
    });
</script>
<!-- /validator-->
</body>
</html>
