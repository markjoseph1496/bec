<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Administrator</title>

    <!-- Bootstrap -->
    <link href="../../src/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../../src/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../../src/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="../../src/animate.css/animate.min.css" rel="stylesheet">
    <!-- Bootstrap Validator -->
    <link href="../../src/validator/bootstrapValidator.min.css">

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
                <h3>Item Page</h3>
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
                  <?php 
                    if (isset($_GET['id'])) {
                      $id = $_GET['id'];
                      if ($id = 'ItemAddNotif') {
                        echo '
                            <div id="ItemAddNotif" class="alert alert-success alert-dismissible fade in" role="alert" style="display: none;">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                                </button>
                                Item successfully Added.
                            </div>
                        ';
                      } elseif ($id = 'ItemUpdateNotif') {
                        echo '
                            <div id="ItemAddNotif" class="alert alert-success alert-dismissible fade in" role="alert" style="display: none;">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                                </button>
                                Item successfully Updated.
                            </div>
                        ';
                      } elseif ($id = 'ItemDeleteNotif') {
                        echo '
                            <div id="ItemAddNotif" class="alert alert-success alert-dismissible fade in" role="alert" style="display: none;">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                                </button>
                                Item successfully Deleted.
                            </div>
                        ';
                      }
                    }
                  ?>
                      <div class="row">
                        <table id="Idatatable" class="table table-striped table-bordered">
                          <thead>
                            <tr>
                              <th >Item Code</th>
                              <th >Model Name</th>
                              <th >Item Description</th>
                              <th >Brand</th>
                              <th >Category</th>
                              <th >SRP</th>
                              <th >Dealer's Price</th>
                              <th width='12%'>Action</th>
                          </thead>
                          <tbody>
                          <?php 
                            $itemstbl = db_select("SELECT * FROM `itemstbl`");
                            foreach ($itemstbl as $value) {
                              $id = $value['id'];
                              $ItemCode = $value['ItemCode'];
                              $ModelName = $value['ModelName'];
                              $ItemDescription = $value['ItemDescription'];
                              $Brand = $value['Brand'];
                              $Category = $value['Category'];
                              $SRP = $value['SRP'];
                              $DP = $value['DP'];
                              $SRP = number_format($SRP, 2, '.', ',');
                              $DP = number_format($DP, 2, '.', ',');
                          ?>
                            <tr>
                              <td><?php echo $ItemCode; ?></td>
                              <td><?php echo $ModelName; ?></td>
                              <td><?php echo $ItemDescription; ?></td>
                              <td><?php echo $Brand; ?></td>
                              <td><?php echo $Category; ?></td>
                              <td><?php echo $SRP; ?></td>
                              <td><?php echo $DP; ?></td>
                              <td>
                                <button name="btnedit" data-toggle='modal'
                                        data-target='#UpdateItem<?php echo $id; ?>' class='btn btn-dark'>
                                    <i class='fa fa-eye'></i>
                                </button>
                                <button class='btn btn-danger' data-toggle="modal"
                                        data-target="#DeleteItem<?php echo $ItemCode; ?>">
                                    <i class="fa fa-remove "></i>
                                </button>
                              </td>
                            </tr>
                          </tbody>

                          <!-- Modal Delete item -->
                          <div class="modal fade" id="DeleteItem<?php echo $ItemCode; ?>" role="dialog">
                            <div class="modal-dialog" style="padding:100px">
                              <!-- Modal Content -->
                              <div class="modal-content">
                                <form action="function/admin-delete.php" method="POST" name="DeleteItem" id="DeleteItem" autocomplete="off">
                                  <div class="modal-header modal-header-danger">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Delete Item</h4>
                                  </div>
                                  <div class="modal-body">
                                    <div class="col-md-15">
                                        <label = "usr" class="control-label">Do you want to delete 
                                        Item <?php echo $ModelName; ?>? This cannot be undone.</label>
                                        <div class="form-group"></div>
                                    </div>
                                    <input type="hidden" name="ItemCode" value="<?php echo $ItemCode; ?>">
                                    <div class="modal-footer">
                                        <button class="btn btn-dark" name="btndeleteitem" id="btndeleteitem">Delete</button>
                                        <button type="button" class="btn btn-dark" data-dismiss="modal">Cancel</button>
                                    </div>
                                  </div>
                              </div>
                            </div>
                          </div>
                              </form>
                          <!-- End Modal Delete item -->

                          
                              <!-- Modal update item-->
                              <div class="modal fade" id="UpdateItem<?php echo $id; ?>" role="dialog">
                                  <div class="modal-dialog">
                                      <!-- Modal content-->
                                      <div class="modal-content">
                                      <form action="function/admin-add.php" id="UpdateItem" method="POST" autocomplete="off">
                                          <div class="modal-header modal-header-dark">
                                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                                              <h4 class="modal-title">Update Item</h4>
                                          </div>
                                          <div class="modal-body">
                                              <div class="row">
                                                  <div class="col-lg-12">
                                                      <div class="form-group">
                                                          <label>Item Code <span class="red">(*)</span></label>
                                                          <input type="text" readonly="readonly" class="form-control" style="text-transform: uppercase" id="uItemCode" name="uItemCode" value="<?php echo $ItemCode; ?>">
                                                      </div>
                                                      <div class="form-group">
                                                          <label>Model Name <span class="red">(*)</span></label>
                                                          <input type="text" class="form-control" style="text-transform: uppercase" id="uModelName" name="uModelName" value="<?php echo $ModelName; ?>">
                                                      </div>
                                                      <div class="form-group">
                                                          <label>Item Description <span class="red">(*)</span></label>
                                                          <input type="text" class="form-control" style="text-transform: uppercase" id="uItemDescription" name="uItemDescription" value="<?php echo $ItemDescription; ?>">
                                                      </div>
                                                      <div class="form-group">
                                                          <label>Brand <span class="red">(*)</span></label>
                                                          <select class="form-control" name="uiBrand" id="uiBrand">
                                                              <option selected="selected" value=""><?php echo $Brand; ?></option>
                                                              <option value="Berlein Mobile">Berlein Mobile</option>
                                                              <option value="Cherry Mobile">Cherry Mobile</option>
                                                              <option value="MyPhone">MyPhone</option>
                                                              <option value="Oppo">Oppo</option>
                                                              <option value="Huawei">Huawei</option>
                                                          </select>
                                                      </div>
                                                      <div class="form-group">
                                                          <label>Category <span class="red">(*)</span></label>
                                                          <input type="text" class="form-control" style="text-transform: uppercase" id="uCategory" name="uCategory" value="<?php echo $Category; ?>">
                                                      </div>
                                                      <div class="form-group">
                                                          <label>SRP <span class="red">(*)</span></label>
                                                          <input type="number" class="form-control" id="uSRP" name="uSRP" value="<?php echo $SRP; ?>">
                                                      </div>
                                                      <div class="form-group">
                                                          <label>Dealer's Price <span class="red">(*)</span></label>
                                                          <input type="number" class="form-control" id="uDP" name="uDP" value="<?php echo $DP; ?>">
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                          <div class="modal-footer">
                                              <button type="submit" class="btn btn-dark" name="btnupdateitem" id="btnupdateitem">Update</button>
                                              <button class="btn btn-dark" data-dismiss="modal">Cancel</button>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              <!-- End Modal update item-->
                          </form> 

                            <?php 
                              }
                            ?>
                        </table>
                        <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#myModal">Add Item</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <form action="function/admin-add.php" id="AddItem" method="POST" autocomplete="off">
                    <!-- Modal add item-->
                    <div class="modal fade" id="myModal" role="dialog">
                        <div class="modal-dialog">
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header modal-header-dark">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Add Item</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>Item Code <span class="red">(*)</span></label>
                                                <input type="text" class="form-control" style="text-transform: uppercase" id="ItemCode" name="ItemCode">
                                            </div>
                                            <div class="form-group">
                                                <label>Model Name <span class="red">(*)</span></label>
                                                <input type="text" class="form-control" style="text-transform: uppercase" id="ModelName" name="ModelName">
                                            </div>
                                            <div class="form-group">
                                                <label>Item Description <span class="red">(*)</span></label>
                                                <input type="text" class="form-control" style="text-transform: uppercase" id="ItemDescription" name="ItemDescription">
                                            </div>
                                            <div class="form-group">
                                                <label>Brand <span class="red">(*)</span></label>
                                                <select class="form-control" name="iBrand" id="iBrand">
                                                    <option selected="selected" value=""> - Please Select one -</option>
                                                    <option value="Berlein Mobile">Berlein Mobile</option>
                                                    <option value="Cherry Mobile">Cherry Mobile</option>
                                                    <option value="MyPhone">MyPhone</option>
                                                    <option value="Oppo">Oppo</option>
                                                    <option value="Huawei">Huawei</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Category <span class="red">(*)</span></label>
                                                <input type="text" class="form-control" style="text-transform: uppercase" id="Category" name="Category">
                                            </div>
                                            <div class="form-group">
                                                <label>SRP <span class="red">(*)</span></label>
                                                <input type="number" class="form-control" id="SRP" name="SRP">
                                            </div>
                                            <div class="form-group">
                                                <label>Dealer's Price <span class="red">(*)</span></label>
                                                <input type="money" style="text-transform: money" class="form-control" id="DP" name="DP">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-dark">Save</button>
                                    <button class="btn btn-dark" data-dismiss="modal">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Modal additem-->
                </form>
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
    <!-- Function JS -->
    <script src="js/function.js"></script>

    <!-- Datatables -->
