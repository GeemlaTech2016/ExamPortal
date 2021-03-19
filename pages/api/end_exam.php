<?php
include_once '../includes/authen.php';
$currenttime = date("Y-m-d H:i:s");
    $query212 = mysqli_query($conn, "select * from trackexam where examstatus='ongoing'");
    while($rq=mysqli_fetch_array($query212)){
        $iddd = $rq['id'];
        $checkres = mysqli_query($conn, "select testseries from trackexam where id='".$iddd."'");
        if (!$checkres) {
            printf("Error: %s\n", mysqli_error($conn));
            exit();
        }
        $gettx11 = mysqli_fetch_array($checkres);
        $getexamidcheck = mysqli_query($conn, "select examid from testseries where id='".$gettx11['testseries']."'") or die(mysqli_error($conn));
        $getexamid11 = mysqli_fetch_array($getexamidcheck);
        $examdetailschk = mysqli_query($conn, "select * from exam where examid='".$getexamid11['examid']."'") or die(mysqli_error($conn));
        $examdetails = mysqli_fetch_array($examdetailschk);
        $timelimit11 = $examdetails['timelimit'];

        $time = $timelimit11 * 60;
        $starttime1 = strtotime($rq['starttime']);
        $endtime1 = date('Y-m-d H:i:s', $starttime1 + $time);//date("Y-m-d H:i:s", strtotime("+{$timelimit11} minutes ", $starttime1));// $starttime1->modify("+{$timelimit11} minutes");
        
        if($endtime1 < $currenttime){
            mysqli_query($conn, "update trackexam set endtime='".$endtime1."', examstatus='completed', userstatus='finished' where id='".$iddd."'") or die(mysqli_error($conn));
        }
    }
?>