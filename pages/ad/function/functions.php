<?php
include('../../../connection.php');
include('../../../functions/encryption.php');

function generateBranchID()
{
    $generateBranchID = db_select("SELECT `BranchID` FROM `branchtbl` ORDER BY BranchID DESC LIMIT 1");

    if ($generateBranchID === false) {
        echo db_error();
    }
    if (count($generateBranchID) == 0) {
        return str_replace("'", "", "BH-" . "001");
    } else {
        $pCount = substr($generateBranchID[0]['BranchID'], 3);
        $gBranchID = "BH-" . sprintf("%03s", (int)$pCount + 1);
        return $gBranchID;
    }
}

function generateAreaID()
{
    $generateAreaID = db_select("SELECT `AreaID` FROM `areatbl` ORDER BY AreaID DESC LIMIT 1");

    if ($generateAreaID === false) {
        echo db_error();
    }
    if (count($generateAreaID) == 0) {
        return str_replace("'", "", "AR-" . "001");
    } else {
        $pCount = substr($generateAreaID[0]['AreaID'], 3);
        $gAreaID = "AR-" . sprintf("%03s", (int)$pCount + 1);
        return $gAreaID;
    }
}

function generateCatergoryID()
{
    $generateID = db_select("SELECT `CategoryID` FROM `categorytbl` ORDER BY `CategoryID` DESC LIMIT 1");

    if ($generateID === false) {
        echo db_error();
    }
    if (count($generateID) == 0) {
        return str_replace("'", "", "CT-" . "001");
    } else {
        $pCount = substr($generateID[0]['CategoryID'], 3);
        $gID = "CT-" . sprintf("%03s", (int)$pCount + 1);
        return $gID;
    }
}

//Add Branches
if (isset($_POST['AddBranchCode'])) {

    $BranchID = db_quote(generateBranchID());
    $AddBranchCode = strtoupper(db_quote($_POST['AddBranchCode']));
    $BranchName = db_quote(ucwords($_POST['BranchName']));
    $bBrand = db_quote($_POST['bBrand']);
    $BranchArea = db_quote($_POST['BranchArea']);

    $AddBranch = db_query("INSERT INTO `branchtbl` (`BranchID`, `BranchCode`,`BranchName`,`BrandID`,`AreaID`) VALUES ($BranchID, $AddBranchCode, $BranchName, $bBrand , $BranchArea)");
    $Branch = str_replace("'", "", strtolower($AddBranchCode));
    $Inv = $Branch . "invtbl";
    $Cash = $Branch . "cashtransactiontbl";
    $Credit = $Branch . "credittransactiontbl";
    $HomeCredit = $Branch . "homecredittransactiontbl";
    $Transaction = $Branch . "transactiontbl";
    $SoldUnits = $Branch . "soldunitstbl";
    $ReceivedUnits = $Branch . "receivedtbl";

    $CreateReceived = db_query("CREATE TABLE $ReceivedUnits (
                          _count INT(7) NOT NULL PRIMARY KEY AUTO_INCREMENT,
                          ItemCode VARCHAR (11) NOT NULL,
                          ItemColor VARCHAR (15) NOT NULL,
                          imeisn VARCHAR(30) NOT NULL,
                          _DateReceived VARCHAR (15) NOT NULL,
                          _TimeReceived VARCHAR (15) NOT NULL,
                          ReceivedBy VARCHAR (15) NOT NULL,
                          DRnumber VARCHAR(15) NOT NULL)");

    $CreateInv = db_query("CREATE TABLE $Inv (
                          _count INT(7) NOT NULL PRIMARY KEY AUTO_INCREMENT,
                          ItemCode VARCHAR (11) NOT NULL,
                          ItemColor VARCHAR (15) NOT NULL,
                          imeisn VARCHAR(30) NOT NULL)");

    $CreateCash = db_query("CREATE TABLE $Cash (
                          _count INT(7) NOT NULL PRIMARY KEY AUTO_INCREMENT,
                          TransactionID VARCHAR (20) NOT NULL,
                          ORNumber VARCHAR (20) NOT NULL,
                          Amount VARCHAR (7) NOT NULL)");

    $CreateCredit = db_query("CREATE TABLE $Credit (
                            _count INT(7) NOT NULL PRIMARY KEY AUTO_INCREMENT,
                            TransactionID VARCHAR (20) NOT NULL,
                            ORNumber VARCHAR (20) NOT NULL,
                            CreditCardNumber VARCHAR (20) NOT NULL,
                            CardHolderName VARCHAR (20) NOT NULL,
                            MID VARCHAR (20) NOT NULL,
                            BatchNum VARCHAR (20) NOT NULL,
                            ApprCode VARCHAR (20) NOT NULL,
                            Term VARCHAR (20) NOT NULL,
                            IDPresented VARCHAR (20) NOT NULL,
                            Amount VARCHAR (20) NOT NULL)");

    $CreateHomeCredit = db_query("CREATE TABLE $HomeCredit (
                                _count INT(7) NOT NULL PRIMARY KEY AUTO_INCREMENT,
                                TransactionID VARCHAR (20) NOT NULL,
                                ORNumber VARCHAR (20) NOT NULL,
                                ReferenceNo VARCHAR (20) NOT NULL,
                                Amount VARCHAR (20) NOT NULL)");

    $CreateTransaction = db_query("CREATE TABLE $Transaction (
                                  _count INT(7) NOT NULL PRIMARY KEY AUTO_INCREMENT,
                                  TransactionID VARCHAR (20) NOT NULL,
                                  ORNumber VARCHAR (20) NOT NULL,
                                  _Date VARCHAR (20) NOT NULL,
                                  _Time VARCHAR (20) NOT NULL,
                                  CustomerName VARCHAR (20) NOT NULL,
                                  SalesClerk VARCHAR (20) NOT NULL,
                                  Cashier VARCHAR (20) NOT NULL,
                                  ModeOfPayment VARCHAR (30) NOT NULL,
                                  Status VARCHAR (15) NOT NULL)");

    $CreateSoldUnit = db_query("CREATE TABLE $SoldUnits (
                                _count INT(7) NOT NULL PRIMARY KEY AUTO_INCREMENT,
                                ItemCode VARCHAR (11) NOT NULL,
                                ItemColor VARCHAR (15) NOT NULL,
                                imeisn VARCHAR(30) NOT NULL,
                                TransactionID VARCHAR (20) NOT NULL)");

    if ($AddBranch === false) {
        echo "False";
    } else {
        echo "True";
    }
}
// End add branch

