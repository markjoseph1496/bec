<?php
include('../../../connection.php');
include('../../../functions/encryption.php');
session_start();
$EmpID = db_quote($_SESSION['EmpID']);

$getBranchCode = db_select("
    SELECT
    branchtbl.BranchCode
    FROM branchtbl
    LEFT JOIN employeetbl ON branchtbl.BranchID = employeetbl.BranchID
    WHERE employeetbl.EmpID = $EmpID;
    ");

$BranchCode = db_quote($getBranchCode[0]['BranchCode']);

function generatePONumber($Branch)
{
    $generatePONumber = db_select("SELECT `PONumber` FROM `purchaserequeststbl` WHERE `BranchCode` = $Branch ORDER BY `PONumber` DESC LIMIT 1");
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

function generateTransactionID($Branch)
{
    $_Date = db_quote(date("Y-m-d"));
    $generateTransactionID = db_select("SELECT `TransactionID` FROM `transactiontbl` WHERE `_Date` = $_Date  AND `BranchCode` = $Branch ORDER BY `TransactionID` DESC LIMIT 1");
    $Branch = str_replace("'", "", $Branch);
    $_Date = str_replace("'", "", $_Date);

    if (count($generateTransactionID) == 0) {
        return str_replace("'", "", $Branch . date("md") . "-" . "0001");
    } else {
        $tCount = substr($generateTransactionID[0]['TransactionID'], 9);
        $TID = $Branch . date("md") . "-" . sprintf("%04s", (int)$tCount + 1);
        return $TID;
    }
}

function mergeArrays($ItemCode, $Qty, $Color)
{
    $result = array();

    foreach ($ItemCode as $key => $name) {
        $result[] = array('ItemCode' => $name, 'Qty' => $Qty[$key], 'Color' => $Color[$key]);
    }

    return $result;
}

function mergeArraysSales($IMEI, $Qty, $SRP)
{
    $result = array();

    foreach ($IMEI as $key => $name) {
        $result[] = array('Imeisn' => $name, 'Qty' => $Qty[$key], 'SRP' => $SRP[$key]);
    }

    return $result;
}

//Insert Purchase Request
if (isset($_POST['EmpID'])) {
    $sEmpID = db_quote($_POST['EmpID']);
    $Qty = $_POST['oQty'];
    $Color = $_POST['oColor'];
    $ItemCode = $_POST['oItemCode'];
    $_Date = db_quote(date("Y-m-d"));
    $_Time = db_quote(date("h:i A"));
    $Branch = db_quote($_POST['Branch']);
    $SelectedBrand = $_POST['BrandID'];
    $PONumber = db_quote(generatePONumber($Branch));
    $ModifyCode = db_quote(rand(0, 9999999999));
    $Items = mergeArrays($ItemCode, $Qty, $Color);

    $PurchaseRequest = db_query("INSERT INTO `purchaserequeststbl` (`PONumber`, `_Date`, `BranchCode`,`BrandID`,`Status`,`Remarks`,`EmpID`,`isDeleted`,`ModifiedBy`,`_Time`,`LastModified`,`ModifyCode`) VALUES ($PONumber, $_Date, $Branch, $SelectedBrand,'Pending', 'Waiting for Approval from Area Manager', $sEmpID, '0', $sEmpID, $_Time, $_Date, $ModifyCode)");

    if ($PurchaseRequest === false) {
        header("location: ../po.php?error");
    } else {
        foreach ($Items as $item) {
            $dItemCode = db_quote($item['ItemCode']);
            $dQty = db_quote($item['Qty']);
            $dColor = db_quote($item['Color']);

            $PurchasedItems = db_query("INSERT INTO `purchaserequestsitemstbl` (`PONumber`, `ItemCode`, `Qty`,`Color`,`DateModified`,`ModifyCode`) VALUES ($PONumber ,$dItemCode, $dQty,$dColor, $_Date, $ModifyCode)");
            if ($PurchasedItems === false) {
                $deletePurchaseRequests = db_query("DELETE FROM `purchaserequeststbl` WHERE `PONumber` = $PONumber");
                header("location: ../po.php?error");
            } else {
                header("location: ../po.php?success");
            }
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
        $Color = $_POST['oColor'];
        $ItemCode = $_POST['oItemCode'];
        $_Date = db_quote(date("Y-m-d"));
        $_Time = db_quote(date("h:i A"));
        $Branch = db_quote($_POST['Branch']);
        $SelectedBrand = db_quote($_POST['BrandID']);
        $ModifyCode = db_quote(rand(0, 9999999999));
        $Items = mergeArrays($ItemCode, $Qty, $Color);


        $PurchaseRequest = db_query("UPDATE `purchaserequeststbl` SET `ModifiedBy` = $sEmpID, `_Time` = $_Time, `LastModified` = $_Date, `ModifyCode` = $ModifyCode, `Remarks` = 'Waiting for Approval from Area Manager', `isAMApproved` = '0', `CheckedByAM` = ''  WHERE `PONumber` = $PRNumber");

        if ($PurchaseRequest === false) {

            header("location: ../po.php?error");

        } else {
            foreach ($Items as $item) {
                $dItemCode = db_quote($item['ItemCode']);
                $dQty = db_quote($item['Qty']);
                $dColor = db_quote($item['Color']);

                $PurchasedItems = db_query("INSERT INTO `purchaserequestsitemstbl` (`PONumber`, `ItemCode`, `Qty`,`Color`,`DateModified`,`ModifyCode`) VALUES ($PRNumber ,$dItemCode, $dQty,$dColor, $_Date, $ModifyCode)");

                if ($PurchasedItems === false) {
                    header("location: ../po.php?error");
                } else {
                    header("location: ../po.php?success");
                }
            }

        }
    }
}
//End of Update Purchase Request


//List of purchase request items
elseif (isset($_POST['PONumber'])) {
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
        $ModifyCode = $purchaserequesttbl[0]['ModifyCode'];
        $getName = db_select("SELECT `Firstname` ,`Lastname` FROM `employeetbl` WHERE `EmpID` = $ModifiedByID");
        $ModifiedBy = $getName[0]['Firstname'] . " " . $getName[0]['Lastname'];
        $Status = $purchaserequesttbl[0]['Status'];
        $prnd = rand(0, 9999);

        if ($Status == "Approved") {
            //Get Brand Coordinator Name
            $CheckedByHO = db_quote($purchaserequesttbl[0]['CheckedByHO']);
            $getBCName = db_select("SELECT `Firstname` ,`Lastname` FROM `employeetbl` WHERE `EmpID` = $CheckedByHO");
            $CheckedBy = $getBCName[0]['Firstname'] . " " . $getBCName[0]['Lastname'];
            $DateApproved = new DateTime($purchaserequesttbl[0]['DateApproved']);
            $TimeApproved = $purchaserequesttbl[0]['TimeApproved'];
        }

        $hashPRNumber = encrypt_decrypt_rnd('encrypt', $PONumber, $prnd);
        ?>
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header modal-header-dark">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Purchase Request Details</h4>
                </div>
                <div class="modal-body">
                    <label>PR Number: <?php echo $PONumber; ?></label>
                    <br>
                    <label>Last Modified by: <?= @$ModifiedBy . " / " . date_format($LastModified, "F j, Y") . " / " . $_Time ?></label>
                    <br>
                    <?php
                    if ($Status == "Approved") {
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
                                            <?php
                                            if ($Status == "Approved" || $Status == "On Going") {
                                                ?>
                                                <th width="15%">Received</th>
                                                <th>Action</th>
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
                                        itemstbl.SRP,
                                        brandtbl.Brand
                                        FROM purchaserequestsitemstbl
                                        LEFT JOIN itemstbl ON purchaserequestsitemstbl.ItemCode = itemstbl.ItemCode
                                        LEFT JOIN brandtbl ON itemstbl.BrandID = brandtbl.BrandID
                                        WHERE purchaserequestsitemstbl.PONumber = " . db_quote($PONumber) . "
                                        AND purchaserequestsitemstbl.ModifyCode = " . db_quote($ModifyCode) . "
                                        ORDER BY purchaserequestsitemstbl.Received ASC");
                                        echo db_error();
                                        $TotalItems = 0;
                                        foreach ($OrderedItems as $item) {
                                            $ItemCode = $item['ItemCode'];
                                            $Qty = $item['Qty'];
                                            $Color = $item['Color'];
                                            $ModelName = $item['ModelName'];
                                            $Brand = $item['Brand'];
                                            $Received = $item['Received'];
                                            $SRP = $item['SRP'];
                                            $TotalItems = $TotalItems + ($Qty * $SRP);
                                            $Total = number_format($Qty * $SRP, 2, '.', ',');
                                            $SRP = number_format($SRP, 2, '.', ',');

                                            $rnd = rand(0, 9999);
                                            $rnd = $rnd . $Color;
                                            $hashItemCode = encrypt_decrypt_rnd('encrypt', $ItemCode, $rnd);
                                            ?>
                                            <tr>
                                                <td><?= @ $ItemCode; ?></td>
                                                <td><?= @ $ModelName . " (" . $Color . ")" ?> </td>
                                                <td><?= @ $Brand ?></td>
                                                <td><?= @ $SRP ?></td>
                                                <td><?= @ $Qty ?></td>
                                                <td width="15%"><?= @ $Total ?></td>
                                                <?php
                                                if ($Status == "Approved" || $Status == "On Going") {
                                                    if ($Qty == $Received) {
                                                        ?>
                                                        <td width="15%">Completed</td>
                                                        <td></td>
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <td width="15%"><?= @$Received . " / " . $Qty . " Received" ?></td>
                                                        <td width="5%"><a href="receive.php?id=<?= @$hashItemCode . $rnd ?>&itemcode=<?= @$ItemCode ?>&pid=<?= @$hashPRNumber . $prnd ?>&prnumber=<?= @$PONumber ?>" class="btn btn-success"><i class="fa fa-plus-circle"></i></a></td>
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
                                    <b>Total Price: <label id="sPrice"><?= @ number_format($TotalItems, 2, '.', ','); ?></label></b>
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
                        <button class="btn btn-danger" onclick="$('#Yes').val('<?= @$hashPRNumber . $prnd . $PONumber ?>');" data-toggle="modal" data-target="#CheckDelete">Cancel Order</button>
                        <a href="modify.php?id=<?= @$hashPRNumber . $prnd ?>&pr=<?= @$PONumber ?>" class="btn btn-dark" id="btnModify">Modify</a>
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
        include_once('../php/errormodal.php');
    }
}
//End of Purchase Request items


//Archive PR
elseif (isset($_POST['dPONumber'])) {
    $hashPRNumber = substr($_POST['dPONumber'], 0, 32);
    $PONumber = db_quote(substr($_POST['dPONumber'], 36, 15));
    $rnd = substr($_POST['dPONumber'], 32, 4);

    if (db_quote(encrypt_decrypt_rnd('decrypt', $hashPRNumber, $rnd)) != $PONumber) {
        echo "error";
    } else {
        $deletePR = db_query("UPDATE `purchaserequeststbl` SET `Remarks` = 'Cancelled', `Status` = 'Cancelled', `isDeleted` = '1', `CancelledBy` = $EmpID WHERE `PONumber` = " . $PONumber);

        if ($deletePR === false) {
            echo "error";
        } else {
            echo "success";
        }
    }
}
//End of Archive PR

if (isset($_POST['rItemCode'])) {
    $ItemCode = $_POST['rItemCode'];
    $ItemColor = $_POST['rColor'];
    $PRNumber = $_POST['rPRNumber'];
    $hashPRNumber = $_POST['rhashPRNumber'];
    $hashItemCode = $_POST['rhashItemCode'];
    $ItemRND = $_POST['rItemRND'];
    $PRRND = $_POST['rPRRND'];
    $ImeiSN = $_POST['_ImeiSN'];
    $_Date = db_quote(date("Y-m-d"));
    $_Time = db_quote(date("h:i A"));


    if (encrypt_decrypt_rnd('decrypt', $hashPRNumber, $PRRND) == $PRNumber &&
        encrypt_decrypt_rnd('decrypt', $hashItemCode, $ItemRND . $ItemColor) == $ItemCode
    ) {

        $getModifyCode = db_select("SELECT `ModifyCode` FROM purchaserequeststbl WHERE `PONumber` = " . db_quote($PRNumber));
        $ModifyCode = db_quote($getModifyCode[0]['ModifyCode']);

        $ItemCode = db_quote($ItemCode);
        $ItemColor = db_quote($ItemColor);

        $getReceived = db_select("SELECT `Received` FROM `purchaserequestsitemstbl` WHERE `ItemCode` = $ItemCode AND `PONumber` = " . db_quote($PRNumber) . "AND `ModifyCode` = $ModifyCode AND `Color` = $ItemColor");

        $ItemCount = (int)$getReceived[0]['Received'];
        foreach ($ImeiSN as $item) {
            $Item = db_quote($item);
            $ItemCount++;

            $AddtoInventory = db_query("
            INSERT INTO invtbl (`ItemCode`, `ItemColor`, `imeisn`, `BranchCode`, `_DateReceived`, `_TimeReceived`, `ReceivedBy`, `Status`) 
            VALUES ($ItemCode, $ItemColor, $item, $BranchCode, $_Date, $_Time, $EmpID, 'On Hand')");

        }

        $updatePR = db_query("UPDATE `purchaserequestsitemstbl` SET `Received` = " . db_quote($ItemCount) . " WHERE `ItemCode` = $ItemCode AND `PONumber` = " . db_quote($PRNumber) . "AND `ModifyCode` = $ModifyCode AND `Color` = $ItemColor");

        $CheckStatus = db_select("SELECT `Qty`, `Received` FROM `purchaserequestsitemstbl` WHERE `ItemCode` = ItemCode AND `PONumber` = " . db_quote($PRNumber) . "AND `ModifyCode` = $ModifyCode");


        $StatusCount = 0;
        foreach ($CheckStatus as $status) {
            $Qty = $status['Qty'];
            $Received = $status['Received'];

            if ($Qty > $Received) {
                $StatusCount++;
            }
        }

        $ItemStatus = "";
        $Remarks = "";
        if ($StatusCount == 0) {
            $ItemStatus = "Completed";
            $Remarks = "Already Shipped";
        } else {
            $ItemStatus = "On Going";
            $Remarks = "For Delivery";
        }

        $UpdateStatus = db_query("UPDATE `purchaserequeststbl` SET `Status` = " . db_quote($ItemStatus) . ", `Remarks` = " . db_quote($Remarks) . " WHERE `PONumber` = " . db_quote($PRNumber) . "AND `ModifyCode` = $ModifyCode");


        header("location: ../receiving.php?success");

    } else {
        header("location: ../receiving.php?error");
    }

}

print_r($_POST);
if (isset($_POST['sIMEISN'])) {
    $sIMEISN = $_POST['sIMEISN'];
    $sSRP = $_POST['sSRP'];
    $sQty = $_POST['sQty'];
    $ORNumber = db_quote($_POST['ORNumber']);
    $CustomerName = db_quote(ucwords($_POST['CustomerName']));
    $SalesClerk = db_quote($_POST['SalesClerk']);
    $ModeOfPayment = db_quote($_POST['ModeOfPayment']);
    $Cash = $_POST['Cash'];
    $CreditCard = $_POST['CreditCard'];
    $CardHolderName = db_quote(ucwords($_POST['CardHolderName']));
    $CardNumber = db_quote($_POST['CardNumber']);
    $MID = db_quote($_POST['MID']);
    $BatchNum = db_quote($_POST['BatchNum']);
    $ApprCode = db_quote($_POST['ApprCode']);
    $Terms = db_quote($_POST['Terms']);
    $IDPresented = db_quote($_POST['IDPresented']);
    $HomeCredit = $_POST['HomeCredit'];
    $ReferenceNo = db_quote($_POST['ReferenceNo']);
    $Items = mergeArraysSales($sIMEISN, $sQty, $sSRP);
    $_Date = db_quote(date("Y-m-d"));
    $_Time = db_quote(date("h:i A"));
    $TransactionID = db_quote(generateTransactionID($BranchCode));
    $ErrorCount = 0;


    $Cash = db_quote((float)str_replace(',', '', $Cash));
    $CreditCard = db_quote((float)str_replace(',', '', $CreditCard));
    $HomeCredit = db_quote((float)str_replace(',', '', $HomeCredit));


    if ($ModeOfPayment != "Cash" ||
        $ModeOfPayment != "Credit Card" ||
        $ModeOfPayment != "Home Credit" ||
        $ModeOfPayment != "HomeCredit Credit Card" ||
        $ModeOfPayment != "Cash CreditCard" ||
        $ModeOfPayment != "Cash Home Credit" ||
        $ModeOfPayment != "Cash CreditCard Home Credit"
    ) {
        $addTransaction = db_query("INSERT INTO `transactiontbl` (`TransactionID`, `ORNumber`, `_Date`, `_Time`, `CustomerName`, `SalesClerk`, `Cashier`, `BranchCode`, `ModeOfPayment`, `Status`)
                                                          VALUES ($TransactionID, $ORNumber, $_Date, $_Time, $CustomerName, $SalesClerk, $EmpID, $BranchCode, $ModeOfPayment, 'Active')");

        if ($addTransaction === false) {
            $ErrorCount++;
            header("location: ../addtrans.php?error");
        } else {
            if ($ModeOfPayment == db_quote("Cash")) {
                $queryCash = db_query("INSERT INTO `cashtransactiontbl` (`TransactionID`, `ORNumber`, `Amount`) VALUES ($TransactionID, $ORNumber, $Cash)");
                if ($queryCash === false) {
                    $ErrorCount++;
                }
            } elseif ($ModeOfPayment == db_quote("Credit Card")) {
                $queryCreditCard = db_query("INSERT INTO `credittransactiontbl`  (`TransactionID`, `ORNumber`, `CreditCardNumber`, `CardHolderName`, `MID`, `BatchNum`, `ApprCode`, `Term`, `IDPresented`, `Amount`)
                                                                VALUES ($TransactionID, $ORNumber, $CardNumber, $CardHolderName, $MID, $BatchNum, $ApprCode,$Terms, $IDPresented, $CreditCard)");
                if ($queryCreditCard === false) {
                    $ErrorCount++;
                }
            } elseif ($ModeOfPayment == db_quote("Home Credit")) {
                $queryHomeCredit = db_query("INSERT INTO `homecredittransactiontbl` (`TransactionID`, `ORNumber`, `ReferenceNo`, `Amount`)
                                                                            VALUES  ($TransactionID, $ORNumber, $ReferenceNo, $HomeCredit)");
                if ($queryHomeCredit === false) {
                    $ErrorCount++;
                }
            } elseif ($ModeOfPayment == db_quote("HomeCredit Credit Card")) {
                $queryCreditCard = db_query("INSERT INTO `credittransactiontbl`  (`TransactionID`, `ORNumber`, `CreditCardNumber`, `CardHolderName`, `MID`, `BatchNum`, `ApprCode`, `Term`, `IDPresented`, `Amount`)
                                                                VALUES ($TransactionID, $ORNumber, $CardNumber, $CardHolderName, $MID, $BatchNum, $ApprCode,$Terms, $IDPresented, $CreditCard)");

                $queryHomeCredit = db_query("INSERT INTO `homecredittransactiontbl` (`TransactionID`, `ORNumber`, `ReferenceNo`, `Amount`)
                                                                            VALUES  ($TransactionID, $ORNumber, $ReferenceNo, $HomeCredit)");
                if ($queryCreditCard === false || $queryHomeCredit === false) {
                    $ErrorCount++;
                }
            } elseif ($ModeOfPayment == db_quote("Cash CreditCard")) {
                $queryCash = db_query("INSERT INTO `cashtransactiontbl` (`TransactionID`, `ORNumber`, `Amount`) VALUES ($TransactionID, $ORNumber, $Cash)");

                $queryCreditCard = db_query("INSERT INTO `credittransactiontbl`  (`TransactionID`, `ORNumber`, `CreditCardNumber`, `CardHolderName`, `MID`, `BatchNum`, `ApprCode`, `Term`, `IDPresented`, `Amount`)
                                                                VALUES ($TransactionID, $ORNumber, $CardNumber, $CardHolderName, $MID, $BatchNum, $ApprCode,$Terms, $IDPresented, $CreditCard)");
                if ($queryCreditCard === false || $queryCash === false) {
                    $ErrorCount++;
                }

            } elseif ($ModeOfPayment == db_quote("Cash Home Credit")) {
                $queryCash = db_query("INSERT INTO `cashtransactiontbl` (`TransactionID`, `ORNumber`, `Amount`) VALUES ($TransactionID, $ORNumber, $Cash)");

                $queryHomeCredit = db_query("INSERT INTO `homecredittransactiontbl` (`TransactionID`, `ORNumber`, `ReferenceNo`, `Amount`)
                                                                            VALUES  ($TransactionID, $ORNumber, $ReferenceNo, $HomeCredit)");
                if ($queryCash === false || $queryHomeCredit === false) {
                    $ErrorCount++;
                }
            } elseif ($ModeOfPayment == db_quote("Cash CreditCard Home Credit")) {
                $queryCash = db_query("INSERT INTO `cashtransactiontbl` (`TransactionID`, `ORNumber`, `Amount`) VALUES ($TransactionID, $ORNumber, $Cash)");

                $queryCreditCard = db_query("INSERT INTO `credittransactiontbl`  (`TransactionID`, `ORNumber`, `CreditCardNumber`, `CardHolderName`, `MID`, `BatchNum`, `ApprCode`, `Term`, `IDPresented`, `Amount`)
                                                                VALUES ($TransactionID, $ORNumber, $CardNumber, $CardHolderName, $MID, $BatchNum, $ApprCode,$Terms, $IDPresented, $CreditCard)");

                $queryHomeCredit = db_query("INSERT INTO `homecredittransactiontbl` (`TransactionID`, `ORNumber`, `ReferenceNo`, `Amount`)
                                                                            VALUES  ($TransactionID, $ORNumber, $ReferenceNo, $HomeCredit)");

                if ($queryCash === false || $queryHomeCredit === false || $queryCreditCard === false) {
                    $ErrorCount++;
                }
            } else {
                $ErrorCount++;
            }

            if($ErrorCount == 0){
                //Validate Items
                //Checking of inventory
                $TotalPrice = 0;
                foreach ($Items as $item) {
                    $IMEISN = db_quote($item['Imeisn']);
                    $Qty = db_quote($item['Qty']);
                    $SRP = str_replace(',', '', $item['SRP']);
                    $SRP = db_quote((float)$SRP);

                    //$GrandTotal = number_format($GrandTotal, 2, '.', ',');

                    $checkImei = db_select("SELECT `ItemCode` FROM `invtbl` WHERE `BranchCode` = $BranchCode AND `imeisn` = $IMEISN AND `Status` = 'On Hand'");
                    $ItemCode = db_quote($checkImei[0]['ItemCode']);
                    $checkSRP = db_select("SELECT `SRP` FROM `itemstbl` WHERE `ItemCode` = $ItemCode");
                    if ($checkImei === false || count($checkImei) == 0) {
                        db_query("DELETE FROM `transactiontbl` WHERE `TransactionID` = $TransactionID");
                        header("location: ../addtrans.php?error");
                    } else {
                        if ($checkSRP === false || count($checkSRP) == 0 || db_quote($checkSRP[0]['SRP']) != $SRP) {
                            db_query("DELETE FROM `transactiontbl` WHERE `TransactionID` = $TransactionID");
                            header("location: ../addtrans.php?error");
                        } else {
                            $TotalPrice = $TotalPrice + str_replace("'", "", $SRP);
                            $UpdateInventory = db_query("UPDATE `invtbl` SET `Status` = 'Sold', `TransactionID` = $TransactionID WHERE `imeisn` = $IMEISN");
                        }
                    }
                }
                header("location: ../addtrans.php?success");
            }else{
                db_query("DELETE FROM `transactiontbl` WHERE `TransactionID` = $TransactionID");
                header("location: ../addtrans.php?error");
            }
        }
    }
}