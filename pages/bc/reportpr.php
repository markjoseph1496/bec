<?php
include_once('../../functions/encryption.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Administrator</title>
    <link rel="shortcut icon" href="../../img/B%20LOGO%20BLACK.png">

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
                        <h3>Purchase Requests</h3>
                    </div>
                </div>

                <div class="clearfix"></div>

                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Completed</h2>
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
                                                <th>Branch</th>
                                                <th>Ordered By</th>
                                                <th width="5%">View</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $PendingOrders = db_select("
                                            SELECT
                                            purchaserequeststbl.PONumber,
                                            purchaserequeststbl._Date,
                                            purchaserequeststbl.Status,
                                            purchaserequeststbl.Remarks,
                                            purchaserequeststbl.BranchCode,
                                            employeetbl.Firstname,
                                            employeetbl.Lastname
                                            FROM purchaserequeststbl
                                            LEFT JOIN employeetbl ON purchaserequeststbl.EmpID = employeetbl.EmpID
                                            WHERE purchaserequeststbl.isAMApproved = '1'
                                            AND purchaserequeststbl.isDeleted = '0'
                                            AND purchaserequeststbl.Status = 'Completed'
                                            ");

                                            foreach ($PendingOrders as $Order) {
                                                $PONumber = $Order['PONumber'];
                                                $_Date = $Order['_Date'];
                                                $Status = $Order['Status'];
                                                $Remarks = $Order['Remarks'];
                                                $Branch = $Order['BranchCode'];
                                                $ContactPerson = $Order['Firstname'] . " " . $Order['Lastname'];

                                                $rnd = rand(1000, 9999);
                                                $hashPONumber = encrypt_decrypt_rnd('encrypt', $PONumber, $rnd);
                                                ?>
                                                <tr>
                                                    <td>
                                                        <input type="hidden" name="PONumber[]" value="<?php echo $PONumber ?>"/>
                                                        <?php echo $PONumber ?>
                                                    </td>
                                                    <td><?php echo $_Date ?></td>
                                                    <td><?php echo $Status ?></td>
                                                    <td><?php echo $Remarks ?></td>
                                                    <td><?php echo $Branch ?></td>
                                                    <td><?php echo $ContactPerson ?></td>
                                                    <td>
                                                        <button class="btn btn-dark" onclick="PODetails(this.value, '<?= @$hashPONumber ?>', '<?= @$rnd ?>');" value="<?= @$PONumber ?>"><i class="fa fa-eye"></i></button>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                            ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- PO Details -->
                                    <div class="modal fade" id="PODetails">

                                    </div>
                                    <!-- /.modal -->
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

<?php
include_once('../js.html');
?>

<!-- Function Script -->
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
</body>
</html>