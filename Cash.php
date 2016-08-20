<?php
include('connection.php');

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Berlein Electronics Corp.</title>

    <link href="css/bootstrap.min.css" rel="stylesheet"/>
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/user.css">

    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css" media="screen">

    <!-- Fonts -->
    <link rel="stylesheet" type="text/css" href="fonts/ffonts/montserrat.css">
    <link rel="stylesheet" type="text/css" href="fonts/ffonts/open-sans.css">

    <!-- Slicknav -->
    <link rel="stylesheet" type="text/css" href="css/slicknav.css" media="screen">

    <!-- Margo CSS Styles  -->
    <link rel="stylesheet" type="text/css" href="css/style.css" media="screen">

    <!-- Responsive CSS Styles  -->
    <link rel="stylesheet" type="text/css" href="css/responsive.css" media="screen">

    <!-- Css3 Transitions Styles  -->
    <link rel="stylesheet" type="text/css" href="css/animate.css" media="screen">

    <!-- OJPMS CSS  -->
    <link rel="stylesheet" type="text/css" href="css/ojpms-style.css" media="screen">

    <!-- Color CSS Styles  -->
    <link rel="stylesheet" type="text/css" href="css/colors/yellow.css" title="yellow" media="screen"/>

    <!-- Checkbox -->
    <link rel="stylesheet" type="text/css" href="css/checkbox.css" media="screen"/>
</head>

<body>
<nav class="navbar navbar-default" style="background-color: #ABABAB">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navcol-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand navbar-link" href="#">Berlein Electronics Corp.</a></div>
        <div class="collapse navbar-collapse" id="navcol-1">
            <ul class="nav navbar-nav">
                <li class="active" role="presentation"><a href="Cash.php">D2 Cash</a></li>
                <li role="presentation"><a href="CreditCard.php">D2 Credit</a></li>
                <li role="presentation"><a href="#">D3 Units</a></li>
            </ul>
        </div>
    </div>
</nav>

