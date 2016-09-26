<?php
include('../../../connection.php');

//Add Branches
if (isset($_POST['BranchCode'])) {

    $BranchCode = strtoupper(db_quote($_POST['BranchCode']));
    $BranchName = strtoupper(db_quote($_POST['BranchName']));
    $Area = db_quote($_POST['BranchArea']);
    $BranchType = db_quote($_POST['BranchType']);
    $bBrand = db_quote($_POST['bBrand']);
    $AddBranch = db_query("INSERT INTO `branchtbl` (`BranchCode`,`BranchName`,`Brand`,`Area`,`BranchType`) VALUES ($BranchCode, $BranchName, $bBrand , $Area ,$BranchType)");

    if ($AddBranch === false) {
        echo "False";
    } else {
        echo "True";
    }
}
// End add branch

//Add Item
if (isset($_POST['ItemCode'])) {

    $ItemCode = strtoupper(db_quote($_POST['ItemCode']));
    $ModelName = strtoupper(db_quote($_POST['ModelName']));
    $ItemDescription = strtoupper(db_quote($_POST['ItemDescription']));
    $iBrand = db_quote($_POST['iBrand']);
    $ItemColor = db_quote($_POST['ItemColor']);
    $Category = db_quote($_POST['Category']);
    $SRP = db_quote($_POST['SRP']);
    $DP = db_quote($_POST['DP']);

    $AddItem = db_query("INSERT INTO `itemstbl` (`ItemCode`,`ModelName`,`ItemDescription`,`Brand`,`Color`,`Category`,`SRP`,`DP`)
		VALUES
        ($ItemCode, $ModelName, $ItemDescription, $iBrand, $ItemColor, $Category, $SRP, $DP)");

    if ($AddItem === false) {
        echo "False";
    } else {
        echo "True";
    }
}
//End Add Item

//Add Employee
if (isset($_POST['EmpID'])) {

    $EmpID = strtoupper(db_quote($_POST['EmpID']));
    $Firstname = db_quote($_POST['Firstname']);
    $Middlename = db_quote($_POST['Middlename']);
    $Lastname = db_quote($_POST['Lastname']);
    $Initials = db_quote($_POST['Initials']);
    $Position = db_quote($_POST['Position']);
    $Branch = db_quote($_POST['Branch']);

    $AddEmployee = db_query("INSERT INTO `employeetbl` (`EmpID`,`Firstname`,`Middlename`,`Lastname`,`Initials`,`Position`,`Branch`)
		VALUES
        ($EmpID, $Firstname, $Middlename, $Lastname, $Initials, $Position, $Branch)");

    if ($AddEmployee === false) {
        echo "False";
    } else {
        echo "True";
    }
}
// End Add Employee

// Add account
if (isset($_POST['btnaddaccount'])) {

    $aUsername = db_quote($_POST['aUsername']);
    $aPassword = db_quote($_POST['aPassword']);
    $aEmpID = db_quote($_POST['aEmpID']);

    $salt = hash('sha512', mt_rand(0, PHP_INT_MAX) . mt_rand(0, PHP_INT_MAX) . mt_rand(0, PHP_INT_MAX));
    $aPassword = hash('sha512', $aPassword . $salt);

    $AddAccount = db_query("INSERT INTO `accountstbl` (`aUsername`,`aPassword`,`aSaltedPassword`,`aEmpID`)
        VALUES ($aUsername,$aPassword ,$salt,$aEmpID)");

    header("location: ../employee.php?Accountadded");
}

// End of add account

//Update Branch

if (isset($_POST['EditBranchCode'])) {

    $BranchCode = strtoupper(db_quote($_POST['EditBranchCode']));
    $BranchName = strtoupper(db_quote($_POST['EditBranchName']));
    $Area = db_quote($_POST['EditBranchArea']);
    $BranchType = db_quote($_POST['EditBranchType']);
    $bBrand = db_quote($_POST['EditBrand']);

    $UpdateBranch = db_query("UPDATE `branchtbl` SET `BranchName` = $BranchName, `Area` = $Area, `BranchType` = $BranchType, `Brand` = $bBrand WHERE `BranchCode` = $BranchCode");

    if ($UpdateBranch === false) {
        echo "False";
        echo db_error();
    } else {
        echo "True";
    }
}
//End Update branch

//Update Item
if (isset($_POST['btnupdateitem'])) {

    $uItemCode = strtoupper(db_quote($_POST['uItemCode']));
    $uModelName = strtoupper(db_quote($_POST['uModelName']));
    $uItemDescription = strtoupper(db_quote($_POST['uItemDescription']));
    $uiBrand = db_quote($_POST['uiBrand']);
    $uCategory = db_quote($_POST['uCategory']);
    $uSRP = db_quote($_POST['uSRP']);
    $uDP = db_quote($_POST['uDP']);

    $UpdateItem = db_query("UPDATE `itemstbl` SET `ModelName` = $uModelName, `ItemDescription` = $uItemDescription, `Brand` = $uiBrand, `Category` = $uCategory, `SRP` = $uSRP, `DP` = $uDP WHERE `ItemCode` = $uItemCode");

    header('location: ../item.php?Updated');
}
//End Update Item

//Update Employee
if (isset($_POST['btnupdateemployee'])) {

    $uEmpID = db_quote($_POST['uEmpID']);
    $uFirstname = db_quote($_POST['uFirstname']);
    $uMiddlename = db_quote($_POST['uMiddlename']);
    $uLastname = db_quote($_POST['uLastname']);
    $uInitials = db_quote($_POST['uInitials']);
    $uPosition = db_quote($_POST['uPosition']);
    $uBranch = db_quote($_POST['uBranch']);

    $UpdateEmployee = db_query("UPDATE `employeetbl` SET `Firstname` = $uFirstname, `Middlename` = $uMiddlename, `Lastname` = $uLastname, `Initials` = $uInitials, `Position` = $uPosition, `Branch` = $uBranch WHERE `EmpID` = $uEmpID");

    header('location: ../employee.php?Updated');
}

if (isset($_POST['dBranchCode'])) {
    $dBranchCode = db_quote($_POST['dBranchCode']);

    $Branches = db_select("SELECT * FROM `branchtbl` WHERE `BranchCode` =" . $dBranchCode);

    $BranchCode = $Branches[0]['BranchCode'];
    $BranchName = $Branches[0]['BranchName'];
    $Brand = $Branches[0]['Brand'];
    $Area = $Branches[0]['Area'];
    $BranchType = $Branches[0]['BranchType'];

    ?>
    <div class="modal-dialog">
        <!-- Modal content-->
        <form id="EditBranch" method="POST" autocomplete="off">
            <div class="modal-content">
                <div class="modal-header modal-header-dark">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Update Branch</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Branch Code <span class="red">(*)</span></label>
                                <input type="text" class="form-control" style="text-transform: uppercase" id="EditBranchCode" name="EditBranchCode" value="<?php echo $BranchCode ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label>Branch Name <span class="red">(*)</span></label>
                                <input type="text" class="form-control" style="text-transform: uppercase" id="EditBranchName" name="EditBranchName" value="<?php echo $BranchName ?>">
                            </div>
                            <div class="form-group">
                                <label>Brand <span class="red">(*)</span></label>
                                <select class="form-control" name="EditBrand" id="EditBrand">
                                    <option selected="selected" value=""> - Please Select one -</option>
                                    <option value="Berlein Mobile" <?php if ($Brand == "Berlein Mobile") echo "selected='selected'" ?>>Berlein Mobile</option>
                                    <option value="Cherry Mobile" <?php if ($Brand == "Cherry Mobile") echo "selected='selected'" ?>>Cherry Mobile</option>
                                    <option value="MyPhone" <?php if ($Brand == "MyPhone") echo "selected='selected'" ?>>MyPhone</option>
                                    <option value="Oppo" <?php if ($Brand == "Oppo") echo "selected='selected'" ?>>Oppo</option>
                                    <option value="Huawei" <?php if ($Brand == "Huawei") echo "selected='selected'" ?>>Huawei</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Branch Area <span class="red">(*)</span></label>
                                <select class="form-control" name="EditBranchArea" id="EditBranchArea">
                                    <option selected="selected" value=""> - Please Select one -</option>
                                    <option value="North Luzon" <?php if ($Area == "North Luzon") echo "selected='selected'" ?>>North Luzon</option>
                                    <option value="Central Luzon" <?php if ($Area == "Central Luzon") echo "selected='selected'" ?>>Central Luzon</option>
                                    <option value="NCR North" <?php if ($Area == "NCR North") echo "selected='selected'" ?>>NCR North</option>
                                    <option value="NCR Central" <?php if ($Area == "NCR Central") echo "selected='selected'" ?>>NCR Central</option>
                                    <option value="NCR Mandaluyong" <?php if ($Area == "NCR Mandaluyong") echo "selected='selected'" ?>>NCR Mandaluyong</option>
                                    <option value="NCR South" <?php if ($Area == "NCR South") echo "selected='selected'" ?>>NCR South</option>
                                    <option value="Cebu" <?php if ($Area == "Cebu") echo "selected='selected'" ?>>Cebu</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Branch Type <span class="red"> (*)</span></label>
                                <select class="form-control" name="EditBranchType" id="EditBranchType">
                                    <option selected="selected" value=""> - Please Select one -</option>
                                    <option value="Inline" <?php if ($BranchType == "Inline") echo "selected='selected'" ?>>Inline</option>
                                    <option value="Kiosk" <?php if ($BranchType == "Kiosk") echo "selected='selected'" ?>>Kiosk</option>
                                    <option value="Concept" <?php if ($BranchType == "Concept") echo "selected='selected'" ?>>Concept</option>
                                </select>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-dark">Save</button>
                    <button class="btn btn-dark" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </form>
    </div>

    <!-- validator -->
    <script type="text/javascript">
        $(document).ready(function () {
            $('#EditBranch').bootstrapValidator({
                message: 'This value is not valid',
                feedbackIcons: {
                    valid: "glyphicon glyphicon-ok",
                    invalid: "glyphicon glyphicon-remove",
                    validating: "glyphicon glyphicon-refresh"
                },
                fields: {
                    group: 'form-group',
                    EditBranchName: {
                        validators: {
                            notEmpty: {
                                message: 'Branch Name is required.'
                            }
                        }
                    },
                    EditBranchArea: {
                        validators: {
                            notEmpty: {
                                message: 'Branch Area is required.'
                            }
                        }
                    },
                    EditBranchType: {
                        validators: {
                            notEmpty: {
                                message: 'Branch Type is required.'
                            }
                        }
                    },
                    EditBrand: {
                        validators: {
                            notEmpty: {
                                message: 'Brand is required.'
                            }
                        }
                    }
                }
            }).on('success.form.bv', function (e) {
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: 'function/functions.php',
                    data: $('#EditBranch').serialize(),
                    success: function (data) {
                        if (data == "True") {
                            window.location.href = "branch.php";
                        }
                    }
                })
            });
        });
    </script>
    <!-- /validator-->
    <?php
}
?>