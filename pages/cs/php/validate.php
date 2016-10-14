<?php
include('../../../connection.php');
include('../../../functions/encryption.php');

if (isset($_POST['rItemCode'])) {
    $isCorrect = false;

    $ItemCode = $_POST['rItemCode'];
    $Color = $_POST['rColor'];
    $PRNumber = $_POST['rPRNumber'];
    $hashPRNumber = $_POST['rhashPRNumber'];
    $hashItemCode = $_POST['rhashItemCode'];
    $ItemRND = $_POST['rItemRND'];
    $PRRND = $_POST['rPRRND'];

    if (encrypt_decrypt_rnd('decrypt', $hashPRNumber, $PRRND) == $PRNumber
        && encrypt_decrypt_rnd('decrypt', $hashItemCode, $ItemRND . $Color) == $ItemCode) {
        $isCorrect = true;
    } else {
        $isCorrect = false;
    }

    echo $isCorrect;
}
if(isset($_POST['ImeiSN'])){
    $isCorrect = false;
    $ImeiSN = db_quote($_POST['ImeiSN']);

    $CheckIMEI = db_select("SELECT `imeisn` FROM `invtbl` WHERE `imeisn` = $ImeiSN");

   if(count($CheckIMEI) == 1){
       $isCorrect = false;
   }else{
       $isCorrect = true;
   }

   echo $isCorrect;
}