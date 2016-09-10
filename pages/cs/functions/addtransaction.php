<?php
include('../../../connection.php');
date_default_timezone_set('Asia/Manila');

if (isset($_POST['Cashier'])) {

    //Data from addcash.php
    $_Date = db_quote(date("Y-m-d"));
    $_Time = date("h:i A");
    $Cashier = db_quote($_POST['Cashier']);
    $BranchCode = db_quote($_POST['BranchCode']);
    $ORNumber = db_quote($_POST['ORNumber']);
    $CustomerName = db_quote($_POST['CName']);
    $SalesClerk = db_quote($_POST['SalesClerk']);
    $ImeiSN = $_POST['timeisn'];
    $Total = db_quote($_POST['hPrice']);
    $Cash = db_quote($_POST['Cash']);
    $CreditCard = db_quote($_POST['CreditCard']);
    $HomeCredit = db_quote($_POST['HomeCredit']);
    $CardHolder = db_quote($_POST['CardHolder']);
    $CardNumber = db_quote($_POST['CardNumber']);
    $MID = db_quote($_POST['MID']);
    $BatchNum = db_quote($_POST['BatchNum']);
    $ApprCode = db_quote($_POST['ApprCode']);
    $Term = db_quote($_POST['Terms']);
    $IDPresented = db_quote($_POST['IDPresented']);
    $ReferenceNumber = db_quote($_POST['RefNum']);
    $Balance = db_quote($_POST['Balance']);


    //start of Check payment mode
    $isCash = db_quote("No");
    $isCredit = db_quote("No");
    $isHomeCredit = db_quote("No");

    if ($Cash != db_quote("0.00")) {
        $isCash = db_quote("Yes");
    }
    if ($CreditCard != db_quote("0.00")) {
        $isCredit = db_quote("Yes");
    }
    if ($HomeCredit != db_quote("0.00")) {
        $isHomeCredit = db_quote("Yes");
    }
    //end of check payment mode


    //add units sold to database
    foreach ($ImeiSN as $value) {
        $sImeiSN = db_quote($value);

        db_query("INSERT INTO `soldunits` (`ORNumber`,`IMEISN`) VALUES
             (" . $ORNumber . ",
             " . $sImeiSN . ")");

        db_query("UPDATE `unitstbl` SET `isSold` = '1' WHERE `IMEISN` = " . $sImeiSN);

    }

    //Create a transaction
    $AddTransaction = db_query("INSERT INTO `unitsalestransactiontbl` 
          (`ORNumber`,`_Date`,`_Time`, `BranchCode`, `CustomerName`, `SalesClerk`,`Cashier`,`isCash`,`isCredit`,`isHomeCredit`,`Total`) 
          VALUES
          (" . $ORNumber . ", " . $_Date . "," . $_Time . ", " . $BranchCode . ", " . $CustomerName . ", " . $SalesClerk . ", " . $Cashier . ", " . $isCash . ", " . $isCredit . ", " . $isHomeCredit . ", " . $Total . ")");

    if ($AddTransaction === false) {
        echo db_error();
    }
    //End of transaction


    //Add cash transaction if have
    if ($isCash == db_quote("Yes")) {
        $AddCash = db_query("INSERT INTO `cashtransactiontbl` (`ORNumber`, `Amount`) VALUES (" . $ORNumber . ", " . $Cash . ")");
        if ($AddCash === false) {
            echo db_error();
        }
    }


    //Add credit card transaction if have
    if ($isCredit == db_quote("Yes")) {
        $AddCredit = db_query("INSERT INTO `creditcardtransactiontbl` (`ORNumber`, `CreditCardNumber`, `CardHolderName`, `MID`, `BatchNum`, `ApprCode`, `Term`, `IDPresented`, `Amount`)
                              VALUES
                               (" . $ORNumber . ", " . $CardNumber . ", " . $CardHolder . ", " . $MID . ", " . $BatchNum . ", " . $ApprCode . ", " . $Term . ", " . $IDPresented . ", " . $CreditCard . ")");
        if ($AddCredit === false) {
            echo db_error();
        }
    }

    //Add Home Credit Transaction if have
    if ($isHomeCredit == db_quote("Yes")) {
        $AddHomeCredit = db_query("INSERT INTO `homecredittransactiontbl` (`ORNumber`, `ReferenceNumber`, `Amount`) VALUES (" . $ORNumber . ", " . $ReferenceNumber . ", " . $HomeCredit . ") ");
        if ($AddHomeCredit === false) {
            echo db_error();
        }
    }


    header("location: ../addcash.php?saved");

}