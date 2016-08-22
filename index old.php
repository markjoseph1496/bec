<?php
include('connection.php')
?>

<html lang="en">
<head>

    <title>Berlein Electronics Corp. | Registration</title>
    <meta charset="utf-8">

    <link rel="stylesheet" type="text/css" href="components/reset.css">
    <link rel="stylesheet" type="text/css" href="components/site.css">
    <link rel="stylesheet" type="text/css" href="components/container.css">
    <link rel="stylesheet" type="text/css" href="components/form.css">
    <link rel="stylesheet" type="text/css" href="components/grid.css">
    <link rel="stylesheet" type="text/css" href="components/header.css">
    <link rel="stylesheet" type="text/css" href="components/image.css">
    <link rel="stylesheet" type="text/css" href="components/menu.css">
    <link rel="stylesheet" type="text/css" href="components/divider.css">
    <link rel="stylesheet" type="text/css" href="components/dropdown.css">
    <link rel="stylesheet" type="text/css" href="components/segment.css">
    <link rel="stylesheet" type="text/css" href="components/modal.css">
    <link rel="stylesheet" type="text/css" href="components/button.css">
    <link rel="stylesheet" type="text/css" href="components/list.css">
    <link rel="stylesheet" type="text/css" href="components/icon.css">
    <link rel="stylesheet" type="text/css" href="components/sidebar.css">
    <link rel="stylesheet" type="text/css" href="components/transition.css">
    <link rel="stylesheet" type="text/css" href="components/rail.css">
    <link rel="stylesheet" type="text/css" href="components/sticky.css">
    <link rel="stylesheet" type="text/css" href="components/fileinput.min.css">
    <link rel="stylesheet" type="text/css" href="components/bootstrap.min.css">


    <script src="js/jquery-1.10.1.min.js"></script>
    <script type="text/javascript" src="components/sticky.js"></script>
    <script type="text/javascript" src="js/smoothscroll.js"></script>
    <script src="js/fileinput.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <!-- Important!!-->
    <script type="text/javascript" src="semantic-ui/semantic.min.js"></script>
    <link rel="stylesheet" type="text/css" href="semantic-ui/semantic.min.css">
</head>

<style TYPE="text/css">
    .masthead.segment {
        min-height: 700px;
        padding: 1em 0;
    }

    .masthead h1.ui.header {
        margin-top: 3em;
        margin-bottom: 0;
        font-size: 4em;
        font-weight: normal;
    }

    .ui.vertical.stripe {
        padding: 8em 0;
    }

    #content {
        padding: 60px 0;
    }

    footer {
        background: #58D475;
        padding: 3em 0;
    }
</style>

<body>

<div class="pusher">
    <div id="home" class="ui inverted vertical masthead center aligned segment">
        <div class="ui text container">
            <h1 class="ui inverted header">
                Berlein
                <div class="sub header">Electronics Corp.</div>
            </h1>
            <h3 class="ui inverted header">
                Unit G10A Regalia Park Tower
                <div class="sub header">150 P. Tuazon Avenue, Cor. EDSA Cubao, Quezon City</div>
            </h3>
            <a href="#start" class="smoothscroll ui pointing below red basic label">Good day, Let's Start!</a>
            <!--<a href="#work" class="smoothscroll ui pointing below yellow basic label">Work</a>
            <a href="#contact" class="smoothscroll ui pointing below green basic label">Contact</a>-->
        </div>
    </div>
</div>