<script>
    $(document).ready(function() {
        var handleDataTableButtons = function() {
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

        TableManageButtons = function() {
            "use strict";
            return {
                init: function() {
                    handleDataTableButtons();
                }
            };
        }();

        $('#Idatatable').dataTable();

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
            'order': [[ 1, 'asc' ]],
            'columnDefs': [
                { orderable: false, targets: [0] }
            ]
        });
        $datatable.on('draw.dt', function() {
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
        $('#AddItem').bootstrapValidator({
            message: 'This value is not valid',
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                group: 'form-group',
                ItemCode: {
                    validators: {
                        notEmpty: {
                            message: 'Please enter Item Code Required!'
                        }
                    }
                },
                ModelName: {
                    validators: {
                        notEmpty: {
                            message: 'Please enter Model Name. Required!'
                        }
                    }
                },
                ItemDescription: {
                    validators: {
                        notEmpty: {
                            message: 'Please enter Item Description. Required!'
                        }
                    }
                },
                iBrand: {
                    validators: {
                        notEmpty: {
                            message: 'Please enter Brand. Required!'
                        }
                    }
                },
                Category: {
                    validators: {
                        notEmpty: {
                            message: 'Please enter Category. Required!'
                        }
                    }
                },
                SRP: {
                    validators: {
                        notEmpty: {
                            message: 'Please enter SRP. Required!'
                        }
                    }
                },
                DP: {
                    validators: {
                        notEmpty: {
                            message: 'Please enter Dealers Price. Required!'
                        }
                    }
                }
            }
        });
    });

    $('#ItemAddNotif').show();
    $("#ItemAddNotif").fadeTo(5000, 500).slideUp(500, function () {
        $("#ItemAddNotif").alert('close');
    });

    $('#ItemUpdateNotif').show();
    $("#ItemUpdateNotif").fadeTo(5000, 500).slideUp(500, function () {
        $("#ItemUpdateNotif").alert('close');
    });

    $('#ItemDeleteNotif').show();
    $("#ItemDeleteNotif").fadeTo(5000, 500).slideUp(500, function () {
        $("#ItemDeleteNotif").alert('close');
    });

</script>
<!-- /validator -->

<script type="text/javascript">

  document.getElementById("DP").onblur = function(){

    this.value = parseFloat(this.value.replace(/,/g, ""))
          .toFixed(2)
          .toString()
          .replace(/\B(?=(\d{3})+(?!\d))/g, ",");

  document.getElementById("number").value = this.value.replace(/,/g, "")

  }

</script>
</body>
</html>