//Add Item
elseif (isset($_POST['btnAddItem'])) {

    $CategoryPOST = db_quote($_POST['CategoryID']);
    $ItemBrand = db_quote($_POST['ItemBrand']);
    $AddItemCode = strtoupper(db_quote($_POST['AddItemCode']));
    $ModelName = db_quote(ucwords($_POST['ModelName']));
    $ItemDescription = db_quote(ucwords($_POST['ItemDescription']));
    $AvailableColor = $_POST['color'];
    $ItemBrandID = db_quote($_POST['ItemBrandID']);
    $Category = db_quote($_POST['Category']);
    $SRP = $_POST['SRP'];
    $DP = $_POST['DP'];
    $CriticalLevel = db_quote($_POST['CriticalLevel']);

    $AvailableColor = db_quote(ucwords(implode(", ", $AvailableColor)));
    $SRP = db_quote((float)str_replace(',', '', $SRP));
    $DP = db_quote((float)str_replace(',', '', $DP));

    $AddItem = db_query("INSERT INTO `itemstbl` (`CategoryCode`,`BrandCode`,`ItemCode`,`ModelName`,`ItemDescription`,`AvailableColor`,`BrandID`,`Category`,`SRP`,`DP`,`CriticalLevel`)
		VALUES
        ($CategoryPOST, $ItemBrand, $AddItemCode, $ModelName, $ItemDescription, $AvailableColor, $ItemBrandID, $Category, $SRP, $DP,$CriticalLevel)");

    if ($AddItem === false) {
        header("location: ../items.php?error");
    } else {
        header("location: ../items.php?success");
    }
}
//End Add Item

//Add Employee
elseif (isset($_POST['AddEmpID'])) {

    $AddEmpID = db_quote(strtoupper($_POST['AddEmpID']));
    $Firstname = db_quote(ucwords($_POST['Firstname']));
    $Middlename = db_quote(ucwords($_POST['Middlename']));
    $Lastname = db_quote(ucwords($_POST['Lastname']));
    $Initials = db_quote(strtoupper($_POST['Initials']));
    $Position = db_quote(ucwords($_POST['Position']));
    $Branch = db_quote($_POST['Branch']);
    $eArea = db_quote($_POST['eArea']);
    $Brand = db_quote($_POST['Brand']);


    $AddEmployee = db_query("
        INSERT INTO `employeetbl` 
        (`EmpID`,`Firstname`,`Middlename`,`Lastname`,`Initials`,`Position`,`BranchID`,`AreaID`,`BrandID`)
		VALUES
        ($AddEmpID, $Firstname, $Middlename, $Lastname, $Initials, $Position, $Branch,$eArea, $Brand)");

    if ($AddEmployee === false) {
        echo "False";
    } else {
        echo "True";
    }
}
// End Add Employee

// Add Area
elseif (isset($_POST['AddArea'])) {

    $AddAreaID = db_quote(generateAreaID());
    $AddArea = db_quote(ucwords($_POST['AddArea']));

    $QueryAdd = db_query("INSERT INTO `areatbl` (`AreaID`,`Area`) VALUES  ($AddAreaID,$AddArea)");

    if ($QueryAdd === false) {
        echo "asdsa";
    } else {
        echo "True";
    }
}
// End of Add Area

//Add Brand
elseif (isset($_POST['AddBrandID'])) {

    $AddBrandID = db_quote($_POST['AddBrandID']);
    $BrandCode = db_quote($_POST['BrandCode']);
    $AddBrand = db_quote(ucwords($_POST['AddBrand']));

    $AddBrand = db_query("INSERT INTO `brandtbl` (`BrandID`,`BrandCode`,`Brand`) VALUES ($AddBrandID,$BrandCode,$AddBrand)");

    if ($AddBrand == false) {
        echo "False";
    } else {
        echo "True";
    }
}
// End Add Brand

// Add Category
elseif (isset($_POST['CategoryCode'])) {

    $AddCategoryID = db_quote(generateCatergoryID());
    $CategoryCode = strtoupper(db_quote($_POST['CategoryCode']));
    $AddCategory = db_quote(ucwords($_POST['AddCategory']));

    $AddCategory = db_query("INSERT INTO `categorytbl` (`CategoryID`,`CategoryCode`,`Category`)  VALUES ($AddCategoryID,$CategoryCode,$AddCategory)");

    if ($AddCategory == false) {
        echo "False";
    } else {
        echo "True";
    }
} // Add account
elseif (isset($_POST['btnfaddAccount'])) {

    $aUsername = db_quote($_POST['aUsername']);
    $aPassword = $_POST['aPassword'];
    $aEmpID = db_quote($_POST['aEmpID']);

    $aSaltedPassword = db_quote(hash('sha512', mt_rand(0, PHP_INT_MAX) . mt_rand(0, PHP_INT_MAX) . mt_rand(0, PHP_INT_MAX)));
    $aPassword = db_quote(hash('sha512', $aPassword . $aSaltedPassword));


    $AddAccount = db_query("INSERT INTO `accountstbl` (`aUsername`,`aPassword`,`aSaltedPassword`,`aEmpID`)
        VALUES (" . $aUsername . "," . $aPassword . "," . $aSaltedPassword . "," . $aEmpID . ")");


    if ($AddAccount == false) {
        echo "False";
    } else {
        echo "True";
    }
}
// End of add account

//Update Branch

elseif (isset($_POST['EditBranchID'])) {
    $BranchID = $_POST['EditBranchID'];
    $hash = substr($_POST['key'], 0, 32);
    $rand = substr($_POST['key'], 32, 4);

    if (encrypt_decrypt_rnd('decrypt', $hash, $rand) == $BranchID) {
        $EditBranchCode = db_quote(strtoupper($_POST['EditBranchCode']));
        $EditBranchName = db_quote(ucwords($_POST['EditBranchName']));
        $EditBrand = db_quote($_POST['EditBrand']);
        $EditBranchArea = db_quote($_POST['EditBranchArea']);

        $UpdateBranch = db_query("
        UPDATE 
        `branchtbl` SET 
        `BranchCode` = $EditBranchCode,
        `BranchName` = $EditBranchName, 
        `BrandID` = $EditBrand, 
        `AreaID` = $EditBranchArea 
        WHERE `BranchID` = " . db_quote($BranchID));

        if ($UpdateBranch === false) {
            header("location: ../branch.php?error");
        } else {
            header("location: ../branch.php?success");
        }
    } else {
        header("location: ../branch.php?error");
    }
} // Update modal of Branch
elseif (isset($_POST['BranchID'])) {
    $BranchID = $_POST['BranchID'];
    $hash = $_POST['hash'];
    $rand = $_POST['rand'];

    if (encrypt_decrypt_rnd('decrypt', $hash, $rand) == $BranchID) {
        $UpdateBranchtbl = db_select("
        SELECT 
        branchtbl.BranchCode,
        branchtbl.BranchName,
        brandtbl.Brand,
        brandtbl.BrandID,
        areatbl.AreaID,
        areatbl.Area
        FROM branchtbl
        LEFT JOIN brandtbl ON branchtbl.BrandID = brandtbl.BrandID
        LEFT JOIN areatbl ON branchtbl.AreaID = areatbl.AreaID
        WHERE branchtbl.BranchID =" . db_quote($BranchID));

        if ($UpdateBranchtbl === false) {
            include_once('errormodal.php');
        } else {
            $BranchCode = $UpdateBranchtbl[0]['BranchCode'];
            $UpdateBranchName = $UpdateBranchtbl[0]['BranchName'];
            $UpdateBBrand = $UpdateBranchtbl[0]['Brand'];
            $UpdateBBrandID = $UpdateBranchtbl[0]['BrandID'];
            $UpdateBArea = $UpdateBranchtbl[0]['Area'];
            $UpdateBAreaID = $UpdateBranchtbl[0]['AreaID'];
            ?>
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="function/functions.php" method="POST" name="Updatebranch" id="Updatebranch" autocomplete="off">
                        <div class="modal-header modal-header-dark">
                            <button type="button" class="close" data-dismiss="modal" aria-label="close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Update Branch</h4>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" value="<?= @$BranchID ?>" name="EditBranchID">
                            <input type="hidden" value="<?= @$hash . $rand ?>" name="key">
                            <div class="form-group">
                                <label>Branch Code <span class="red">(*)</span></label>
                                <input type="text" class="form-control" id="EditBranchCode" name="EditBranchCode" value="<?php echo $BranchCode ?>">
                            </div>
                            <div class="form-group">
                                <label>Branch Name <span class="red">(*)</span></label>
                                <input type="text" class="form-control" style="text-transform: capitalize" id="EditBranchName" name="EditBranchName" value="<?php echo $UpdateBranchName ?>">
                            </div>
                            <div class="form-group">
                                <label>Brand <span class="red">(*)</span></label>
                                <select class="form-control" name="EditBrand" id="EditBrand">
                                    <option value="" <?php if ($UpdateBBrandID == "") echo "selected='selected'" ?>>- Select Brand -</option>
                                    <option value="All" <?php if ($UpdateBBrandID == "") echo "selected='selected'" ?>>Berlein Mobile</option>
                                    <?php
                                    $Brandtbl = db_select("SELECT `BrandID`,`Brand` FROM `brandtbl` ORDER BY `Brand` ASC");

                                    foreach ($Brandtbl as $valueBrand) {
                                        $BrandID = $valueBrand['BrandID'];
                                        $Brand = $valueBrand['Brand'];
                                        ?>
                                        <option value="<?= @$BrandID; ?>" <?php if ($BrandID == $UpdateBBrandID) echo "selected='selected'" ?>><?= @$Brand; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Branch Area <span class="red">(*)</span></label>
                                <select class="form-control" name="EditBranchArea" id="EditBranchArea">
                                    <option value="">- Select Area -</option>
                                    <?php
                                    $Areatbl = db_select("SELECT `AreaID`,`Area` FROM `areatbl` ORDER BY `Area` ASC");

                                    foreach ($Areatbl as $valueArea) {
                                        $AreaID = $valueArea['AreaID'];
                                        $Area = $valueArea['Area'];
                                        ?>
                                        <option value="<?= @$AreaID; ?>" <?php if ($AreaID == $UpdateBAreaID) echo "selected='selected'" ?>><?= @$Area; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-dark" name="btnUpdateBranch" id="btnUpdateBranch">Update</button>
                            <button class="btn btn-default" data-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->

            <!-- validator -->
            <script type="text/javascript">
                $(document).ready(function () {
                    $('#Updatebranch').bootstrapValidator({
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
                            EditBrand: {
                                validators: {
                                    notEmpty: {
                                        message: 'Brand is required.'
                                    }
                                }
                            },
                            EditBranchArea: {
                                validators: {
                                    notEmpty: {
                                        message: 'Branch Area is required.'
                                    }
                                }
                            }
                        }
                    });
                });
            </script>
            <!-- /validator-->
            <?php
        }
    } else {
        include_once('errormodal.php');
    }
} //Update Item
elseif (isset($_POST['btnUpdateItems'])) {

    $EditItemCode = db_quote($_POST['EditItemCode']);
    $EditModelName = db_quote(ucwords($_POST['EditModelName']));
    $EditItemDescription = db_quote(ucwords($_POST['EditItemDescription']));
    $EditSRP = $_POST['EditSRP'];
    $EditDP = $_POST['EditDP'];
    $EditCriticalLevel = db_quote($_POST['EditCriticalLevel']);

    $EditSRP = db_quote((float)str_replace(',', '', $EditSRP));
    $EditDP = db_quote((float)str_replace(',', '', $EditDP));

    $UpdateItem = db_query("
    UPDATE 
    `itemstbl` 
    SET
    `ModelName` = $EditModelName, 
    `ItemDescription` = $EditItemDescription, 
    `SRP` = $EditSRP, 
    `DP` = $EditDP,
    `CriticalLevel` = $EditCriticalLevel
    WHERE `ItemCode` = $EditItemCode");


    if ($UpdateItem === false) {
        header('location: ../items.php?error');
    } else {
        header('location: ../items.php?success');
    }

}
//End Update Items

// Update Modal of Items
elseif (isset($_POST['ItemCode'])) {
    $UpdateItemCode = $_POST['ItemCode'];
    $hashItemCode = $_POST['hashItemCode'];
    $Itemsrnd = $_POST['Itemsrnd'];

    if (encrypt_decrypt_rnd('decrypt', $hashItemCode, $Itemsrnd) === $UpdateItemCode) {
        $UpdateItemstbl = db_select("
        SELECT
        itemstbl.ItemCode,
        itemstbl.ModelName,
        itemstbl.ItemDescription,
        itemstbl.AvailableColor,
        categorytbl.Category,
        brandtbl.Brand,
        itemstbl.SRP,
        itemstbl.DP,
        itemstbl.CriticalLevel
        FROM itemstbl
        LEFT JOIN categorytbl ON itemstbl.CategoryCode = categorytbl.CategoryCode
        LEFT JOIN brandtbl ON itemstbl.BrandCode = brandtbl.BrandCode
        WHERE itemstbl.ItemCode =" . db_quote($UpdateItemCode));

        if ($UpdateItemstbl === false) {
            include_once('errormodal.php');
        } else {
            $ItemCode = $UpdateItemstbl[0]['ItemCode'];
            $UpdateModelName = $UpdateItemstbl[0]['ModelName'];
            $UpdateItemDescription = $UpdateItemstbl[0]['ItemDescription'];
            $UpdateAvailableColor = $UpdateItemstbl[0]['AvailableColor'];
            $UpdateICategory = $UpdateItemstbl[0]['Category'];
            $UpdateIBrand = $UpdateItemstbl[0]['Brand'];
            $UpdateSRP = $UpdateItemstbl[0]['SRP'];
            $UpdateDP = $UpdateItemstbl[0]['DP'];
            $UpdateCriticalLevel = $UpdateItemstbl[0]['CriticalLevel'];

            $UpdateSRP = number_format($UpdateSRP, 2, '.', ',');
            $UpdateDP = number_format($UpdateDP, 2, '.', ',');
            ?>
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="function/functions.php" method="POST" name="UpdateItems" id="UpdateItems" autocomplete="off">
                        <div class="modal-header modal-header-dark">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Edit Item</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Category <span class="red">(*)</span></label>
                                <input type="text" readonly class="form-control" id="EditCategory" name="EditCategor" value="<?php echo $UpdateICategory; ?>">
                            </div>
                            <div class="form-group">
                                <label>Brand <span class="red">(*)</span></label>
                                <input type="text" readonly class="form-control" id="EditBrand" name="EditBrand" value="<?php echo $UpdateIBrand; ?>">
                            </div>
                            <div class="form-group">
                                <label>Item Code <span class="red">(*)</span></label>
                                <input type="text" class="form-control" readonly id="EditItemCode" name="EditItemCode" value="<?php echo $ItemCode; ?>">
                            </div>
                            <div class="form-group">
                                <label>Model Name <span class="red">(*)</span></label>
                                <input type="text" class="form-control" style="text-transform: capitalize" id="EditModelName" name="EditModelName" value="<?php echo $UpdateModelName; ?>">
                            </div>
                            <div class="form-group">
                                <label>Item Description <span class="red">(*)</span></label>
                                <input type="text" class="form-control" style="text-transform: capitalize" id="EditItemDescription" name="EditItemDescription" value="<?php echo $UpdateItemDescription; ?>">
                            </div>
                            <div class="form-group">
                                <label>Available Color <span class="red">(*)</span></label>
                                <?php
                                $AvailColor = explode(",", $UpdateAvailableColor);
                                foreach ($AvailColor as $ColorValue) {
                                    $AvailColor = $ColorValue;
                                    ?>
                                    <input type="text" class="form-control" style="text-transform: capitalize" value="<?= @$AvailColor; ?>">
                                    <?php
                                }
                                ?>
                            </div>
                            <div class="form-group">
                                <label>SRP <span class="red">(*)</span></label>
                                <input type="text" class="form-control" id="EditSRP" name="EditSRP" onblur="UpdateConvertToMoney()" onclick="this.setSelectionRange(0, this.value.length)" value="<?= @$UpdateSRP; ?>">
                            </div>
                            <div class="form-group">
                                <label>Dealer's Price<span class="red">(*)</span></label>
                                <input type="text" class="form-control" id="EditDP" name="EditDP" onblur="UpdateConvertToMoney()" onclick="this.setSelectionRange(0, this.value.length)" value="<?= @$UpdateDP; ?>">
                            </div>
                            <div class="form-group">
                                <label>Critical Level<span class="red">(*)</span></label>
                                <input type="number" class="form-control" id="EditCriticalLevel" name="EditCriticalLevel" value="<?= @$UpdateCriticalLevel; ?>">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-dark" id="btnUpdateItems" name="btnUpdateItems">Update</button>
                            <button class="btn btn-default" data-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->

            <!-- validator -->
            <script type="text/javascript">
                $(document).ready(function () {
                    $('#UpdateItems').bootstrapValidator({
                        message: 'This value is not valid',
                        feedbackIcons: {
                            valid: "glyphicon glyphicon-ok",
                            invalid: "glyphicon glyphicon-remove",
                            validating: "glyphicon glyphicon-refresh"
                        },
                        fields: {
                            group: 'form-group',
                            EditModelName: {
                                validators: {
                                    notEmpty: {
                                        message: 'Model Name is required.'
                                    }
                                }
                            },
                            EditItemDescription: {
                                validators: {
                                    notEmpty: {
                                        message: 'Item Description is required.'
                                    }
                                }
                            },
                            EditSRP: {
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
                            EditDP: {
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
                            EditCriticalLevel: {
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
            <?php
        }
    } else {
        include_once('errormodal.php');
    }
} //Update Employee
elseif (isset($_POST['btnupdateEmployee'])) {

    $uEmpID = db_quote(strtoupper($_POST['uEmpID']));
    $uFirstname = db_quote(ucwords($_POST['uFirstname']));
    $uMiddlename = db_quote(ucwords($_POST['uMiddlename']));
    $uLastname = db_quote(ucwords($_POST['uLastname']));
    $uInitials = db_quote(strtoupper($_POST['uInitials']));
    $uPosition = db_quote($_POST['uPosition']);
    $uBranch = db_quote($_POST['uBranch']);
    $ueArea = db_quote($_POST['ueArea']);
    $uBrand = db_quote($_POST['uBrand']);

    if ($uPosition == db_quote("Brand Coordinator")) {
        $uBranch = db_quote("");
        $ueArea = db_quote("");
    } else if ($uPosition == db_quote("Auditor")) {
        $uBranch = db_quote("");
        $ueArea = db_quote("");
        $uBrand = db_quote("");
    } elseif ($uPosition == db_quote("Area Manager")) {
        $uBranch = db_quote("");
        $uBrand = db_quote("");
    } elseif ($uPosition == db_quote("OIC") || $uPosition == db_quote("Cashier" || $uPosition == db_quote("Sales Clerk"))) {
        $ueArea = db_quote("");
        $uBrand = db_quote("");
    } else {
        header('location: ../employee.php?error');
    }

    $UpdateEmployee = db_query("
    UPDATE `employeetbl` 
    SET 
    `Firstname` = $uFirstname, 
    `Middlename` = $uMiddlename, 
    `Lastname` = $uLastname, 
    `Initials` = $uInitials, 
    `Position` = $uPosition, 
    `BranchID` = $uBranch, 
    `AreaID` = $ueArea,
    `BrandID` = $uBrand
    WHERE `EmpID` = $uEmpID");

    if ($UpdateEmployee === false) {
        header('location: ../employee.php?error');
    } else {
        header('location: ../employee.php?success');
    }

}
//End Update Employee

//Modal of update employee
elseif (isset($_POST['EmpID'])) {
    $UpdateEmpID = $_POST['EmpID'];
    $hashEmpID = $_POST['hashEmpID'];
    $rnd = $_POST['rnd'];

    if (encrypt_decrypt_rnd('decrypt', $hashEmpID, $rnd) == $UpdateEmpID) {
        $UpdateEmployeetbl = db_select("
    SELECT 
    employeetbl.EmpID, 
    employeetbl.Firstname, 
    employeetbl.Middlename, 
    employeetbl.Lastname,
    employeetbl.Initials, 
    employeetbl.Position,
    branchtbl.BranchID,
    branchtbl.BranchName,
    areatbl.AreaID,
    areatbl.Area,
    brandtbl.BrandID,
    brandtbl.Brand
    FROM employeetbl
    LEFT JOIN branchtbl ON employeetbl.BranchID = branchtbl.BranchID
    LEFT JOIN  areatbl ON employeetbl.AreaID = areatbl.AreaID
    LEFT JOIN brandtbl ON employeetbl.BrandID = brandtbl.BrandID
    WHERE employeetbl.EmpID = " . db_quote($UpdateEmpID));


        if ($UpdateEmployeetbl === false) { // Pang validate to kung tama ba yung query niya. Pag mali i error niya. lalabas yung error modal
            include_once('errormodal.php');
        } else {
            $EmpID = $UpdateEmployeetbl[0]['EmpID'];
            $UpdateFirstname = $UpdateEmployeetbl[0]['Firstname'];
            $UpdateMiddlename = $UpdateEmployeetbl[0]['Middlename'];
            $UpdateLastname = $UpdateEmployeetbl[0]['Lastname'];
            $UpdateInitials = $UpdateEmployeetbl[0]['Initials'];
            $UpdatePosition = $UpdateEmployeetbl[0]['Position'];
            $UpdateBranchID = $UpdateEmployeetbl[0]['BranchID'];
            $UpdateBranchName = $UpdateEmployeetbl[0]['BranchName'];
            $UpdateArea = $UpdateEmployeetbl[0]['Area'];
            $UpdateAreaID = $UpdateEmployeetbl[0]['AreaID'];
            $UpdateBrand = $UpdateEmployeetbl[0]['Brand'];
            $UpdateBrandID = $UpdateEmployeetbl[0]['BrandID'];

            ?>
            <!-- Update Employee Modal -->
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="function/functions.php" method="POST" name="EditEmployee" id="EditEmployee" autocomplete="off">
                        <div class="modal-header modal-header-dark">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Update Employee</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Employee ID <span class="red">(*)</span></label>
                                <input type="text" class="form-control" readonly id="uEmpID" name="uEmpID" value="<?= @$EmpID; ?>">
                            </div>
                            <div class="form-group">
                                <label>First Name <span class="red">(*)</span></label>
                                <input type="text" class="form-control" style="text-transform: capitalize" id="uFirstname" name="uFirstname" value="<?= @$UpdateFirstname; ?>">
                            </div>
                            <div class="form-group">
                                <label>Middle Name</label>
                                <input type="text" class="form-control" style="text-transform: capitalize" id="uMiddlename" name="uMiddlename" value="<?= @$UpdateMiddlename; ?>">
                            </div>
                            <div class="form-group">
                                <label>Last Name <span class="red">(*)</span></label>
                                <input type="text" class="form-control" style="text-transform: capitalize" id="uLastname" name="uLastname" value="<?= @$UpdateLastname; ?>">
                            </div>
                            <div class="form-group">
                                <label>Initials <span class="red">(*)</span></label>
                                <input type="text" class="form-control" style="text-transform: uppercase" id="uInitials" name="uInitials" value="<?= @$UpdateInitials; ?>">
                            </div>
                            <div class="form-group">
                                <label>Position <span class="red">(*)</span></label>
                                <select class="form-control" onchange="BranchAndAreaModal(this.value)" id="uPosition" name="uPosition">
                                    <option value="" selected="selected">- Select Position -</option>
                                    <option value="Brand Coordinator" <?php if ($UpdatePosition == "Brand Coordinator") echo "selected='selected'" ?>>Brand Coordinator</option>
                                    <option value="Auditor" <?php if ($UpdatePosition == "Auditor") echo "selected='selected'" ?>>Auditor</option>
                                    <option value="Area Manager" <?php if ($UpdatePosition == "Area Manager") echo "selected='selected'" ?>>Area Manager</option>
                                    <option value="OIC" <?php if ($UpdatePosition == "OIC") echo "selected='selected'" ?>>Officer In Charge</option>
                                    <option value="Cashier" <?php if ($UpdatePosition == "Cashier") echo "selected='selected'" ?>>Cashier</option>
                                    <option value="Sales Clerk" <?php if ($UpdatePosition == "Sales Clerk") echo "selected='selected'" ?>>Sales Clerk</option>
                                </select>
                            </div>
                            <div class="form-group" style="display:none" id="DivBranchModal">
                                <label>Branch <span class="red">(*)</span></label>
                                <select class="form-control" name="uBranch" id="uBranch">
                                    <option value="" selected="selected">- Select Branch -</option>
                                    <?php
                                    $Branchtbl = db_select("SELECT `BranchID`,`BranchName`, `BranchCode` FROM `branchtbl`");

                                    foreach ($Branchtbl as $valueBranch) {
                                        $BranchID = $valueBranch['BranchID'];
                                        $BranchCode = $valueBranch['BranchCode'];
                                        $BranchName = $valueBranch['BranchName'];
                                        ?>
                                        <option value="<?= @$BranchID; ?>" <?php if ($BranchID == $UpdateBranchID) echo "selected='selected'" ?>><?= @"(" . $BranchCode . ") " . $BranchName; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group" style="display:none" id="DivAreaModal">
                                <label>Area <span class="red">(*)</span></label>
                                <select class="form-control" name="ueArea" id="ueArea">
                                    <option value="" selected="selected">- Select Area -</option>
                                    <?php
                                    $Areatbl = db_select("SELECT `AreaID`,`Area` FROM `areatbl`");

                                    foreach ($Areatbl as $valueArea) {
                                        $AreaID = $valueArea['AreaID'];
                                        $Area = $valueArea['Area'];
                                        ?>
                                        <option value="<?= @$AreaID; ?>" <?php if ($AreaID == $UpdateAreaID) echo "selected='selected'" ?> ><?= @$Area; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group" style="display:none" id="DivBrandModal">
                                <label>Brand <span class="red">(*)</span></label>
                                <select class="form-control" id="uBrand" name="uBrand">
                                    <option value="" selected="selected">- Select Brand -</option>
                                    <?php
                                    $brandtbl = db_select("SELECT `BrandID` , `Brand` FROM `brandtbl`");

                                    foreach ($brandtbl as $brand) {
                                        $BrandID = $brand['BrandID'];
                                        $Brand = $brand['Brand'];
                                        ?>
                                        <option value="<?= @$BrandID ?>" <?php if ($BrandID == $UpdateBrandID) echo "selected='selected'" ?>><?= @ $Brand ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" onclick="addAccount('<?= @$EmpID ?>','<?= @$hashEmpID ?>','<?= @$rnd ?>')" id="btnModify" class="btn btn-dark">Account Details</button>
                            <button class="btn btn-dark" type="submit" id="btnupdateEmployee" name="btnupdateEmployee">Update</button>
                            <button class="btn btn-dark" data-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->
            <script>
                BranchAndAreaModal($('#uPosition').val());
            </script>

            <!-- validator -->
            <script type="text/javascript">
                $(document).ready(function () {
                    $('#EditEmployee').bootstrapValidator({
                        message: 'This value is not valid',
                        feedbackIcons: {
                            valid: 'glyphicon glyphicon-ok',
                            invalid: 'glyphicon glyphicon-remove',
                            validating: 'glyphicon glyphicon-refresh'
                        },
                        fields: {
                            group: 'form-group',
                            uFirstname: {
                                validators: {
                                    notEmpty: {
                                        message: 'Please enter your First Name. Required!'
                                    },
                                    regexp: {
                                        regexp: /^[a-zA-Z ]+$/,
                                        message: "Invalid input."
                                    }
                                }
                            },
                            uMiddlename: {
                                validators: {
                                    regexp: {
                                        regexp: /^[a-zA-Z ]+$/,
                                        message: "Invalid input."
                                    }
                                }
                            },
                            uLastname: {
                                validators: {
                                    notEmpty: {
                                        message: 'Please enter your Last Name. Required!'
                                    },
                                    regexp: {
                                        regexp: /^[a-zA-Z ]+$/,
                                        message: "Invalid input."
                                    }
                                }
                            },
                            uInitials: {
                                validators: {
                                    notEmpty: {
                                        message: 'Please enter your Initial. Required!'
                                    },
                                    regexp: {
                                        regexp: /^[a-zA-Z ]+$/,
                                        message: "Invalid input."
                                    }
                                }
                            },
                            uPosition: {
                                validators: {
                                    notEmpty: {
                                        message: 'Please select Position. Required!'
                                    }
                                }
                            },
                            uBranch: {
                                validators: {
                                    notEmpty: {
                                        message: 'Please select Branch. Required!'
                                    }
                                }
                            },
                            ueArea: {
                                validators: {
                                    notEmpty: {
                                        message: 'Please select Area. Required!'
                                    }
                                }
                            },
                            uBrand: {
                                validators: {
                                    notEmpty: {
                                        message: 'Please select Brand. Required!'
                                    }
                                }
                            }
                        }
                    });
                });

            </script>
            <!-- /validator -->
            <?php
        }
    } else {
        //Pag hindi nag tugma yung employee id niya sa naka hash na emp id i error niya.
        include_once('errormodal.php');
    }
}
// End of Update Modal

//Update Area
elseif (isset($_POST['btnUpdateArea'])) {
    $AreaID = $_POST['EditAreaID'];
    $hashAreaID = substr($_POST['key'], 0, 32);
    $Rand = substr($_POST['key'], 32, 4);

    if (encrypt_decrypt_rnd('decrypt', $hashAreaID, $Rand) == $AreaID) {
        $EditAreaID = db_quote($AreaID);
        $EditArea = db_quote(ucwords($_POST['EditArea']));

        $updateArea = db_query("UPDATE areatbl SET `Area` = $EditArea WHERE AreaID = $EditAreaID");

        if ($updateArea === false) {
            header("location: ../area.php?error");
        } else {
            header("location: ../area.php?success");
        }
    } else {
        header("location: ../area.php?error");
    }
}
// End of Update Area

//Modal Update Area
elseif (isset($_POST['AreaID'])) {
    $AreaID = $_POST['AreaID'];
    $hashAreaID = $_POST['hash'];
    $Rand = $_POST['rnd'];

    if (encrypt_decrypt_rnd('decrypt', $hashAreaID, $Rand) == $AreaID) {
        $getArea = db_select("SELECT `Area` FROM `areatbl` WHERE `AreaID` = " . db_quote($AreaID));

        if ($getArea === false) {
            include_once('errormodal.php');
        } else {
            $Area = $getArea[0]['Area'];
            ?>
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="function/functions.php" method="POST" name="EditArea" id="EditArea" autocomplete="off">
                        <div class="modal-header modal-header-dark">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Edit Area</h4>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="EditAreaID" value="<?= @$AreaID ?>">
                            <input type="hidden" name="key" value="<?= @$hashAreaID . $Rand ?>">
                            <div class="form-group">
                                <label>Area <span class="red">(*)</span></label>
                                <input type="text" class="form-control" style="text-transform: capitalize" id="EditArea" name="EditArea" value="<?php echo $Area; ?>">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-dark" id="btnUpdateArea" name="btnUpdateArea">Update</button>
                            <button class="btn btn-default" data-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->

            <!-- validator -->
            <script type="text/javascript">
                $(document).ready(function () {
                    $('#EditArea').bootstrapValidator({
                        message: 'This value is not valid',
                        feedbackIcons: {
                            valid: "glyphicon glyphicon-ok",
                            invalid: "glyphicon glyphicon-remove",
                            validating: "glyphicon glyphicon-refresh"
                        },
                        fields: {
                            group: 'form-group',
                            EditArea: {
                                validators: {
                                    notEmpty: {
                                        message: 'Area is required.'
                                    }
                                }
                            }
                        }
                    });
                });
            </script>
            <!-- /validator-->
            <?php
        }
    } else {
        include_once('errormodal.php');
    }
} //Update Brand
elseif (isset($_POST['EditBrandID'])) {
    $EditBrandID = $_POST['EditBrandID'];
    $hash = $_POST['hash'];
    $rand = $_POST['rnd'];

    if (encrypt_decrypt_rnd('decrypt', $hash, $rand) == $EditBrandID) {
        $EditBrandID = db_quote($_POST['EditBrandID']);
        $EditBrandCode = db_quote($_POST['EditBrandCode']);
        $EditBrand = db_quote(ucwords($_POST['EditBrand']));

        $UpdateBrand = db_query("UPDATE brandtbl SET BrandCode = $EditBrandCode, Brand = $EditBrand WHERE  BrandID = $EditBrandID");

        if ($UpdateBrand === false) {
            header("location: ../brand.php?error");
        } else {
            header("location: ../brand.php?success");
        }
    } else {
        header("location: ../brand.php?error");
    }
}
//End of Update Brand

//Modal of Update Brand
elseif (isset($_POST['BrandID'])) {
    $UpdateBrandID = $_POST['BrandID'];
    $hash = $_POST['hash'];
    $rand = $_POST['rnd'];

    if (encrypt_decrypt_rnd('decrypt', $hash, $rand) == $UpdateBrandID) {
        $UpdateBrandtbl = db_select("
        SELECT 
        BrandID,
        BrandCode,
        Brand
        FROM `brandtbl` 
        WHERE `BrandID` = " . db_quote($UpdateBrandID));

        $BrandID = $UpdateBrandtbl[0]['BrandID'];
        $UpdateBrandCode = $UpdateBrandtbl[0]['BrandCode'];
        $UpdateBrand = $UpdateBrandtbl[0]['Brand'];
        ?>
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="function/functions.php" method="POST" name="EditBrand" id="EditBrand" autocomplete="off">
                    <div class="modal-header modal-header-dark">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Edit Area</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="hidden" name="EditBrandID" value="<?= @$BrandID; ?>">
                            <input type="hidden" name="hash" value="<?= @$hash ?>">
                            <input type="hidden" name="rnd" value="<?= @$rand ?>">
                        </div>
                        <div class="form-group">
                            <label>Brand Code <span class="red">(*)</span></label>
                            <input type="text" class="form-control" style="text-transform: uppercase" id="EditBrandCode" name="EditBrandCode" value="<?= @$UpdateBrandCode; ?>">
                        </div>
                        <div class="form-group">
                            <label>Brand <span class="red">(*)</span></label>
                            <input type="text" class="form-control" style="text-transform: capitalize" id="EditBrand" name="EditBrand" value="<?= @$UpdateBrand; ?>">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-dark" id="btnUpdateBrand" name="btnUpdateBrand">Update</button>
                        <button class="btn btn-default" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->

        <!-- validator -->
        <script type="text/javascript">
            $(document).ready(function () {
                $('#EditBrand').bootstrapValidator({
                    message: 'This value is not valid',
                    feedbackIcons: {
                        valid: "glyphicon glyphicon-ok",
                        invalid: "glyphicon glyphicon-remove",
                        validating: "glyphicon glyphicon-refresh"
                    },
                    fields: {
                        group: 'form-group',
                        EditBrandCode: {
                            validators: {
                                notEmpty: {
                                    message: 'Brand Code is required.'
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
                });
            });
        </script>
        <!-- /validator-->
        <?php
    } else {
        include_once('errormodal.php');
    }
} // Update Category
elseif (isset($_POST['btnUpdateCategory'])) {

    $EditCategoryID = db_quote($_POST['EditCategoryID']);
    $EditCategoryCode = db_quote(ucwords($_POST['EditCategoryCode']));
    $EditCategory = db_quote(ucwords($_POST['EditCategory']));

    $UpdateCategory = db_query("UPDATE `categorytbl` SET `CategoryCode` = $EditCategoryCode, `Category` = $EditCategory WHERE  `CategoryID` = $EditCategoryID");

    if ($UpdateCategory === false) {
        header("location: ../category.php?error");
    } else {
        header("location: ../category.php?success");
    }


} //modal update Category
elseif (isset($_POST['CategoryID'])) {
    $upCategoryID = db_quote($_POST['CategoryID']);

    $UpdateCategorytbl = db_select("
    SELECT
    `CategoryID`,
    `CategoryCode`,
    `Category`
    FROM `categorytbl` WHERE `CategoryID` = $upCategoryID");

    $CategoryID = $UpdateCategorytbl[0]['CategoryID'];
    $UpdateCategoryCode = $UpdateCategorytbl[0]['CategoryCode'];
    $updateCategory = $UpdateCategorytbl[0]['Category'];
    ?>
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="function/functions.php" method="POST" name="UpdateCategory" id="UpdateCategory" autocomplete="off">
                <div class="modal-header modal-header-dark">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Edit Category</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" class="form-control" readonly id="EditCategoryID" name="EditCategoryID" value="<?php echo $CategoryID; ?>">
                    </div>
                    <div class="form-group">
                        <label>Category Code <span class="red">(*)</span></label>
                        <input type="text" class="form-control" style="text-transform: capitalize" id="EditCategoryCode" name="EditCategoryCode" value="<?= @$UpdateCategoryCode; ?>">
                    </div>
                    <div class="form-group">
                        <label>Area <span class="red">(*)</span></label>
                        <input type="text" class="form-control" style="text-transform: capitalize" id="EditCategory" name="EditCategory" value="<?php echo $updateCategory; ?>">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-dark" id="btnUpdateCategory" name="btnUpdateCategory">Update</button>
                    <button class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->

    <!-- validator -->
    <script type="text/javascript">
        $(document).ready(function () {
            $('#UpdateCategory').bootstrapValidator({
                message: 'This value is not valid',
                feedbackIcons: {
                    valid: "glyphicon glyphicon-ok",
                    invalid: "glyphicon glyphicon-remove",
                    validating: "glyphicon glyphicon-refresh"
                },
                fields: {
                    group: 'form-group',
                    EditCategoryCode: {
                        validators: {
                            notEmpty: {
                                message: 'Category Code is required.'
                            }
                        }
                    },
                    EditCategory: {
                        validators: {
                            notEmpty: {
                                message: 'Category is required.'
                            }
                        }
                    }
                }
            });
        });
    </script>
    <!-- /validator-->
    <?php
} elseif (isset($_POST['dBranchCode'])) {
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
} elseif (isset($_POST['addAccountEmpID'])) {
    $EmpID = $_POST['addAccountEmpID'];
    $hashEmpID = $_POST['hashEmpID'];
    $rnd = $_POST['rnd'];

    if (encrypt_decrypt_rnd('decrypt', $hashEmpID, $rnd) == $EmpID) {
        $CheckEmpID = db_select("SELECT `aEmpID` FROM `accountstbl` WHERE `aEmpID` = " . db_quote($EmpID));
        if (count($CheckEmpID) == 0) { //Check niya kung may account na ba si Employee
            ?>
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <form id="AddAccountForm" method="POST" autocomplete="off" action="function/functions.php">
                        <div class="modal-header modal-header-dark">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Add Account</h4>
                        </div>
                        <div class="modal-body">
                            <div class="alert alert-primary" id="success-alert">
                                <strong><span class="fa fa-info-circle"></span> Create an account for this employee.</strong>
                            </div>
                            <input type="hidden" name="HashEmpID" value="<?= @$hashEmpID ?>">
                            <input type="hidden" name="rndEmpID" value="<?= @$rnd ?>">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Employee ID <span class="red">(*)</span></label>
                                        <input type="text" readonly="readonly" class="form-control" style="text-transform: uppercase" id="AddAcctEmpID" name="AddAccEmpID" value="<?= @$EmpID; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Username <span class="red">(*)</span></label>
                                        <input type="text" class="form-control" id="AddUsername" name="AddUsername">
                                    </div>
                                    <div class="form-group">
                                        <label>Password <span class="red">(*)</span></label>
                                        <input type="password" class="form-control" id="AddPassword" name="AddPassword">
                                    </div>
                                    <div class="form-group">
                                        <label>Confirm Password <span class="red">(*)</span></label>
                                        <input type="password" class="form-control" id="AddConfPassword" name="AddConfPassword">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-dark">Add Account</button>
                            <button class="btn btn-dark" data-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
            <script type="text/javascript">
                $(document).ready(function () {
                    $('#AddAccountForm').bootstrapValidator({
                        message: 'This value is not valid',
                        feedbackIcons: {
                            valid: 'glyphicon glyphicon-ok',
                            invalid: 'glyphicon glyphicon-remove',
                            validating: 'glyphicon glyphicon-refresh'
                        },
                        fields: {
                            group: 'form-group',
                            AddUsername: {
                                validators: {
                                    notEmpty: {
                                        message: 'Please enter your username.'
                                    },
                                    stringLength: {
                                        min: 8,
                                        max: 16,
                                        message: "Username must be 8-16 characters long."
                                    },
                                    remote: {
                                        message: 'Username already exists.',
                                        url: 'function/remote.php',
                                        data: {
                                            type: 'AddUsername'
                                        },
                                        type: 'POST'
                                    }
                                }
                            },
                            AddPassword: {
                                validators: {
                                    notEmpty: {
                                        message: 'Please enter your password.'
                                    },
                                    identical: {
                                        field: "AddConfPassword",
                                        message: "Password and confirm password mismatched."
                                    },
                                    stringLength: {
                                        min: 8,
                                        max: 16,
                                        message: "Password must be 8-16 characters long."
                                    }
                                }
                            },
                            AddConfPassword: {
                                validators: {
                                    notEmpty: {
                                        message: 'Please enter your password.'
                                    },
                                    identical: {
                                        field: "AddPassword",
                                        message: "Password and confirm password mismatched."
                                    },
                                    stringLength: {
                                        min: 8,
                                        max: 16,
                                        message: "Password must be 8-16 characters long."
                                    }
                                }
                            }

                        }
                    });
                });
            </script>
            <?php
        } else {
            $getAccountDetails = db_select("SELECT `aUsername` FROM `accountstbl` WHERE `aEmpID` = " . db_quote($EmpID));
            if ($getAccountDetails === false) {
                include_once('errormodal.php');
            } else {
                $Username = $getAccountDetails[0]['aUsername'];
                ?>
                <div class="modal-dialog modal-sm">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <form id="ModifyAccountForm" method="POST" autocomplete="off" action="function/functions.php">
                            <div class="modal-header modal-header-dark">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Account Details</h4>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="updateHashEmpID" value="<?= @$hashEmpID ?>">
                                <input type="hidden" name="updaterndEmpID" value="<?= @$rnd ?>">
                                <input type="hidden" name="updateaccEmpID" value="<?= @$EmpID ?>">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Username <span class="red">(*)</span></label>
                                            <input type="text" class="form-control" id="UpdateUsername" name="UpdateUsername" value="<?= @$Username ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Password <span class="red">(*)</span></label>
                                            <input type="password" class="form-control" id="UpdatePassword" name="UpdatePassword">
                                        </div>
                                        <div class="form-group">
                                            <label>Confirm Password <span class="red">(*)</span></label>
                                            <input type="password" class="form-control" id="UpdateConfPassword" name="UpdateConfPassword">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-dark">Save</button>
                                <button class="btn btn-dark" data-dismiss="modal">Cancel</button>
                                <br>
                                <button type="button" onclick="DeleteAccount('<?= @$EmpID ?>','<?= @$hashEmpID ?>', '<?= @$rnd ?>')" class="btn btn-danger">Remove Account</button>
                            </div>
                        </form>
                    </div>
                </div>
                <script type="text/javascript">
                    $(document).ready(function () {
                        $('#ModifyAccountForm').bootstrapValidator({
                            message: 'This value is not valid',
                            feedbackIcons: {
                                valid: 'glyphicon glyphicon-ok',
                                invalid: 'glyphicon glyphicon-remove',
                                validating: 'glyphicon glyphicon-refresh'
                            },
                            fields: {
                                group: 'form-group',
                                UpdateUsername: {
                                    validators: {
                                        notEmpty: {
                                            message: 'Please enter your username.'
                                        },
                                        stringLength: {
                                            min: 8,
                                            max: 16,
                                            message: "Username must be 8-16 characters long."
                                        }
                                    }
                                },
                                UpdatePassword: {
                                    validators: {
                                        notEmpty: {
                                            message: 'Please enter your password.'
                                        },
                                        identical: {
                                            field: "UpdateConfPassword",
                                            message: "Password and confirm password mismatched."
                                        },
                                        stringLength: {
                                            min: 8,
                                            max: 16,
                                            message: "Password must be 8-16 characters long."
                                        }
                                    }
                                },
                                UpdateConfPassword: {
                                    validators: {
                                        notEmpty: {
                                            message: 'Please enter your password.'
                                        },
                                        identical: {
                                            field: "UpdatePassword",
                                            message: "Password and confirm password mismatched."
                                        },
                                        stringLength: {
                                            min: 8,
                                            max: 16,
                                            message: "Password must be 8-16 characters long."
                                        }
                                    }
                                }

                            }
                        });
                    });
                </script>
                <?php
            }
        }
    } else {
        include_once('errormodal.php');
    }

} //Adding of accounts to
elseif (isset($_POST['AddAccEmpID'])) {
    $EmpID = $_POST['AddAccEmpID'];
    $hashEmpID = $_POST['HashEmpID'];
    $rnd = $_POST['rndEmpID'];
    $Username = db_quote($_POST['AddUsername']);
    $Password = db_quote($_POST['AddPassword']);
    $ConfPassword = db_quote($_POST['AddConfPassword']);

    if ($Password == $ConfPassword) {
        if (encrypt_decrypt_rnd('decrypt', $hashEmpID, $rnd) == $EmpID) {
            $salt = hash('sha512', mt_rand(0, PHP_INT_MAX) . mt_rand(0, PHP_INT_MAX) . mt_rand(0, PHP_INT_MAX));
            $Password = db_quote(hash('sha512', $Password . $salt));

            $addAccount = db_query("INSERT INTO accountstbl (`aUsername`, `aPassword`, `aSaltedPassword`, `aEmpID`) VALUES ($Username, $Password," . db_quote($salt) . ", " . db_quote($EmpID) . ")");

            if ($addAccount === false) {
                header('location: ../employee.php?error');
            } else {
                header('location: ../employee.php?success');
            }
        } else {
            header('location: ../employee.php?error');
        }
    } else {
        header('location: ../employee.php?error');
    }


} // Update ng account ni Employee
elseif (isset($_POST['updateaccEmpID'])) {
    $EmpID = $_POST['updateaccEmpID'];
    $hashEmpID = $_POST['updateHashEmpID'];
    $rnd = $_POST['updaterndEmpID'];
    $Username = db_quote($_POST['UpdateUsername']);
    $Password = db_quote($_POST['UpdatePassword']);
    $ConfPassword = db_quote($_POST['UpdateConfPassword']);


    if ($Password == $ConfPassword) {
        if (encrypt_decrypt_rnd('decrypt', $hashEmpID, $rnd) == $EmpID) {
            $salt = hash('sha512', mt_rand(0, PHP_INT_MAX) . mt_rand(0, PHP_INT_MAX) . mt_rand(0, PHP_INT_MAX));
            $Password = db_quote(hash('sha512', $Password . $salt));

            $updateAccount = db_query("UPDATE `accountstbl` SET `aUsername` = $Username, `aPassword` = $Password, `aSaltedPassword` = " . db_quote($salt) . " WHERE `aEmpID` = " . db_quote($EmpID));

            if ($updateAccount === false) {
                header('location: ../employee.php?error');
            } else {
                header('location: ../employee.php?success');
            }
        } else {
            header('location: ../employee.php?error');
        }
    } else {
        header('location: ../employee.php?error');
    }

}