<section id="start">
    <div class="ui equal width center aligned padded grid">
        <div class="row" style="background-color: #D95C5C;color: #FFFFFF;">
            <div class="two wide column"></div>
            <div class="twelve wide white column">
                <div class="ui column stackable grid container">
                    <div class="column">
                        <form class="ui form" name="frmRegister" id="frmRegister" method="POST" action="add.php">
                            <h3 class="ui dividing header">Staff Information</h3>

                            <div class="ui form">
                                <div class="field">
                                    <label>Branch Code</label>

                                    <div class="fields">
                                        <div class="three wide field">
                                            <select class="ui fluid dropdown" id="cboBranchCode" name="cboBranchCode">
                                                <option value="" selected="selected">Please Select One</option>
                                                <option value="1">Please Select One</option>
                                            </select>
                                        </div>
                                    </div>
                                    <br>
                                    <label>ID Picture</label>

                                    <div class="fields">
                                        <div class="six wide field">
                                            <div class="form-group">
                                                <input id="idpicture" name="idpicture" type="file" class="file file-loading" data-allowed-file-extensions='["png", "jpg", "jpeg"]'>
                                            </div>
                                            <script>
                                                $("#idpicture").fileinput({
                                                    showUpload: false
                                                });
                                            </script>
                                        </div>
                                    </div>
                                    <label>Name</label>

                                    <div class="fields">
                                        <div class="six wide field">
                                            <input type="text" id="txtLastName" name="txtLastName" placeholder="Last Name">
                                        </div>
                                        <div class="six wide field">
                                            <input type="text" id="txtFirstName" name="txtFirstName" placeholder="First Name">
                                        </div>
                                        <div class="six wide field">
                                            <input type="text" id="txtMiddleName" name="txtMiddleName" placeholder="Middle Name">
                                        </div>
                                    </div>
                                    <h4 class="ui dividing header">Address</h4>
                                    <div class="fields">
                                        <div class="five wide field">
                                            <label>Province</label>
                                            <select class="ui fluid dropdown" id="cboProvince" name="cboProvince">
                                                <option value="" selected="selected">Please Select One</option>
                                                <option value="abc">abc</option>
                                            </select>
                                        </div>
                                        <div class="five wide field">
                                            <label>City</label>
                                            <select class="ui fluid dropdown" id="cboCity" name="cboCity">
                                                <option value="" selected="selected">Please Select One</option>
                                                <option value="abc">abc</option>
                                            </select>
                                        </div>

                                        <div class="five wide field">
                                            <label>Barangay</label>
                                            <select class="ui fluid dropdown" id="cboBarangay" name="cboBarangay">
                                                <option value="" selected="selected">Please Select One</option>
                                                <option value="abc">abc</option>
                                            </select>
                                        </div>
                                        <div class="three wide field">
                                            <label>House No./Street</label>
                                            <input type="text" name="txtStreet" id="txtStreet">
                                        </div>

                                    </div>

                                    <div class="fields">
                                        <div class="eight wide field">
                                            <label>Email</label>
                                            <input type="text" name="txtEmail" id="txtEmail" placeholder="">
                                        </div>
                                        <div class="eight wide field">
                                            <label>Mobile No.</label>
                                            <input type="text" name="txtMobileNo" id="txtMobileNo" placeholder="">
                                        </div>
                                    </div>

                                    <div class="fields">
                                        <div class="seven wide field">
                                            <label>Civil Status</label>
                                            <select class="ui fluid dropdown" id="cboStatus" name="cboStatus">
                                                <option value="" selected="selected">Please Select One</option>
                                                <option value="single">Single</option>
                                                <option value="married">Married</option>
                                                <option value="widowed">Widowed</option>
                                                <option value="separated">Separated</option>
                                            </select>
                                        </div>
                                        <div class="seven wide field">
                                            <label>Gender</label>
                                            <select class="ui fluid dropdown" id="cboGender" name="cboGender">
                                                <option value="" selected="selected">Please Select One</option>
                                                <option value="female">Female</option>
                                                <option value="male">Male</option>
                                            </select>
                                        </div>
                                        <div class="two wide field">
                                            <label>Age</label>
                                            <input type="text" name="txtAge" id="txtAge" placeholder="">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="ui secondary segment">
                                <h4 class="ui header">If Married:</h4>

                                <div class="ui form">
                                    <div class="fields">
                                        <div class="six wide field">
                                            <label>Name of Spouse</label>
                                            <input type="text" name="txtSpouse" id="txtSpouse">
                                        </div>
                                        <div class="six wide field">
                                            <label>Occupation</label>
                                            <input type="text" name="txtOccupation" id="txtOccupation">
                                        </div>
                                        <div class="four wide field">
                                            <label>Number of Children</label>
                                            <input type="text" name="txtNumOfChildren" id="txtNumOfChildren">
                                        </div>
                                    </div>
                                    <div class="fields">
                                        <div class="sixteen wide field">
                                            <label>Provincial/City Address of Spouse</label>
                                            <input type="text" name="txtProvinceofSpouse" id="txtProvinceofSpouse">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="fields">
                                <div class="six wide field">
                                    <label>Religion</label>
                                    <input type="text" name="txtReligion" id="txtReligion">
                                </div>
                                <div class="six wide field">
                                    <label>Birthdate</label>
                                    <input type="date" name="txtBirthdate" id="txtBirthdate">
                                </div>
                                <div class="six wide field">
                                    <label>Birthplace</label>
                                    <input type="text" name="txtBirthplace" id="txtBirthplace">
                                </div>
                            </div>


                            <div class="fields">
                                <div class="eight wide field">
                                    <label>Father's Name</label>
                                    <input type="text" name="txtFather" id="txtFather">
                                </div>
                                <div class="eight wide field">
                                    <label>Father's Occupation</label>
                                    <input type="text" name="txtFOccupation" id="txtFOccupation">
                                </div>
                            </div>
                            <div class="fields">
                                <div class="eight wide field">
                                    <label>Address</label>
                                    <input type="text" name="txtFAddress" id="txtFAddress">
                                </div>
                                <div class="eight wide field">
                                    <label>Contact Number</label>
                                    <input type="text" name="txtFContactNumber" id="txtFContactNumber">
                                </div>
                            </div>
                            <div class="fields">
                                <div class="eight wide field">
                                    <label>Mother's Name</label>
                                    <input type="text" name="" id="txtMother">
                                </div>
                                <div class="eight wide field">
                                    <label>Mother's Occupation</label>
                                    <input type="text" name="" id="txtMOccupation" placeholder="">
                                </div>
                            </div>
                            <div class="fields">
                                <div class="eight wide field">
                                    <label>Address</label>
                                    <input type="text" name="" id="txtMAddress">
                                </div>
                                <div class="eight wide field">
                                    <label>Contact Number</label>
                                    <input type="text" name="" id="txtMContactNumber">
                                </div>
                            </div>

                            <div class="fields">
                                <div class="three wide field">
                                    <label>Number of Siblings</label>

                                    <select class="ui fluid dropdown" id="txtNoSiblings" name="txtNoSiblings">
                                        <option value="" selected="selected">Please Select One</option>
                                        <option value="0">0</option>
                                        <?php
                                        $x = 0;
                                        $y = 0;
                                        for ($x; $x <= 20; $x++) {
                                            for ($y; $y == $x; $y++) {
                                                echo "<option value=" . $y . ">" . $y . "</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="ui green segment">
                                <div class="fields">
                                    <div class="six wide field">
                                        <label>Name</label>
                                        <input type="text" name="txtSName" id="txtSName">
                                    </div>
                                    <div class="six wide field">
                                        <label>Address</label>
                                        <input type="text" name="txtSAddress" id="txtSAddress">
                                    </div>
                                    <div class="six wide field">
                                        <label>Occupation</label>
                                        <input type="text" name="txtSOccupation" id="txtSOccupation">
                                    </div>
                                    <div class="six wide field">
                                        <label>Contact No.</label>
                                        <input type="text" name="txtSContactNo" id="txtSContactNo">
                                    </div>
                                </div>
                            </div>

                            <h4 class="ui dividing header">Educational Attainment</h4>

                            <table class="ui definition table">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>School</th>
                                    <th>Years Inclusive</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>Primary</td>
                                    <td><input type="text" id="txtPrimarySchool"></td>
                                    <td><input type="text" id="txtPrimarySY"></td>
                                </tr>
                                <tr>
                                    <td>Secondary</td>
                                    <td><input type="text" id="txtSecondarySchool"></td>
                                    <td><input type="text" id="txtSecondarySY"></td>
                                </tr>
                                <tr>
                                    <td>Tertiary</td>
                                    <td><input type="text" id="txtTertiarySchool"></td>
                                    <td><input type="text" id="txtTertiarySY"></td>
                                </tr>
                                </tbody>
                            </table>
                            <div class="fields">
                                <div class="sixteen wide field">
                                    <label>Skills</label>
                                    <input type="text" name="txtSkills" id="txtSkills">
                                    <i>(Please separate with comma.)</i>
                                </div>
                            </div>

                            <h4 class="ui dividing header">Previous Employer(s)</h4>

                            <h3 class="ui right aligned header">
                                <button class="ui inverted yellow button">Add</button>
                            </h3>

                            <div class="ui yellow segment">
                                <div class="fields">
                                    <div class="six wide field">
                                        <label>Company Name</label>
                                        <input type="text" name="">
                                    </div>
                                    <div class="six wide field">
                                        <label>Imm. Supervisor</label>
                                        <input type="text" name="">
                                    </div>
                                    <div class="six wide field">
                                        <label>Address</label>
                                        <input type="text" name="">
                                    </div>
                                    <div class="six wide field">
                                        <label>Contact No.</label>
                                        <input type="text" name="">
                                    </div>
                                </div>
                            </div>

                            <div class="ui secondary segment">
                                <div class="field">
                                    <label>Contact Person to notify in case of Emergency (member of the family, friend, roommate)</label>

                                    <div class="fields">
                                        <div class="eight wide field">
                                            <input type="text" name="" placeholder="Company Name">
                                        </div>
                                        <div class="eight wide field">
                                            <input type="text" name="" placeholder="Address">
                                        </div>
                                    </div>
                                    <div class="fields">
                                        <div class="eight wide field">
                                            <input type="text" name="" placeholder="Relation">
                                        </div>
                                        <div class="eight wide field">
                                            <input type="text" name="" placeholder="Contact No.">
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="ui form">
                                <div class="fields">
                                    <div class="eight wide field">
                                        <label>TIN</label>
                                        <input type="text" name="">
                                    </div>
                                    <div class="eight wide field">
                                        <label>SSS</label>
                                        <input type="text" name="">
                                    </div>
                                    <div class="eight wide field">
                                        <label>PHIC</label>
                                        <input type="text" name="">
                                    </div>
                                    <div class="eight wide field">
                                        <label>HDMF</label>
                                        <input type="text" name="">
                                    </div>
                                </div>
                            </div>
                            <br>
                            <!-- <div class="ui red message">Please fill out all the informations asked. Don't leave anything blank.</div> -->
                            <button class="ui right floated huge inverted red button">SUBMIT</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="two wide column"></div>
        </div>
    </div>
</section>


<footer id="contact">
    <div class="ui vertical footer segment container">
        <div class="ui container">

            <div class="ui center aligned container">
                <a href="#home" class="smoothscroll ui pointing red basic label">
                    Go up... up!
                </a>
                <h5 class="ui header">
                    <div class="sub header">&copy; 2016 Berlein Electronics Corp. All rights reserved.</div>
                </h5>
            </div>
        </div>
    </div>
</footer>
</body>
</html>
<script type="text/javascript">
    $('select.dropdown')
        .dropdown();
</script>
<script type="text/javascript"