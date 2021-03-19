<?php
include_once '../includes/authen.php';
    $input = isset($_GET['input'])?$_GET['input']:"";
    $userid = isset($_GET['userid'])?$_GET['userid']:"";
    if($input != NULL){
        $query = mysqli_query($conn,"insert into feedbacks(id, userid, feedback) values ('','$userid','$input')");
        if($query){
            header("location:../out.php");
        }
    }
?>