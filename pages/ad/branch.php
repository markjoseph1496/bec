<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Administrator</title>

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
                                                SELECT 
                                                branchtbl.BranchID,
                                                branchtbl.BranchCode, 
                                                branchtbl.BranchName, 
                                                brandtbl.Brand, 
                                                areatbl.Area
                                                FROM branchtbl
                                                LEFT JOIN brandtbl ON branchtbl.BrandID = brandtbl.BrandID
                                                LEFT  JOIN areatbl ON branchtbl.AreaID = areatbl.AreaID ORDER BY branchtbl.BranchCode DESC");
                                            foreach ($BranchQuery as $Branch) {

                                                $BranchID = $Branch['BranchID'];
                                                $BranchCode = $Branch['BranchCode'];
                                                $BranchName = $Branch['BranchName'];
                                                $Brand = $Branch['Brand'];
                                                $BranchArea = $Branch['Area'];

                                                if ($Brand == "") {
                                                    $Brand = "Berlein Mobile";
                                                }
                                                $Branchrnd = rand(1000, 9999);
                                                $hashBranchID = encrypt_decrypt_rnd('encrypt', $BranchID, $Branchrnd);
                                                ?>
                                                <tr>
                                                    <td><?php echo $BranchCode ?></td>
                                                    <td><?php echo $BranchName ?></td>
                                                    <td><?php echo $Brand ?></td>
                                                    <td><?php echo $BranchArea ?></td>
                                                    <td>
                                                        <button class="btn btn-dark" onclick="BranchDetails(this.value,'<?= @$hashBranchID; ?>','<?= @$Branchrnd; ?>')" value="<?= @$BranchID ?>"><i class="fa fa-eye"></i></button>
                                                        <button class="btn btn-danger" onclick="BranchDelete(this.value,'<?= @$hashBranchID; ?>','<?= @$Branchrnd; ?>')" value="<?= @$BranchID ?>"><i class="fa fa-trash"></i></button>
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
                                    <div class="modal fade" id="BranchDeleteModal">

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
                                                <input type="text" class="form-control" style="text-transform: capitalize" id="BranchName" name="BranchName">
                                            </div>
                                            <div class="form-group">
                                                <label>Brand <span class="red">(*)</span></label>
                                                <select class="form-control" id="bBrand" name="bBrand">
                                                    <option value="" selected="selected"> - Choose Brand -</option>
                                                    <option value="All">Berlein Mobile</option>
                                                    <?php
                                                    $brandtbl = db_select("SELECT `BrandID`,`Brand` FROM `brandtbl` ORDER BY `Brand` ASC");

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
                                                    $areatbl = db_select("SELECT `AreaID`,`Area` FROM `areatbl` ORDER BY `Area` ASC");

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
        text: 'Employee Updated',
        type: 'success',
        styling: 'bootstrap3',
        delay:3000
    });
</script>";
} elseif (isset($_GET['deleted'])) {
    echo "<script type='text/javascript'>
    new PNotify({
        title: 'Success',
        text: 'Employee Deleted',
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
        $('#datatable').dataTable({
            "order": [[3, "asc"]]
        });

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
                AddBranchCode: {
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
                url: 'function/functions.php',
                data: $('#AddBranch').serialize(),
                success: function (data) {
                    if (data == "True") {
                        window.location.href = "branch.php?success";
                    }
                    else {
                        window.location.href = "branch.php?error";
                    }
                }
            })
        });
    });
</script>
<!-- /validator-->
</body>
</html>
