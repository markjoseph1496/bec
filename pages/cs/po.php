<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Purchase Request</title>
    <link rel="shortcut icon" href="../../img/B%20LOGO%20BLACK.png">

    <!-- Bootstrap -->
    <link href="../../src/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../../src/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../../src/nprogress/nprogress.css" rel="stylesheet">
    <!-- Bootstrap Validator -->
    <link href="../../src/validator/bootstrapValidator.min.css">

    <!-- PNotify -->
    <link href="../../src/pnotify/dist/pnotify.css" rel="stylesheet">
    <link href="../../src/pnotify/dist/pnotify.buttons.css" rel="stylesheet">
    <link href="../../src/pnotify/dist/pnotify.nonblock.css" rel="stylesheet">

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
                        <h3>Purchase Requests</h3>
                    </div>
                </div>

                <div class="clearfix"></div>

                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Pending Purchase Requests</h2>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <div class="col-lg-12">
                                    <div class="row">
                                        <table id="datatable" class="table table-striped table-bordered">
                                            <thead>
                                            <tr>
                                                <th>PR No.</th>
                                                <th>Date Ordered</th>
                                                <th>Status</th>
                                                <th width="15%">Remarks</th>
                                                <th>Ordered By</th>
                                                <th width="5%">View</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $purchaserequests = db_select("
                                                        SELECT
                                                        purchaserequeststbl.PONumber,
                                                        purchaserequeststbl._Date,
                                                        purchaserequeststbl.Status,
                                                        purchaserequeststbl.Remarks,
                                                        employeetbl.Firstname,
                                                        employeetbl.Lastname
                                                        FROM purchaserequeststbl
                                                        LEFT JOIN employeetbl ON purchaserequeststbl.EmpID = employeetbl.EmpID
                                                        WHERE purchaserequeststbl.BranchCode = " . db_quote($BranchCode) . " 
                                                        AND purchaserequeststbl.Status = 'Pending' 
                                                        AND purchaserequeststbl.isDeleted = '0'");

                                            if ($purchaserequests === false) {
                                                echo db_error();
                                            }
                                            foreach ($purchaserequests as $purchase) {
                                                $PONumber = $purchase['PONumber'];
                                                $_Date = $purchase['_Date'];
                                                $Status = $purchase['Status'];
                                                $Remarks = $purchase['Remarks'];
                                                $ContactPerson = $purchase['Firstname'] . " " . $purchase['Lastname'];
                                                $rnd = rand(0, 9999);
                                                $hashPONumber = encrypt_decrypt_rnd('encrypt', $PONumber, $rnd);
                                                ?>
                                                <tr>
                                                    <td><?php echo $PONumber ?></td>
                                                    <td><?php echo $_Date ?></td>
                                                    <td><?php echo $Status ?></td>
                                                    <td><?php echo $Remarks ?></td>
                                                    <td><?php echo $ContactPerson ?></td>
                                                    <td>
                                                        <button class="btn btn-dark" onclick="PODetails(this.value, '<?= @$hashPONumber ?>', '<?= @$rnd ?>');" value="<?= @$PONumber ?>" data-toggle="modal" data-target="#PODetails"><i class="fa fa-eye"></i></button>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                            ?>
                                            </tbody>
                                        </table>
                                        <button data-toggle="modal" data-target="#PurchaseNow" class="btn btn-dark">Purchase now</button>

                                    </div>

                                    <!-- PO Details -->
                                    <div class="modal fade" id="PODetails">

                                    </div>
                                    <!-- /.modal -->

                                    <!-- Check Before Delete Modal -->
                                    <div class="modal fade" id="CheckDelete">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header modal-header-danger">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title">Cancel Purchase Request?</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Are you sure you want to cancel this purchase request? This cannot be undone</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button id="Yes" onclick="DeletePR(this.value)" class="btn btn-danger">Yes</button>
                                                    <button class="btn btn-default" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>
                                    <!-- /.modal -->

                                    <form method="POST" action="purchase.php" id="frmBrand">
                                        <!-- Purchase Now Modal -->
                                        <div class="modal fade" id="PurchaseNow">
                                            <div class="modal-dialog modal-sm">
                                                <div class="modal-content">
                                                    <div class="modal-header modal-header-dark">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                        <h4 class="modal-title">Select Brand</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <div class="form-group">
                                                                    <label for="Brand">Brand (*)</label>
                                                                    <select class="form-control" name="Brand" id="Brand">
                                                                        <option value="" selected="selected">- Select Brand -</option>
                                                                        <?php
                                                                        $tblBrand = db_select("
                                                                                    SELECT
                                                                                    brandtbl.Brand,
                                                                                    brandtbl.BrandID
                                                                                    FROM brandtbl
                                                                                    LEFT JOIN branchtbl ON brandtbl.BrandID = branchtbl.BrandID
                                                                                    WHERE branchtbl.BranchCode = " . db_quote($BranchCode)
                                                                        );
                                                                        foreach ($tblBrand as $brand) {
                                                                            $Brand = $brand['Brand'];
                                                                            $BrandID = $brand['BrandID'];
                                                                            ?>
                                                                            <option value="<?= @$BrandID ?>"><?= @$Brand ?></option>
                                                                            <?php
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-default" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-dark">Proceed</button>
                                                    </div>
                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
                                    </form>
                                    <!-- /.modal -->
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
<!-- PNotify -->
<script src="../../src/pnotify/dist/pnotify.js"></script>
<script src="../../src/pnotify/dist/pnotify.buttons.js"></script>
<script src="../../src/pnotify/dist/pnotify.nonblock.js"></script>

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
<!-- function JS -->
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
         text: 'Purchase Request Updated',
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
        $('#frmBrand').bootstrapValidator({
            fields: {
                group: 'form-group',
                Brand: {
                    validators: {
                        notEmpty: {
                            message: 'Brand is required.'
                        }
                    }
                }
            }
        });
    });
</script>
</body>
</html>