<?php
include('../../../connection.php');
include('../../../functions/encryption.php');

//Delete Branch
if (isset($_POST['BranchID'])) {
    $BranchID = $_POST['BranchID'];
    $hashBranchID = $_POST['hashBranchID'];
    $Branchrnd = $_POST['Branchrnd'];

    if (encrypt_decrypt_rnd('decrypt', $hashBranchID, $Branchrnd) == $BranchID) {
        $BranchID = db_quote($BranchID);

        $branchtbl = db_query("DELETE FROM `branchtbl` WHERE `BranchID` = $BranchID");

        if ($branchtbl === false) {
            header("location: ../branch.php?error");
        } else {
            header("location: ../branch.php?deleted");
        }
    } else {
        header("location: ../branch.php?error");
    }
}

//DeleteBranch
if (isset($_POST['dBranch'])) {
    $BranchID = $_POST['dBranch'];
    $hashBranchID = $_POST['dhash'];
    $Branchrnd = $_POST['drnd'];

    if (encrypt_decrypt_rnd('decrypt', $hashBranchID, $Branchrnd) == $BranchID) {
        ?>
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="function/admin-delete.php">
                    <div class="modal-header modal-header-dark">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Delete Branch</h4>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="BranchID" value="<?= @$BranchID ?>">
                        <input type="hidden" name="hashBranchID" value="<?= @$hashBranchID ?>">
                        <input type="hidden" name="Branchrnd" value="<?= @$Branchrnd ?>">
                        <label>Are you sure you want to remove this Branch? This cannot be undone.</label>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-dark">Delete</button>
                        <button class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
        <?php
    } else {
        include_once('errormodal.php');
    }
}


//Delete Item
if (isset($_POST['ItemCode'])) {
    $ItemCode = $_POST['ItemCode'];
    $hashItemCode = $_POST['hashItemCode'];
    $Itemsrnd = $_POST['Itemsrnd'];

    if (encrypt_decrypt_rnd('decrypt', $hashItemCode, $Itemsrnd) == $ItemCode) {
        $ItemCode = db_quote($_POST['ItemCode']);

        $itemstbl = db_query("DELETE FROM `itemstbl` WHERE ItemCode = $ItemCode");

        if ($itemstbl === false) {
            header("location: ../items.php?error");
        } else {
            header("location: ../items.php?Deleted");
        }
    } else {
        header("location: ../items.php?error");
    }

}

//Delete Employee
if (isset($_POST['EmpID'])) {
    $EmpID = $_POST['EmpID'];
    $hashEmpID = $_POST['hashEmpID'];
    $rnd = $_POST['rnd'];

    if (encrypt_decrypt_rnd('decrypt', $hashEmpID, $rnd) == $EmpID) {
        $EmpID = db_quote($_POST['EmpID']);

        $employeetbl = db_query("DELETE FROM `employeetbl` WHERE `EmpID` = $EmpID");

        if ($employeetbl === false) {
            header("location: ../employee.php?error");
        } else {
            header("location: ../employee.php?deleted");
        }
    } else {
        header("location: ../employee.php?error");
    }

}

//Delete Account
if (isset($_POST['btndeleteAccount'])) {

    $aUsername = db_quote($_POST['aUsername']);

    $Accounttbl = db_query("DELETE FROM accountstbl WHERE aEmpID = $aUsername");
    $EmployeeAccounttbl = db_query("DELETE FROM employeetbl WHERE EmpID = $aUsername");

    header("location: ../accounts.php?Deleted");
}

