<?php


$a = $_POST['tModelName'];


foreach($a as $value){
    $b = $value;

    echo $b . "<br>";
}
print_r($a);