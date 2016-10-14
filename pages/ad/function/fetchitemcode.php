<?php
include('../../../connection.php');


if (isset($_POST['Category']) && isset($_POST['ItemBrand'])) {
    $Category = $_POST['Category'];
    $ItemBrand = $_POST['ItemBrand'];


    $GeneratingItemsCode = db_query("SELECT * FROM itemstbl where CategoryCode='$Category' and BrandCode='$ItemBrand'");
    $num = mysqli_num_rows($GeneratingItemsCode);

    if ($num > 0) {
        while ($ID = mysqli_fetch_array($GeneratingItemsCode)) {
            $AddItemCode = $ID['ItemCode'];
            $AddItemCode++;
        }
        echo '<input type="text" readonly class="form-control" value="' . $AddItemCode . '" name="AddItemCode" id="AddItemCode">';
    } else {
        echo '<input type="text" readonly class="form-control" value="' . $Category . '' . $ItemBrand . '001" name="AddItemCode" id="AddItemCode">';

    }
}

?>