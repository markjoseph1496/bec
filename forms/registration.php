<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Basic -->
    <title>Berlein Electronics Corporation</title>

    <!-- Define Charset -->
    <meta charset="utf-8">

    <!-- Responsive Metatag -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Page Description and Author -->
    <meta name="description" content=" - Responsive HTML5 Template">
    <link rel="shortcut icon" href="../images/logo/favicon.ico">

    <!-- Bootstrap CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet"/>

    <!-- BootstrapValidator CSS -->
    <link href="../css/bootstrapValidator.min.css" rel="stylesheet"/>

    <!-- jQuery and Bootstrap JS -->
    <script type="text/javascript" src="../js/jquery.min.js"></script>
    <script type="text/javascript" src="../js/bootstrap.min.js"></script>

    <!-- BootstrapValidator -->
    <script src="../js/bootstrapValidator.min.js" type="text/javascript"></script>

    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="../css/font-awesome.min.css" type="text/css" media="screen">

    <!-- Fonts -->
    <link rel="stylesheet" type="text/css" href="../fonts/ffonts/montserrat.css">
    <link rel="stylesheet" type="text/css" href="../fonts/ffonts/open-sans.css">

    <!-- Slicknav -->
    <link rel="stylesheet" type="text/css" href="../css/slicknav.css" media="screen">

    <!-- CSS Styles  -->
    <link rel="stylesheet" type="text/css" href="../css/style.css" media="screen">

    <!-- Responsive CSS Styles  -->
    <link rel="stylesheet" type="text/css" href="../css/responsive.css" media="screen">

    <!-- Css3 Transitions Styles  -->
    <link rel="stylesheet" type="text/css" href="../css/animate.css" media="screen">

    <!-- OJPMS CSS  -->
    <link rel="stylesheet" type="text/css" href="../css/ojpms-style.css" media="screen">

    <!-- Color CSS Styles  -->
    <link rel="stylesheet" type="text/css" href="../css/colors/yellow.css" title="yellow" media="screen"/>

    <!-- JS  -->
    <script type="text/javascript" src="../js/jquery.migrate.js"></script>
    <script type="text/javascript" src="../js/modernizrr.js"></script>
    <script type="text/javascript" src="../js/jquery.fitvids.js"></script>
    <script type="text/javascript" src="../js/owl.carousel.min.js"></script>
    <script type="text/javascript" src="../js/nivo-lightbox.min.js"></script>
    <script type="text/javascript" src="../js/jquery.isotope.min.js"></script>
    <script type="text/javascript" src="../js/jquery.appear.js"></script>
    <script type="text/javascript" src="../js/count-to.js"></script>
    <script type="text/javascript" src="../js/jquery.textillate.js"></script>
    <script type="text/javascript" src="../js/jquery.lettering.js"></script>
    <script type="text/javascript" src="../js/jquery.easypiechart.min.js"></script>
    <script type="text/javascript" src="../js/jquery.nicescroll.min.js"></script>
    <script type="text/javascript" src="../js/jquery.parallax.js"></script>
    <script type="text/javascript" src="../js/jquery.slicknav.js"></script>

    <!-- Checkbox -->
    <link rel="stylesheet" type="text/css" href="../css/checkbox.css" media="screen"/>

    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
</head>