//Delete Color
if (isset($_POST['btnDeleteColor'])) {

    $ColorID = db_quote($_POST['ColorID']);

    $colortbl = db_query("DELETE FROM `colortbl` WHERE ColorID = $ColorID");

    header("location: ../colors.php?Deleted");
} //Modal Delete Color
elseif (isset($_POST['ColorID'])) {
    $delColorID = db_quote($_POST['ColorID']);

    $DeleteColortbl = db_select("
    SELECT
    `ColorID`,
    `Color`
    FROM `colortbl` WHERE ColorID = $delColorID");

    $ColorID = $DeleteColortbl[0]['ColorID'];
    $DeleteColor = $DeleteColortbl[0]['Color'];
    ?>
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="function/admin-delete.php" method="POST" name="DeleteColor" id="DeleteColor">
                <div class="modal-header modal-header-danger">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Delete Color</h4>
                </div>
                <div class="modal-body">
                    <label>Do you want to delete this Color "<?= @$DeleteColor; ?>"</label>
                    <div class="form-group"></div>
                </div>
                <input type="hidden" name="ColorID" value="<?= @$ColorID; ?>">
                <div class="modal-footer">
                    <button class="btn btn-danger" name="btnDeleteColor" id="btnDeleteColor">Delete</button>
                    <button class="btn btn-dark" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
    <?php
}
//End of modal delete Color

// Delete Brand
if (isset($_POST['BrandID'])) {
    $BrandID = $_POST['BrandID'];
    $hash = substr($_POST['key'], 0, 32);
    $rand = substr($_POST['key'], 32, 4);

    if (encrypt_decrypt_rnd('decrypt', $hash, $rand) == $BrandID) {
        $brandtbl = db_query("DELETE FROM `brandtbl` WHERE  BrandID = " . db_quote($BrandID));

        if ($brandtbl === false) {
            header("location: ../brand.php?error");
        } else {
            header("location: ../brand.php?deleted");
        }

    } else {
        header("location: ../brand.php?error");
    }

}

//Modal of Delete Brand
elseif (isset($_POST['dBrandID'])) {
    $delBrandID = $_POST['dBrandID'];
    $hash = $_POST['dhash'];
    $rand = $_POST['drnd'];

    if (encrypt_decrypt_rnd('decrypt', $hash, $rand) == $delBrandID) {
        ?>
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="function/admin-delete.php" method="POST" name="DeleteBrand" id="DeleteBrand">
                    <div class="modal-header modal-header-dark">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"> Delete Brand</h4>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" value="<?= @$delBrandID ?>" name="BrandID">
                        <input type="hidden" value="<?= @$hash . $rand ?>" name="key">
                        <label>Do you want to delete this Brand. This cannot be undone.</label>
                        <div class="form-group"></div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-dark" name="btndeleteBrand" id="btndeleteBrand">Delete</button>
                        <button class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
        <?php

    } else {
        include_once('errormodal.php');
    }
}

//Delete Area
if (isset($_POST['AreaID'])) {
    $AreaID = $_POST['AreaID'];
    $hash = substr($_POST['key'], 0, 32);
    $rand = substr($_POST['key'], 32, 4);
    if (encrypt_decrypt_rnd('decrypt', $hash, $rand) === $AreaID) {
        $AreaID = db_quote($AreaID);
        $QueryDelete = db_query("DELETE FROM `areatbl` WHERE  AreaID = $AreaID");
        if ($QueryDelete === false) {
            header("location: ../area.php?error");
        } else {
            header("location: ../area.php?deleted");
        }
    } else {
        header("location: ../area.php?error");
    }
}

//Modal Delete Area
elseif (isset($_POST['dAreaID'])) {
    $AreaID = $_POST['dAreaID'];
    $hash = $_POST['dhash'];
    $rand = $_POST['drnd'];

    if (encrypt_decrypt_rnd('decrypt', $hash, $rand) === $AreaID) {
        $getArea = db_select("SELECT `Area` FROM `areatbl` WHERE `AreaID` =" . db_quote($AreaID));
        $Area = $getArea[0]['Area'];
        ?>
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="function/admin-delete.php" method="POST" name="DeleteArea" id="DeleteArea">
                    <div class="modal-header modal-header-danger">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Delete Area</h4>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" value="<?= @$AreaID ?>" name="AreaID">
                        <input type="hidden" value="<?= @$hash . $rand ?>" name="key">
                        <label>Do you want to delete <?= @$Area; ?>. This cannot be undone.</label>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-danger">Delete</button>
                        <button class="btn btn-dark" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
        <?php
    } else {
        include_once('errormodal.php');
    }

}

//Delete Category
if (isset($_POST['btnDeleteCategory'])) {
    $CategoryID = db_quote($_POST['CategoryID']);

    $categorytbl = db_query("DELETE FROM `categorytbl` WHERE CategoryID = $CategoryID");

    header("location: ../category.php?deleted");
} //Modal Delete Category
elseif (isset($_POST['CategoryID'])) {
    $delCategoryID = db_quote($_POST['CategoryID']);

    $DeleteCategorytbl = db_select("
    SELECT
    `CategoryID`,
    `CategoryCode`,
    `Category`
    FROM `categorytbl` WHERE `CategoryID` = $delCategoryID");

    $CategoryID = $DeleteCategorytbl[0]['CategoryID'];
    $DeleteCategoryCode = $DeleteCategorytbl[0]['CategoryCode'];
    $DeleteCategory = $DeleteCategorytbl[0]['Category'];
    ?>
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="function/admin-delete.php" method="POST" name="DeleteCategory" id="DeleteCategory">
                <div class="modal-header modal-header-danger">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Delete Category</h4>
                </div>
                <div class="modal-body">
                    <label>Do you want to delete this Category "<?= @$DeleteCategory; ?>"</label>
                    <div class="form-group"></div>
                </div>
                <input type="hidden" name="CategoryID" value="<?= @$CategoryID; ?>">
                <div class="modal-footer">
                    <button class="btn btn-danger" name="btnDeleteCategory" id="btnDeleteCategory">Delete</button>
                    <button class="btn btn-dark" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
    <?php
}

?>