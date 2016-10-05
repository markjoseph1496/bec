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
                        <h3>Accounts</h3>
                    </div>
                </div>

                <div class="clearfix"></div>

                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Accounts</h2>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <div class="col-lg-12">
                                    <div class="row">
                                        <table id="datatable" class="table table-striped table-bordered">
                                            <thead>
                                            <tr>
                                                <th>Username</th>
                                                <th>EmpID</th>
                                                <th>Firstname</th>
                                                <th>Middlename</th>
                                                <th>Lastname</th>
                                                <th width=12%>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $AccountQuery = db_select("SELECT *
                                                                      FROM accountstbl
                                                                      JOIN employeetbl
                                                                      ON accountstbl.aEmpID = employeetbl.EmpID
                                                                      ORDER BY accountstbl.aUsername");
                                            foreach ($AccountQuery as $Account) {
                                                $aUsername = $Account['aUsername'];
                                                $aEmpID = $Account['aEmpID'];
                                                $Firstname = $Account['Firstname'];
                                                $Middlename = $Account['Middlename'];
                                                $Lastname = $Account['Lastname'];

                                                ?>
                                                <tr>
                                                    <td><?php echo $aUsername ?></td>
                                                    <td><?php echo $aEmpID ?></td>
                                                    <td><?php echo $Firstname ?></td>
                                                    <td><?php echo $Middlename ?></td>
                                                    <td><?php echo $Lastname ?></td>
                                                    <td>
                                                        <button class="btn btn-dark" data-target='#EditAccount<?= @$aEmpID; ?>' data-toggle='modal'><i class="fa fa-eye"></i></button>
                                                        <button class="btn btn-danger" data-toggle="modal" data-target="#DeleteAccountModal<?= @$aEmpID; ?>" );
                                                        "><i class="fa fa-trash"></i></button>
                                                    </td>
                                                </tr>

                                                <!-- Delete Account Modal -->
                                                <div class="modal fade" id="DeleteAccountModal<?= @$aEmpID; ?>">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <form action="function/admin-delete.php" method="POST" name="DeleteAccount" id="DeleteAccount">
                                                                <div class="modal-header modal-header-danger">
                                                                    <button type="button" class="close" data-dissmiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                    <h4 class="modal-title">Delete Account</h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <label>Do you want to delete this Account "<?= @$aUsername; ?>"</label>
                                                                    <div class="form-group"></div>
                                                                </div>
                                                                <input type="hidden" name="aUsername" value="<?= @$aEmpID; ?>">
                                                                <div class="modal-footer">
                                                                    <button class="btn btn-danger" name="btndeleteAccount" id="btndeleteAccount">Delete</button>
                                                                    <button class="btn btn-dark" data-dismiss="modal">Cancel</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Edit Account Modal -->
                                                <div class="modal fade" id="EditAccount<?= @$aEmpID; ?>">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <form action="function/functions.php" method="POST" name="UpdateAccount" id="UpdateAccount" autocomplete="off">
                                                                <div class="modal-header modal-header-dark">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                    <h4 class="modal-title">Edit Account</h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="form-group">
                                                                        <label>Username <span class="red">(*)</span></label>
                                                                        <input type="text" class="form-control" style="text-transform: uppercase" id="UpdateaUsername" name="UpdateaUsername" value="<?php echo $aUsername; ?>">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>EmpID <span class="red">(*)</span></label>
                                                                        <input type="text" class="form-control" style="text-transform: uppercase" id="UpdateaEmpID" name="UpdateaEmpID" READONLY value="<?php echo $aEmpID; ?>">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>First Name <span class="red">(*)</span></label>
                                                                        <input type="text" class="form-control" id="UpdateFirstname" name="UpdateFirstname" value="<?php echo $Firstname; ?>">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Middle Name <span class="red">(*)</span></label>
                                                                        <input type="text" class="form-control" id="UpdateMiddlename" name="UpdateMiddlename" value="<?php echo $Middlename; ?>">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Last Name <span class="red">(*)</span></label>
                                                                        <input type="text" class="form-control" id="UpdateLastname" name="UpdateLastname" value="<?php echo $Lastname; ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button id="btnupdateaccount" class="btn btn-dark" name="btnupdateaccount">Update</button>
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
                                    </div>
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

</body>
</html>