<body>
<div id="container">
    <div class="page-banner no-subtitle">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="text-center">JOB FAIR PARTICIPATION CONFIRMATION FORM</h1>
                </div>
            </div>
        </div>
    </div>

    <!-- Start Content -->
    <form id="JobFair" name="JobFair" autocomplete="off" method="POST" action="functions.php">
        <div id="content">
            <div class="container">
                <?php
                if (isset($_GET['done'])) {
                    ?>
                    <script type="text/javascript">
                        $(window).load(function () {
                            $('#Done').modal('show');
                        });
                    </script>
                    <?php
                }
                if (isset($_GET['error'])) {
                    ?>
                    <script type="text/javascript">
                        $(window).load(function () {
                            $('#Error').modal('show');
                        });
                    </script>
                    <?php
                }
                ?>
                <!-- Done Modal -->
                <div class="modal fade" id="Done"
                     role="dialog">
                    <div class="modal-dialog" style="padding:100px">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Registration Successful</h4>
                            </div>
                            <div class="modal-body">
                                <div class="col-md-15">
                                    <label = "usr" class = "control-label">You have successfully registered to Job Fair 2016.</label>
                                    <div class="form-group">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <a href="../index.php" type="button" class="btn btn-default">Done</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Error Modal -->
                <div class="modal fade" id="Error"
                     role="dialog">
                    <div class="modal-dialog" style="padding:100px">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Registration unsuccessful</h4>
                            </div>
                            <div class="modal-body">
                                <div class="col-md-15">
                                    <label = "usr" class = "control-label">Some errors occured while registering your company.</label>
                                    <div class="form-group">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <a href="#" type="button" class="btn btn-default" data-dismiss="modal">Try Again</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="call-action call-action-boxed call-action-style2 clearfix">
                    <img src="../images/forms/banner.jpg">
                    <div class="hr1" style="margin-top:30px;margin-bottom:30px;"></div>
                    <div class="row">
                        <div class="text-center"><label>Required Fields <span>(*)</span></label></div>
                        <div class="col-md-6">
                            <label>Company Name <span>(*)</span></label>
                            <input type="hidden" name="FormSubmit">
                            <div class="form-group">
                                <input type="text" class="form-control" id="CompanyName" name="CompanyName">
                            </div>

                            <label>Company Address <span>(*)</span></label>
                            <div class="row">
                                <div class="col-md-6">
                                    Street Address
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="CompanyAddress" name="CompanyAddress">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    City <span>(*)</span>
                                    <div class="form-group">
                                        <select class="form-control" name="City" id="City">
                                            <option value=""></option>
                                            <option value="City of Manila">City of Manila</option>
                                            <option value="Caloocan">Caloocan</option>
                                            <option value="Las Piñas">Las Piñas</option>
                                            <option value="Makati">Makati</option>
                                            <option value="Malabon">Malabon</option>
                                            <option value="Mandaluyong">Mandaluyong</option>
                                            <option value="Marikina">Marikina</option>
                                            <option value="Muntinlupa">Muntinlupa</option>
                                            <option value="Navotas">Navotas</option>
                                            <option value="Parañaque">Parañaque</option>
                                            <option value="Pasay">Pasay</option>
                                            <option value="Pasig">Pasig</option>
                                            <option value="Quezon City">Quezon City</option>
                                            <option value="San Juan">San Juan</option>
                                            <option value="Taguig">Taguig</option>
                                            <option value="Valenzuela">Valenzuela</option>
                                            <option value="Others">Others</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <label>Website <span>(*)</span></label>
                            <div class="form-group">
                                <input type="url" class="form-control" id="Website" name="Website" placeholder="http://www.example.com">
                            </div>

                            <label>Contact Person <span>(*)</span></label>
                            <div class="form-group">
                                <input type="text" class="form-control" id="ContactPerson" name="ContactPerson">
                            </div>

                            <label>Designation <span>(*)</span></label>
                            <div class="form-group">
                                <input type="text" class="form-control" id="Designation" name="Designation">
                            </div>
                            Phone1
                        </div>
                        <div class="col-md-6">
                            <label>Email Address <span>(*)</span></label>
                            <div class="form-group">
                                <input type="email" class="form-control" id="Email" name="Email">
                            </div>

                            <label>Telephone No. <span>(*)</span></label>
                            <div class="row">
                                <div class="col-md-4">
                                    Phone No. 1
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="Phone1" name="Phone1">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    Phone No. 2
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="Phone2" name="Phone2">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    Phone No. 3
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="Phone3" name="Phone3">
                                    </div>
                                </div>
                            </div>

                            <label>Mobile No.</label>
                            <div class="form-group">
                                <input type="text" class="form-control" id="MobileNumber" name="MobileNumber">
                            </div>

                            <label>Fax No.</label>
                            <div class="form-group">
                                <input type="text" class="form-control" id="FaxNumber" name="FaxNumber">
                            </div>

                            <label>Type of Industry <span>(*)</span></label>
                            <div class="form-group">
                                <select class="form-control" name="Industry" id="Industry">
                                    <option value=""></option>
                                    <option value="Accounting">Accounting</option>
                                    <option value="Admin / Human Resources">Admin / Human Resources</option>
                                    <option value="Banking / Financial / Insurance">Banking / Financial / Insurance</option>
                                    <option value="Beauty / Health Care / Social Assistance">Beauty / Health Care / Social Assistance</option>
                                    <option value="Business Process Outsourcing (BPO) / Call Center">Business Process Outsourcing (BPO) / Call Center</option>
                                    <option value="Building / Construction">Building / Construction</option>
                                    <option value="Computer/ IT (Hardware)">Computer/ IT (Hardware)</option>
                                    <option value="Computer/ IT (Network/Sys/DB)">Computer/ IT (Network/Sys/DB)</option>
                                    <option value="Computer/ IT (Software)">Computer/ IT (Software)</option>
                                    <option value="Education / Training and Development">Education / Training and Development</option>
                                    <option value="Engineering">Engineering</option>
                                    <option value="Government">Government</option>
                                    <option value="Hospitality / F &amp; B">Hospitality / F &amp; B</option>
                                    <option value="Management">Management</option>
                                    <option value="Manufacturing">Manufacturing</option>
                                    <option value="Marketing / Public Relations">Marketing / Public Relations</option>
                                    <option value="Medical Services">Medical Services</option>
                                    <option value="Merchandising / Purchasing">Merchandising / Purchasing</option>
                                    <option value="Printing">Printing</option>
                                    <option value="Professional Services">Professional Services</option>
                                    <option value="Property / Real Estate">Property / Real Estate</option>
                                    <option value="Sales / Customer Service">Sales / Customer Service</option>
                                    <option value="Sciences / Lab / R &amp; D">Sciences / Lab / R &amp; D</option>
                                    <option value="Telecommunications">Telecommunications</option>
                                    <option value="Transportation / Logistics">Transportation / Logistics</option>
                                    <option value="Wholesale / Retail Trade">Wholesale / Retail Trade</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="hr1" style="margin-top:30px;margin-bottom:30px;"></div>

                    <div class="row">
                        <div class="col-md-6">
                            <label>Name of Company Representative/s <span>(*)</span></label> <i data-toggle="tooltip" title data-original-title="Due to limited space, maximum of two company representatives are allowed to man the booth." class="fa fa-question-circle"></i>
                            <div class="row">
                                <div class="col-md-6">
                                    Name of Representative 1
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="Representative1" name="Representative1">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    Name of Representative 2
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="Representative2" name="Representative2">
                                    </div>
                                </div>
                            </div>

                            <label>List of Marketing Materials to bring <span>(*)</span></label> <i data-toggle="tooltip" title data-original-title="Companies may bring in and use any of the equipment only during the Job Fair. Promotional items as your freebies are encouraged."
                                                                                                    class="fa fa-question-circle"></i>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="checkbox checkbox-success">
                                            <input id="checkbox1" name="MarketingMaterials[]" class="styled" type="checkbox" value="Desktop/Laptop/Notebook Computer">
                                            <label for="checkbox1"><b>Desktop/Laptop/Notebook Computer</b></label>
                                        </div>
                                        <div class="checkbox checkbox-success">
                                            <input id="checkbox2" name="MarketingMaterials[]" class="styled" type="checkbox" value="Wireless Broadband">
                                            <label for="checkbox2"><b>Wireless Broadband</b></label>
                                        </div>
                                        <div class="checkbox checkbox-success">
                                            <input id="checkbox3" name="MarketingMaterials[]" class="styled" type="checkbox" value="LCD Television">
                                            <label for="checkbox3"><b>LCD Television</b></label>
                                        </div>
                                        <div class="checkbox checkbox-success">
                                            <input id="checkbox4" name="MarketingMaterials[]" class="styled" type="checkbox" value="DVD Player">
                                            <label for="checkbox4"><b>DVD Player</b></label>
                                        </div>
                                        <div class="checkbox checkbox-success">
                                            <input id="checkbox5" name="MarketingMaterials[]" class="styled" type="checkbox" value="Speakers">
                                            <label for="checkbox5"><b>Speakers</b></label>
                                        </div>
                                        <div class="checkbox checkbox-success">
                                            <input id="checkbox6" name="MarketingMaterials[]" class="styled" type="checkbox" value="Tarpaulin">
                                            <label for="checkbox6"><b>Tarpaulin</b></label>
                                        </div>
                                        <div class="checkbox checkbox-success">
                                            <input id="checkbox7" name="MarketingMaterials[]" class="styled" type="checkbox" value="Roll up Banner and Stand">
                                            <label for="checkbox7"><b>Roll up Banner and Stand</b></label>
                                        </div>
                                        <div class="checkbox checkbox-success">
                                            <input id="checkbox8" name="MarketingMaterials[]" class="styled" type="checkbox" value="Posters and the like">
                                            <label for="checkbox8"><b>Posters and the like</b></label>
                                        </div>
                                        <div class="checkbox checkbox-success">
                                            <input id="checkbox9" name="MarketingMaterials[]" class="styled" type="checkbox" value="Flyers, pamphlets, company programs, job description and the like">
                                            <label for="checkbox9"><b>Flyers, pamphlets, company programs, job description and the like</b></label>
                                        </div>
                                        <div class="checkbox checkbox-success">
                                            <input id="checkbox10" name="MarketingMaterials[]" class="styled" type="checkbox" value="Company freebies, give-aways and the like">
                                            <label for="checkbox10"><b>Company freebies, give-aways and the like</b></label>
                                        </div>
                                        <div class="checkbox checkbox-success">
                                            <input id="checkbox11" name="OthersCB" class="styled" type="checkbox">
                                            <label for="checkbox11"><b>Others</b></label>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control" id="Others" name="Others" placeholder="Others: Please Specify">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label>The STI Caloocan Alumni and Placement Office will provide each company partner with a table, 2 chairs for the company representatives, 2 chairs for the applicants and number label. Please indicate if you have additional equipment or special service.</label>
                            <div class="checkbox checkbox-success">
                                <input id="checkbox12" name="Extras[]" class="styled" type="checkbox" value="Extra Table">
                                <label for="checkbox12"><b>Extra Table</b></label>
                            </div>
                            <div class="checkbox checkbox-success">
                                <input id="checkbox13" name="Extras[]" class="styled" type="checkbox" value="Electrical power">
                                <label for="checkbox13"><b>Electrical power (Note: due to limited supply, available first come, first served. Extension cords are not provided.)</b></label>
                            </div>
                            <div class="checkbox checkbox-success">
                                <input id="checkbox14" name="OthersExtraCB" class="styled" type="checkbox">
                                <label for="checkbox14"><b>Others</b></label>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="OthersExtra" name="OthersExtra" placeholder="Others: Please Specify">
                            </div>

                            <label>Our company would like to schedule a room for examination (This is a free service for employers.)</label>
                            <div class="checkbox checkbox-success">
                                <input id="checkbox15" name="RoomForExam" class="styled" type="checkbox">
                                <label for="checkbox15"><b>Yes</b></label>
                            </div>

                            <label>Our company can provide an item for door prizes.</label>
                            <div class="checkbox checkbox-success">
                                <input id="checkbox16" name="DoorPrizes" class="styled" type="checkbox">
                                <label for="checkbox16"><b>Yes</b></label>
                            </div>

                            Item Description:
                            <div class="form-group">
                                <input type="text" class="form-control" id="ItemDescription" name="ItemDescription" placeholder="">
                            </div>
                        </div>
                    </div>

                    <div class="hr1" style="margin-top:30px;margin-bottom:30px;"></div>

                    <div class="row">
                        <h1 class="text-center">PARTICIPATION CONFIRMATION</h1>
                        <div class="col-md-6">
                            <label>Please check <span>(*)</span></label>
                            <div class="row-6">
                                <div class="form-group">
                                    <div class="checkbox checkbox-success">
                                        <input id="checkbox17" name="Participate" class="styled" type="checkbox">
                                        <label for="checkbox17"><b>YES, We will participate in Job Fair 2015</b></label>
                                    </div>
                                </div>
                            </div>
                            <label>In order to complete the process, you are requested to forward the following requirements <span>(*)</span>:</label><br>
                            Please email at <u>jobplacement@caloocan.sti.edu</u>
                            <div class="row-6">
                                <div class="form-group">
                                    <div class="checkbox checkbox-success">
                                        <input id="checkbox18" name="Requirements[]" class="styled" type="checkbox" value="Participation Confirmation">
                                        <label for="checkbox18"><b>Participation Confirmation</b></label>
                                    </div>
                                    <div class="checkbox checkbox-success">
                                        <input id="checkbox19" name="Requirements[]" class="styled" type="checkbox" value="Company Profile">
                                        <label for="checkbox19"><b>Company Profile</b></label>
                                    </div>
                                    <div class="checkbox checkbox-success">
                                        <input id="checkbox20" name="Requirements[]" class="styled" type="checkbox" value="Photocopy of the company’s Securities and Exchange Commission Registration">
                                        <label for="checkbox20"><b>Photocopy of the company’s Securities and Exchange Commission Registration</b></label>
                                    </div>
                                    <div class="checkbox checkbox-success">
                                        <input id="checkbox21" name="Requirements[]" class="styled" type="checkbox" value="List of Job Vacancies">
                                        <label for="checkbox21"><b>List of Job Vacancies</b></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="hr1" style="margin-top:30px;margin-bottom:30px;"></div>

                    <div class="row text-center">
                        <h1 class="text-center">CONTACT US</h1>
                        <p>If you would like more information about the Jobs Fair, please contact:</p>

                        <label>MS. ANNABELLE O. VILLEGAS</label>
                        <p>Alumni and Job Placement Officer</p>
                        <p>STI College – Caloocan</p>
                        <p>Contact No.: (02) 294 - 4001 to 02 loc. 110-111</p>
                        <p>Mobile no. : 0932-8436642</p>
                        Email adds.: <span class="accent-color">annabelle.villegas@caloocan.sti.edu</span> and <span class="accent-color">jobplacement@caloocan.sti.edu</span>
                    </div>

                    <img src="../images/forms/banner2.jpg">

                    <div class="hr1" style="margin-top:20px;margin-bottom:20px;"></div>
                    <div class="text-center">
                        <button type="submit" name="" class="btn-system btn-large btn-black">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<!-- End Content -->

