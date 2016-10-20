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
                        <h3>Branches</h3>
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
                                                <th width=12%>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $BranchQuery = db_select("
                                                SELECT branchtbl.BranchCode, branchtbl.BranchName, brandtbl.Brand, areatbl.Area
                                                FROM branchtbl
                                                LEFT JOIN brandtbl ON branchtbl.BrandID = brandtbl.BrandID
                                                LEFT  JOIN areatbl ON branchtbl.AreaID = areatbl.AreaID");
                                            foreach ($BranchQuery as $Branch) {
                                                $BranchCode = $Branch['BranchCode'];
                                                $BranchName = $Branch['BranchName'];
                                                $Brand = $Branch['Brand'];
                                                $BranchArea = $Branch['Area'];

                                                $Branchrnd = rand(0, 9999);
                                                $hashBranchCode = encrypt_decrypt_rnd('encrypt', $BranchCode, $Branchrnd);
                                                ?>
                                                <tr>
                                                    <td><?php echo $BranchCode ?></td>
                                                    <td><?php echo $BranchName ?></td>
                                                    <td><?php echo $Brand ?></td>
                                                    <td><?php echo $BranchArea ?></td>
                                                    <td>
                                                        <button class="btn btn-dark" onclick="BranchDetails('<?= @$BranchCode; ?>','<?= @$hashBranchCode; ?>','<?= @$Branchrnd; ?>')" data-toggle="modal" data-target="#BranchUpdateModal"><i class="fa fa-eye"></i></button>
                                                        <button class="btn btn-danger" onclick="BranchDelete('<?= @$BranchCode; ?>','<?= @$hashBranchCode; ?>','<?= @$Branchrnd; ?>')" data-toggle="modal" data-target="#BranchDeleteModal"><i
                                                                class="fa fa-trash"></i></button>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                            ?>
                                            </tbody>
                                        </table>
                                        <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#AddBranchModal">Add Branch</button>
                                    </div>

                                    <!-- Update Branch Modal -->
                                    <div class="modal fade" id="BranchUpdateModal">

                                    </div>
                                    <!-- /.modal -->

                                    <!-- Modal Delete Branch -->
                                    <div class="modal fade" id="BranchDeleteModal" role="dialog">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form method="POST" action="function/admin-delete.php">
                                                    <div class="modal-header modal-header-danger">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                        <h4 class="modal-title">Delete Branch</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <input type="hidden" name="BranchCode" id="BranchCode">
                                                        <input type="hidden" name="hashBranchCode" id="hashBranchCode">
                                                        <input type="hidden" name="Branchrnd" id="Branchrnd">
                                                        <label>Are you sure you want to remove this Branch? This cannot be undone.</label>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-dark">Delete</button>
                                                        <button class="btn btn-default" data-dismiss="modal">Close</button>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>
                                    <!-- End Modal Delete Branch -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <form id="AddBranch" method="POST" autocomplete="off">
                    <!-- Modal add branch-->
                    <div class="modal fade" id="AddBranchModal" role="dialog">
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
                                                <input type="text" class="form-control" style="text-transform: uppercase" id="AddBranchCode" name="AddBranchCode">
                                            </div>
                                            <div class="form-group">
                                                <label>Branch Name <span class="red">(*)</span></label>
                                                <input type="text" class="form-control" style="text-transform: uppercase" id="BranchName" name="BranchName">
                                            </div>
                                            <div class="form-group">
                                                <label>Brand <span class="red">(*)</span></label>
                                                <select class="form-control" id="bBrand" name="bBrand">
                                                    <option value="" selected="selected"> - Choose Brand -</option>
                                                    <?php
                                                    $brandtbl = db_select("SELECT `BrandID`,`Brand` FROM `brandtbl`");

                                                    foreach ($brandtbl as $vBrand) {
                                                        $BrandID = $vBrand['BrandID'];
                                                        $Brand = $vBrand['Brand'];
                                                        ?>
                                                        <option value="<?= @$BrandID; ?>"><?= @$Brand; ?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Branch Area <span class="red">(*)</span></label>
                                                <select class="form-control" id="BranchArea" name="BranchArea">
                                                    <option value="" selected="selected"> - Choose Branch Area -</option>
                                                    <?php
                                                    $areatbl = db_select("SELECT `AreaID`,`Area` FROM `areatbl`");

                                                    foreach ($areatbl as $vArea) {
                                                        $AreaID = $vArea['AreaID'];
                                                        $Area = $vArea['Area'];
                                                        ?>
                                                        <option value="<?= @$AreaID; ?>"><?= @$Area ?></option>
                                                        <?php
                                                    }
                                                    ?>
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

                <!-- Delete Branch Modal -->
                <div class="modal fade" id="CheckDelete">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header modal-header-danger">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Delete Branch?</h4>
                            </div>
                            <div class="modal-body">
                                <strong><p>Are you sure you want to delete this branch?</p></strong>
                            </div>
                            <div class="modal-footer">
                                <button id="Yes" class="btn btn-danger">Yes</button>
                                <button class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
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
        $('#AddBranch').bootstrapValidator({
            message: 'This value is not valid',
            feedbackIcons: {
                valid: "glyphicon glyphicon-ok",
                invalid: "glyphicon glyphicon-remove",
                validating: "glyphicon glyphicon-refresh"
            },
            fields: {
                group: 'form-group',
                BranchCode: {
                    validators: {
                        notEmpty: {
                            message: 'Branch Code is required.'
                        },
                        remote: {
                            message: 'Branch Code already exists',
                            url: 'function/check.php',
                            data: {
                                type: 'BranchCode'
                            },
                            type: 'POST'

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
                url: 'function/functions.php',
                data: $('#AddBranch').serialize(),
                success: function (data) {
                    if (data == "True") {
                        window.location.href = "branch.php";
                    }
                }
            })
        });
    });
</script>
<!-- /validator-->
</body>
</html>
