<?php
include('../../../connection.php');

if (isset($_POST['imeisn'])) {
    $ImeiSN = $_POST['imeisn'];

    $ItemDetails = db_select("SELECT * FROM `unitstbl` WHERE `IMEISN` = " . $ImeiSN);


if(count($ItemDetails) > 0){
    $ItemCode = $ItemDetails[0]['ItemCode'];
    $ModelName = $ItemDetails[0]['Model'];
    $Brand = $ItemDetails[0]['Brand'];
    $UnitPrice = $ItemDetails[0]['SRP'];

    $data = array(
        'Count' => count($ItemDetails),
        'rItemCode' => $ItemCode,
        'rModelName' => $ModelName,
        'rBrand' => $Brand,
        'rUnitPrice' => $UnitPrice,
    );
    echo json_encode($data);
}else{
    $data = array(
        'Count' => count($ItemDetails),
    );
    echo json_encode($data);
}

}