<?php
include('../../../connection.php');

if (isset($_POST['id'])) {
    $id = db_quote($_POST['id']);

    $unitprice = db_select("SELECT `SRP` FROM `unitstbl` WHERE `Model` = " . $id);

    echo $unitprice[0]['SRP'];

    if ($unitprice === false) {
        $error = db_error();
        echo $error;
    }
}