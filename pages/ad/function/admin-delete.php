<?php 
include('../../../connection.php');

//Delete Branch
if (isset($_POST['btndeletebranch'])) {
	
	$BranchID = db_quote($_POST['BranchID']);

	$branchtbl = db_query("DELETE FROM `branchtbl` WHERE BranchID = $BranchID");

	header("location ../branch.php?deleted");
}

//Delete Item
if (isset($_POST['btndeleteItems'])) {

	$ItemCode = db_quote($_POST['ItemCode']);

	$itemstbl = db_query("DELETE FROM `itemstbl` WHERE ItemCode = $ItemCode");

header("location: ../item.php?deleted");
}

//Delete Employee
if (isset($_POST['btndeleteemployee'])) {
	
	$EmpID = db_quote($_POST['EmpID']);

	$employeetbl = db_query("DELETE FROM `employeetbl` WHERE EmpID = $EmpID");

	header("location: ../employee.php?deleted");
}

//Delete Account
if (isset($_POST['btndeleteAccount'])){

    $aUsername = db_quote($_POST['aUsername']);

    $Accounttbl = db_query("DELETE FROM accountstbl WHERE aEmpID = $aUsername");
    $EmployeeAccounttbl = db_query("DELETE FROM employeetbl WHERE EmpID = $aUsername");

    header("location: ../accounts.php?Deleted");
}

//Delete Color
if (isset($_POST['btndeleteColor'])) {

    $ColorID = db_quote($_POST['ColorID']);

    $colortbl = db_query("DELETE FROM `colortbl` WHERE ColorID = $ColorID");

    header("location: ../colors.php?Deleted");
}

// Delete Brand
if (isset($_POST['btndeleteBrand'])) {
    $BrandID = db_quote($_POST['BrandID']);

    $brandtbl = db_query("DELETE FROM `brandtbl` WHERE  BrandID = $BrandID");

    header("location: ../brand.php?Deleted");
}

//Delete Area
if (isset($_POST['btndeleteArea'])) {
    $AreaID = db_quote($_POST['AreaID']);

    $areatbl = db_query("DELETE FROM `areatbl` WHERE  AreaID = $AreaID");

    header("location: ../area.php?Deleted");
}

//Delete Category
if (isset($_POST['btndeleteCategory'])) {
    $CategoryID = db_quote($_POST['CategoryID']);

    $categorytbl = db_query("DELETE FROM `categorytbl` WHERE CategoryID = $CategoryID");

    header("location: ../category.php?Deleted");
}

?>