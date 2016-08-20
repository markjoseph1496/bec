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
                <li role="presentation"><a href="Cash.php">D2 Cash</a></li>
                <li class="active" role="presentation"><a href="CreditCard.php">D2 Credit</a></li>
                <li role="presentation"><a href="#">D3 Units</a></li>
            </ul>
        </div>
    </div>
</nav>

<form method="POST" name="frmSubmit" id="frmSubmit" action="#">
    <div id="content">
        <div class="container">
            <div class="big-title text-center">
                <h1><strong>D2 Credit Card (OPPO)</strong></h1>
            </div>
            <br>
            <div class="row">
                <div class="col-md-6">
                    <label>CI. Number</label>
                    <div class="form-group">
                        <input type="text" class="form-control" id="ORNumber" name="ORNumber">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label>Customer Name</label>
                    <div class="form-group">
                        <div class="controls">
                            <input type="text" class="form-control" name="Birthday" id="Birthday">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <label>Model Unit 1</label>
                    <div class="form-group">
                        <div class="controls">
                            <select id="ModelUnit[]" name="ModelUnit[]" class="form-control" style="width:100%; height:34px;">
                                <option value="">- Please select one -</option>
                                <option value="Caloocan City">Caloocan City</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-1">
                    <label>Quantity</label>
                    <div class="form-group">
                        <div class="controls">
                            <input type="number" class="form-control" name="Quantity[]" id="Quantity[]" min="1" max="50">
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <label>Total Price</label>
                    <div class="form-group">
                        <div class="controls">
                            <input type="text" class="form-control" name="TotalPrice[]" id="TotalPrice[]" disabled>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <label>Model Unit 2</label>
                    <div class="form-group">
                        <div class="controls">
                            <select id="ModelUnit[]" name="ModelUnit[]" class="form-control" style="width:100%; height:34px;">
                                <option value="">- Please select one -</option>
                                <option value="Caloocan City">Caloocan City</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-1">
                    <label>Quantity</label>
                    <div class="form-group">
                        <div class="controls">
                            <input type="number" class="form-control" name="Quantity[]" id="Quantity[]" min="1" max="50">
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <label>Total Price</label>
                    <div class="form-group">
                        <div class="controls">
                            <input type="text" class="form-control" name="TotalPrice[]" id="TotalPrice[]" disabled>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <label>Model Unit 3</label>
                    <div class="form-group">
                        <div class="controls">
                            <select id="ModelUnit[]" name="ModelUnit[]" class="form-control" style="width:100%; height:34px;">
                                <option value="">- Please select one -</option>
                                <option value="Caloocan City">Caloocan City</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-1">
                    <label>Quantity</label>
                    <div class="form-group">
                        <div class="controls">
                            <input type="number" class="form-control" name="Quantity[]" id="Quantity[]" min="1" max="50">
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <label>Total Price</label>
                    <div class="form-group">
                        <div class="controls">
                            <input type="text" class="form-control" name="TotalPrice[]" id="TotalPrice[]" disabled>
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
    $("#hiddendiv").hide()
    $("#CBDownPayment").click(function() {
        if($(this).is(":checked")) {
            $("#hiddendiv").show(300);
        } else {
            $("#hiddendiv").hide(200);
        }
    });
</script>