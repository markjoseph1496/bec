<?php
include('../../../connection.php');

//Add Branches
if (isset($_POST['BranchCode'])) {

    $BranchCode = db_quote($_POST['BranchCode']);
    $BranchName = db_quote($_POST['BranchName']);
    $Area = db_quote($_POST['BranchArea']);
    $BranchType = db_quote($_POST['BranchType']);
    $bBrand = db_quote($_POST['bBrand']);
    $AddBranch = db_query("
        INSERT INTO `branchtbl` (`BranchCode`,`BranchName`,`Brand`,`Area`,`BranchType`)
		VALUES (" . $BranchCode . "," . $BranchName . "," . $bBrand . "," . $Area . "," . $BranchType . ")");

    if($AddBranch === false){
        echo "False";
    }else{
        echo "True";
    }
}
// End add branch

//Add Item
if (isset($_POST['ItemCode'])) {

    $ItemCode = db_quote($_POST['ItemCode']);
    $ModelName = db_quote($_POST['ModelName']);
    $ItemDescription = db_quote($_POST['ItemDescription']);
    $iBrand = db_quote($_POST['iBrand']);
    $ItemColor = db_quote($_POST['ItemColor']);
    $Category = db_quote($_POST['Category']);
    $SRP = db_quote($_POST['SRP']);
    $DP = db_quote($_POST['DP']);

    $AddItem = db_query("INSERT INTO `itemstbl` (`ItemCode`,`ModelName`,`ItemDescription`,`Color`,`Brand`,`Category`,`SRP`,`DP`)
		VALUES
		(" . $ItemCode . "," . $ModelName . "," . $ItemDescription . "," . $iBrand . ",". $ItemColor ."," . $Category . "," . $SRP . "," . $DP . ")");

    header("location: ../item.php");
}
//End Add Item

//Add Employee
if (isset($_POST['EmpID'])) {

    $EmpID = db_quote($_POST['EmpID']);
    $Firstname = db_quote($_POST['Firstname']);
    $Middlename = db_quote($_POST['Middlename']);
    $Lastname = db_quote($_POST['Lastname']);
    $Initials = db_quote($_POST['Initials']);
    $Position = db_quote($_POST['Position']);
    $Branch = db_quote($_POST['Branch']);

    $AddEmployee = db_query("INSERT INTO `employeetbl` (`EmpID`,`Firstname`,`Middlename`,`Lastname`,`Initials`,`Position`,`Branch`)
		VALUES
		(" . $EmpID . "," . $Firstname . "," . $Middlename . "," . $Lastname . "," . $Initials . "," . $Position . "," . $Branch . ")");

    header("location: ../employee.php?id=EmployeeAddNotif");
}
// End Add Employee

// Add account
if (isset($_POST['btnaddaccount'])) {
    
    $aUsername = db_quote($_POST['aUsername']);
    $aPassword = db_quote($_POST['aPassword']);
    $aEmpID = db_quote($_POST['aEmpID']);

    $aSaltedPassword = hash('sha512', mt_rand(0, PHP_INT_MAX) . mt_rand(0, PHP_INT_MAX) . mt_rand(0, PHP_INT_MAX));
    $aPassword = hash('sha512', $aPassword . $aSaltedPassword);


    $AddAccount = db_query("INSERT INTO `accountstbl` (`aUsername`,`aPassword`,`aSaltedPassword`,`aEmpID`)
        VALUES (". $aUsername .",". $aPassword .",". $aSaltedPassword .",". $aEmpID .")");

    echo db_error();
    die();

    //header("location: ../employee.php?Accountadded");
    //echo $_POST['aEmpID'];
    //echo $_POST['aUsername'];
    //echo $_POST['aPassword'];
    //echo $salt;
    //die();
}
// End of add account

//Update Branch

if (isset($_POST['btnupdatebranch'])) {

    $BranchID = db_quote($_POST['BranchID']);
    $BranchCode = db_quote($_POST['BranchCode']);
    $BranchName = db_quote($_POST['BranchName']);
    $Area = db_quote($_POST['Area']);
    $BranchType = db_quote($_POST['BranchType']);

    $UpdateBranch = db_query("UPDATE `branchtbl` SET `BranchName` = $BranchName, `Area` = $Area, `BranchType` = $BranchType WHERE `BranchID` = $BranchID");

    header("location: ../branch.php?saved");
}
//End Update branch

//Update Item
if (isset($_POST['btnupdateitem'])) {

    $uItemCode = db_quote($_POST['uItemCode']);
    $uModelName = db_quote($_POST['uModelName']);
    $uItemDescription = db_quote($_POST['uItemDescription']);
    $uiBrand = db_quote($_POST['uiBrand']);
    $uCategory = db_quote($_POST['uCategory']);
    $uSRP = db_quote($_POST['uSRP']);
    $uDP = db_quote($_POST['uDP']);

    $UpdateItem = db_query("UPDATE `itemstbl` SET `ModelName` = $uModelName, `ItemDescription` = $uItemDescription, `Brand` = $uiBrand, `Category` = $uCategory, `SRP` = $uSRP, `DP` = $uDP WHERE `ItemCode` = $uItemCode");

    header('location: ../item.php?Updated');
}
//End Update Item

//Update Employee
if (isset($_POST['btnupdateemployee'])) {

    $uEmpID = db_quote($_POST['uEmpID']);
    $uFirstname = db_quote($_POST['uFirstname']);
    $uMiddlename = db_quote($_POST['uMiddlename']);
    $uLastname = db_quote($_POST['uLastname']);
    $uInitials = db_quote($_POST['uInitials']);
    $uPosition = db_quote($_POST['uPosition']);
    $uBranch = db_quote($_POST['uBranch']);

    $UpdateEmployee = db_query("UPDATE `employeetbl` SET `Firstname` = $uFirstname, `Middlename` = $uMiddlename, `Lastname` = $uLastname, `Initials` = $uInitials, `Position` = $uPosition, `Branch` = $uBranch WHERE `EmpID` = $uEmpID");

    header('location: ../employee.php?Updated');
}
?>