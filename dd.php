<?php
include('connection.php');

$BranchCode = $_POST['BranchCode'];
$Cashier = $_POST['Cashier'];
$ORNumber = $_POST['ORNumber'];
$CustomerName =$_POST['CName'];
$ModelName = $_POST['model_name'];
$Price = $_POST['Price'];
$Qty = $_POST['Quantity'];
$TotalPrice = $_POST['TotalPrice'];



GSecureSQL::query(
    "INSERT INTO tmpsales (Cashier, BranchCode, ORNumber, Customer, Unit, Price, Qty, TotalPrice) values (?,?,?,?,?,?,?,?)",
    FALSE,
    "ssssssss",
    $Cashier,
    $BranchCode,
    $ORNumber,
    $CustomerName,
    $ModelName,
    $Price,
    $Qty,
    $TotalPrice
);


/*
$data = json_decode(stripslashes($_POST['data']));

foreach($data as $d){

    $a = $d;

    echo $a . $a;
}
*/