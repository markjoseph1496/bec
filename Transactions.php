<?php
include('connection.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST["Cash"]) {
        $ORNumber = $_POST['ORNumber'];
        $CustomerName = $_POST['CustomerName'];
        $ModelUnit1 = $_POST['ModelUnit1'];
        $Quantity1 = $_POST['Quantity1'];
        $TotalPrice1 = $_POST['TotalPrice1hid'];
        $ModelUnit2 = $_POST['ModelUnit2'];
        $Quantity2 = $_POST['Quantity2'];
        $TotalPrice2 = $_POST['TotalPrice2hid'];
        $ModelUnit3 = $_POST['ModelUnit3'];
        $Quantity3 = $_POST['Quantity3'];
        $TotalPrice3 = $_POST['TotalPrice3hid'];
        $Downpayment = $_POST['Downpayment'];


        $CustomerName = ucwords($CustomerName);

        $TotalPrice = $TotalPrice1 + $TotalPrice2 + $TotalPrice3 + $Downpayment;
        GSecureSQL::query(
            "INSERT INTO cashtransactiontbl (ORNumber, CustomerName, Downpayment, Total) VALUES(?,?,?,?)",
            FALSE,
            "ssii",
            $ORNumber,
            $CustomerName,
            $Downpayment,
            $TotalPrice
        );

        if($ModelUnit1 != ""){
            GSecureSQL::query(
                "INSERT INTO unitmodeltransaction (ORNumber, ModelUnit, Quantity, TotalPrice) VALUE (?,?,?,?)",
                FALSE,
                "ssii",
                $ORNumber,
                $ModelUnit1,
                $Quantity1,
                $TotalPrice1
            );
        }
        if($ModelUnit2 != ""){
            GSecureSQL::query(
                "INSERT INTO unitmodeltransaction (ORNumber, ModelUnit, Quantity, TotalPrice) VALUE (?,?,?,?)",
                FALSE,
                "ssii",
                $ORNumber,
                $ModelUnit2,
                $Quantity2,
                $TotalPrice2
            );
        }
        if($ModelUnit3 != ""){
            GSecureSQL::query(
                "INSERT INTO unitmodeltransaction (ORNumber, ModelUnit, Quantity, TotalPrice) VALUE (?,?,?,?)",
                FALSE,
                "ssii",
                $ORNumber,
                $ModelUnit3,
                $Quantity3,
                $TotalPrice3
            );
        }

        echo "
        <script type='text/javascript'>
            alert('Submitted Successfully!');
            window.location.href = 'cash.php';
        </script>
        ";
    }
}