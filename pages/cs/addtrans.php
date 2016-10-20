<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Purchase Request</title>
    <link rel="shortcut icon" href="../../img/B%20LOGO%20BLACK.png">

    <link rel="import" href="../css.html">

</head>

<body class="nav-md" onload="$('#ImeiSN').focus(); aModeOfPayment();">
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
                        <h3>Transactions</h3>
                    </div>
                </div>

                <div class="clearfix"></div>

                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Sales</h2>
                                <div class="clearfix"></div>
                            </div>
                            <form method="POST" name="frmSaleItem" id="frmSaleItem" action="php/function.php" autocomplete="off" onkeypress="return noenter(event)">
                                <div class="col-md-8 col-xs-12 col-sm-12">
                                    <div class="x_panel">
                                        <div class="x_content">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <div class="row">
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <label>Enter IMEI / SN / PDC</label>
                                                                <input type="text" class="form-control" name="ImeiSN" id="ImeiSN" onkeypress="return addSaleItem(event)">
                                                                <input type="hidden" id="ItemCode">
                                                                <input type="hidden" id="ModelName">
                                                                <input type="hidden" id="ItemColor">
                                                                <input type="hidden" id="Description">
                                                                <input type="hidden" id="SRP">
                                                                <input type="hidden" id="Category">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Panel -->
                                                    <div class="panel panel-info">
                                                        <div class="panel-heading">
                                                            <i class="fa fa-shopping-cart fa-fw"></i> <b>Items</label></b>
                                                        </div>
                                                        <!-- /.panel-heading -->
                                                        <div class="panel-body" style="height: 400px; overflow-y: scroll;">
                                                            <table id="ItemsToOrder" class="table table-striped table-bordered">
                                                                <thead>
                                                                <tr>
                                                                    <th width="1%"></th>
                                                                    <th>Item Name</th>
                                                                    <th>Price</th>
                                                                    <th>Qty.</th>
                                                                    <th>Total</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-4" style="float: right;">
                                                            <label for="AmountTendered">Total Amount Tendered</label>
                                                            <input type="text" class="form-control" id="AmountTendered" readonly value="0.00">
                                                            <br>
                                                            <label for="AmountToPay">Total Amount to Pay</label>
                                                            <input type="text" class="form-control" id="AmountToPay" readonly value="0.00">
                                                            <br>
                                                            <label for="Change">Change</label>
                                                            <input type="text" class="form-control" id="Change" readonly value="0.00">
                                                        </div>
                                                    </div>
                                                    <!-- End Panel -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4" style="float: right">
                                    <div class="x_panel">
                                        <div class="x_title">
                                            <label>Payment Details</label>
                                        </div>
                                        <div class="form-group">
                                            <label>OR / SI / CI <span class="red"> (*)</span></label>
                                            <input type="text" class="form-control" id="ORNumber" name="ORNumber">
                                        </div>
                                        <div class="form-group">
                                            <label>Customer Name<span class="red"> (*)</span></label>
                                            <input type="text" class="form-control" id="CustomerName" name="CustomerName" style="text-transform: capitalize">
                                        </div>
                                        <div class="form-group">
                                            <label>Sales Clerk<span class="red"> (*)</span></label>
                                            <select class="form-control" id="SalesClerk" name="SalesClerk">
                                                <option value="">- Select One -</option>
                                                <?php
                                                $getSalesClerk = db_select("SELECT `Initials`,`EmpID` FROM `employeetbl` WHERE `Position` = 'Sales Clerk' AND `BranchID` = " . db_quote($BranchID));

                                                foreach ($getSalesClerk as $SC) {
                                                    $Initials = $SC['Initials'];
                                                    $scEmpID = $SC['EmpID'];
                                                    ?>
                                                    <option value="<?= @$scEmpID ?>"><?= @$Initials ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Mode of payment <span class="red"> (*)</span></label>
                                            <select class="form-control" id="ModeOfPayment" name="ModeOfPayment" onchange="aModeOfPayment();">
                                                <option value="Cash">Cash</option>
                                                <option value="Credit Card">Credit Card</option>
                                                <option value="Home Credit">Home Credit</option>
                                                <option value="HomeCredit Credit Card">Home Credit + Credit Card</option>
                                                <option value="Cash CreditCard">Cash + Credit Card</option>
                                                <option value="Cash Home Credit">Cash + Home Credit</option>
                                                <option value="Cash CreditCard Home Credit">Cash + Credit Card + Home Credit</option>
                                            </select>
                                        </div>
                                        <!-- Div for Cash Transaction -->
                                        <div class="x_panel" id="DivCash">
                                            <div class="x_title">
                                                <label>Cash</label>
                                            </div>
                                            <div class="form-group">
                                                <label>Amount Tendered<span class="red"> (*)</span></label>
                                                <input type="text" class="form-control" id="Cash" name="Cash" onblur="ConvertToMoney()" onClick="this.setSelectionRange(0, this.value.length)" value="0.00">
                                            </div>
                                        </div>

                                        <!-- Div for Credit Card Transaction -->
                                        <div class="x_panel" id="divCreditCard" style="display: none">
                                            <div class="x_title">
                                                <label>Credit Card</label>
                                            </div>
                                            <div class="form-group">
                                                <label>Amount Tendered<span class="red"> (*)</span></label>
                                                <input type="text" class="form-control" id="CreditCard" name="CreditCard" onblur="ConvertToMoney()" onClick="this.setSelectionRange(0, this.value.length)" value="0.00">
                                            </div>
                                            <div class="form-group">
                                                <label>Cardholder Name<span class="red"> (*)</span></label>
                                                <input type="text" class="form-control" id="CardHolderName" name="CardHolderName" style="text-transform: capitalize;">
                                            </div>
                                            <div class="form-group">
                                                <label>Card Number<span class="red"> (*)</span></label>
                                                <input type="text" class="form-control" id="CardNumber" name="CardNumber">
                                            </div>
                                            <div class="form-group">
                                                <label>Merchant ID<span class="red"> (*)</span></label>
                                                <input type="text" class="form-control" id="MID" name="MID">
                                            </div>
                                            <div class="form-group">
                                                <label>Batch Number<span class="red"> (*)</span></label>
                                                <input type="text" class="form-control" id="BatchNum" name="BatchNum">
                                            </div>
                                            <div class="form-group">
                                                <label>Approval Code<span class="red"> (*)</span></label>
                                                <input type="text" class="form-control" id="ApprCode" name="ApprCode">
                                            </div>
                                            <div class="form-group">
                                                <label>Terms<span class="red"> (*)</span></label>
                                                <select class="form-control" name="Terms" id="Terms">
                                                    <option value="">- Select One -</option>
                                                    <option value="Debit">Debit</option>
                                                    <option value="Straight">Straight</option>
                                                    <option value="3 Months">3 Months</option>
                                                    <option value="6 Months">6 Months</option>
                                                    <option value="9 Months">9 Months</option>
                                                    <option value="12 Months">12 Months</option>

                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>ID Presented</span></label>
                                                <input type="text" class="form-control" id="IDPresented" name="IDPresented">
                                            </div>
                                        </div>

                                        <!-- Div for Home Credit Transaction -->
                                        <div class="x_panel" id="divHomeCredit" style="display: none">
                                            <div class="x_title">
                                                <label>Home Credit</label>
                                            </div>
                                            <div class="form-group">
                                                <label>Amount Tendered<span class="red"> (*)</span></label>
                                                <input type="text" class="form-control" id="HomeCredit" name="HomeCredit" onblur="ConvertToMoney()" onClick="this.setSelectionRange(0, this.value.length)" value="0.00">
                                            </div>
                                            <div class="form-group">
                                                <label>Reference No.<span class="red"> (*)</span></label>
                                                <input type="text" class="form-control" id="ReferenceNo" name="ReferenceNo">
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-dark" style="float: right"><i class="fa fa-credit-card"></i> Submit Payment</button>
                                    </div>
                                </div>
                            </form>

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

                            <!-- Check Before Submit Modal -->
                            <div class="modal fade" id="CheckItems">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header modal-header-dark">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title">Save Transaction?</h4>
                                        </div>
                                        <div class="modal-body">
                                            <p>Are you sure you want to submit this sale? This cannot be undone.</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-dark" data-dismiss="modal">Review items</button>
                                            <button type="submit" id="SubmitPayment" class="btn btn-dark">Submit Payment</button>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            <!-- /.modal -->

                            <!-- Item dont Exists Modal -->
                            <div class="modal fade" id="itemDontExists">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header modal-header-danger">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title">Item Does not Exists</h4>
                                        </div>
                                        <div class="modal-body">
                                            <p>Please check IMEI or Serial Number or Product Code and try again.</p>
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

                            <!-- No Item Modal -->
                            <div class="modal fade" id="NoItem">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header modal-header-danger">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title">No Item</h4>
                                        </div>
                                        <div class="modal-body">
                                            <p>Please enter IMEI or Serial Number</p>
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

                            <!-- Edit Item Modal -->
                            <div class="modal fade" id="EditItemModal">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header modal-header-dark">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title">Update Item Details</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label id="uItemName">Item Name: Flare S3 (Green)</label>
                                                    <label>IMEI / SN / PDC: Flare S3</label>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-dark">Update</button>
                                            <button class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            <!-- /.modal -->

                            <!-- No Item Modal -->
                            <div class="modal fade" id="noItemModal">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header modal-header-danger">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title">No items added.</h4>
                                        </div>
                                        <div class="modal-body">
                                            <p>Please add item(s) before you can submit payment.</p>
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

                            <!-- Error Modal -->
                            <div class="modal fade" id="ErrorModal">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header modal-header-danger">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title">Error</h4>
                                        </div>
                                        <div class="modal-body">
                                            <p>Error! Please contact administrator about this problem.</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                            </div>
                            <!-- /.modal-dialog -->

                            <!-- Amount Tendered Modal -->
                            <div class="modal fade" id="AmountTenderedModal">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header modal-header-danger">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title">No amount tendered</h4>
                                        </div>
                                        <div class="modal-body">
                                            <p>Please enter amount tendered.</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                            </div>
                            <!-- /.modal-dialog -->

                            <!-- Amount Tendered Modal -->
                            <div class="modal fade" id="ChangeModal">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header modal-header-danger">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title">Remaining Balance</h4>
                                        </div>
                                        <div class="modal-body">
                                            <p>Please check amount tendered, you have an existing balance.</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                            </div>
                            <!-- /.modal-dialog -->
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

<link rel="import" href="../js.html">

<!-- Function JS -->
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
         text: 'Transaction Successful.',
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

<!-- Bootstrap Validator -->

<script type="text/javascript">
    $(document).ready(function () {
        $('#frmSaleItem').bootstrapValidator({
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
                CustomerName: {
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
                ModeOfPayment: {
                    validators: {
                        notEmpty: {
                            message: 'Please select one.'
                        }
                    }
                },
                CardHolderName: {
                    validators: {
                        notEmpty: {
                            message: 'This field cannot be empty.'
                        },
                        identical: {
                            field: 'CustomerName',
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
                Terms: {
                    validators: {
                        notEmpty: {
                            message: 'This field cannot be empty.'
                        }
                    }
                },
                ReferenceNo: {
                    validators: {
                        notEmpty: {
                            message: 'This field cannot be empty.'
                        }
                    }
                }
            }
        }).on('success.form.bv', function (e) {
            // Prevent form submission
            e.preventDefault();
            $('.submit-button', $(this)).attr('disabled', true);
            if(imeisnArray == 0){
                $('#noItemModal').modal('show');
            }else{
                CheckIfNoChange();
            }

        }).on('error.field.bv', function(e, data) {
            if (data.bv.getSubmitButton()) {
                data.bv.disableSubmitButtons(false);
            }
        })
            .on('success.field.bv', function(e, data) {
                if (data.bv.getSubmitButton()) {
                    data.bv.disableSubmitButtons(false);
                }
            });
    });
</script>
</body>
</html>