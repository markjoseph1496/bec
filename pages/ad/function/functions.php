<?php
include('../../../connection.php');

//Add Branches
if (isset($_POST['BranchCode'])) {

    $BranchCode = strtoupper(db_quote($_POST['BranchCode']));
    $BranchName = strtoupper(db_quote($_POST['BranchName']));
    $bBrand = db_quote($_POST['bBrand']);
    $BranchArea = db_quote($_POST['BranchArea']);

    $AddBranch = db_query("INSERT INTO `branchtbl` (`BranchCode`,`BranchName`,`BrandID`,`AreaID`) VALUES ($BranchCode, $BranchName, $bBrand , $BranchArea)");

    if ($AddBranch === false) {
        echo "False";
    } else {
        echo "True";
    }
}
// End add branch

//Add Item
if (isset($_POST['ItemCode'])) {

    $Category = db_quote($_POST['Category']);
    $ItemBrand = db_quote($_POST['ItemBrand']);
    $ItemCode = strtoupper(db_quote($_POST['ItemCode']));
    $ModelName = strtoupper(db_quote($_POST['ModelName']));
    $ItemDescription = strtoupper(db_quote($_POST['ItemDescription']));
    $SRP = db_quote($_POST['SRP']);
    $DP = db_quote($_POST['DP']);

    $AddItem = db_query("INSERT INTO `itemstbl` (`CategoryID`,`BrandID`,`ItemCode`,`ModelName`,`ItemDescription`,`SRP`,`DP`)
		VALUES
        ($Category, $ItemBrand, $ItemCode, $ModelName, $ItemDescription, $SRP, $DP)");

    if ($AddItem === false) {
        echo "False";
    } else {
        echo "True";
    }

}
//End Add Item

//Add Employee
if (isset($_POST['AddEmpID'])) {

    $AddEmpID = strtoupper(db_quote($_POST['AddEmpID']));
    $Firstname = db_quote($_POST['Firstname']);
    $Middlename = db_quote($_POST['Middlename']);
    $Lastname = db_quote($_POST['Lastname']);
    $Initials = db_quote($_POST['Initials']);
    $Position = db_quote($_POST['Position']);
    $Branch = db_quote($_POST['Branch']);
    $eArea = db_quote($_POST['eArea']);

    $AddEmployee = db_query("INSERT INTO `employeetbl` (`EmpID`,`Firstname`,`Middlename`,`Lastname`,`Initials`,`Position`,`BranchID`,`AreaID`)
		VALUES
        ($EmpID, $Firstname, $Middlename, $Lastname, $Initials, $Position, $Branch,$eArea)");

    if ($AddEmployee === false) {
        echo "False";
    } else {
        echo "True";
    }
}
// End Add Employee

// Add Area
if (isset($_POST['AddArea'])) {

    $AreaID = db_quote($_POST['AreaID']);
    $AddArea = strtoupper(db_quote($_POST['AddArea']));

    $AddArea = db_query("INSERT INTO `areatbl` (`AreaID`,`Area`) VALUES  ($AreaID,$AddArea)");

    if ($AddArea === false) {
        echo "False";
    } else {
        echo "True";
    }
}
// End of Add Area

//Add Brand
if (isset($_POST['BrandID'])) {

    $BrandID = db_quote($_POST['BrandID']);
    $BrandCode = db_quote($_POST['BrandCode']);
    $AddBrand = strtoupper(db_quote($_POST['AddBrand']));

    $AddBrand = db_query("INSERT INTO `brandtbl` (`BrandID`,`BrandCode`,`Brand`) VALUES ($BrandID,$BrandCode,$AddBrand)");

    if ($AddBrand == false) {
        echo "False";
    } else {
        echo "True";
    }
}
// End Add Brand

// Add Color
if (isset($_POST['AddColor'])) {

    $ColorID = db_quote($_POST['ColorID']);
    $AddColor = strtoupper(db_quote($_POST['AddColor']));

    $AddColor = db_query("INSERT INTO `colortbl` (`ColorID`,`Color`) VALUES ($ColorID,$AddColor)");

    if ($AddColor == false) {
        echo "False";
    } else {
        echo "True";
    }
}

// Add Category
if (isset($_POST['CategoryID'])) {

    $CategoryID = db_quote($_POST['CategoryID']);
    $CategoryCode = strtoupper(db_quote($_POST['CategoryCode']));
    $AddCategory = strtoupper(db_quote($_POST['AddCategory']));

    $AddCategory = db_query("INSERT INTO `categorytbl` (`CategoryID`,`CategoryCode`,`Category`)  VALUES ($CategoryID,$CategoryCode,$AddCategory)");

    if ($AddCategory == false) {
        echo "False";
    } else {
        echo "True";
    }
}

// Add account
if (isset($_POST['btnaddAccount'])) {

    $aUsername = db_quote($_POST['aUsername']);
    $aPassword = db_quote($_POST['aPassword']);
    $aEmpID = db_quote($_POST['aEmpID']);

    $aSaltedPassword = hash('sha512', mt_rand(0, PHP_INT_MAX) . mt_rand(0, PHP_INT_MAX) . mt_rand(0, PHP_INT_MAX));
    $aPassword = hash('sha512', $aPassword . $aSaltedPassword);


    $AddAccount = db_query("INSERT INTO `accountstbl` (`aUsername`,`aPassword`,`aSaltedPassword`,`aEmpID`)
        VALUES (". $aUsername .",". $aPassword .",". $aSaltedPassword .",". $aEmpID .")");

    echo db_error();
    die();

    //header("location: ../employee.php?Accountadded");
    //echo $_POST['aEmpID'];
    //echo $_POST['aUsername'];
    //echo $_POST['aPassword'];
    //echo $salt;
    //die();
}
// End of add account

//Update Branch

if (isset($_POST['EditBranchCode'])) {

    $EditBranchCode = strtoupper(db_quote($_POST['EditBranchCode']));
    $EditBranchName = strtoupper(db_quote($_POST['EditBranchName']));
    $EditBrand = db_quote($_POST['EditBrand']);
    $EditBranchArea = db_quote($_POST['EditBranchArea']);


    $UpdateBranch = db_query("UPDATE `branchtbl` SET `BranchName` = $EditBranchName, `BrandID` = $EditBrand, `AreaID` = $EditBranchArea WHERE `BranchCode` = $EditBranchCode");

    header("location: ../branch.php?Updated");
}
//End Update branch

//Update Item
if (isset($_POST['btnupdateItems'])) {

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
    $ueArea = db_quote($_POST['ueArea']);

    $UpdateEmployee = db_query("UPDATE `employeetbl` SET `Firstname` = $uFirstname, `Middlename` = $uMiddlename, `Lastname` = $uLastname, `Initials` = $uInitials, `Position` = $uPosition, `BranchID` = $uBranch, `AreaID` = $ueArea WHERE `EmpID` = $uEmpID");

    header('location: ../employee.php?Updated');
}
//End Update Employee

//Modal of update employee
if (isset($_POST['EmpID'])) {
    $UpdateEmpID = db_quote($_POST['EmpID']);

    $UpdateEmployeetbl = db_select("
    SELECT 
    employeetbl.EmpID, 
    employeetbl.Firstname, 
    employeetbl.Middlename, 
    employeetbl.Lastname,
    employeetbl.Initials, 
    employeetbl.Position, 
    branchtbl.BranchName, 
    areatbl.Area
    FROM employeetbl
    LEFT JOIN branchtbl ON employeetbl.BranchID = branchtbl.BranchID
    LEFT JOIN  areatbl ON employeetbl.AreaID = areatbl.AreaID");

    $EmpID = $UpdateEmployeetbl[0]['EmpID'];
    $UpdateFirstname = $UpdateEmployeetbl[0]['Firstname'];
    $UpdateMiddlename = $UpdateEmployeetbl[0]['Middlename'];
    $UpdateLastname = $UpdateEmployeetbl[0]['Lastname'];
    $UpdateInitials = $UpdateEmployeetbl[0]['Initials'];
    $UpdatePosition = $UpdateEmployeetbl[0]['Position'];
    $UpdateBranchName = $UpdateEmployeetbl[0]['BranchName'];
    $UpdateArea = $UpdateEmployeetbl[0]['Area'];
    ?>
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <form method="POST" name="EditEmployee" id="EditEmployee" autocomplete="off">
                <div class="modal-header modal-header-dark">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Edit Employee</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Employee ID <span class="red">(*)</span></label>
                                <input type="text" readonly="readonly" class="form-control" style="text-transform: uppercase" id="uEmpID" name="uEmpID"
                                       value="<?php echo $EmpID; ?>">
                            </div>
                            <div class="form-group">
                                <label>First Name <span class="red">(*)</span></label>
                                <input type="text" class="form-control" style="text-transform: uppercase" id="uFirstname" name="uFirstname"
                                       value="<?php echo $UpdateFirstname; ?>">
                            </div>
                            <div class="form-group">
                                <label>Middle Name <span class="red">(*)</span></label>
                                <input type="text" class="form-control" style="text-transform: uppercase" id="uMiddlename" name="uMiddlename"
                                       value="<?php echo $UpdateMiddlename; ?>">
                            </div>
                            <div class="form-group">
                                <label>Last Name <span class="red">(*)</span></label>
                                <input type="text" class="form-control" style="text-transform: uppercase" id="uLastname" name="uLastname"
                                       value="<?php echo $UpdateLastname; ?>">
                            </div>
                            <div class="form-group">
                                <label>Initials <span class="red">(*)</span></label>
                                <input type="text" class="form-control" style="text-transform: uppercase" id="uInitials" name="uInitials"
                                       value="<?php echo $UpdateInitials; ?>">
                            </div>
                            <div class="form-group">
                                <label>Position <span class="red">(*)</span></label>
                                <input type="text" class="form-control" style="text-transform: uppercase" id="uPosition" name="uPosition"
                                       value="<?php echo $UpdatePosition; ?>">
                            </div>
                            <div class="form-group">
                                <label>Branch <span class="red">(*)</span></label>
                                <select class="form-control" id="uBranch" name="uBranch">
                                    <option value="" selected="selected"><?= @$UpdateBranchName; ?></option>
                                    <?php
                                    $branchtbl = db_select("SELECT `BranchName`,`BranchID` FROM `branchtbl`");

                                    foreach ($branchtbl as $value) {
                                        $BranchName = $value['BranchName'];
                                        $BranchID = $value['BranchID'];
                                        ?>
                                        <option value="<?php echo $BranchID; ?>"><?php echo $BranchName; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Area <span class="red">(*)</span></label>
                                <select class="form-control" id="ueArea" name="ueArea">
                                    <option value="" selected="selected"><?= @$UpdateArea; ?></option>
                                    <?php
                                    $Areatbl = db_select("SELECT `AreaID`, `Area` FROM `areatbl`");

                                    foreach ($Areatbl as $vArea) {
                                        $AreaID = $vArea['AreaID'];
                                        $Area = $vArea['Area'];
                                        ?>
                                        <option value="<?= @$AreaID; ?>"><?= @$Area; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-dark" id="btnupdateemployee" name="btnupdateemployee">Update</button>
                    <button class="btn btn-dark" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>

<?php
}
// End of Update Modal

//Update Account
if (isset($_POST['btnupdateaccount'])) {

    $UpdateaUsername = db_quote($_POST['UpdateaUsername']);
    $UpdateaEmpID = db_quote($_POST['UpdateaEmpID']);
    $UpdateFirstname = db_quote($_POST['UpdateFirstname']);
    $UpdateMiddleName = db_quote($_POST['UpdateMiddlename']);
    $UpdateLastname = db_quote($_POST['UpdateLastname']);

    $UpdateAccount = db_query("UPDATE accountstbl
                              INNER JOIN employeetbl
                              ON accountstbl.aEmpID = employeetbl.EmpID
                              SET accountstbl.aUsername = $UpdateaUsername, employeetbl.Firstname = $UpdateFirstname,
                              employeetbl.Middlename = $UpdateMiddleName, employeetbl.Lastname = $UpdateLastname
                              WHERE employeetbl.EmpID = $UpdateaEmpID");

    header('location: ../accounts.php?Updated');
}
//End update account

//Update Area
if (isset($_POST['btnupdatearea'])) {

    $EditAreaID = db_quote($_POST['EditAreaID']);
    $EditArea = db_quote($_POST['EditArea']);

    $UpdateArea = db_query("UPDATE areatbl SET `Area` = $EditArea WHERE AreaID = $EditAreaID");

    header("location: ../area.php?Updated");
}
// End of Update Area

//Update Brand
if (isset($_POST['btnupdatebrand'])) {

    $EditBrandID = db_quote($_POST['EditBrandID']);
    $EditBrandCode = db_quote($_POST['EditBrandCode']);
    $EditBrand = strtoupper(db_quote($_POST['EditBrand']));

    $UpdateBrand = db_query("UPDATE brandtbl SET BrandCode = $EditBrandCode, Brand = $EditBrand WHERE  BrandID = $EditBrandID");

    header("location: ../brand.php?Updated");
}
//End of Update Brand

//Update Color
if (isset($_POST['btnupdatecolor'])) {

    $EditColorID = db_quote($_POST['EditColorID']);
    $EditColor = strtoupper(db_quote($_POST['EditColor']));

    $UpdateColor = db_query("UPDATE colortbl SET `Color` = $EditColor WHERE `ColorID` = $EditColorID");

    header("location: ../colors.php?Updated");
}
// End of Update Color

// Update Category
if (isset($_POST['btnupdateCategory'])) {

    $EditCategoryID = db_quote($_POST['EditCategoryID']);
    $EditCategoryCode = strtoupper(db_quote($_POST['EditCategoryCode']));
    $EditCategory = strtoupper(db_quote($_POST['EditCategory']));

    $UpdateCategory = db_query("UPDATE `categorytbl` SET `CategoryCode` = $EditCategoryCode, `Category` = $EditCategory WHERE  `CategoryID` = $EditCategoryID");

    header("location: ../category.php?Updated");

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