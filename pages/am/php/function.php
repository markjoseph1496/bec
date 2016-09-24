<?php
include('../../../connection.php');

function generatePONumber($Branch)
{
    $generatePONumber = db_select("SELECT `PONumber` FROM `purchaserequeststbl` WHERE `Branch` = " . $Branch . " ORDER BY `PONumber` DESC LIMIT 1");
    $Branch = str_replace("'", "", $Branch);
    if ($generatePONumber === false) {
        echo db_error();
    }
    if (count($generatePONumber) == 0) {
        return str_replace("'", "", "PO-" . $Branch . "-" . date("my") . "001");
    } else {
        $pCount = substr($generatePONumber[0]['PONumber'], 12);
        $gPONumber = "PO-" . $Branch . "-" . date("my") . sprintf("%03s", (int)$pCount + 1);
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
    $Branch = db_quote($_POST['Branch']);
    $PONumber = db_quote(generatePONumber($Branch));


    $PurchaseRequest = db_query("INSERT INTO `purchaserequeststbl` (`PONumber`, `_Date`, `Branch`,`Status`,`Remarks`,`EmpID`,`isDeleted`,`isAMApproved`) VALUES (" . $PONumber . "," . $_Date . "," . $Branch . ",'Pending', 'Waiting for Approval from HO'," . $sEmpID . ",'0','1')");

    if ($PurchaseRequest === false) {
        echo db_error();
        die();
    } else {
        foreach ($Items as $item => $qty) {
            $dItemCode = db_quote($item);
            $dQty = db_quote($qty);

            $PurchasedItems = db_query("INSERT INTO `purchaserequestsitemstbl` (`PONumber`, `ItemCode`, `Qty`) VALUES (" . $PONumber . "," . $dItemCode . "," . $dQty . ")");

        }
        header("location: ../po.php");
    }


}
//End of Purchase Request


//List of purchase request items
if (isset($_POST['PONumber'])) {
    $sPONumber = db_quote($_POST['PONumber']);

    $purchaserequesttbl = db_select("
    SELECT
    purchaserequeststbl.PONumber,
    purchaserequeststbl.Branch,
    purchaserequeststbl._Date,
    purchaserequeststbl.isAMApproved,
    employeetbl.Firstname,
    employeetbl.Lastname
    FROM purchaserequeststbl
    LEFT JOIN employeetbl ON purchaserequeststbl.EmpID = employeetbl.EmpID
    WHERE PONumber =" . $sPONumber . "AND `isDeleted` = '0'");

    $PONumber = $purchaserequesttbl[0]['PONumber'];
    $Branch = $purchaserequesttbl[0]['Branch'];
    $ContactPerson = $purchaserequesttbl[0]['Firstname'] . " " . $purchaserequesttbl[0]['Lastname'];
    $_Date = new DateTime($purchaserequesttbl[0]['_Date']);
    $isAMpproved = $purchaserequesttbl[0]['isAMApproved'];

    ?>
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header modal-header-dark">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Purchase Order Details</h4>
            </div>
            <div class="modal-body">
                <label>PO Number: <?php echo $PONumber ?></label>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Area</label>
                                <input type="text" class="form-control" value="Central Luzon" readonly>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Brand</label>
                                <input type="text" class="form-control" value="Cherry Mobile" readonly>
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
                                <label>Ordered By</label>
                                <input type="text" class="form-control" value="<?php echo $ContactPerson ?>" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Date</label>
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
                                        <th>Color</th>
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
                                        itemstbl.Color,
                                        itemstbl.Brand,
                                        itemstbl.SRP
                                        FROM purchaserequestsitemstbl
                                        LEFT JOIN itemstbl ON purchaserequestsitemstbl.ItemCode = itemstbl.ItemCode
                                        WHERE purchaserequestsitemstbl.PONumber = " . db_quote($PONumber));

                                    $TotalItems = 0;
                                    foreach ($OrderedItems as $item) {
                                        $ItemCode = $item['ItemCode'];
                                        $Qty = $item['Qty'];
                                        $ModelName = $item['ModelName'];
                                        $Color = $item['Color'];
                                        $Brand = $item['Brand'];
                                        $SRP = $item['SRP'];
                                        $TotalItems = $TotalItems + ($Qty * $SRP);
                                        $Total = number_format($Qty * $SRP, 2, '.', ',');
                                        $SRP = number_format($SRP, 2, '.', ',');
                                        ?>
                                        <tr>
                                            <td><?php echo $ItemCode ?></td>
                                            <td><?php echo $ModelName ?></td>
                                            <td><?php echo $Color ?></td>
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
                if ($isAMpproved == 0) {
                    ?>
                    <button class="btn btn-success" onclick="ApproveRequest(<?php echo db_quote($PONumber) ?>);"><i class="fa fa-check"></i> Approve</button>
                    <button class="btn btn-danger" onclick="RejectRequest(<?php echo db_quote($PONumber) ?>);"><i class="fa fa-close"></i> Reject</button>
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
}
//End of Purchase Request items


//Approve PR
if (isset($_POST['approvedPONumber'])) {
    $PONumber = db_quote($_POST['approvedPONumber']);

    $updatePR = db_query("UPDATE `purchaserequeststbl` SET `Remarks` = 'Waiting for Approval from HO', `isAMApproved` = '1' WHERE `PONumber` =" . $PONumber);

}
//End of Approve PR

//Reject PR
if (isset($_POST['rejectedPONumber'])) {
    $PONumber = db_quote($_POST['rejectedPONumber']);
    $Reason = db_quote($_POST['Reason']);


    $updatePR = db_query("UPDATE `purchaserequeststbl` SET `Remarks` = " . $Reason . ", Status ='Rejected' , `isAMApproved` = '2' WHERE `PONumber` =" . $PONumber);

}
//End of Reject PR
