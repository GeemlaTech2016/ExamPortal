<?php
ob_start();
session_start();
include_once 'includes/authen.php';
include 'includes/secure.php';
include 'includes/functions.php';
$user = isset($_SESSION["uid"]) ? $_SESSION["uid"] : "";
$user_role = isset($_SESSION["user_role"]) ? $_SESSION["user_role"] : "";
$dt = date("Y-m-d H:i:s");
if (isset($_POST['finish'])) {
    $key = isset($_POST['key'])?$_POST['key']:'';
    $tseries = isset($_POST['tseries'])?$_POST['tseries']:'';
    $s_cnt = 1;
    $qsession = isset($_POST['qsession'])?$_POST['qsession']:'';
    foreach ($key as $lp3) {
        $result_id = $user . "-" . date('YmdHis') . $s_cnt;
        $s_exam_id = $lp3;
        $s_user_id = $user;
        
        //Get correct answer
        $get_exam_ans = mysqli_fetch_array(mysqli_query($conn, "select ans,qtype from questions where questionid='$s_exam_id' and testseries='$tseries'"));
        $exam_ans = $get_exam_ans['ans'];
        $qtype = $get_exam_ans['qtype'];
        $s_ans=NULL;
        if($qtype=='1' || $qtype=='3'){
            $get_ans = $_POST['option'. $s_cnt];
            $s_ans = $get_ans;
        }elseif($qtype=='2' || $qtype=='4'){
            $count = count($_POST['checklist'. $s_cnt]);
                $ans[]=NULL;
                    foreach($_POST['checklist'. $s_cnt] as $selected){
                        if(isset($_POST['checklist'. $s_cnt])){
                            $ans[] = $selected;
                        }
                    }
                $s_ans = implode(",", $ans);
        }elseif($qtype=='5'){
            $s_ans = $_POST['fillanswer'. $s_cnt];
        }
        //Compare answer
        if ($exam_ans == $s_ans) {
            $s_score = 1;
        } else {
            $s_score = 0;
        }
        //Save student result
        $ins_query = mysqli_query($conn, "insert into result values('$result_id', '$s_exam_id', '$user', '$s_score', '$tseries','$qsession')") or die(mysqli_error($conn));
        $s_cnt++;
    }
    $getresult = mysqli_fetch_array(mysqli_query($conn,"select count(score) as t from result where user_id='".$user."' and score=1 and qsession='".$qsession."'"));
    $tscore = $getresult['t'];
    mysqli_query($conn, "insert into scores (candidateid,score,testseries,qsession) values('$user', '$tscore', '$tseries','$qsession')");
    $gettrackexam = mysqli_fetch_array(mysqli_query($conn,"select id from trackexam where userid='".$user."' and testseries ='".$tseries."' order by starttime desc limit 1"));
    mysqli_query($conn, "update trackexam set endtime='".$dt."',numofques='',examstatus='completed',
        userstatus='finished', qsession='".$qsession."' where id ='".$gettrackexam['id']."' ") or die(mysqli_error($conn));
    if (!mysqli_error($conn)) {
        //$link = urlencode("testseries='".$tseries."'&qsession='".$qsession."'");
        header("location:result.php?testseries=$tseries&qsession=$qsession");
    } else {
        header("location:result.php?rep=no");
    }
}
?>