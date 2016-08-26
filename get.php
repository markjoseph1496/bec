<?php
include('connection.php');

if(isset($_POST['id'])){
    $id = $_POST['id'];
    $unitprice =
        GSecureSQL::query(
            "SELECT SRP FROM unitstbl WHERE Model = '$id'",
            TRUE
        );

    $Price = $unitprice[0][0];
    echo $Price;
}