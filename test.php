<?php
include('connection.php');

$BranchCode = "B009";
$_Date = date('Ymd');

$Count = "0000";
$TransactionID = $BranchCode . $_Date;


$query = "CREATE TRIGGER trigger BEFORE INSERT ON ";