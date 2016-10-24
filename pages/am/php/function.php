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

function mergeArrays($ItemCode, $Qty, $Color)
{
    $result = array();

    foreach ($ItemCode as $key => $name) {
        $result[] = array('ItemCode' => $name, 'Qty' => $Qty[$key], 'Color' => $Color[$key]);
    }

    return $result;
}

//Insert Purchase Request
if (isset($_POST['EmpID'])) {
    $sEmpID = db_quote($_POST['EmpID']);
    $Qty = $_POST['oQty'];
    $ItemCode = $_POST['oItemCode'];
    $Color = $_POST['oColor'];
    $_Date = db_quote(date("Y-m-d"));
    $_Time = db_quote(date("h:i A"));
    $Branch = db_quote($_POST['Branch']);
    $SelectedBrand = $_POST['BrandID'];
    $PONumber = db_quote(generatePONumber($Branch));
    $ModifyCode = db_quote(rand(0, 9999999999));
    $Items = mergeArrays($ItemCode, $Qty, $Color);


    $PurchaseRequest = db_query("INSERT INTO `purchaserequeststbl` (`PONumber`, `_Date`, `BranchCode`,`BrandID`,`Status`,`Remarks`,`EmpID`,`isAMApproved`,`ModifiedBy`,`_Time`,`LastModified`,`ModifyCode`) VALUES ($PONumber, $_Date, $Branch, $SelectedBrand,'Pending', 'Waiting for Approval from Branch Coordinator', $sEmpID, '1', $sEmpID, $_Time, $_Date, $ModifyCode)");

    if ($PurchaseRequest === false) {
        header("location: ../po.php?error");
    } else {
        foreach ($Items as $item) {
            $dItemCode = db_quote($item['ItemCode']);
            $dQty = db_quote($item['Qty']);
            $dColor = db_quote($item['Color']);

            $PurchasedItems = db_query("INSERT INTO `purchaserequestsitemstbl` (`PONumber`, `ItemCode`, `Qty`,`Color`,`DateModified`,`ModifyCode`) VALUES ($PONumber ,$dItemCode, $dQty,$dColor, $_Date, $ModifyCode)");

            if ($PurchasedItems === false) {
                header("location: ../po.php?error");
            } else {
                header("location: ../po.php?success");
            }
        }
    }

}
//End of Purchase Request

