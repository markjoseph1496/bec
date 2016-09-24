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
    <!-- bootstrap-progressbar -->
    <link href="../../src/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../../build/css/custom.min.css" rel="stylesheet">
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
                <h3>Plain Page</h3>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Plain Page</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      Add content to the page ...
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="dashboard_graph x_panel">
                  <div class="row x_title">
                    <div class="col-md-6">
                      <h3>Branches Activities <small>Monthly Sales</small></h3>
                    </div>
                    <div class="col-md-6">
                      <div id="reportrange" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc">
                        <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                        <span>December 30, 2014 - January 28, 2015</span> <b class="caret"></b>
                      </div>
                    </div>
                  </div>
                  <div class="x_content">
                    <div class="demo-container" style="height:250px">
                      <div id="placeholder3xx3" class="demo-placeholder" style="width: 100%; height:250px;"></div>
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

    <!-- jQuery -->
    <script src="../../src/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../../src/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="../../src/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="../../src/nprogress/nprogress.js"></script>
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
    <!-- Chart.js -->
    <script src="../../src/Chart.js/dist/Chart.min.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="../../src/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- Flot -->
    <script src="../../src/Flot/jquery.flot.js"></script>
    <script src="../../src/Flot/jquery.flot.pie.js"></script>
    <script src="../../src/Flot/jquery.flot.time.js"></script>
    <script src="../../src/Flot/jquery.flot.stack.js"></script>
    <script src="../../src/Flot/jquery.flot.resize.js"></script>
    <!-- Flot plugins -->
    <script src="../../src/flot.orderbars/js/jquery.flot.orderBars.js"></script>
    <script src="../../src/flot-spline/js/jquery.flot.spline.min.js"></script>
    <script src="../../src/flot.curvedlines/curvedLines.js"></script>
    <!-- DateJS -->
    <script src="../../src/DateJS/build/date.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="../js/moment/moment.min.js"></script>
    <script src="../js/datepicker/daterangepicker.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="../../build/js/custom.min.js"></script>

    <!-- Flot -->
    <script>
      $(document).ready(function() {
        //random data
        var d1 = [
          [0, 1],
          [1, 9],
          [2, 6],
          [3, 10],
          [4, 5],
          [5, 17],
          [6, 6],
          [7, 10],
          [8, 7],
          [9, 11],
          [10, 35],
          [11, 9],
          [12, 12],
          [13, 5],
          [14, 3],
          [15, 4],
          [16, 9],
          [17, 1],
          [18, 9],
          [19, 6],
          [20, 10],
          [21, 5],
          [22, 17],
          [23, 6],
          [24, 10],
          [25, 7],
          [26, 11],
          [27, 35],
          [28, 9],
          [29, 12],
          [30, 5]
        ];

        //flot options
        var options = {
          series: {
            curvedLines: {
              apply: true,
              active: true,
              monotonicFit: true
            }
          },
          colors: ["#0A60EC"],
          grid: {
            borderWidth: {
              top: 0,
              right: 0,
              bottom: 1,
              left: 1
            },
            borderColor: {
              bottom: "#7EA3DF",
              left: "#7EA3DF"
            }
          }
        };
        var plot = $.plot($("#placeholder3xx3"), [{
          label: "Registrations",
          data: d1,
          lines: {
            fillColor: "rgba(150, 202, 89, 0.12)"
          }, //#96CA59 rgba(150, 202, 89, 0.42)
          points: {
            fillColor: "#fff"
          }
        }], options);
      });
    </script>
    <!-- /Flot -->

    <!-- bootstrap-daterangepicker -->
    <script type="text/javascript">
      $(document).ready(function() {

        var cb = function(start, end, label) {
          console.log(start.toISOString(), end.toISOString(), label);
          $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        };

        var optionSet1 = {
          startDate: moment().subtract(29, 'days'),
          endDate: moment(),
          minDate: '01/01/2012',
          maxDate: '12/31/2015',
          dateLimit: {
            days: 60
          },
          showDropdowns: true,
          showWeekNumbers: true,
          timePicker: false,
          timePickerIncrement: 1,
          timePicker12Hour: true,
          ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
          },
          opens: 'left',
          buttonClasses: ['btn btn-default'],
          applyClass: 'btn-small btn-primary',
          cancelClass: 'btn-small',
          format: 'MM/DD/YYYY',
          separator: ' to ',
          locale: {
            applyLabel: 'Submit',
            cancelLabel: 'Clear',
            fromLabel: 'From',
            toLabel: 'To',
            customRangeLabel: 'Custom',
            daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
            monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
            firstDay: 1
          }
        };
        $('#reportrange span').html(moment().subtract(29, 'days').format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));
        $('#reportrange').daterangepicker(optionSet1, cb);
        $('#reportrange').on('show.daterangepicker', function() {
          console.log("show event fired");
        });
        $('#reportrange').on('hide.daterangepicker', function() {
          console.log("hide event fired");
        });
        $('#reportrange').on('apply.daterangepicker', function(ev, picker) {
          console.log("apply event fired, start/end dates are " + picker.startDate.format('MMMM D, YYYY') + " to " + picker.endDate.format('MMMM D, YYYY'));
        });
        $('#reportrange').on('cancel.daterangepicker', function(ev, picker) {
          console.log("cancel event fired");
        });
        $('#options1').click(function() {
          $('#reportrange').data('daterangepicker').setOptions(optionSet1, cb);
        });
        $('#options2').click(function() {
          $('#reportrange').data('daterangepicker').setOptions(optionSet2, cb);
        });
        $('#destroy').click(function() {
          $('#reportrange').data('daterangepicker').remove();
        });
      });
    </script>
    <!-- /bootstrap-daterangepicker -->
  </body>
</html>
