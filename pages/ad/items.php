<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Administrator</title>

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
                        <h3>Items</h3>
                    </div>
                </div>

                <div class="clearfix"></div>

                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Items</h2>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <div class="col-lg-12">
                                    <div class="row">
                                        <table id="datatable" class="table table-striped table-bordered">
                                            <thead>
                                            <tr>
                                                <th>Item Code</th>
                                                <th>Model Name</th>
                                                <th>Item Description</th>
                                                <th>Available Color</th>
                                                <th>Brand</th>
                                                <th>Category</th>
                                                <th>SRP</th>
                                                <th>DP</th>
                                                <th width=12%>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $ItemsQuery = db_select("SELECT itemstbl.ItemCode,itemstbl.ModelName,itemstbl.ItemDescription,itemstbl.AvailableColor,
                                                                    brandtbl.BrandCode,brandtbl.Brand,categorytbl.CategoryCode,categorytbl.Category,
                                                                    itemstbl.SRP,itemstbl.DP
                                                                    FROM itemstbl
                                                                    LEFT JOIN brandtbl ON itemstbl.BrandID = brandtbl.BrandID
                                                                    LEFT JOIN categorytbl ON itemstbl.Category = categorytbl.Category
                                                                     ");
                                            foreach ($ItemsQuery as $valueItems) {
                                                $ItemCode = $valueItems['ItemCode'];
                                                $ModelName = $valueItems['ModelName'];
                                                $ItemDescription = $valueItems['ItemDescription'];
                                                $AvailableColor = $valueItems['AvailableColor'];
                                                $BrandCode = $valueItems['BrandCode'];
                                                $Brand = $valueItems['Brand'];
                                                $CategoryCode = $valueItems['CategoryCode'];
                                                $Category = $valueItems['Category'];
                                                $SRP = $valueItems['SRP'];
                                                $DP = $valueItems['DP'];
                                                $SRP = number_format($SRP, 2, '.', ',');
                                                $DP = number_format($DP, 2, '.', ',');

                                                $Itemsrnd = rand(0, 9999);
                                                $hashItemCode = encrypt_decrypt_rnd('encrypt', $ItemCode, $Itemsrnd);
                                                ?>
                                                <tr>
                                                    <td><?php echo $ItemCode ?></td>
                                                    <td><?php echo $ModelName ?></td>
                                                    <td><?php echo $ItemDescription ?></td>
                                                    <td><?=@$AvailableColor ?></td>
                                                    <td><?php echo $Brand ?></td>
                                                    <td><?php echo $Category ?></td>
                                                    <td><?= @$SRP; ?></td>
                                                    <td><?= @$DP; ?></td>
                                                    <td>
                                                        <button class="btn btn-dark" onclick="ItemsDetails('<?= @$ItemCode; ?>','<?= @$hashItemCode; ?>','<?= @$Itemsrnd; ?>')" data-toggle="modal" data-target="#ItemsUpdateModal"><i
                                                                class="fa fa-eye"></i></button>
                                                        <button class="btn btn-danger" onclick="ItemsDelete('<?= @$ItemCode; ?>','<?= @$hashItemCode; ?>','<?= @$Itemsrnd; ?>')" data-toggle="modal" data-target="#ItemsDeleteModal"><i
                                                                class="fa fa-trash"></i></button>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                            ?>
                                            </tbody>
                                        </table>
                                        <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#AddItemsModal">Add Items</button>
                                    </div>

                                    <!-- Edit Items Modal -->
                                    <div class="modal fade" id="ItemsUpdateModal">

                                    </div>
                                    <!-- /.modal -->

                                    <!-- Modal Delete Items -->
                                    <div class="modal fade" id="ItemsDeleteModal" role="dialog">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form method="POST" action="function/admin-delete.php">
                                                    <div class="modal-header modal-header-danger">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                        <h4 class="modal-title">Delete Item</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <input type="hidden" name="ItemCode" id="ItemCode">
                                                        <input type="hidden" name="hashItemCode" id="hashItemCode">
                                                        <input type="hidden" name="Itemsrnd" id="Itemsrnd">
                                                        <label>Are you sure you want to delete this Item? This cannot be undone.</label>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                        <button class="btn btn-dark" data-dismiss="modal">Cancel</button>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>
                                    <!-- /.Modal -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Add Items Modal -->
                <div class="modal fade" id="AddItemsModal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="function/functions.php" method="POST" name="AddItems" id="AddItems" autocomplete="off">
                                <div class="modal-header modal-header-dark">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">Add Item</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label>Category <span class="red">(*)</span></label>
                                        <select class="form-control" name="Category" id="Category">
                                            <option value=""> - Please Select Category -</option>
                                            <?php
                                            $Categorytbl = db_select("SELECT * FROM `categorytbl`");

                                            foreach ($Categorytbl as $ValueCateg) {
                                                $CategoryID = $ValueCateg['CategoryID'];
                                                $CategoryCode = $ValueCateg['CategoryCode'];
                                                $Category = $ValueCateg['Category'];
                                                ?>
                                                <option value="<?= @$CategoryCode; ?>">(<?= @$CategoryCode; ?>) <?= @$Category; ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Brand <span class="red">(*)</span></label>
                                        <select class="form-control" name="ItemBrand" id="ItemBrand">
                                            <option value=""> - Please Select Brand -</option>
                                            <?php
                                            $Brandtbl = db_select("SELECT * FROM `brandtbl`");

                                            foreach ($Brandtbl as $valueBrand) {
                                                $BrandID = $valueBrand['BrandID'];
                                                $BrandCode = $valueBrand['BrandCode'];
                                                $Brand = $valueBrand['Brand'];
                                                ?>
                                                <option value="<?= @$BrandCode; ?>">(<?= @$BrandCode; ?>) <?= @$Brand; ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Item Code <span class="red">(*)</span></label>
                                        <div id="itemcodes"></div>
                                    </div>
                                    <div class="form-group">
                                        <label>Model Name <span class="red">(*)</span></label>
                                        <input type="text" class="form-control" style="text-transform: capitalize" id="ModelName" name="ModelName">
                                    </div>
                                    <div class="form-group">
                                        <label>Item Description <span class="red">(*)</span></label>
                                        <input type="text" class="form-control" style="text-transform: capitalize" id="ItemDescription" name="ItemDescription">
                                    </div>
                                    <div class="form-group">
                                        <label>Available Color <span class="red">(*)</span></label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" style="text-transform: capitalize" id="available-color" name="Color">
                                            <script>
                                                var kl_index = -1;
                                                function delete_Color(index) {
                                                    $('#cl-span-' + index).remove();
                                                    $('#cl-a-' + index).remove();
                                                    $('#cl-input-' + index).remove();
                                                }
                                            </script>
                                            <span class="input-group-btn">
                                                <a class="btn btn-dark" onclick="
                                                (function(){
                                              var _requirements = $('#available-color').val();
                                              if(_requirements==''){
                                                  alert('Cannot add empty value.');
                                              }
                                              else{
                                                  kl_index++;
                                                  var cl = $('#Color-template');
                                                  var cl_span = cl.find('span');
                                                  var cl_a = cl.find('a');
                                                  var cl_input = cl.find('input');

                                                  cl_span.text($('#available-color').val());
                                                  cl_span.attr('id', 'cl-span-' + kl_index);
                                                  cl_a.attr('id', 'cl-a-' + kl_index);
                                                  cl_a.attr('onclick', 'delete_Color(' + kl_index + ')');
                                                  cl_input.attr('id', 'cl-input-' + kl_index);
                                                  cl_input.attr('name', 'color[' + kl_index +']');
                                                  cl_input.val(cl_span.text());
                                                  $('#Color-list').append($('#Color-template').html());
                                                  $('#available-color').val('');

                                                  //disposal of used resource in #knowledge-template
                                                  cl_span.removeAttr('id');
                                                  cl_a.removeAttr('id');
                                                  cl_a.removeAttr('onclick');
                                                  cl_input.removeAttr('id');
                                                  cl_input.removeAttr('name');
                                                  cl_input.removeAttr('value');
                                              }
                                            })()">Add</a>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="hidden" id="Color-template">
                                            <b><span>Dito_lalabas_yung_text</span></b>
                                            <a href="javascript:void(0)">[remove]<br></a>
                                            <input type="hidden">
                                        </div>
                                        <div class=" col-md-4" id="Color-list" style="width: 300px; word-wrap: break-word">
                                        </div>
                                    </div>
                                    &nbsp;
                                    <div class="form-group">
                                        <label>SRP <span class="red">(*)</span></label>
                                        <input type="text" class="form-control" id="SRP" name="SRP" onblur="NumberConvertToMoney()" onclick="this.setSelectionRange(0, this.value.length)" value="0.00">
                                    </div>
                                    <div class="form-group">
                                        <label>Dealer's Price<span class="red">(*)</span></label>
                                        <input type="text" class="form-control" id="DP" name="DP" onblur="NumberConvertToMoney()" onclick="this.setSelectionRange(0, this.value.length)" value="0.00">
                                    </div>
                                    <div class="form-group">
                                        <label>Critical Level<span class="red">(*)</span></label>
                                        <input TYPE="number" class="form-control" id="CriticalLevel" name="CriticalLevel">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-dark" name="btnAddItem">Add</button>
                                    <button class="btn btn-default" data-dismiss="modal">Cancel</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->
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
        text: 'Items Updated',
        type: 'success',
        styling: 'bootstrap3',
        delay:3000
    });
</script>";
} elseif (isset($_GET['deleted'])) {
    echo "<script type='text/javascript'>
    new PNotify({
        title: 'Success',
        text: 'Item Deleted',
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

<!-- Item Codes -->
<script>
    $(document).ready(function () {

        $(("#Category") && ("#ItemBrand")).change(function () {
            var Category = $("#Category").val();
            var ItemBrand = $("#ItemBrand").val();

            $.ajax({

                url: "function/fetchitemcode.php",
                method: "POST",
                data: {Category: Category, ItemBrand: ItemBrand},
                dataType: "text",
                success: function (data) {
                    $("#itemcodes").html(data);
                }
            });
        });


        $(("#ItemBrand") && ("#Category")).change(function () {
            var Category = $("#Category").val();
            var ItemBrand = $("#ItemBrand").val();

            $.ajax({

                url: "function/fetchitemcode.php",
                method: "POST",
                data: {Category: Category, ItemBrand: ItemBrand},
                dataType: "text",
                success: function (data) {
                    $("#itemcodes").html(data);
                }
            });
        });


    });
</script>
<!-- /.Item COdes -->

<!-- validator -->
<script type="text/javascript">
    $(document).ready(function () {
        $('#AddItems').bootstrapValidator({
            message: 'This value is not valid',
            feedbackIcons: {
                valid: "glyphicon glyphicon-ok",
                invalid: "glyphicon glyphicon-remove",
                validating: "glyphicon glyphicon-refresh"
            },
            fields: {
                group: 'form-group',
                Category: {
                    validators: {
                        notEmpty: {
                            message: 'Category is required.'
                        }
                    }
                },
                ItemBrand: {
                    validators: {
                        notEmpty: {
                            message: 'Brand is required.'
                        }
                    }
                },
                ModelName: {
                    validators: {
                        notEmpty: {
                            message: 'Model Name is required.'
                        }
                    }
                },
                ItemDescription: {
                    validators: {
                        notEmpty: {
                            message: 'Item Description is required.'
                        }
                    }
                },
                SRP: {
                    validators: {
                        notEmpty: {
                            message: 'SRP is required.'
                        },
                        regexp: {
                            regexp: /^[0-9\s]+$/i,
                            message: "SRP can consist of positive numbers only"
                        }
                    }
                },
                DP: {
                    validators: {
                        notEmpty: {
                            message: 'DP is required.'
                        },
                        regexp: {
                            regexp: /^[0-9\s]+$/i,
                            message: "DP can consist of positive numbers only"
                        }
                    }
                },
                CriticalLevel: {
                    validators: {
                        notEmpty: {
                            message: 'Critical Level is required.'
                        },
                        regexp: {
                            regexp: /^[0-9\s]+$/i,
                            message: "Critical Level can consist of positive numbers only"
                        }
                    }
                }
            }
        });
    });
</script>
<!-- /validator-->

</body>
</html>