//Update Purchase Request
if (isset($_POST['aEmpID'])) {

    $hashPRNumber = $_POST['HashPRNumber'];
    $PRNumber = db_quote($_POST['PRNumber']);

    if (db_quote(encrypt_decrypt('decrypt', $hashPRNumber)) != $PRNumber) {
        header("location: ../po.php?error");
    } else {
        $sEmpID = db_quote($_POST['aEmpID']);
        $Qty = $_POST['oQty'];
        $ItemCode = $_POST['oItemCode'];
        $Color = $_POST['oColor'];
        $_Date = db_quote(date("Y-m-d"));
        $_Time = db_quote(date("h:i A"));
        $Branch = db_quote($_POST['Branch']);
        $SelectedBrand = db_quote($_POST['BrandID']);
        $ModifyCode = db_quote(rand(0, 9999999999));
        $Items = mergeArrays($ItemCode, $Qty, $Color);


        $PurchaseRequest = db_query("UPDATE `purchaserequeststbl` SET `ModifiedBy` = $sEmpID, `_Time` = $_Time, `LastModified` = $_Date, `ModifyCode` = $ModifyCode, `Remarks` = 'Waiting for Approval from Brand Coordinator', `isAMApproved` = '1', `CheckedByAM` = $EmployeeID  WHERE `PONumber` = $PRNumber");


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
                    header("location: ../po.php?success" . $dColor);
                }
            }
        }
    }
}
//End of Update Purchase Request


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

        if ($Status == "Approved") {
            //Get Brand Coordinator Name
            $CheckedByHO = db_quote($purchaserequesttbl[0]['CheckedByHO']);
            $getBCName = db_select("SELECT `Firstname` ,`Lastname` FROM `employeetbl` WHERE `EmpID` = $CheckedByHO");
            $CheckedBy = $getBCName[0]['Firstname'] . " " . $getBCName[0]['Lastname'];
            $DateApproved = new DateTime($purchaserequesttbl[0]['DateApproved']);
            $TimeApproved = $purchaserequesttbl[0]['TimeApproved'];
        }

        $hashPRNumber = encrypt_decrypt('encrypt', $PONumber);
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
                                            if ($Status == "Approved") {
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

//Approve PR
if (isset($_POST['approvedPONumber'])) {
    $PONumber = db_quote($_POST['approvedPONumber']);

    $updatePR = db_query("UPDATE `purchaserequeststbl` SET `Remarks` = 'Waiting for Approval from Brand Coordinator', `isAMApproved` = '1', `CheckedByAM` = $EmployeeID WHERE `PONumber` = $PONumber");

    if ($updatePR === false) {
        echo "error";
    } else {
        echo "success";
    }

}
//End of Approve PR

//Reject PR
if (isset($_POST['rejectedPONumber'])) {
    $PONumber = db_quote($_POST['rejectedPONumber']);
    $Reason = db_quote($_POST['Reason']);


    $updatePR = db_query("UPDATE `purchaserequeststbl` SET `Remarks` = " . $Reason . ", Status ='Rejected' , `isAMApproved` = '2', `CancelledBy` = $EmployeeID WHERE `PONumber` = $PONumber");

    if ($updatePR === false) {
        echo "error";
    } else {
        echo "success";
    }

}
//End of Reject PR

//Cancel PR
if (isset($_POST['CancelledPONumber'])) {
    $PONumber = db_quote($_POST['CancelledPONumber']);

    $updatePR = db_query("UPDATE `purchaserequeststbl` SET `Remarks` = 'Cancelled', Status ='Cancelled' , `isAMApproved` = '2', `CancelledBy` = $EmployeeID WHERE `PONumber` = $PONumber");

    if ($updatePR === false) {
        echo "error";
    } else {
        echo "success";
    }
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
} elseif (isset($_POST['TransactionID'])) {
    $TransactionID = $_POST['TransactionID'];
    $hash = $_POST['Hash'];
    $rnd = $_POST['rnd'];
    $BranchCode = substr($_POST['sBranchCode'], 0, 32);
    $Currentrnd = substr($_POST['sBranchCode'], 32, 4);
    $BranchCode = db_quote(encrypt_decrypt_rnd('decrypt', $BranchCode, $Currentrnd));

    if (encrypt_decrypt_rnd('decrypt', $hash, $rnd) == $TransactionID) {
        $transactionDetails = db_select("
        SELECT
        transactiontbl.ORNumber,
        transactiontbl._Date,
        transactiontbl._Time,
        transactiontbl.CustomerName,
        transactiontbl.SalesClerk,
        transactiontbl.Cashier,
        transactiontbl.ModeOfPayment,
        branchtbl.BranchName,
        cashtransactiontbl.Amount Cash,
        credittransactiontbl.Amount CreditCard,
        credittransactiontbl.CreditCardNumber,
        credittransactiontbl.CardHolderName,
        credittransactiontbl.MID,
        credittransactiontbl.BatchNum,
        credittransactiontbl.ApprCode,
        credittransactiontbl.Term,
        credittransactiontbl.IDPresented,
        homecredittransactiontbl.Amount HomeCredit,
        homecredittransactiontbl.ReferenceNo
        FROM transactiontbl
        LEFT JOIN cashtransactiontbl ON transactiontbl.TransactionID = cashtransactiontbl.TransactionID
        LEFT JOIN credittransactiontbl ON transactiontbl.TransactionID = credittransactiontbl.TransactionID
        LEFT JOIN homecredittransactiontbl ON transactiontbl.TransactionID = homecredittransactiontbl.TransactionID
        LEFT JOIN branchtbl ON transactiontbl.BranchCode = branchtbl.BranchCode
        WHERE transactiontbl.TransactionID = " . db_quote($TransactionID) . "
        AND transactiontbl.BranchCode = $BranchCode
        ");

        $EmpSC = $transactionDetails[0]['SalesClerk'];
        $EmpCS = $transactionDetails[0]['Cashier'];
        $getSC = db_select("SELECT `Firstname`, `Lastname` FROM `employeetbl` WHERE `EmpID` = " . db_quote($EmpSC));
        $getCS = db_select("SELECT `Firstname`, `Lastname` FROM `employeetbl` WHERE `EmpID` = " . db_quote($EmpCS));

        $ORNumber = $transactionDetails[0]['ORNumber'];
        $_Date = $transactionDetails[0]['_Date'];
        $_Time = $transactionDetails[0]['_Time'];
        $CustomerName = $transactionDetails[0]['CustomerName'];
        $Branch = $transactionDetails[0]['BranchName'];
        $SalesClerk = $getSC[0]['Firstname'] . " " . $getSC[0]['Lastname'];
        $Cashier = $getCS[0]['Firstname'] . " " . $getCS[0]['Lastname'];
        $ModeOfPayment = $transactionDetails[0]['ModeOfPayment'];
        $Cash = $transactionDetails[0]['Cash'];
        $CreditCard = $transactionDetails[0]['CreditCard'];
        $CreditCardNumber = $transactionDetails[0]['CreditCardNumber'];
        $CardHolderName = $transactionDetails[0]['CardHolderName'];
        $MID = $transactionDetails[0]['MID'];
        $BatchNum = $transactionDetails[0]['BatchNum'];
        $ApprCode = $transactionDetails[0]['ApprCode'];
        $Term = $transactionDetails[0]['Term'];
        $IDPresented = $transactionDetails[0]['IDPresented'];
        $HomeCredit = $transactionDetails[0]['HomeCredit'];
        $ReferenceNo = $transactionDetails[0]['ReferenceNo'];

        $MOD = "";
        if ($ModeOfPayment == "Cash") {
            $MOD = "Cash";
            $CreditCard = 0;
            $HomeCredit = 0;
        } elseif ($ModeOfPayment == "Credit Card") {
            $MOD = "Credit Card";
            $Cash = 0;
            $HomeCredit = 0;
        } elseif ($ModeOfPayment == "Home Credit") {
            $MOD = "Home Credit";
            $Cash = 0;
            $CreditCard = 0;
        } elseif ($ModeOfPayment == "HomeCredit Credit Card") {
            $MOD = "Credit Card, Home Credit";
            $Cash = 0;
        } elseif ($ModeOfPayment == "Cash CreditCard") {
            $MOD = "Cash, Credit Card";
            $Home = 0;
        } elseif ($ModeOfPayment == "Cash Home Credit") {
            $MOD = "Cash, Home Credit";
            $CreditCard = 0;
        } elseif ($ModeOfPayment == "Cash CreditCard Home Credit") {
            $MOD = "Cash, Credit Card, Home Credit";
        } else {
            $MOD = "Error";
        }

        $TotalAmountPaid = $Cash + $CreditCard + $HomeCredit;
        $Cash = number_format($Cash, 2, '.', ',');
        $CreditCard = number_format($CreditCard, 2, '.', ',');
        $HomeCredit = number_format($HomeCredit, 2, '.', ',');
        $TotalAmountPaid = number_format($TotalAmountPaid, 2, '.', ',');
        ?>
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header modal-header-dark">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="fa fa-globe"></i> Invoice</h4>
                </div>
                <div class="modal-body">
                    <section class="content invoice">
                        <!-- title row -->
                        <div class="row">
                            <div class="col-xs-12 invoice-header">
                                <label>Transaction # <?= @$TransactionID ?></label>
                                <label class="pull-right">Date: <?= @$_Date ?></label>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- info row -->
                        <div class="row">
                            <div class="col-sm-4">
                                <b>OR # <?= @$ORNumber ?></b>
                                <br>
                                <b>Sales Clerk:</b> <?= @$SalesClerk ?>
                                <br>
                                <b>Cashier:</b> <?= @$Cashier ?>
                                <br>
                                <b>Time purchased:</b> <?= @$_Time ?>
                                <br>
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4">
                                From
                                <address>
                                    <strong><?= @$BranchCode = str_replace("'", "", $BranchCode); ?></strong>
                                    <br>
                                    <strong><?= @$Branch ?></strong>
                                </address>
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4">
                                To
                                <address>
                                    <strong><?= @$CustomerName ?></strong>
                                </address>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <!-- Table row -->
                        <div class="row">
                            <div class="col-xs-12 table">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>Qty</th>
                                        <th>Item Name</th>
                                        <th>IMEI / SN / PDC</th>
                                        <th style="width: 30%">Description</th>
                                        <th>SRP</th>
                                        <th>Subtotal</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $Items = db_select("
                                    SELECT
                                    invtbl.ItemColor,
                                    invtbl.imeisn,
                                    itemstbl.ModelName,
                                    itemstbl.ItemDescription,
                                    itemstbl.SRP
                                    FROM invtbl
                                    LEFT JOIN itemstbl ON invtbl.ItemCode = itemstbl.ItemCode
                                    WHERE invtbl.TransactionID = " . db_quote($TransactionID) . "
                                    AND invtbl.BranchCode = " . db_quote($BranchCode) . "
                                    AND invtbl.Status = 'Sold'
                                    ");
                                    echo db_error();
                                    foreach ($Items as $item) {
                                        $ModelName = $item['ModelName'];
                                        $ItemColor = $item['ItemColor'];
                                        $ImeiSN = $item['imeisn'];
                                        $ItemDescription = $item['ItemDescription'];
                                        $SRP = $item['SRP'];


                                        $countItem = db_select("SELECT * FROM `invtbl` WHERE `imeisn` = " . db_quote($ImeiSN) . " AND `Status` = 'Sold' AND `BranchCode` = " . db_quote($BranchCode));
                                        $Qty = count($countItem);

                                        $Total = $Qty * $SRP;
                                        $Total = number_format($Total, 2, '.', ',');
                                        $SRP = number_format($SRP, 2, '.', ',');
                                        ?>
                                        <tr>
                                            <td><?= @$Qty ?></td>
                                            <td><?= @$ModelName . " (" . $ItemColor . ")" ?></td>
                                            <td><?= @$ImeiSN ?></td>
                                            <td><?= @$ItemDescription ?> </td>
                                            <td>&#x20B1; <?= @$SRP ?></td>
                                            <td>&#x20B1; <?= @$Total ?></td>
                                        </tr>
                                        <?php
                                    }
                                    ?>

                                    </tbody>
                                </table>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                        &nbsp;
                        <div class="row">
                            <!-- accepted payments column -->
                            <div class="col-xs-6">
                                <h2><b>Payment Method:</b> <?= @$MOD ?></h2>
                                <?php
                                if ($MOD == "Credit Card" || $MOD == "Credit Card, Home Credit" || $MOD == "Cash, Credit Card" || $MOD == "Cash, Credit Card, Home Credit") {
                                    ?>
                                    <div id="CreditCardDetails">
                                        <h4><b>Credit Card Details</b></h4>
                                        <strong>Cardholder Name:</strong> <?= @$CustomerName ?> <br>
                                        <strong>Card #:</strong> <?= @$CreditCardNumber ?> <br>
                                        <strong>MID:</strong> <?= @$MID ?> <br>
                                        <strong>Batch #:</strong> <?= @$BatchNum ?> <br>
                                        <strong>Appr Code:</strong> <?= @$ApprCode ?> <br>
                                        <strong>Terms:</strong> <?= @$Terms ?> <br>
                                    </div>
                                    <br>
                                    <?php
                                } elseif ($MOD == "Home Credit" || $MOD == "Credit Card, Home Credit" || $MOD == "Cash, Home Credit" || $MOD == "Cash, Credit Card, Home Credit") {
                                    ?>
                                    <div id="HomeCreditDetails">
                                        <h4><b>Home Credit Details</b></h4>
                                        <strong>Ref #:</strong> <?= @$ReferenceNo ?><br>
                                    </div>
                                    <br>
                                    <?php
                                }
                                ?>
                            </div>
                            <!-- /.col -->
                            <div class="col-xs-6">
                                <p class="lead">Total Amount Paid</p>
                                <div class="table-responsive">
                                    <table class="table">
                                        <tbody>
                                        <tr>
                                            <th style="width:50%">Cash:</th>
                                            <td align="right">&#x20B1; <?= @$Cash ?> </td>
                                        </tr>
                                        <tr>
                                            <th>Credit Card</th>
                                            <td align="right">&#x20B1; <?= @$CreditCard ?></td>
                                        </tr>
                                        <tr>
                                            <th>Home Credit:</th>
                                            <td align="right">&#x20B1; <?= @$HomeCredit ?></td>
                                        </tr>
                                        <tr>
                                            <th>Total:</th>
                                            <td align="right">&#x20B1; <?= @$TotalAmountPaid ?></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </section>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-dark" data-dismiss="modal">Close</button>
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