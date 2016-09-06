<?php
include('../../../connection.php');

if(isset($_POST['Cashier'])){
    $_Date = date("Y-m-d");
    $Cashier = db_quote($_POST['Cashier']);
    $BranchCode = db_quote($_POST['BranchCode']);
    $ORNumber = db_quote($_POST['ORNumber']);
    $CustomerName = db_quote($_POST['CName']);
    $ItemCode = $_POST['tItemCode'];
    $ImeiSN = $_POST['timeisn'];
    $ModelName = $_POST['tmodel_name'];
    $Brand = $_POST['tBrand'];
    $UnitPrice = $_POST['tUnitPrice'];
    $SalesClerk = db_quote($_POST['SalesClerk']);
    $Total = db_quote($_POST['hPrice']);


    foreach($ImeiSN as $value){
        $sImeiSN = db_quote($value);

        db_query("INSERT INTO `soldunits` (`ORNumber`,`IMEISN`) VALUES
             (". $ORNumber .",
             ". $sImeiSN .")");

        db_query("UPDATE `unitstbl` SET `isSold` = '1' WHERE `IMEISN` = " . $sImeiSN);

    }

    db_query("INSERT INTO `unitstransactiontbl` (`ORNumber`,`_Date`, `BranchCode`, `CustomerName`, `SalesClerk`,`Cashier`,`Total`) VALUES
            (". $ORNumber .",
            ". $_Date .",
            ". $BranchCode . ",
            ". $CustomerName .",
            ". $SalesClerk . ",
            ". $Cashier . ",
            ". $Total .")");


    header("location: ../addcash.php");
}