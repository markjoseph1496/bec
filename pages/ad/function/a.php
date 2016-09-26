<?php

include('../../../connection.php');


//Check BranchCode if exists

$isAvailable = true;
$BranchCode = strtoupper('B205');
$hBranchCode = strtoupper('B205');
$Result = db_select("SELECT `BranchCode` FROM `branchtbl` WHERE `BranchCode` =" . db_quote($BranchCode));

if (count($Result) == 0) {
    $isAvailable = true;
} else {
    if($Result[0]['BranchCode'] == $hBranchCode){
        $isAvailable = true;
    }else{
        $isAvailable = false;
    }
}

echo $Result[0]['BranchCode'];
echo $hBranchCode;

echo json_encode(array(
    'valid' => $isAvailable,
));

//End of Check BranchCode