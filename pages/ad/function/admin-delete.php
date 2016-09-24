<?php 
include('../../../connection.php');

//Delete Branch
if (isset($_POST['btndeletebranch'])) {
	
	$BranchID = db_quote($_POST['BranchID']);

	$branchtbl = db_query("DELETE FROM `branchtbl` WHERE BranchID = $BranchID");

	header("location ../branch.php?deleted");
}

//Delete Item
if (isset($_POST['btndeleteitem'])) {

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

?>