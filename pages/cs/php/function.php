<?php
include('../../../connection.php');
include('../../../functions/encryption.php');
session_start();
$EmpID = db_quote($_SESSION['EmpID']);

function generatePONumber($Branch)
{
    $generatePONumber = db_select("SELECT `PONumber` FROM `purchaserequeststbl` WHERE `BranchCode` = " . $Branch . " ORDER BY `PONumber` DESC LIMIT 1");
    $Branch = str_replace("'", "", $Branch);
    if ($generatePONumber === false) {
        echo db_error();
    }
    if (count($generatePONumber) == 0) {
        return str_replace("'", "", "PR-" . $Branch . "-" . date("my") . "001");
    } else {
        $pCount = substr($generatePONumber[0]['PONumber'], 12);
        $gPONumber = "PR-" . $Branch . "-" . date("my") . sprintf("%03s", (int)$pCount + 1);
        return $gPONumber;
    }
}

//Insert Purchase Request
if (isset($_POST['EmpID'])) {
    $sEmpID = $_POST['EmpID'];
    $Qty = $_POST['oQty'];
    $ItemCode = $_POST['oItemCode'];
    $Items = array_combine($ItemCode, $Qty);
    $_Date = db_quote(date("Y-m-d"));
    $_Time = db_quote(date("h:i A"));
    $Branch = db_quote($_POST['Branch']);
    $SelectedBrand = $_POST['BrandID'];
    $PONumber = db_quote(generatePONumber($Branch));
    $ModifyCode = db_quote(rand(0, 9999999999));

    $PurchaseRequest = db_query("INSERT INTO `purchaserequeststbl` (`PONumber`, `_Date`, `BranchCode`,`BrandID`,`Status`,`Remarks`,`EmpID`,`isDeleted`,`ModifiedBy`,`_Time`,`LastModified`,`ModifyCode`) VALUES ($PONumber, $_Date, $Branch, $SelectedBrand,'Pending', 'Waiting for Approval from Area Manager', $sEmpID, '0', $sEmpID, $_Time, $_Date, $ModifyCode)");

    if ($PurchaseRequest === false) {
        header("location: ../po.php?error");
    } else {
        foreach ($Items as $item => $qty) {
            $dItemCode = db_quote($item);
            $dQty = db_quote($qty);

            $PurchasedItems = db_query("INSERT INTO `purchaserequestsitemstbl` (`PONumber`, `ItemCode`, `Qty`,`DateModified`,`ModifyCode`) VALUES ($PONumber ,$dItemCode, $dQty, $_Date, $ModifyCode)");
        }
        if ($PurchasedItems === false) {
            $deletePurchaseRequests = db_query("DELETE FROM `purchaserequeststbl` WHERE `PONumber` = $PONumber");
            header("location: ../po.php?error");
        } else {
            header("location: ../po.php?success");
        }
    }

}
//End of Purchase Request

//Update Purchase Request
elseif (isset($_POST['aEmpID'])) {

    $hashPRNumber = $_POST['HashPRNumber'];
    $PRNumber = db_quote($_POST['PRNumber']);

    if (db_quote(encrypt_decrypt('decrypt', $hashPRNumber)) != $PRNumber) {
        header("location: ../po.php?error");
    } else {
        $sEmpID = $_POST['aEmpID'];
        $Qty = $_POST['oQty'];
        $ItemCode = $_POST['oItemCode'];
        $Items = array_combine($ItemCode, $Qty);
        $_Date = db_quote(date("Y-m-d"));
        $_Time = db_quote(date("h:i A"));
        $Branch = db_quote($_POST['Branch']);
        $SelectedBrand = db_quote($_POST['BrandID']);
        $ModifyCode = db_quote(rand(0, 9999999999));


        $PurchaseRequest = db_query("UPDATE `purchaserequeststbl` SET `ModifiedBy` = $sEmpID, `_Time` = $_Time, `LastModified` = $_Date, `ModifyCode` = $ModifyCode, `Remarks` = 'Waiting for Approval from Area Manager', `isAMApproved` = '0', `CheckedByAM` = ''  WHERE `PONumber` = $PRNumber");


        if ($PurchaseRequest === false) {
            echo db_error();
            die();
        } else {
            foreach ($Items as $item => $qty) {
                $dItemCode = db_quote($item);
                $dQty = db_quote($qty);

                $PurchasedItems = db_query("INSERT INTO `purchaserequestsitemstbl` (`PONumber`, `ItemCode`, `Qty`,`DateModified`,`ModifyCode`) VALUES ($PRNumber ,$dItemCode, $dQty, $_Date, $ModifyCode)");

            }
            if ($PurchasedItems === false) {
                header("location: ../po.php?error");
            } else {
                header("location: ../po.php?success");
            }
        }
    }
}
//End of Update Purchase Request


