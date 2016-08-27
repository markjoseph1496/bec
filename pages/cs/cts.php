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

    <title>Cash Transactions</title>

    <!-- Bootstrap Core CSS -->
    <link href="../../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- jQuery -->
    <script src="../../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../../dist/js/sb-admin-2.js"></script>

    <!-- Accounting.js -->
    <script src="../../js/accounting.min.js"></script>
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
                    <h1 class="page-header">Transactions</h1>
                    <h3>View transactions</h3>
                    <div class="row">
                        <div class="col-lg-3 col-md-6">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-list-alt fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <div class="huge">Units</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="tcash.php">
                                    <div class="panel-footer">
                                        <span class="pull-left">View Transactions</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6">
                            <div class="panel panel-yellow">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-list-alt fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <div class="huge">BM Accent</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="tbmaccent.php">
                                    <div class="panel-footer">
                                        <span class="pull-left">View Transactions</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6">
                            <div class="panel panel-green">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-list-alt fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <div class="huge">Quantum</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="tquantum.php">
                                    <div class="panel-footer">
                                        <span class="pull-left">View Transactions</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6">
                            <div class="panel panel-red">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-list-alt fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <div class="huge">Units</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="tcredit.php">
                                    <div class="panel-footer">
                                        <span class="pull-left">View Transactions</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <h3>Add transaction</h3>
                    <div class="row">
                        <div class="col-lg-3 col-md-6">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-list-ul fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <div class="huge">Units</div>
                                        </div>
                                    </div>
                                </div>
                                <a data-toggle="modal" data-target="#unitcash">
                                    <div class="panel-footer">
                                        <span class="pull-left">Add Cash Transaction</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>

                        <!-- Modal -->
                        <form method="POST" name="frmUnitsCash" id="frmUnitsCash">
                            <input type="hidden" value="<?php echo $Cashier ?>" name="Cashier">
                            <input type="hidden" value="<?php echo $BranchCode ?>" name="BranchCode">
                            <div class="modal fade" id="unitcash" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">Add Cash Transaction</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-lg-12 col-xs-12">
                                                    <div class="form-group">
                                                        <label>OR Number</label>
                                                        <input class="form-control" name="ORNumber" id="ORNumber" required>
                                                        <p class="help-block">Ex. 84956</p>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Customer Name</label>
                                                        <input class="form-control" name="CName" id="CName" required>
                                                        <p class="help-block">Ex. Juan Dela Cruz</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-4 col-xs-4">
                                                    <div class="form-group">
                                                        <label>Model / Unit</label>
                                                        <select class="form-control" id="model_name" name="model_name" onchange="trans()" required>
                                                            <option selected value="">Please select one</option>
                                                            <?php
                                                            $models =
                                                                GSecureSQL::query(
                                                                    "SELECT * FROM unitstbl",
                                                                    TRUE
                                                                );

                                                            foreach ($models as $value) {
                                                                $Model = $value[1];
                                                                echo "<option value='$Model'>" . $Model . "</option>";

                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Price</label>
                                                        <input type="text" class="form-control" readonly name="Price" id="Price">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Quantity</label>
                                                        <input type="number" min="1" max="20" class="form-control" id="Quantity" name="Quantity" onchange="trans()" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Total Price</label>
                                                        <input type="text" class="form-control" readonly name="TotalPrice" id="TotalPrice">
                                                    </div>
                                                    <div class="form-group">
                                                        <button type="button" class="btn btn-primary" onclick="btn()" id="btnAdd">Add Item</button>
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
                                                                <div class="panel-body" style="height: 250px; overflow-y: scroll;">
                                                                    <table class="table table-hover" id="test">
                                                                        <thead>
                                                                        <tr>
                                                                            <th width="40%">Model / Unit</th>
                                                                            <th width="20%">Unit Price</th>
                                                                            <th width="10%">Qty</th>
                                                                            <th width="20%">Total Price</th>
                                                                        </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                        <?php
                                                                            $tmpsales =
                                                                                GSecureSQL::query(
                                                                                    "SELECT Unit, Price, Qty, TotalPrice FROM tmpsales WHERE BranchCode = ? AND Cashier = ?",
                                                                                    TRUE,
                                                                                    "ss",
                                                                                    $BranchCode,
                                                                                    $Cashier
                                                                                );
                                                                            foreach ($tmpsales as $val){
                                                                                $Unit = $val[0];
                                                                                $Price = $val[1];
                                                                                $Qty = $val[2];
                                                                                $TotalPrice = $val[3];
                                                                                ?>
                                                                                <tr>
                                                                                    <td><?php echo $Unit ?></td>
                                                                                    <td><?php echo $Price ?></td>
                                                                                    <td><?php echo $Qty ?></td>
                                                                                    <td><?php echo $TotalPrice ?></td>
                                                                                </tr>
                                                                        <?php
                                                                            }
                                                                        ?>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                                <!-- /.panel-body -->
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary" id="btnSubmit">Submit</button>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                        </form>
                        <!-- /.modal -->

                        <div class="col-lg-3 col-md-6">
                            <div class="panel panel-yellow">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-list-ul fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <div class="huge">BM Accent</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="#">
                                    <div class="panel-footer">
                                        <span class="pull-left">Add Cash Transaction</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6">
                            <div class="panel panel-green">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-list-ul fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <div class="huge">Quantum</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="#">
                                    <div class="panel-footer">
                                        <span class="pull-left">Add Cash Transaction</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6">
                            <div class="panel panel-red">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-list-ul fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <div class="huge">Units</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="#">
                                    <div class="panel-footer">
                                        <span class="pull-left">Add Credit Transaction</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.col-lg-12 -->
            </div>
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->
</body>
</html>
<script type="text/javascript">
    var ModelUnit = document.getElementById("model_name");
    var Qty = document.getElementById('Quantity');
    var Price = document.getElementById('Price');
    var TotalPrice = document.getElementById('TotalPrice');
    document.getElementById("Quantity").disabled = true;
    document.getElementById("btnAdd").disabled = true;
    var arrayq = ["Banana", "Orange", "Apple", "Mango"];

    function btn() {
        $.post('../../dd.php',
            $('#frmUnitsCash').serialize());

        /*
         var jsonString = JSON.stringify(arrayq);
         $.ajax({
         type: "POST",
         url: "../../dd.php",
         data: {data: jsonString},
         cache: false,

         success: function (data) {
         alert(data);
         }
         });
         */
    }

    function refreshtable(){
        $('#test').load('cts.php #test');
    }

    setInterval(function(){
        refreshtable();
    }, 500);


    function trans() {
        if (ModelUnit.value != "") {
            var selectedString = ModelUnit.options[ModelUnit.selectedIndex].value;
            var data = {id: selectedString};
            $.post('../../get.php', data, function (data) {
                var price = data;
                var Qty = document.getElementById('Quantity').value;
                Price.value = accounting.formatNumber(price, 2, ",", ".");
                var tp = price * Qty;
                tp = accounting.formatNumber(tp, 2, ",", ".");
                TotalPrice.value = tp;
                document.getElementById("Quantity").disabled = false;
            });
        } else {
            Qty.value = "";
            Price.value = "";
            TotalPrice.value = "";
            document.getElementById("Quantity").disabled = true;
        }

        if (ModelUnit.value != "" && Qty.value != "") {
            document.getElementById("btnAdd").disabled = false;
            document.getElementById("Quantity").disabled = false;
        } else {
            document.getElementById("btnAdd").disabled = true;
            document.getElementById("Quantity").disabled = true;
        }
    }
</script>