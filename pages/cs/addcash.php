<?php
include('../../connection.php');

$Cashier = "MFC";
$BranchCode = "B000";

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
</head>
<body>

<div id="wrapper">

    <?php
    include('navigation.html');
    ?>
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Add Cash Transaction</h1>
                    <form method="POST" name="frmUnitsCash" id="frmUnitsCash" action="a.php">
                        <input type="hidden" value="<?php echo $Cashier ?>" name="Cashier">
                        <input type="hidden" value="<?php echo $BranchCode ?>" name="BranchCode">
                        <div class="row">
                            <div class="col-lg-4 col-xs-4">
                                <div class="form-group">
                                    <label>OR Number</label>
                                    <input class="form-control" name="ORNumber" id="ORNumber" maxlength="9">
                                </div>
                                <div class="form-group">
                                    <label>Customer Name</label>
                                    <input class="form-control" name="CName" id="CName" maxlength="50" style="text-transform: capitalize">
                                </div>
                                <div class="form-group">
                                    <label>IMEI / SN</label>
                                    <input type="hidden" class="form-control" name="ItemCode" id="ItemCode">
                                    <input type="text" class="form-control" name="imeisn" id="imeisn" onkeypress="checkImeiSN()" maxlength="15">
                                    <input type="hidden" class="form-control" name="model_name" id="model_name">
                                    <input type="hidden" class="form-control" name="Brand" id="Brand">
                                    <input type="hidden" class="form-control" name="UnitPrice" id="UnitPrice">
                                </div>

                            </div>
                            <div class="col-lg-8 col-xs-8">
                                <div class="row">
                                    <div class="col-lg-12 col-xs-12">
                                        <div class="panel panel-info">
                                            <div class="panel-heading">
                                                <i class="fa fa-table fa-fw"></i> Items
                                            </div>
                                            <!-- /.panel-heading -->
                                            <div class="panel-body" style="height: 400px; overflow-y: scroll;">
                                                <table class="table table-hover" id="Items">
                                                    <thead>
                                                    <tr>
                                                        <th width="15%">Item Code</th>
                                                        <th width="20%">IMEI / SN</th>
                                                        <th width="20%">Model / Unit</th>
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
                                                <b>Total Price: <label id="sPrice">0.00</label></b>
                                                <input type="hidden" id="hPrice" name="hPrice" value="0">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- /.modal -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
        <br><br><br><br>
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
    var arrayImei = ["0"];

    function checkimei(){
        var b = arrayImei.indexOf(imeisn.value);
        if(b == -1){
            arrayImei.push(imeisn.value);
            addItem();
        }
        else{
            imeisn.value = "";
            alert('bawal to i add');
        }
    }

    function addItem() {
        var data = $('#imeisn, #ItemCode, #model_name, #Brand, #UnitPrice');
        var row = $('<tr>');
        for (var i = 0; i < data.length; i++) {
            $('<td>').text(data[i].value).appendTo(row);
        }

        $('<input type="hidden" name="tItemCode[]">').val(data[0].value).appendTo(row);
        $('<input type="hidden" name="timeisn[]">').val(data[1].value).appendTo(row);
        $('<input type="hidden" name="tmodel_name[]">').val(data[2].value).appendTo(row);
        $('<input type="hidden" name="tBrand[]">').val(data[3].value).appendTo(row);
        $('<input type="hidden" name="tUnitPrice[]">').val(data[4].value).appendTo(row);
        row.appendTo('#Items');

        var tPrice = document.getElementsByName('tUnitPrice[]'); //value of unit price on table

        itemCode.value = "";
        imeisn.value = "";
        ModelUnit.value = "";
        brand.value = "";
        UnitPrice.value = "";

        var stPrice = 0;


        for (i = 0; i < tPrice.length; i++) {
            stPrice = parseFloat(stPrice) + parseFloat(tPrice[i].value.replace(/,/g, ''));
        }
        stPrice = accounting.formatNumber(stPrice, 2, ",", ".");
        sPrice.textContent = stPrice;
        hPrice.value = stPrice;

    }

    function checkImeiSN() {
        var imeisnlength = imeisn.value.length;
        if (imeisnlength == 15) {
            $.ajax({
                type: 'POST',
                url: 'functions/checkimeisn.php',
                data: 'imeisn=' + imeisn.value,
                success: function (data) {
                    var result = $.parseJSON(data);
                    if (result.Count == 0) {
                        alert('walang item ito');
                        imeisn.value = "";
                    } else {
                        itemCode.value = result.rItemCode;
                        ModelUnit.value = result.rModelName;
                        brand.value = result.rBrand;
                        UnitPrice.value = accounting.formatNumber(result.rUnitPrice, 2, ",", ".");
                        checkimei()

                    }
                }
            })
        }
    }

    /*
     // Bootstrap Validator
     $(document).ready(function () {
     var validator = $("#frmUnitsCash").bootstrapValidator({
     feedbackIcons: {
     valid: "glyphicon glyphicon-ok",
     invalid: "glyphicon glyphicon-remove",
     validating: "glyphicon glyphicon-refresh"
     },
     fields: {
     CName: {
     validators: {
     notEmpty: {
     message: "Customer name is required."
     },
     regexp: {
     regexp: /^[a-zA-Z .]+$/,
     message: "Invalid name."
     }
     }
     },
     ORNumber: {
     validators: {
     notEmpty: {
     message: "OR number is required"
     },
     regexp: {
     regexp: /^[0-9]+$/,
     message: "Invalid OR number."
     }
     }
     }
     }
     });
     });

     */
</script>