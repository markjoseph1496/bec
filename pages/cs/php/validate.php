<?php
include('../../../connection.php');
include('../../../functions/encryption.php');
session_start();
$EmpID = db_quote($_SESSION['EmpID']);

$getBranchCode = db_select("SELECT branchtbl.BranchCode FROM branchtbl LEFT JOIN employeetbl ON branchtbl.BranchID = employeetbl.BranchID WHERE employeetbl.EmpID = $EmpID");
$BranchCode = db_quote($getBranchCode[0]['BranchCode']);


if (isset($_POST['rItemCode'])) {
    $isCorrect = false;

    $ItemCode = $_POST['rItemCode'];
    $Color = $_POST['rColor'];
    $PRNumber = $_POST['rPRNumber'];
    $hashPRNumber = $_POST['rhashPRNumber'];
    $hashItemCode = $_POST['rhashItemCode'];
    $ItemRND = $_POST['rItemRND'];
    $PRRND = $_POST['rPRRND'];

    if (encrypt_decrypt_rnd('decrypt', $hashPRNumber, $PRRND) == $PRNumber
        && encrypt_decrypt_rnd('decrypt', $hashItemCode, $ItemRND . $Color) == $ItemCode
    ) {
        $isCorrect = true;
    } else {
        $isCorrect = false;
    }

    echo $isCorrect;
}
if (isset($_POST['ImeiSN'])) {
    $isCorrect = false;
    $ImeiSN = db_quote($_POST['ImeiSN']);

    $CheckIMEI = db_select("SELECT `imeisn` FROM `invtbl` WHERE `imeisn` = $ImeiSN");

    if (count($CheckIMEI) == 1) {
        $isCorrect = false;
    } else {
        $isCorrect = true;
    }

    echo $isCorrect;
}

if (isset($_POST['sImeiSN'])) {
    $isCorrect = false;
    $ImeiSN = db_quote($_POST['sImeiSN']);

    $CheckIMEI = db_select("
    SELECT
    itemstbl.ItemCode,
    itemstbl.ModelName,
    itemstbl.ItemDescription,
    itemstbl.SRP,
    itemstbl.Category,
    invtbl.ItemColor
    FROM invtbl
    LEFT JOIN itemstbl ON invtbl.ItemCode = itemstbl.ItemCode
    WHERE invtbl.imeisn = $ImeiSN
    AND invtbl.Status = 'On Hand'
    AND invtbl.BranchCode = $BranchCode
    ");

    if ($CheckIMEI === false) {
        $data = array(
            'Count' => 2,
            'ItemCode' => "",
            'ModelName' => "",
            'Description' => "",
            'SRP' => "",
            'Category' => "",
            'Color' => ""
        );
    } else {
        if (count($CheckIMEI) == 0) {
            $data = array(
                'Count' => 0,
                'ItemCode' => "",
                'ModelName' => "",
                'Description' => "",
                'SRP' => "",
                'Category' => "",
                'Color' => ""
            );
        } else {
            $ItemCode = $CheckIMEI[0]['ItemCode'];
            $ModelName = $CheckIMEI[0]['ModelName'];
            $Description = $CheckIMEI[0]['ItemDescription'];
            $SRP = $CheckIMEI[0]['SRP'];
            $Category = $CheckIMEI[0]['Category'];
            $Color = $CheckIMEI[0]['ItemColor'];

            $data = array(
                'Count' => 1,
                'ItemCode' => $ItemCode,
                'ModelName' => $ModelName,
                'Description' => $Description,
                'SRP' => $SRP,
                'Category' => $Category,
                'Color' => $Color
            );
        }
    }
    echo json_encode($data);
}