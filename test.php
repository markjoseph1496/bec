<?php


for ($x = 0; $x < 20; $x++) {
    $i = 0;
    $tmp = mt_rand(1, 9);
    do {
        $tmp .= mt_rand(0, 9);
    } while (++$i < 14);
    echo $tmp . "<br>";
}