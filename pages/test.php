<?php
    $original = ",B,D";
    $a = explode(",", $original);
    //print_r($a);
    //echo $a[0];
    if (in_array("C", $a))
        {
        echo "Match found";
        }
        else
        {
        echo "Match not found";
        }
    echo $a[1];
    echo $a[2];
?>