<script type="text/javascript" src="../js/script.js"></script>

<!-- Start Footer Section -->
<footer>
    <div class="container">
        <!-- Start Copyright -->
        <div class="copyright-section">
            <div class="row">
                <div class="col-md-6">
                    <p>&copy; 2015 OJPMS - All Rights Reserved</p>
                </div>
                <!-- .col-md-6 -->
                <div class="col-md-6">
                    <ul class="footer-nav">
                        <li><a href="#">Sitemap</a>
                        </li>
                        <li><a href="#">Privacy Policy</a>
                        </li>
                        <li><a href="../contact.php">Contact</a>
                        </li>
                    </ul>
                </div>
                <!-- .col-md-6 -->
            </div>
            <!-- .row -->
        </div>
        <!-- End Copyright -->
    </div>
</footer>
<!-- End Footer Section -->

<!-- Go To Top Link -->
<a href="#" class="back-to-top"><i class="fa fa-angle-up"></i></a>
</body>
</html>
<script type="text/javascript">
    $('#checkbox11').click(function () {
        $("#Others").val("");
        if ($(this).is(':checked')) {
            $('#Others').show();
        } else {
            $('#Others').hide();
        }
    });

    if ($('#checkbox11').is(':checked')) {
        $('#Others').show();
    } else {
        $('#Others').hide();
    }

    $('#checkbox14').click(function () {
        $("#OthersExtra").val("");
        if ($(this).is(':checked')) {
            $('#OthersExtra').show();
        } else {
            $('#OthersExtra').hide();
        }
    });

    if ($('#checkbox14').is(':checked')) {
        $('#OthersExtra').show();
    } else {
        $('#OthersExtra').hide();
    }

    $(document).ready(function () {
        var validator = $("#JobFair").bootstrapValidator({
            feedbackIcons: {
                valid: "glyphicon glyphicon-ok",
                invalid: "glyphicon glyphicon-remove",
                validating: "glyphicon glyphicon-refresh"
            },
            fields: {
                CompanyName: {
                    validators: {
                        notEmpty: {
                            message: "This field is required."
                        }
                    }
                },
                CompanyAddress: {
                    validators: {
                        notEmpty: {
                            message: "This field is required."
                        }
                    }
                },
                City: {
                    validators: {
                        notEmpty: {
                            message: "This field is required."
                        }
                    }
                },
                Website: {
                    validators: {
                        notEmpty: {
                            message: "This field is required."
                        }
                    }
                },
                ContactPerson: {
                    validators: {
                        notEmpty: {
                            message: "This field is required."
                        },
                        regexp: {
                            regexp: /^[a-z\s]+$/i,
                            message: "Name should be consist of alphabetical characters and spaces only"
                        }
                    }
                },
                Designation: {
                    validators: {
                        notEmpty: {
                            message: "This field is required."
                        }
                    }
                },
                Email: {
                    validators: {
                        notEmpty: {
                            message: "This field is required."
                        }
                    }
                },
                Phone1: {
                    validators: {
                        notEmpty: {
                            message: "This field is required."
                        },
                        regexp: {
                            regexp: /(^(0(9(05|06|07|08|09|10|11|12|13|14|15|16|17|18|19|20|21|22|23|24|25|26|27|28|29|30|32|33|34|35|36|37|38|39|42|43|46|47|48|49|75|77|89|94|96|97|98)[0-9]{7}|[0-8][0-9]{5})|[1-9][0-9]{6})$|^$)/,
                            message: "Invalid phone number"
                        }
                    }
                },
                Phone2: {
                    validators: {
                        regexp: {
                            regexp: /(^(0(9(05|06|07|08|09|10|11|12|13|14|15|16|17|18|19|20|21|22|23|24|25|26|27|28|29|30|32|33|34|35|36|37|38|39|42|43|46|47|48|49|75|77|89|94|96|97|98)[0-9]{7}|[0-8][0-9]{5})|[1-9][0-9]{6})$|^$)/,
                            message: "Invalid phone number"
                        }
                    }
                },
                Phone3: {
                    validators: {
                        regexp: {
                            regexp: /(^(0(9(05|06|07|08|09|10|11|12|13|14|15|16|17|18|19|20|21|22|23|24|25|26|27|28|29|30|32|33|34|35|36|37|38|39|42|43|46|47|48|49|75|77|89|94|96|97|98)[0-9]{7}|[0-8][0-9]{5})|[1-9][0-9]{6})$|^$)/,
                            message: "Invalid phone number"
                        }
                    }
                },
                MobileNumber: {
                    validators: {
                        regexp: {
                            regexp: /^(0(9(05|06|07|08|09|10|11|12|13|14|15|16|17|18|19|20|21|22|23|24|25|26|27|28|29|30|32|33|34|35|36|37|38|39|42|43|46|47|48|49|75|77|89|94|96|97|98)[0-9]{7}|[0-8][0-9]{5})|[1-9][0-9]{6})$/,
                            message: "Invalid mobile number"
                        }
                    }
                },
                FaxNumber: {
                    validators: {
                        regexp: {
                            regexp: /^(([0-9]+[.]*)+$|^$)/i,
                            message: "Invalid fax number"
                        }
                    }
                },
                Industry: {
                    validators: {
                        notEmpty: {
                            message: "This field is required."
                        }
                    }
                },
                Representative1: {
                    validators: {
                        notEmpty: {
                            message: "This field is required."
                        },
                        regexp: {
                            regexp: /^[a-z\s]+$/i,
                            message: "Name should be consist of alphabetical characters and spaces only"
                        }
                    }
                },
                Representative2: {
                    validators: {
                        regexp: {
                            regexp: /^[a-z\s]+$/i,
                            message: "Name should be consist of alphabetical characters and spaces only"
                        }
                    }
                },
                'MarketingMaterials[]': {
                    validators: {
                        choice: {
                            min: 1,
                            message: "Please check atleast one."
                        }
                    }
                },
                'Participate': {
                    validators: {
                        choice: {
                            min: 1,
                            message: "Please check this."
                        }
                    }
                },
                'Requirements[]': {
                    validators: {
                        choice: {
                            min: 1,
                            message: "Please check atleast one."
                        }
                    }
                }
            }
        });
    });
</script>
