<?php
include('connection.php');

$models =
    GSecureSQL::query(
        "SELECT * FROM unitstbl",
        TRUE
    );

foreach ($models as $value){
    $Model = $value[1];

    echo "<option value='$Model'>" . $Model . "</option>";
}