//List of purchase request items
elseif (isset($_POST['PONumber'])) {
    $sPONumber = db_quote($_POST['PONumber']);

    $purchaserequesttbl = db_select("
    SELECT
    areatbl.Area,
    purchaserequeststbl.PONumber,
    purchaserequeststbl.BranchCode,
    purchaserequeststbl.BrandID,
    purchaserequeststbl._Date,
    purchaserequeststbl._Time,
    purchaserequeststbl.ModifiedBy,
    purchaserequeststbl.LastModified,
    purchaserequeststbl.ModifyCode,
    employeetbl.Firstname,
    employeetbl.Lastname,
    brandtbl.Brand
    FROM purchaserequeststbl
    LEFT JOIN employeetbl ON purchaserequeststbl.EmpID = employeetbl.EmpID
    LEFT JOIN brandtbl ON purchaserequeststbl.BrandID = brandtbl.BrandID
    LEFT JOIN branchtbl ON purchaserequeststbl.BranchCode = branchtbl.BranchCode
    LEFT JOIN areatbl ON branchtbl.AreaID = areatbl.AreaID
    WHERE purchaserequeststbl.PONumber = $sPONumber AND purchaserequeststbl.isDeleted = '0'");

    $Area = $purchaserequesttbl[0]['Area'];
    $PONumber = $purchaserequesttbl[0]['PONumber'];
    $Branch = $purchaserequesttbl[0]['BranchCode'];
    $Brand = $purchaserequesttbl[0]['Brand'];
    $ContactPerson = $purchaserequesttbl[0]['Firstname'] . " " . $purchaserequesttbl[0]['Lastname'];
    $_Date = new DateTime($purchaserequesttbl[0]['_Date']);
    $LastModified = new DateTime($purchaserequesttbl[0]['LastModified']);
    $_Time = $purchaserequesttbl[0]['_Time'];
    $ModifiedByID = db_quote($purchaserequesttbl[0]['ModifiedBy']);
    $ModifyCode = $purchaserequesttbl[0]['ModifyCode'];
    $getName = db_select("SELECT `Firstname` ,`Lastname` FROM `employeetbl` WHERE `EmpID` = $ModifiedByID");
    $ModifiedBy = $getName[0]['Firstname'] . " " . $getName[0]['Lastname'];

    $rnd = rand(0, 9999);
    $hashPRNumber = encrypt_decrypt_rnd('encrypt', $PONumber, $rnd);
    ?>
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header modal-header-dark">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Purchase Order Details</h4>
            </div>
            <div class="modal-body">
                <label>PO Number: <?php echo $PONumber; ?></label>
                <br>
                <label>Last Modified by: <?= @$ModifiedBy . " / " . date_format($LastModified, "F j, Y") . " / " . $_Time ?></label>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Area</label>
                                <input type="text" class="form-control" value="<?= @$Area ?>" readonly>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Brand</label>
                                <input type="text" class="form-control" value="<?= @$Brand ?>" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Branch</label>
                                <input type="text" class="form-control" value="<?= @ $Branch ?>" readonly>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Requested By</label>
                                <input type="text" class="form-control" value="<?= @ $ContactPerson ?>" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Date Requested</label>
                                <input type="text" class="form-control" value="<?= @ date_format($_Date, "F j, Y"); ?>" readonly>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <!-- Panel -->
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <i class="fa fa-table fa-fw"></i> Items to order
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body" style="height: 250px; overflow-y: scroll;">
                                <table id="OrderedItems[]" class="table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Item Code</th>
                                        <th>Item Name</th>
                                        <th>Brand</th>
                                        <th>SRP</th>
                                        <th width="5%">Qty.</th>
                                        <th width="15%">Total Amount</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $OrderedItems = db_select(
                                        "SELECT
                                        purchaserequestsitemstbl.ItemCode,
                                        purchaserequestsitemstbl.Qty,
                                        itemstbl.ModelName,
                                        itemstbl.SRP,
                                        brandtbl.Brand
                                        FROM purchaserequestsitemstbl
                                        LEFT JOIN itemstbl ON purchaserequestsitemstbl.ItemCode = itemstbl.ItemCode
                                        LEFT JOIN brandtbl ON itemstbl.BrandID = brandtbl.BrandID
                                        WHERE purchaserequestsitemstbl.PONumber = " . db_quote($PONumber) . "
                                        AND purchaserequestsitemstbl.ModifyCode = " . db_quote($ModifyCode) . "
                                        ORDER BY itemstbl.ModelName ASC");
                                    echo db_error();
                                    $TotalItems = 0;
                                    foreach ($OrderedItems as $item) {
                                        $ItemCode = $item['ItemCode'];
                                        $Qty = $item['Qty'];
                                        $ModelName = $item['ModelName'];
                                        $Brand = $item['Brand'];
                                        $SRP = $item['SRP'];
                                        $TotalItems = $TotalItems + ($Qty * $SRP);
                                        $Total = number_format($Qty * $SRP, 2, '.', ',');
                                        $SRP = number_format($SRP, 2, '.', ',');
                                        ?>
                                        <tr>
                                            <td><?= @ $ItemCode; ?></td>
                                            <td><?= @ $ModelName ?> </td>
                                            <td><?= @ $Brand ?></td>
                                            <td><?= @ $SRP ?></td>
                                            <td><?= @ $Qty ?></td>
                                            <td width="15%"><?= @ $Total ?></td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.panel-body -->
                            <div class="panel-footer">
                                <b>Total Price: <label id="sPrice"><?= @ number_format($TotalItems, 2, '.', ','); ?></label></b>
                            </div>
                        </div>
                        <!-- End Panel -->
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-danger" onclick="$('#Yes').val('<?= @$hashPRNumber . $rnd . $PONumber ?>');" data-toggle="modal" data-target="#CheckDelete">Cancel Order</button>
                <a href="modify.php?id=<?= @$hashPRNumber . $rnd ?>&pr=<?= @$PONumber ?>" class="btn btn-dark" id="btnModify">Modify</a>
                <button class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
    <?php

}
//End of Purchase Request items


//Archive PR
elseif (isset($_POST['dPONumber'])) {
    $hashPRNumber = substr($_POST['dPONumber'], 0, 32);
    $PONumber = db_quote(substr($_POST['dPONumber'], 36, 15));
    $rnd = substr($_POST['dPONumber'], 32, 4);

    if (db_quote(encrypt_decrypt_rnd('decrypt', $hashPRNumber, $rnd)) != $PONumber) {
        echo "error";
    } else{
        $deletePR = db_query("UPDATE `purchaserequeststbl` SET `Remarks` = 'Cancelled', `Status` = 'Cancelled', `isDeleted` = '1', `CancelledBy` = $EmpID WHERE `PONumber` = " . $PONumber);

        if($deletePR === false){
            echo "error";
        }else{
            echo "success";
        }
    }
}
//End of Archive PR


