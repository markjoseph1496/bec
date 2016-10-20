<?php
include('../../../connection.php');


if (isset($_POST['Category']) && isset($_POST['ItemBrand'])) {
    $CategoryPOST = $_POST['Category'];
    $ItemBrand = $_POST['ItemBrand'];


    $GeneratingItemsCode = db_query("SELECT * FROM itemstbl where CategoryCode='$CategoryPOST' and BrandCode='$ItemBrand'");
    $num = mysqli_num_rows($GeneratingItemsCode);

    if ($num > 0) {
        while ($ID = mysqli_fetch_array($GeneratingItemsCode)) {
            $AddItemCode = $ID['ItemCode'];
            $AddItemCode++;
        }

        echo '<input type="text" readonly class="form-control" value="' . $AddItemCode . '" name="AddItemCode" id="AddItemCode">';

        $qry1 = db_query("SELECT * FROM categorytbl where CategoryCode='$CategoryPOST'");
        $numqry1 = mysqli_num_rows($qry1);

        if ($numqry1 > 0) {
            while ($row = mysqli_fetch_array($qry1)) {
                extract($row);
            }
            echo '<input type="hidden" readonly class="form-control" value="' . $Category . '" name="Category" id="Category">';
        } else {

            echo '<input type="hidden" readonly class="form-control" placeholder="Please select category">';
        }

        $qry2 = db_query("SELECT * FROM brandtbl where BrandCode='$ItemBrand'");
        $numqry2 = mysqli_num_rows($qry2);

        if ($numqry2 > 0) {
            while ($row = mysqli_fetch_array($qry2)) {
                extract($row);
            }
            echo '<input type="hidden" readonly class="form-control" value="' . $BrandID . '" name="ItemBrandID" id="ItemBrandID">';
        } else {
            echo '<input type="hidden" readonly class="form-control" value="PLease select brand">';
        }

        echo '<input type="hidden" readonly class="form-control" value="' . $CategoryPOST . '" name="CategoryID" id="CategoryID">';

    } else {

        echo '<input type="text" readonly class="form-control" value="' . $CategoryPOST . '' . $ItemBrand . '001" name="AddItemCode" id="AddItemCode">';

        $qry1 = db_query("SELECT * FROM categorytbl where CategoryCode='$CategoryPOST'");
        $numqry1 = mysqli_num_rows($qry1);

        if ($numqry1 > 0) {
            while ($row = mysqli_fetch_array($qry1)) {
                extract($row);
            }
            echo '<input type="hidden" readonly class="form-control" value="' . $Category . '" name="Category" id="Category">';
        } else {

            echo '<input type="hidden" readonly class="form-control" placeholder="Please select category">';
        }

        $qry2 = db_query("SELECT * FROM brandtbl where BrandCode='$ItemBrand'");
        $numqry2 = mysqli_num_rows($qry2);

        if ($numqry2 > 0) {
            while ($row = mysqli_fetch_array($qry2)) {
                extract($row);
            }
            echo '<input type="hidden" readonly class="form-control" value="' . $BrandID . '" name="ItemBrandID" id="ItemBrandID">';
        } else {
            echo '<input type="hidden" readonly class="form-control" value="PLease select brand">';
        }

        echo '<input type="hidden" readonly class="form-control" value="' . $CategoryPOST . '" name="CategoryID" id="CategoryID">';


    }
}
