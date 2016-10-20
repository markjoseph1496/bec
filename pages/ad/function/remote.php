<?php
include('../../../connection.php');

if (isset($_POST['AddEmpID'])) {
    $isAvailable = true;
    $EmpID = db_quote($_POST['AddEmpID']);

    $CheckEmpID = db_select("SELECT `EmpID` FROM `employeetbl` WHERE `EmpID` = $EmpID");

    if (count($CheckEmpID) == 0) {
        $isAvailable = true;
    } else {
        $isAvailable = false;
    }

    echo json_encode(array(
        'valid' => $isAvailable,
    ));
} elseif (isset($_POST['AddUsername'])) {
    $isAvailable = true;
    $Username = db_quote($_POST['AddUsername']);

    $CheckUsername = db_select("SELECT `aUsername` FROM `accountstbl` WHERE `aUsername` = $Username");
    echo db_error();
    if (count($CheckUsername) == 0) {
        $isAvailable = true;
    } else {
        $isAvailable = false;
    }

    echo json_encode(array(
        'valid' => $isAvailable,
    ));
}