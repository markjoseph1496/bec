<?php
include('../../../connection.php');
include('../../../functions/encryption.php');
session_start();
$EmployeeID = db_quote($_SESSION['EmpID']);

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
    echo $_Time;

    $PurchaseRequest = db_query("INSERT INTO `purchaserequeststbl` (`PONumber`, `_Date`, `BranchCode`,`BrandID`,`Status`,`Remarks`,`EmpID`,`isAMApproved`,`ModifiedBy`,`_Time`,`LastModified`) VALUES ($PONumber, $_Date, $Branch, $SelectedBrand,'Pending', 'Waiting for Approval from Branch Coordinator', $sEmpID, '1', $sEmpID, $_Time, $_Date)");

    if ($PurchaseRequest === false) {
        echo db_error();
        die();
    } else {
        foreach ($Items as $item => $qty) {
            $dItemCode = db_quote($item);
            $dQty = db_quote($qty);

            $PurchasedItems = db_query("INSERT INTO `purchaserequestsitemstbl` (`PONumber`, `ItemCode`, `Qty`) VALUES ($PONumber ,$dItemCode, $dQty)");

        }
        header("location: ../po.php");
    }

}
//End of Purchase Request

//Update Purchase Request
if (isset($_POST['aEmpID'])) {

    $hashPRNumber = $_POST['HashPRNumber'];
    $PRNumber = db_quote($_POST['PRNumber']);

    if (db_quote(encrypt_decrypt('decrypt', $hashPRNumber)) != $PRNumber) {
        echo "error message here";
        die();
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


        $PurchaseRequest = db_query("UPDATE `purchaserequeststbl` SET `ModifiedBy` = $sEmpID, `_Time` = $_Time, `LastModified` = $_Date, `ModifyCode` = $ModifyCode, `Remarks` = 'Waiting for Approval from Brand Coordinator', `isAMApproved` = '1', `CheckedByAM` = $EmployeeID  WHERE `PONumber` = $PRNumber");


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
                echo db_error();
                die();
            }
            header("location: ../po.php");
        }
    }
}
//End of Update Purchase Request


//List of purchase request items
if (isset($_POST['PONumber'])) {
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
    purchaserequeststbl.isAMApproved,
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
    $getName = db_select("SELECT `Firstname` ,`Lastname` FROM `employeetbl` WHERE `EmpID` = $ModifiedByID");
    $ModifiedBy = $getName[0]['Firstname'] . " " . $getName[0]['Lastname'];
    $ModifyCode = $purchaserequesttbl[0]['ModifyCode'];

    $hashPRNumber = encrypt_decrypt('encrypt', $PONumber);
    ?>
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header modal-header-dark">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Purchase Order Details</h4>
            </div>
            <div class="modal-body">
                <label>PO Number: <?php echo $PONumber ?></label>
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
                                <label>Ship to</label>
                                <input type="text" class="form-control" value="<?php echo $Branch ?>" readonly>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Requested By</label>
                                <input type="text" class="form-control" value="<?php echo $ContactPerson ?>" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Date Requested</label>
                                <input type="text" class="form-control" value="<?php echo date_format($_Date, "F j, Y"); ?>" readonly>
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
                                <table id="ItemsToOrder" class="table table-striped table-bordered">
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
                                        brandtbl.Brand,
                                        itemstbl.SRP
                                        FROM purchaserequestsitemstbl
                                        LEFT JOIN itemstbl ON purchaserequestsitemstbl.ItemCode = itemstbl.ItemCode
                                        LEFT JOIN brandtbl ON itemstbl.BrandID = brandtbl.BrandID
                                        WHERE purchaserequestsitemstbl.PONumber = " . db_quote($PONumber) . "
                                        AND purchaserequestsitemstbl.ModifyCode = " . db_quote($ModifyCode) . "
                                        ");
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
                                            <td><?php echo $ItemCode ?></td>
                                            <td><?php echo $ModelName ?></td>
                                            <td><?php echo $Brand ?></td>
                                            <td><?php echo $SRP ?></td>
                                            <td width="5%"><?php echo $Qty ?></td>
                                            <td width="15%"><?php echo $Total ?></td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.panel-body -->
                            <div class="panel-footer">
                                <b>Total Price: <label id="sPrice"><?php echo number_format($TotalItems, 2, '.', ','); ?></label></b>
                            </div>
                        </div>
                        <!-- End Panel -->
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <?php
                if ($purchaserequesttbl[0]['isAMApproved'] == 0) {
                    ?>
                    <button class="btn btn-success" onclick="$('#Approved').val('<?= @$PONumber ?>')" data-toggle="modal" data-target="#ApproveRequest"><i class="fa fa-check"></i> Approve</button>
                    <button class="btn btn-danger" onclick="$('#Rejected').val('<?= @$PONumber ?>')" data-toggle="modal" data-target="#RejectRequest"><i class="fa fa-close"></i> Reject</button>
                    <?php
                } else {
                    ?>
                    <button class="btn btn-danger" onclick="$('#CancelOrder').val('<?= @$PONumber ?>')" data-toggle="modal" data-target="#CancelRequest"><i class="fa fa-close"></i> Cancel Order</button>
                    <?php
                }
                ?>
                <a href="modify.php?id=<?= @$hashPRNumber ?>&pr=<?= @$PONumber ?>" class="btn btn-dark" id="btnModify">Modify</a>
                <button class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
    <?php
}
//End of Purchase Request items


//Approve PR
if (isset($_POST['approvedPONumber'])) {
    $PONumber = db_quote($_POST['approvedPONumber']);

    $updatePR = db_query("UPDATE `purchaserequeststbl` SET `Remarks` = 'Waiting for Approval from Brand Coordinator', `isAMApproved` = '1', `CheckedByAM` = $EmployeeID WHERE `PONumber` = $PONumber");

}
//End of Approve PR

//Reject PR
if (isset($_POST['rejectedPONumber'])) {
    $PONumber = db_quote($_POST['rejectedPONumber']);
    $Reason = db_quote($_POST['Reason']);


    $updatePR = db_query("UPDATE `purchaserequeststbl` SET `Remarks` = " . $Reason . ", Status ='Rejected' , `isAMApproved` = '2', `CancelledBy` = $EmployeeID WHERE `PONumber` = $PONumber");

}
//End of Reject PR

//Cancel PR
if (isset($_POST['CancelledPONumber'])) {
    $PONumber = db_quote($_POST['CancelledPONumber']);

    $updatePR = db_query("UPDATE `purchaserequeststbl` SET `Remarks` = 'Cancelled', Status ='Cancelled' , `isAMApproved` = '2', `CancelledBy` = $EmployeeID WHERE `PONumber` = $PONumber");

}
//End of Cancel PR

//Get Brand
if (isset($_POST['BranchID'])) {
    $BranchID = db_quote($_POST['BranchID']);

    $getBrand = db_select("SELECT 
    brandtbl.BrandID,
    brandtbl.Brand
    FROM brandtbl
    LEFT JOIN branchtbl ON brandtbl.BrandID = branchtbl.BrandID
    WHERE branchtbl.BranchID = $BranchID
    ");
    echo '<option value="">- Select Brand -</option>';
    foreach ($getBrand as $brand) {
        $BrandID = $brand['BrandID'];
        $Brand = $brand['Brand'];
        ?>
        <option value="<?= @$BrandID ?>"><?= @$Brand ?></option>
        <?php
    }

}
