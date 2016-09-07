<?php
include('../../connection.php');

$Cashier = "MFC";
$BranchCode = "B009";

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Transactions</title>

    <!-- Bootstrap Core CSS -->
    <link href="../../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- bootstrap validator -->
    <link href="../../dist/css/bootstrapValidator.min.css" rel="stylesheet" type="text/css">

    <!-- jQuery -->
    <script src="../../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../../dist/js/sb-admin-2.js"></script>

    <!-- Accounting.js -->
    <script src="../../dist/js/accounting.min.js"></script>

    <!-- Bootstrap Validator -->
    <script src="../../dist/js/bootstrapValidator.min.js"></script>

    <!-- Function -->
    <script src="js/addcash.js"></script>


</head>
<body onload="imeisn.focus();">

<div id="wrapper">
    <?php
    include('navigation.html');
    ?>
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Add Transaction</h1>
                    <form method="POST" name="frmUnitsCash" id="frmUnitsCash" action="functions/addtransaction.php" onkeypress="return noenter(event)">
                        <input type="hidden" value="<?php echo $Cashier ?>" name="Cashier">
                        <input type="hidden" value="<?php echo $BranchCode ?>" name="BranchCode">
                        <div class="row">
                            <div class="col-lg-4 col-xs-12">
                                <div class="form-group">
                                    <label>Enter IMEI / SN:</label>
                                    <input type="hidden" class="form-control" name="ItemCode" id="ItemCode">
                                    <input type="text" class="form-control" name="imeisn" id="imeisn" onkeypress="return checkImeiSN(event)" maxlength="15">
                                    <input type="hidden" class="form-control" name="model_name" id="model_name">
                                    <input type="hidden" class="form-control" name="Brand" id="Brand">
                                    <input type="hidden" class="form-control" name="UnitPrice" id="UnitPrice">
                                </div>
                                <div class="form-group">
                                    <a class="btn btn-primary" onclick="ProceedToPayment();">Proceed to payment</a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-xs-12">
                                    <div class="panel panel-info">
                                        <div class="panel-heading">
                                            <i class="fa fa-table fa-fw"></i> Items
                                        </div>
                                        <!-- /.panel-heading -->
                                        <div class="panel-body" style="height: 300px; overflow-y: scroll;" id="testssss">
                                            <table class="table table-hover" id="Items">
                                                <thead>
                                                <tr>
                                                    <th width="15%">Item Code</th>
                                                    <th width="20%">IMEI / SN</th>
                                                    <th width="15%">Model / Unit</th>
                                                    <th width="15%">Brand</th>
                                                    <th width="15%">Unit Price</th>
                                                    <th width="20%">Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- /.panel-body -->
                                        <div class="panel-footer">
                                            <b>Total Price: <label id="sPrice">0.00</label></b>
                                            <input type="hidden" id="hPrice" name="hPrice" value="0">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Modal-->
                        <div class="modal fade" id="errorModal">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header modal-header-danger">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title">No item(s) added.</h4>
                                    </div>
                                    <div class="modal-body">
                                        <p>Please add item(s) before you can proceed to payment.</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                        <!-- /.modal -->
                        <!--End Modal-->
                    </form>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->
</body>
</html>
<script type="text/javascript">
    var itemCode = document.getElementById('ItemCode'); //textfield
    var imeisn = document.getElementById('imeisn'); //textfield
    var ModelUnit = document.getElementById('model_name'); //textfield
    var brand = document.getElementById('Brand'); //textfield
    var UnitPrice = document.getElementById('UnitPrice'); //textfield
    var sPrice = document.getElementById("sPrice"); //label of total price
    var hPrice = document.getElementById("hPrice"); //hidden value of total price
    var DeleteRow = document.getElementById("Items"); // table name
    var arrayImei = ["0"];

/*
    $(document).ready(function () {
        $('#frmUnitsCash').bootstrapValidator({
//        live: 'disabled',
            message: 'This value is not valid',
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                imeisn: {
                    group: '.form-group',
                    validators: {
                        notEmpty: {
                            message: 'The last name is required and cannot be empty'
                        }
                    }
                }
            }
        });
    });
    */
</script>