<form method="POST" name="frmSubmitCash" id="frmSubmitCash" action="Transactions.php">
    <div id="content">
        <div class="container">
            <div class="big-title text-center">
                <h1><strong>D2 Cash (OPPO)</strong></h1>
            </div>
            <br>
            <div class="row">
                <div class="col-md-6">
                    <label>OR. Number</label>
                    <div class="form-group">
                        <input type="hidden" name="Cash" value="Cash">
                        <input type="text" class="form-control" id="ORNumber" name="ORNumber" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label>Customer Name</label>
                    <div class="form-group">
                        <div class="controls">
                            <input style="text-transform: capitalize" type="text" class="form-control" name="CustomerName" id="CustomerName" required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <label>Model Unit 1</label>
                    <div class="form-group">
                        <div class="controls">
                            <select id="ModelUnit1" name="ModelUnit1" class="form-control" style="width:100%; height:34px;" required>
                                <option value="">- Please select one -</option>
                                <?php
                                $ModelUnit1 =
                                    GSecureSQL::query(
                                        "SELECT Model FROM unitstbl WHERE Brand = 'Oppo'",
                                        TRUE
                                    );
                                foreach($ModelUnit1 as $value1){
                                    $ModelUnit = $value1[0];
                                    ?>
                                    <option value="<?php echo $ModelUnit; ?>"><?php echo $ModelUnit; ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-1">
                    <label>Quantity</label>
                    <div class="form-group">
                        <div class="controls">
                            <input type="hidden" name="Price1" id="Price1">
                            <input type="number" class="form-control" name="Quantity1" id="Quantity1" min="1" max="50" required>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <label>Total Price</label>
                    <div class="form-group">
                        <div class="controls">
                            <input type="hidden" id="TotalPrice1hid" name="TotalPrice1hid" value="">
                            <input type="text" class="form-control" name="TotalPrice1" id="TotalPrice1" disabled>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <label>Model Unit 2</label>
                    <div class="form-group">
                        <div class="controls">
                            <select id="ModelUnit2" name="ModelUnit2" class="form-control" style="width:100%; height:34px;">
                                <option value="">- Please select one -</option>
                                <?php
                                $ModelUnit2 =
                                    GSecureSQL::query(
                                        "SELECT Model FROM unitstbl WHERE Brand = 'Oppo'",
                                        TRUE
                                    );
                                foreach($ModelUnit2 as $value1){
                                    $ModelUnit = $value1[0];
                                    ?>
                                    <option value="<?php echo $ModelUnit; ?>"><?php echo $ModelUnit; ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-1">
                    <label>Quantity</label>
                    <div class="form-group">
                        <div class="controls">
                            <input type="hidden" id="TotalPrice2hid" name="TotalPrice2hid" value="">
                            <input type="number" class="form-control" name="Quantity2" id="Quantity2" min="1" max="50">
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <label>Total Price</label>
                    <div class="form-group">
                        <div class="controls">
                            <input type="text" class="form-control" name="TotalPrice2" id="TotalPrice2" disabled>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <label>Model Unit 3</label>
                    <div class="form-group">
                        <div class="controls">
                            <select id="ModelUnit3" name="ModelUnit3" class="form-control" style="width:100%; height:34px;">
                                <option value="" selected="selected">- Please select one -</option>
                                <?php
                                    $ModelUnit3 =
                                        GSecureSQL::query(
                                            "SELECT Model FROM unitstbl WHERE Brand = 'Oppo'",
                                            TRUE
                                        );
                                        foreach($ModelUnit3 as $value1){
                                            $ModelUnit = $value1[0];
                                            ?>
                                            <option value="<?php echo $ModelUnit; ?>"><?php echo $ModelUnit; ?></option>
                                            <?php
                                        }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-1">
                    <label>Quantity</label>
                    <div class="form-group">
                        <div class="controls">
                            <input type="number" class="form-control" name="Quantity3" id="Quantity3" min="1" max="50">
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <label>Total Price</label>
                    <div class="form-group">
                        <div class="controls">
                            <input type="hidden" id="TotalPrice3hid" name="TotalPrice3hid" value="">
                            <input type="text" class="form-control" name="TotalPrice3" id="TotalPrice3" disabled>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2" id="hiddendiv">
                    <input type="text" class="form-control" name="Downpayment" id="Downpayment">
                </div>
                <div class="col-md-2">
                    <div class="checkbox">
                        <input id="CBDownPayment" class="styled" type="checkbox">
                        <label for="CBDownPayment"><b>With Downpayment?</b></label>
                    </div>
                </div>

            </div>
            <br><br>
            <div class="row">
                <div class="col-md-3">
                    <button type="submit" name="btnSave" class="btn-system btn-large border-btn" style="float:left;">Submit</button>
                </div>
            </div>
        </div>
        <div class="hr5" style="margin-top:40px;margin-bottom:40px;"></div>
    </div>
</form>
</body>
</html>
<script type="text/javascript">
    $("#hiddendiv").hide();
    $("#CBDownPayment").click(function () {
        if ($(this).is(":checked")) {
            $("#hiddendiv").show(300);
        } else {
            $("#hiddendiv").hide(200);
        }
    });


    var ModelUnit1 = document.getElementById("ModelUnit1");
    ModelUnit1.onchange = function(){
        var selectedString1 = ModelUnit1.options[ModelUnit1.selectedIndex].value;
        var data = {id:selectedString1};
        $.post('geta.php',data,function(data){
        var price = data;
            var Qty = document.getElementById('Quantity1').value;
            var TP = document.getElementById('TotalPrice1');
            var TPhid = document.getElementById('TotalPrice1hid');
            var TP1 = price * Qty;
            TP.value = TP1;
            TPhid.value = TP1;

        });
    }

    var quantity1 = document.getElementById("Quantity1");
    quantity1.onchange = function(){
        var selectedString1 = ModelUnit1.options[ModelUnit1.selectedIndex].value;
        var data = {id:selectedString1};
        $.post('geta.php',data,function(data){
            var price = data;
            var Qty = document.getElementById('Quantity1').value;
            var TP = document.getElementById('TotalPrice1');
            var TPhid = document.getElementById('TotalPrice1hid');
            var TP1 = price * Qty;
            TP.value = TP1;
            TPhid.value = TP1;

        });
    }


    var ModelUnit2 = document.getElementById("ModelUnit2");
    ModelUnit2.onchange = function(){
        var selectedString2 = ModelUnit2.options[ModelUnit2.selectedIndex].value;
        var data = {id:selectedString2};
        $.post('geta.php',data,function(data){
            var price = data;
            var Qty = document.getElementById('Quantity2').value;
            var TP = document.getElementById('TotalPrice2');
            var TPhid = document.getElementById('TotalPrice2hid');
            var TP2 = price * Qty;
            TP.value = TP2;
            TPhid.value = TP2;

        });
    }

    var quantity2 = document.getElementById("Quantity2");
    quantity2.onchange = function(){
        var selectedString2 = ModelUnit2.options[ModelUnit2.selectedIndex].value;
        var data = {id:selectedString2};
        $.post('geta.php',data,function(data){
            var price = data;
            var Qty = document.getElementById('Quantity2').value;
            var TP = document.getElementById('TotalPrice2');
            var TPhid = document.getElementById('TotalPrice2hid');
            var TP2 = price * Qty;
            TP.value = TP2;
            TPhid.value = TP2;

        });
    }


    var ModelUnit3 = document.getElementById("ModelUnit3");
    ModelUnit3.onchange = function(){
        var selectedString3 = ModelUnit3.options[ModelUnit3.selectedIndex].value;
        var data = {id:selectedString3};
        $.post('geta.php',data,function(data){
            var price = data;
            var Qty = document.getElementById('Quantity3').value;
            var TP = document.getElementById('TotalPrice3');
            var TPhid = document.getElementById('TotalPrice3hid');
            var TP3 = price * Qty;
            TP.value = TP3;
            TPhid.value = TP3;

        });
    }

    var quantity3 = document.getElementById("Quantity3");
    quantity3.onchange = function(){
        var selectedString3 = ModelUnit3.options[ModelUnit3.selectedIndex].value;
        var data = {id:selectedString3};
        $.post('geta.php',data,function(data){
            var price = data;
            var Qty = document.getElementById('Quantity3').value;
            var TP = document.getElementById('TotalPrice3');
            var TPhid = document.getElementById('TotalPrice3hid');
            var TP3 = price * Qty;
            TP.value = TP3;
            TPhid.value = TP3;

        });
    }

</script>