<?php
include('../../../connection.php');
include('../../../functions/encryption.php');
session_start();
$EmpID = db_quote($_SESSION['EmpID']);


//List of purchase request items
if (isset($_POST['PONumber'])) {
    $sPONumber = db_quote($_POST['PONumber']);
    $hash = $_POST['Hash'];
    $rnd = $_POST['rnd'];

    if (db_quote(encrypt_decrypt_rnd('decrypt', $hash, $rnd)) == $sPONumber) {
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
    purchaserequeststbl.Status,
    purchaserequeststbl.CheckedByHO,
    purchaserequeststbl.DateApproved,
    purchaserequeststbl.TimeApproved,
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
        $Status = $purchaserequesttbl[0]['Status'];
        $rnd = rand(0, 9999);


        if ($Status == "Approved" || $Status == "On Going" || $Status == "Completed") {
            //Get Brand Coordinator Name
            $CheckedByHO = db_quote($purchaserequesttbl[0]['CheckedByHO']);
            $getBCName = db_select("SELECT `Firstname` ,`Lastname` FROM `employeetbl` WHERE `EmpID` = $CheckedByHO");
            $CheckedBy = $getBCName[0]['Firstname'] . " " . $getBCName[0]['Lastname'];
            $DateApproved = new DateTime($purchaserequesttbl[0]['DateApproved']);
            $TimeApproved = $purchaserequesttbl[0]['TimeApproved'];
        }

        $hashPRNumber = encrypt_decrypt_rnd('encrypt', $PONumber, $rnd);
        ?>
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header modal-header-dark">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Purchase Request Details</h4>
                </div>
                <div class="modal-body">
                    <label>PR Number: <?php echo $PONumber ?></label>
                    <br>
                    <label>Last Modified by: <?= @$ModifiedBy . " / " . date_format($LastModified, "F j, Y") . " / " . $_Time ?></label>
                    <br>
                    <?php
                    if ($Status == "Approved" || $Status == "On Going" || $Status == "Completed") {
                        ?>
                        <label>Approved by: <?= @$CheckedBy . " / " . date_format($DateApproved, "F j, Y") . " / " . $TimeApproved ?></label>
                        <?php
                    }
                    ?>
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
                                            <?php
                                            if ($Status == "Approved" || $Status == "On Going") {
                                                ?>
                                                <th width="15%">Received</th>
                                                <?php
                                            }
                                            ?>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $OrderedItems = db_select(
                                            "SELECT
                                        purchaserequestsitemstbl.ItemCode,
                                        purchaserequestsitemstbl.Qty,
                                        purchaserequestsitemstbl.Color,
                                        purchaserequestsitemstbl.Received,
                                        itemstbl.ModelName,
                                        brandtbl.Brand,
                                        itemstbl.SRP
                                        FROM purchaserequestsitemstbl
                                        LEFT JOIN itemstbl ON purchaserequestsitemstbl.ItemCode = itemstbl.ItemCode
                                        LEFT JOIN brandtbl ON itemstbl.BrandID = brandtbl.BrandID
                                        WHERE purchaserequestsitemstbl.PONumber = " . db_quote($PONumber) . "
                                        AND purchaserequestsitemstbl.ModifyCode = " . db_quote($ModifyCode) . "
                                        ");

                                        $TotalItems = 0;
                                        foreach ($OrderedItems as $item) {
                                            $ItemCode = $item['ItemCode'];
                                            $Qty = $item['Qty'];
                                            $ModelName = $item['ModelName'];
                                            $Color = $item['Color'];
                                            $Brand = $item['Brand'];
                                            $SRP = $item['SRP'];
                                            $Received = $item['Received'];
                                            $TotalItems = $TotalItems + ($Qty * $SRP);
                                            $Total = number_format($Qty * $SRP, 2, '.', ',');
                                            $SRP = number_format($SRP, 2, '.', ',');
                                            ?>
                                            <tr>
                                                <td><?php echo $ItemCode ?></td>
                                                <td><?php echo $ModelName . " (" . $Color . ")" ?></td>
                                                <td><?php echo $Brand ?></td>
                                                <td><?php echo $SRP ?></td>
                                                <td width="5%"><?php echo $Qty ?></td>
                                                <td width="15%"><?php echo $Total ?></td>
                                                <?php
                                                if ($Status == "Approved" || $Status == "On Going") {
                                                    if ($Qty == $Received) {
                                                        ?>
                                                        <td width="15%">Completed</td>
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <td width="15%"><?= @$Received . " / " . $Qty . " Received" ?></td>
                                                        <?php
                                                    }
                                                }
                                                ?>
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
                    if ($Status == "Pending") {
                        ?>
                        <a href="approvepr.php?id=<?= @$hashPRNumber . $rnd ?>&pr=<?= @$PONumber ?>" class="btn btn-success"><i class="fa fa-check"></i> Approve</a>
                        <button class="btn btn-danger" onclick="$('#Rejected').val('<?= @$PONumber ?>'); $('#hashPRNumber').val('<?= @$hashPRNumber . $rnd ?>');" data-toggle="modal" data-target="#RejectRequest"><i class="fa fa-close"></i> Reject</button>
                        <?php
                    }
                    ?>
                    <button class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
        <?php
    } else {
        include_once('errormodal.php');
    }
}
//End of Purchase Request items

//Approve PR
elseif (isset($_POST['approvedPONumber'])) {
    $PONumber = db_quote($_POST['approvedPONumber']);

    $updatePR = db_query("UPDATE `purchaserequeststbl` SET `Remarks` = 'Waiting for Approval from Brand Coordinator', `isAMApproved` = '1', `CheckedByAM` = $EmployeeID WHERE `PONumber` = $PONumber");

}
//End of Approve PR

//Reject PR
elseif (isset($_POST['rejectedPRNumber'])) {
    $hashPRNumber = substr($_POST['hashPRNumber'], 0, 32);
    $PRNumber = $_POST['rejectedPRNumber'];
    $rnd = substr($_POST['hashPRNumber'], 32, 36);

    if (encrypt_decrypt_rnd('decrypt', $hashPRNumber, $rnd) != $PRNumber) {
        echo "error";
    } else {
        $updatePR = db_query("UPDATE `purchaserequeststbl` SET Status ='Rejected' , `CancelledBy` = $EmpID WHERE `PONumber` = " . db_quote($PRNumber));

        if ($updatePR === false) {
            echo "error";
        } else {
            echo "success";
        }
    }

}
//End of Reject PR

//Update Purchase Request
elseif (isset($_POST['HashPRNumber'])) {


    $hashPRNumber = substr($_POST['HashPRNumber'], 0, 32);
    $PRNumber = $_POST['PRNumber'];
    $rnd = substr($_POST['HashPRNumber'], 32, 36);

    if (encrypt_decrypt_rnd('decrypt', $hashPRNumber, $rnd) != $PRNumber) {
        header("location: ../pending.php?error");
    } else {
        $PRNumber = db_quote($PRNumber);
        $Remarks = $_POST['Remarks'];
        $ItemCode = $_POST['oItemCode'];
        $Items = array_combine($ItemCode, $Remarks);
        $_Date = db_quote(date("Y-m-d"));
        $_Time = db_quote(date("h:i A"));
        $ModifyCode = db_quote($_POST['ModifyCode']);

        $PurchaseRequest = db_query("UPDATE `purchaserequeststbl` SET `isBCApproved` = '1', `CheckedByHO` = $EmpID, `DateApproved` = $_Date, `TimeApproved` = $_Time, `Status` = 'Approved', `Remarks` = 'For Delivery' WHERE `PONumber` = $PRNumber AND `ModifyCode` = $ModifyCode");

        if ($PurchaseRequest === false) {
            echo db_error();
            header("location: ../pending.php?error");

        } else {
            foreach ($Items as $item => $remark) {
                $dItemCode = db_quote($item);
                $dRemarks = db_quote($remark);

                $PurchasedItems = db_query("UPDATE `purchaserequestsitemstbl` SET `Remarks` = $dRemarks WHERE `PONumber` = $PRNumber AND `ModifyCode` = $ModifyCode AND `ItemCode` = $dItemCode");

                if ($PurchasedItems === false) {
                    header("location: ../pending.php?error");
                } else {
                    header("location: ../pending.php?success");
                }
            }

        }
    }
}
//End of Update Purchase Request