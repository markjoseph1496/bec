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
                        <h3>Employee's Page</h3>
                    </div>
                </div>

                <div class="clearfix"></div>

                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Employees</h2>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <div class="col-lg-12">
                                    <div class="row">
                                        <table id="datatable" class="table table-striped table-bordered">
                                            <thead>
                                            <tr>
                                                <th>Employee ID</th>
                                                <th>Name</th>
                                                <th>Initials</th>
                                                <th>Position</th>
                                                <th>Branch</th>
                                                <th>Area</th>
                                                <th width='17%'>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $employeetbl = db_select("
                                                SELECT 
                                                employeetbl.EmpID, 
                                                employeetbl.Firstname,  
                                                employeetbl.Lastname,
                                                employeetbl.Initials, 
                                                employeetbl.Position, 
                                                branchtbl.BranchCode, 
                                                areatbl.Area
                                                FROM employeetbl
                                                LEFT JOIN branchtbl ON employeetbl.BranchID = branchtbl.BranchID
                                                LEFT JOIN  areatbl ON employeetbl.AreaID = areatbl.AreaID
                                                WHERE employeetbl.Position != 'Admin'
                                                ORDER BY employeetbl.EmpID ASC
                                                ");
                                            foreach ($employeetbl as $value) {
                                                $EmpID = $value['EmpID'];
                                                $Firstname = $value['Firstname'];
                                                $Lastname = $value['Lastname'];
                                                $Initials = $value['Initials'];
                                                $Position = $value['Position'];
                                                $BranchName = $value['BranchCode'];
                                                $Area = $value['Area'];

                                                $rnd = rand(0, 9999);
                                                $hashEmpID = encrypt_decrypt_rnd('encrypt', $EmpID, $rnd);

                                                ?>
                                                <tr>
                                                    <td><?= @$EmpID; ?></td>
                                                    <td><?= @$Firstname . " " . @$Lastname; ?></td>
                                                    <td><?= @$Initials; ?></td>
                                                    <td><?= @$Position; ?></td>
                                                    <td><?= @$BranchName; ?></td>
                                                    <td><?= @$Area ?></td>
                                                    <td width="15%">
                                                        <!-- Ipapasa niya kay employee details nasa Function.js yung Employee ID, Hash, at Random Number -->
                                                        <button class="btn btn-dark" onclick="EmployeeDetails('<?= @$EmpID; ?>','<?= @$hashEmpID ?>','<?= @$rnd ?>');" data-toggle="modal" data-target="#EmployeeUpdateModal"><i class='fa fa-eye'></i></button>
                                                        <!-- Ipapasa niya kay EmployeDelete nasa function.js yung Employee ID, Hash, at Random -->
                                                        <button class='btn btn-danger' onclick="EmployeeDelete('<?= @$EmpID; ?>','<?= @$hashEmpID ?>','<?= @$rnd ?>');" data-toggle="modal" data-target="#DeleteEmployee"><i class="fa fa-trash "></i></button>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                            ?>
                                            </tbody>
                                        </table>
                                        <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#AddEmployeeModal">Add Employee</button>
                                    </div>

                                    <!-- Modal edit item-->
                                    <div class="modal fade" id="EmployeeUpdateModal">

                                    </div>
                                    <!-- End Modal Edit Item-->

                                    <!-- Modal add account-->
                                    <div class="modal fade" id="AddAccount" role="dialog">

                                    </div>
                                    <!-- End Modal add account -->

                                    <!-- Modal Delete Employee -->
                                    <div class="modal fade" id="DeleteEmployee" role="dialog">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form method="POST" action="function/admin-delete.php">
                                                    <div class="modal-header modal-header-danger">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                        <h4 class="modal-title">Delete</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <!-- Yung value nito galing dun sa button na view, sinet to ni javascript gamit yung EmployeeDelete na function -->
                                                        <input type="hidden" name="EmpID" id="EmpID">
                                                        <input type="hidden" name="hashEmpID" id="hashEmpID">
                                                        <input type="hidden" name="rnd" id="rnd">
                                                        <label>Are you sure you want to remove this account? This cannot be undone.</label>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <!-- Idedelete niya yung data na laman ni input once submitted -->
                                                        <button type="submit" class="btn btn-dark">Delete</button>
                                                        <button class="btn btn-default" data-dismiss="modal">Close</button>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>
                                    <!-- End Modal Delete Employee -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Add Employee Modal -->
                <div class="modal fade" id="AddEmployeeModal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form method="POST" name="AddEmployee" id="AddEmployee" autocomplete="off">
                                <div class="modal-header modal-header-dark">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">Add Employee</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label>Employee ID <span class="red">(*)</span></label>
                                        <input type="text" class="form-control" style="text-transform: uppercase" id="AddEmpID" name="AddEmpID">
                                    </div>
                                    <div class="form-group">
                                        <label>First Name <span class="red">(*)</span></label>
                                        <input type="text" class="form-control" style="text-transform: capitalize" id="Firstname" name="Firstname">
                                    </div>
                                    <div class="form-group">
                                        <label>Middle Name</label>
                                        <input type="text" class="form-control" style="text-transform: capitalize" id="Middlename" name="Middlename">
                                    </div>
                                    <div class="form-group">
                                        <label>Last Name <span class="red">(*)</span></label>
                                        <input type="text" class="form-control" style="text-transform: capitalize" id="Lastname" name="Lastname">
                                    </div>
                                    <div class="form-group">
                                        <label>Initials <span class="red">(*)</span></label>
                                        <input type="text" class="form-control" style="text-transform: uppercase" id="Initials" name="Initials">
                                    </div>
                                    <div class="form-group">
                                        <label>Position <span class="red">(*)</span></label>
                                        <select class="form-control" onchange="BranchAndArea(this.value)" id="Position" name="Position">
                                            <option value="" selected="selected">- Select Position -</option>
                                            <option value="Brand Coordinator">Brand Coordinator</option>
                                            <option value="Auditor">Auditor</option>
                                            <option value="Area Manager">Area Manager</option>
                                            <option value="OIC">Officer In Charge</option>
                                            <option value="Cashier">Cashier</option>
                                        </select>
                                    </div>
                                    <div class="form-group" style="display:none" id="DivBranch">
                                        <label>Branch <span class="red">(*)</span></label>
                                        <select class="form-control" id="Branch" name="Branch">
                                            <option value="" selected="selected">- Select Branch -</option>
                                            <?php
                                            $branchtbl = db_select("SELECT `BranchName`,`BranchID` FROM `branchtbl`");

                                            foreach ($branchtbl as $value) {
                                                $BranchName = $value['BranchName'];
                                                $BranchID = $value['BranchID'];
                                                ?>
                                                <option value="<?php echo $BranchID; ?>"><?php echo $BranchName; ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group" style="display:none" id="DivArea">
                                        <label>Area <span class="red">(*)</span></label>
                                        <select class="form-control" id="eArea" name="eArea">
                                            <option value="" selected="selected">- Select Area -</option>
                                            <?php
                                            $Areatbl = db_select("SELECT `AreaID`, `Area` FROM `areatbl`");

                                            foreach ($Areatbl as $vArea) {
                                                $AreaID = $vArea['AreaID'];
                                                $Area = $vArea['Area'];
                                                ?>
                                                <option value="<?= @$AreaID; ?>"><?= @$Area; ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group" style="display:none" id="DivBrand">
                                        <label>Brand <span class="red">(*)</span></label>
                                        <select class="form-control" id="Brand" name="Brand">
                                            <option value="" selected="selected">- Select Brand -</option>
                                            <?php
                                            $brandtbl = db_select("SELECT `BrandID` , `Brand` FROM `brandtbl`");

                                            foreach ($brandtbl as $brand) {
                                                $BrandID = $brand['BrandID'];
                                                $Brand = $brand['Brand'];
                                                ?>
                                                <option value="<?= @$BrandID ?>"><?= @ $Brand ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-dark">Save</button>
                                    <button class="btn btn-dark" data-dismiss="modal">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- End of Add employee modal -->
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
} elseif (isset($_GET['Updated'])) {
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
        $('#AddEmployee').bootstrapValidator({
            message: 'This value is not valid',
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                group: 'form-group',
                AddEmpID: {
                    validators: {
                        notEmpty: {
                            message: 'Please enter your Employee ID. Required!'
                        },
                        remote: {
                            message: 'Employee ID already exists',
                            url: 'function/remote.php',
                            data: {
                                type: 'AddEmpID'
                            },
                            type: 'POST'
                        }
                    }
                },
                Firstname: {
                    validators: {
                        notEmpty: {
                            message: 'Please enter your First Name. Required!'
                        },
                        regexp: {
                            regexp: /^[a-zA-Z ]+$/,
                            message: "Invalid input."
                        }
                    }
                },
                Middlename: {
                    validators: {
                        regexp: {
                            regexp: /^[a-zA-Z ]+$/,
                            message: "Invalid input."
                        }
                    }
                },
                Lastname: {
                    validators: {
                        notEmpty: {
                            message: 'Please enter your Last Name. Required!'
                        },
                        regexp: {
                            regexp: /^[a-zA-Z ]+$/,
                            message: "Invalid input."
                        }
                    }
                },
                Initials: {
                    validators: {
                        notEmpty: {
                            message: 'Please enter your Initial. Required!'
                        },
                        regexp: {
                            regexp: /^[a-zA-Z ]+$/,
                            message: "Invalid input."
                        }
                    }
                },
                Position: {
                    validators: {
                        notEmpty: {
                            message: 'Please select position. Required!'
                        }
                    }
                },
                Branch: {
                    validators: {
                        notEmpty: {
                            message: 'Please select Branch. Required!'
                        }
                    }
                },
                eArea: {
                    validators: {
                        notEmpty: {
                            message: 'Please select Area. Required!'
                        }
                    }
                },
                Brand: {
                    validators: {
                        notEmpty: {
                            message: 'Please select Brand. Required!'
                        }
                    }
                }
            }
        }).on('success.form.bv', function (e) {
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: 'function/functions.php',
                data: $('#AddEmployee').serialize(),
                success: function (data) {
                    if (data == "True") {
                        window.location.href = "employee.php?Updated";
                    }
                    else if (data == "False") {
                        window.location.href = "employee.php?error";
                    }
                    else {
                        window.location.href = "employee.php?error";
                    }
                }
            })
        });
    });
</script>
<!-- /validator -->
</body>
</html>
