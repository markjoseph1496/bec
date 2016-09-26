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
                                    <?php
                                    if (isset($_GET['id'])) {
                                        $id = $_GET['id'];
                                        if ($id = 'EmployeeAddNotif') {
                                            echo '
                            <div id="EmployeeAddNotif" class="alert alert-success alert-dismissible fade in" role="alert" style="display: none;">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                                </button>
                                Employee successfully Added.
                            </div>
                        ';
                                        }
                                    }
                                    ?>
                                    <div class="row">
                                        <table id="datatable" class="table table-striped table-bordered">
                                            <thead>
                                            <tr>
                                                <th>EmployeeID</th>
                                                <th>First Name</th>
                                                <th>Middle Name</th>
                                                <th>Last Name</th>
                                                <th>Initials</th>
                                                <th>Position</th>
                                                <th>Branch</th>
                                                <th width='17%'>Action</th>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $employeetbl = db_select("SELECT * FROM `employeetbl`");
                                            foreach ($employeetbl as $value) {
                                            $EmpID = $value['EmpID'];
                                            $Firstname = $value['Firstname'];
                                            $Middlename = $value['Middlename'];
                                            $Lastname = $value['Lastname'];
                                            $Initials = $value['Initials'];
                                            $Position = $value['Position'];
                                            $Branch = $value['Branch'];
                                            ?>
                                            <tr>
                                                <td><?php echo $EmpID; ?></td>
                                                <td><?php echo $Firstname; ?></td>
                                                <td><?php echo $Middlename; ?></td>
                                                <td><?php echo $Lastname; ?></td>
                                                <td><?php echo $Initials; ?></td>
                                                <td><?php echo $Position; ?></td>
                                                <td><?php echo $Branch; ?></td>
                                                <td>
                                                    <button data-toggle='modal'
                                                            data-target='#AddAccount<?php echo $EmpID; ?>' class='btn btn-dark'>
                                                        <i class='fa fa-plus'></i>
                                                    </button>
                                                    <button name="btnedit" data-toggle='modal'
                                                            data-target='#UpdateEmployee<?php echo $EmpID; ?>' class='btn btn-dark'>
                                                        <i class='fa fa-eye'></i>
                                                    </button>
                                                    <button class='btn btn-danger' data-toggle="modal"
                                                            data-target="#DeleteEmployee<?php echo $EmpID; ?>">
                                                        <i class="fa fa-remove "></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            </tbody>

                                            <!-- Modal add account-->
                                            <div class="modal fade" id="AddAccount<?php echo $EmpID; ?>" role="dialog">
                                                <div class="modal-dialog">
                                                    <!-- Modal content-->
                                                    <div class="modal-content">
                                                        <form action="function/admin-add.php" method="POST" name="addAccount" id="addAccount" autocomplete="off">
                                                            <div class="modal-header modal-header-dark">
                                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                <h4 class="modal-title">Add Account</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="alert alert-primary" id="success-alert">
                                                                    <strong><span class="fa fa-info-circle"></span> You want to create an account for this employee.</strong>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-lg-12">
                                                                        <div class="form-group">
                                                                            <label>Username <span class="red">(*)</span></label>
                                                                            <input type="text" class="form-control" style="text-tranform: uppercase" id="aUsername" name="aUsername">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>Password <span class="red">(*)</span></label>
                                                                            <input type="password" class="form-control" id="aPassword" name="aPassword">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>Employee ID <span class="red">(*)</span></label>
                                                                            <input type="text" readonly="readonly" class="form-control" style="text-transform: uppercase" id="aEmpID" name="aEmpID"
                                                                                   value="<?php echo $EmpID; ?>">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit" class="btn btn-dark" id="btnaddaccount" name="btnaddaccount">Add Account</button>
                                                                <button class="btn btn-dark" data-dismiss="modal">Cancel</button>
                                                            </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End Modal add account -->
                                            </form>

                                            <!-- Modal Delete Employee -->
                                            <div class="modal fade" id="DeleteEmployee<?php echo $EmpID; ?>" role="dialog">
                                                <div class="modal-dialog" style="padding:100px">
                                                    <!-- Modal Content -->
                                                    <div class="modal-content">
                                                        <form action="function/admin-delete.php" method="POST" name="DeleteEmployee" id="DeleteEmployee" autocomplete="off">
                                                            <div class="modal-header modal-header-danger">
                                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                <h4 class="modal-title">Delete Employee</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="col-md-15">
                                                                    <label = "usr" class="control-label">Do you want to delete
                                                                    Item <?php echo $Firstname;
                                                                    echo $Lastname; ?>? This cannot be undone.</label>
                                                                    <div class="form-group"></div>
                                                                </div>
                                                                <input type="hidden" name="EmpID" value="<?php echo $EmpID; ?>">
                                                                <div class="modal-footer">
                                                                    <button class="btn btn-dark" name="btndeleteemployee" id="btndeleteemployee">Delete</button>
                                                                    <button type="button" class="btn btn-dark" data-dismiss="modal">Cancel</button>
                                                                </div>
                                                            </div>
                                                    </div>
                                                </div>
                                            </div>
                                            </form>
                                            <!-- End Modal Delete Employee -->


                                            <!-- Modal edit item-->
                                            <div class="modal fade" id="UpdateEmployee<?php echo $EmpID; ?>" role="dialog">
                                                <div class="modal-dialog">
                                                    <!-- Modal content-->
                                                    <div class="modal-content">
                                                        <form action="function/admin-add.php" method="POST" name="EditEmployee" id="EditEmployee" autocomplete="off">
                                                            <div class="modal-header modal-header-dark">
                                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                <h4 class="modal-title">Edit Employee</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col-lg-12">
                                                                        <div class="form-group">
                                                                            <label>Employee ID <span class="red">(*)</span></label>
                                                                            <input type="text" readonly="readonly" class="form-control" style="text-transform: uppercase" id="uEmpID" name="uEmpID"
                                                                                   value="<?php echo $EmpID; ?>">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>First Name <span class="red">(*)</span></label>
                                                                            <input type="text" class="form-control" style="text-transform: uppercase" id="uFirstname" name="uFirstname"
                                                                                   value="<?php echo $Firstname; ?>">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>Middle Name <span class="red">(*)</span></label>
                                                                            <input type="text" class="form-control" style="text-transform: uppercase" id="uMiddlename" name="uMiddlename"
                                                                                   value="<?php echo $Middlename; ?>">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>Last Name <span class="red">(*)</span></label>
                                                                            <input type="text" class="form-control" style="text-transform: uppercase" id="uLastname" name="uLastname"
                                                                                   value="<?php echo $Lastname; ?>">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>Initials <span class="red">(*)</span></label>
                                                                            <input type="text" class="form-control" style="text-transform: uppercase" id="uInitials" name="uInitials"
                                                                                   value="<?php echo $Initials; ?>">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>Position <span class="red">(*)</span></label>
                                                                            <input type="text" class="form-control" style="text-transform: uppercase" id="uPosition" name="uPosition"
                                                                                   value="<?php echo $Position; ?>">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>Branch <span class="red">(*)</span></label>
                                                                            <select class="form-control" id="uBranch" name="uBranch">
                                                                                <option value="" selected="selected"><?php echo $BranchName; ?></option>
                                                                                <?php
                                                                                $branchtbl = db_select("SELECT `BranchName` FROM `branchtbl`");

                                                                                foreach ($branchtbl as $branch) {
                                                                                    $BranchName = $branch['BranchName'];
                                                                                    ?>
                                                                                    <option value="<?php echo $BranchName; ?>"><?php echo $BranchName; ?></option>
                                                                                    <?php
                                                                                }
                                                                                ?>

                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit" class="btn btn-dark" id="btnupdateemployee" name="btnupdateemployee">Update</button>
                                                                <button class="btn btn-dark" data-dismiss="modal">Cancel</button>
                                                            </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End Modal Edit Item-->
                                            </form>

                                            <?php
                                            }
                                            ?>
                                        </table>
                                        <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#myModal">Add Employee</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <form action="function/admin-add.php" method="POST" name="AddEmployee" id="AddEmployee" autocomplete="off">
                    <!-- Modal add employee-->
                    <div class="modal fade" id="myModal" role="dialog">
                        <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header modal-header-dark">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Add Employee</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>Employee ID <span class="red">(*)</span></label>
                                                <input type="text" class="form-control" style="text-transform: uppercase" id="EmpID" name="EmpID">
                                            </div>
                                            <div class="form-group">
                                                <label>First Name <span class="red">(*)</span></label>
                                                <input type="text" class="form-control" style="text-transform: uppercase" id="Firstname" name="Firstname">
                                            </div>
                                            <div class="form-group">
                                                <label>Middle Name <span class="red">(*)</span></label>
                                                <input type="text" class="form-control" style="text-transform: uppercase" id="Middlename" name="Middlename">
                                            </div>
                                            <div class="form-group">
                                                <label>Last Name <span class="red"></span>(*)</label>
                                                <input type="text" class="form-control" style="text-transform: uppercase" id="Lastname" name="Lastname">
                                            </div>
                                            <div class="form-group">
                                                <label>Initials <span class="red">(*)</span></label>
                                                <input type="text" class="form-control" style="text-transform: uppercase" id="Initials" name="Initials">
                                            </div>
                                            <div class="form-group">
                                                <label>Position <span class="red">(*)</span></label>
                                                <input type="text" class="form-control" style="text-transform: uppercase" id="Position" name="Position">
                                            </div>
                                            <div class="form-group">
                                                <label>Branch <span class="red">(*)</span></label>
                                                <select class="form-control" id="Branch" name="Branch">
                                                    <option value="" selected="selected">- Choose Branch -</option>
                                                    <?php
                                                    $branchtbl = db_select("SELECT `BranchName` FROM `branchtbl`");

                                                    foreach ($branchtbl as $value) {
                                                        $BranchName = $value['BranchName'];
                                                        ?>
                                                        <option value="<?php echo $BranchName; ?>"><?php echo $BranchName; ?></option>
                                                        <?php
                                                    }
                                                    ?>

                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-dark" id="btnaddemployee" name="btnaddemployee">Save</button>
                                    <button class="btn btn-dark" data-dismiss="modal">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Modal add employee-->
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
        $('#AddEmployee').bootstrapValidator({
            message: 'This value is not valid',
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                group: 'form-group',
                EmpID: {
                    validators: {
                        notEmpty: {
                            message: 'Please enter your Employee ID. Required!'
                        }
                    }
                },
                Firstname: {
                    validators: {
                        notEmpty: {
                            message: 'Please enter your First Name. Required!'
                        }
                    }
                },
                Middlename: {
                    validators: {
                        notEmpty: {
                            message: 'Please enter your Middle Name. Required!'
                        }
                    }
                },
                Lastname: {
                    validators: {
                        notEmpty: {
                            message: 'Please enter your Last Name. Required!'
                        }
                    }
                },
                Initials: {
                    validators: {
                        notEmpty: {
                            message: 'Please enter your Initial. Required!'
                        }
                    }
                },
                Position: {
                    validators: {
                        notEmpty: {
                            message: 'Please enter your Position. Required!'
                        }
                    }
                },
                Branch: {
                    validators: {
                        notEmpty: {
                            message: 'Please enter Branch. Required!'
                        }
                    }
                }
            }
        });
    });


    $('#EmployeeAddNotif').show();
    $("#EmployeeAddNotif").fadeTo(5000, 500).slideUp(500, function () {
        $("#EmployeeAddNotif").alert('close');
    });
</script>
<!-- /validator -->
</body>
</html>
