<?php
include('../../../connection.php');

$BranchCode = $_POST['BranchCode'];
$Cashier = $_POST['Cashier'];
$ModelName = $_POST['model_name'];
$Price = $_POST['Price'];
$Qty = $_POST['Quantity'];
$TotalPrice = $_POST['TotalPrice'];


GSecureSQL::query(
    "INSERT INTO tmpsales (Cashier, BranchCode, Unit, Price, Qty, TotalPrice) values (?,?,?,?,?,?)",
    FALSE,
    "ssssss",
    $Cashier,
    $BranchCode,
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