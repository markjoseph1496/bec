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
<body onload="ConvertToMoney(); imeisn.focus();">

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
                            <?php
                            if (isset($_GET['saved'])) {
                                echo '
                                    <div class="alert alert-success fade in" id="success-alert">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                     <strong><span class="fa fa-info-circle"></span> Transaction successfully added.</strong>
                                    </div>
                                    ';
                            }
                            ?>
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
                                                    <th width="15%">Item</th>
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

                        <!-- ProceedToPaymentModal -->
                        <div class="modal fade" id="PaymentDetails">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header modal-header-success">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title">Payment Details</h4>
                                    </div>
                                    <div class="modal-body">
                                        <h4 class="red"><i>NOTE: Please check all data before you save. This cannot be edited after saving.</i></h4>
                                        <h5 class="red"><i>Asterisk Fields (*) are required to filled up.</i></h5>
                                        <label>Transaction No: 5654987366</label>
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label>OR / SI / CI <span class="red">(*)</span></label>
                                                    <input type="text" class="form-control" name="ORNumber" id="ORNumber" maxlength="9" tabindex="1">
                                                </div>
                                                <div class="form-group">
                                                    <label>Customer Name <span class="red">(*)</span></label>
                                                    <input type="text" class="form-control text-capitalize" name="CName" id="CName" maxlength="50" tabindex="2">
                                                </div>
                                                <div class="form-group">
                                                    <label>Sales Clerk <span class="red">(*)</span></label>
                                                    <select class="form-control" name="SalesClerk" id="SalesClerk" tabindex="3">
                                                        <option value="" selected="selected">Select One</option>
                                                        <option value="MFC">MFC</option>
                                                        <option value="RRG">RRG</option>
                                                        <option value="BDP">BDP</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Cash</label>
                                                    <input type="text" class="form-control" name="Cash" id="Cash" onkeyup="updateBalance();" onfocusout="ConvertToMoney()"
                                                           onClick="this.setSelectionRange(0, this.value.length)" tabindex="4">
                                                </div>
                                                <div class="form-group">
                                                    <label>Credit Card</label>
                                                    <input type="text" class="form-control" name="CreditCard" id="CreditCard" onkeyup="updateBalance();" onfocusout="ConvertToMoney()"
                                                           onClick="this.setSelectionRange(0, this.value.length)" tabindex="5">
                                                </div>
                                            </div>
                                            <div class="col-lg-6" id="divCreditCard" style="display: none;">
                                                <div class="panel panel-info">
                                                    <div class="panel-heading">
                                                        <i class="fa fa-credit-card"></i> For Credit Card
                                                    </div>
                                                    <!-- /.panel-heading -->
                                                    <div class="panel-body" style="height: 310px;">
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label>Cardholder Name <span class="red">(*)</span></label>
                                                                <input type="text" class="form-control text-capitalize" name="CardHolder" id="CardHolder" tabindex="7">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Card Number <span class="red">(*)</span></label>
                                                                <input type="text" class="form-control" name="CardNumber" id="CardNumber" tabindex="8">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Merchant ID <span class="red">(*)</span></label>
                                                                <input type="text" class="form-control" name="MID" id="MID" tabindex="9">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Batch Number <span class="red">(*)</span></label>
                                                                <input type="text" class="form-control" name="BatchNum" id="BatchNum" tabindex="10">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label>Approval Code <span class="red">(*)</span></label>
                                                                <input type="text" class="form-control text-uppercase" name="ApprCode" id="ApprCode" tabindex="11">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Terms <span class="red">(*)</span></label>
                                                                <select class="form-control" name="Terms" id="Terms" tabindex="12">
                                                                    <option value="Debit">Debit</option>
                                                                    <option value="Straight">Straight</option>
                                                                    <option value="3Months">3 Months</option>
                                                                    <option value="6Months">6 Months</option>
                                                                    <option value="12Months">12 Months</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>ID Presented</label>
                                                                <input type="text" class="form-control" name="IDPresented" id="IDPresented" tabindex="13">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3" id="divHomeCredit" style="display: none;">
                                                <div class="panel panel-info">
                                                    <div class="panel-heading">
                                                        <i class="fa fa-credit-card"></i> For Home Credit
                                                    </div>
                                                    <!-- /.panel-heading -->
                                                    <div class="panel-body" style="height: 310px;">
                                                        <div class="form-group">
                                                            <label>Reference Number <span class="red">(*)</span></label>
                                                            <input type="text" class="form-control" name="RefNum" id="RefNum" tabindex="14">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label>Home Credit</label>
                                                    <input type="text" class="form-control" name="HomeCredit" id="HomeCredit" onkeyup="updateBalance();" onfocusout="ConvertToMoney();"
                                                           onClick="this.setSelectionRange(0, this.value.length)" tabindex="6">
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label>Total Amount Tendered</label>
                                                    <input type="text" class="form-control" name="TotalAmountTendered" id="TotalAmountTendered" readonly>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label>Total Amount to pay</label>
                                                    <input type="text" class="form-control" name="TotalAmountToPay" id="TotalAmountToPay" readonly>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label>Change</label>
                                                    <input type="text" class="form-control" name="Balance" id="Balance" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class=col-lg-12>
                                                <div class="panel panel-info">
                                                    <div class="panel-heading">
                                                        <i class="fa fa-table fa-fw"></i> Items
                                                    </div>
                                                    <!-- /.panel-heading -->
                                                    <div class="panel-body" style="height: 300px; overflow-y: scroll;">
                                                        <table class="table table-hover" id="ModalItems">
                                                            <thead>
                                                            <tr>
                                                                <th width="20%">Item Code</th>
                                                                <th width="20%">IMEI / SN</th>
                                                                <th width="20%">Item</th>
                                                                <th width="20%">Brand</th>
                                                                <th width="20%">Unit Price</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <!-- /.panel-body -->
                                                    <div class="panel-footer">
                                                        <b>Total Price: <label id="mPrice">0.00</label></b>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Save</button>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                                <!-- /.modal -->
                            </div>
                        </div>
                    </form>
                    <!--Modal-->
                    <!-- No Item Modal -->
                    <div class="modal fade" id="noItemModal">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header modal-header-danger">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">No items added.</h4>
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

                    <!-- Item Exists Modal -->
                    <div class="modal fade" id="itemExists">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header modal-header-danger">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">Item Already exists</h4>
                                </div>
                                <div class="modal-body">
                                    <p>Please enter other item.</p>
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

                    <!-- No Item From Modal -->
                    <div class="modal fade" id="noItemFromDB">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header modal-header-danger">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">Item Doesn't exists</h4>
                                </div>
                                <div class="modal-body">
                                    <p>Please enter other item.</p>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-default" data-dismiss="modal" id="btnClose">Close</button>
                                </div>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                    <!-- /.modal -->
                    <!--End Modal-->
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
    var ORNumber = document.getElementById('ORNumber');
    var imeisn = document.getElementById('imeisn'); //textfield
    var ModelUnit = document.getElementById('model_name'); //textfield
    var brand = document.getElementById('Brand'); //textfield
    var UnitPrice = document.getElementById('UnitPrice'); //textfield
    var sPrice = document.getElementById("sPrice"); //label of total price
    var hPrice = document.getElementById("hPrice"); //hidden value of total price
    var mPrice = document.getElementById("mPrice"); //label of total price for modal
    var DeleteRow = document.getElementById("Items"); // table name
    var ModalItems = document.getElementById("ModalItems"); // Modal Table
    var AmountToPay = document.getElementById("TotalAmountToPay"); // Amount to pay by customer
    var AmountTendered = document.getElementById("TotalAmountTendered"); //Amount Tendered by customer
    var Balance = document.getElementById("Balance");
    var Cash = document.getElementById("Cash"); //Cash paid by customer
    var Credit = document.getElementById("CreditCard"); //Credit paid by customer
    var HomeCredit = document.getElementById("HomeCredit");  //Home Credit paid by customer
    var arrayImei = ["0"];
    var stPrice = 0;

    $("#success-alert").fadeTo(5000, 500).slideUp(500, function () {
        $("#success-alert").alert('close');
    });

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
                group: 'form-group',
                ORNumber: {
                    validators: {
                        notEmpty: {
                            message: 'This field cannot be empty.'
                        },
                        regexp: {
                            regexp: /^[0-9]+$/,
                            message: 'Invalid Input. Only numerical values are allowed.'
                        }
                    }
                },
                CName: {
                    validators: {
                        notEmpty: {
                            message: 'This field cannot be empty.'
                        },
                        regexp: {
                            regexp: /^[A-Za-z. ]+$/,
                            message: 'Name cannot contain invalid characters.'
                        }
                    }
                },
                SalesClerk: {
                    validators: {
                        notEmpty: {
                            message: 'Please select one.'
                        }
                    }
                },
                CardHolder: {
                    validators: {
                        notEmpty: {
                            message: 'This field cannot be empty.'
                        },
                        identical: {
                            field: 'CName',
                            message: "Cardholder name must be same with Customer name."
                        },
                        regexp: {
                            regexp: /^[A-Za-z. ]+$/,
                            message: 'Name cannot contain invalid characters.'
                        }
                    }
                },
                CardNumber: {
                    validators: {
                        notEmpty: {
                            message: 'This field cannot be empty.'
                        },
                        creditCard: {
                            message: 'Invalid credit card number.'
                        }
                    }
                },
                MID: {
                    validators: {
                        notEmpty: {
                            message: 'This field cannot be empty.'
                        }
                    }
                },
                BatchNum: {
                    validators: {
                        notEmpty: {
                            message: 'This field cannot be empty.'
                        }
                    }
                },
                ApprCode: {
                    validators: {
                        notEmpty: {
                            message: 'This field cannot be empty.'
                        }
                    }
                },
                RefNum: {
                    validators: {
                        notEmpty: {
                            message: 'This field cannot be empty.'
                        }
                    }
                }
            }
        });
    });
</script>