<?php
include('../../../connection.php');
//Check BranchCode if exists
if(isset($_POST['BranchCode'])){
    $isAvailable = true;
    $BranchCode = db_quote($_POST['BranchCode']);
    $Result = db_select("SELECT `BranchCode` FROM `branchtbl` WHERE `BranchCode` =" . $BranchCode);

    if (count($Result) == 0) {
        $isAvailable = true;
    } else {
        $isAvailable = false;
    }


    echo json_encode(array(
        'valid' => $isAvailable,
    ));
}
//End of Check BranchCode