<?php
include('../../../connection.php');

if(isset($_POST['deleteID'])){
    $id = $_POST['deleteID'];

    GSecureSQL::query(
        "DELETE FROM tmpsales WHERE id = $id",
        FALSE
    );
}