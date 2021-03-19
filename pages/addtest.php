<?php
include_once 'includes/authen.php';
    $testid = "TID".sprintf("%08d", mt_rand(1, 99999999));
    $input = isset($_GET['input'])?$_GET['input']:"";
    $examid = isset($_GET['examid'])?$_GET['examid']:"";
    if($input != NULL){
        $query = mysqli_query($conn,"insert into testseries(id, testseries, examid) values ('$testid','$input','$examid')");
        if($query){
            header("location:addtestseries.php?examid=$examid");
        }
    }
?>