<?php
include('../connection.php');
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Basic -->
    <title>BERLEIN ELECTRONICS Corporation</title>

    <!-- Define Charset -->
    <meta charset="utf-8">

    <?php
    include('../css.text');
    ?>

</head>

<body>
<form method="POST" id="registration" name="registration" autocomplete="off" action="">
    <!-- Container -->
    <div id="container">
        <div class="hidden-header"></div>
        <!-- Start Content -->
        <div id="content">
            <div class="container">
                <div class="big-title text-center">
                    <h1><strong>Registration</strong></h1>
                </div>
                <h3><strong>Staff Details:</strong></h3>
                <br>

                <div class="row">
                    <div class="col-md-2">
                        <label>First Name <span>(*)</span></label>

                        <div class="form-group">
                            <input type="text" class="form-control" id="FirstName" name="FirstName">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <label>Middle Name <span></span></label>

                        <div class="form-group">
                            <input type="text" class="form-control" id="LastName" name="LastName">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <label>Last Name <span>(*)</span></label>

                        <div class="form-group">
                            <input type="text" class="form-control" id="LastName" name="LastName">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label>Birthdate <span>(*)</span></label>

                        <div class="form-group">
                            <div class="controls">
                                <input type="date" class="form-control" name="Birthday" id="Birthday">
                            </div>
                        </div>


                        <label>Mobile Number <span>(*)</span></label>

                        <div class="form-group">
                            <div class="controls">
                                <input type="text" class="form-control" id="MobileNumber" name="MobileNumber" maxlength="11">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label>Email <span>(*)</span></label>

                        <div class="form-group">
                            <div class="controls">
                                <input type="email" class="form-control" id="Email" name="Email">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label>Address <span>(*)</span></label>

                        <div class="form-group">
                            <div class="controls">
                                <select id="City" name="City" class="form-control" style="width:100%; height:34px;">
                                    <option value="">- Please select one -</option>
                                    <option value="Caloocan City">Caloocan City</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <br><br>

                <div class="hr5" style="margin-top:40px;margin-bottom:40px;"></div>
                <div class
                "row">
                <div class="col-md-6">
                    <label><b>By clicking the "Sign Up" button, I certify that I have read and agree to the <a
                                href="" target="_blank">Terms of Use</a>.</b></label>
                </div>
                <div class="col-md-6">
                    &nbsp;
                </div>
            </div>

            <div class="row">
                <button type="submit" name="btnSave" class="btn-system btn-large border-btn" style="float:right;">Sign Up</button>
            </div>
        </div>
    </div>
    </div>
    <!-- End content -->

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
                            <li><a href="#">Contact</a>
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

</form>
</body>
</html>