<?php
ob_start();
session_start();
include_once 'includes/authen.php';
include 'includes/secure.php';
include 'includes/functions.php';
$user = isset($_SESSION["uid"]) ? $_SESSION["uid"] : "";
$user_role = isset($_SESSION["user_role"]) ? $_SESSION["user_role"] : "";
$getuser = mysqli_fetch_array(mysqli_query($conn,"select sname,fname from login where username='".$user."'"));
$query=NULL;
$gettest=NULL;
$testseries = $_POST['testseries'];
$selExamTimeLimit = $_POST['timelimit'];
$time = $selExamTimeLimit * 60;
$_SESSION['TIMER'] = $time;
$qsession = $user . date('YmdHis');
if($testseries!=""){
    $query = "select * from questions where testseries='".$testseries."' order by rand()";
    $gettest = mysqli_fetch_array(mysqli_query($conn, "select * from testseries where id='".$testseries."'"));
    mysqli_query($conn, "insert into trackexam(userid,testseries,numofques,examstatus,userstatus,qsession) values ('$user','$testseries','','ongoing','started','$qsession')");
}
?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <meta charset="utf-8" />
        <title><?php echo $app_name; ?> | Exam Proper</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="Preview page of Metronic Admin Theme #1 for form layouts" name="description" />
        <meta content="" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="../assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="../assets/global/plugins/bootstrap-sweetalert/sweetalert.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
        <link href="../assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="../assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="../assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <link href="../assets/layouts/layout/css/layout.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/layouts/layout/css/themes/default.min.css" rel="stylesheet" type="text/css" id="style_color" />
        <link href="../assets/layouts/layout/css/custom.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME LAYOUT STYLES -->
        <link rel="shortcut icon" href="favicon.ico" />
        
        <script type="text/javascript" >
        function preventBack(){window.history.forward();}
            setTimeout("preventBack()", 0);
            window.onunload=function(){null};
            
            window.history.pushState(null, "", window.location.href);
            window.onpopstate = function () {
                window.history.pushState(null, "", window.location.href);
            };
        </script>

        </head>
    <!-- END HEAD -->

    <body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white">
        <div class="page-wrapper">
            <!-- BEGIN HEADER -->
            <?php include 'includes/header.php'?>
            <!-- END HEADER -->
            <!-- BEGIN HEADER & CONTENT DIVIDER -->
            <div class="clearfix"> </div>
            <!-- END HEADER & CONTENT DIVIDER -->
            <!-- BEGIN CONTAINER -->
            <div class="page-container">
                <!-- BEGIN SIDEBAR -->
                <?php include 'includes/sidebar.php'?>
                <!-- END SIDEBAR -->
                </div>
                <!-- END SIDEBAR -->
                <!-- BEGIN CONTENT -->
                <div class="page-content-wrapper">
                    <!-- BEGIN CONTENT BODY -->
                    <div class="page-content">
                        <!-- BEGIN PAGE HEADER-->
                        <!-- BEGIN THEME PANEL -->
                        <h3 class="page-title">
                        Exam Proper <small>Exam Ongoing...</small>
                        
                        </h3>
                        <!-- END THEME PANEL -->
                        <!-- BEGIN PAGE BAR -->
                        <div class="page-bar">
                            <ul class="page-breadcrumb">
                                <li>
                                    <a href="home.php">Home</a>
                                    <i class="fa fa-circle"></i>
                                </li>
                                <li>
                                    <span>Exam Proper</span>
                                </li>
                            </ul>
                            
                        </div>
                        <!-- END PAGE BAR -->
                        <!-- END PAGE HEADER-->
                <div class="row">
                            
                    <div class="col-md-12">
					    <!-- BEGIN SAMPLE TABLE PORTLET-->
                            <div class="portlet box purple">
                                <div class="portlet-title">
                                    <div class="caption">
                                            <i class="fa fa-globe"></i><?php echo $getuser['fname']." ".$getuser['sname']?>: <?php echo $gettest['testseries']?>                                 
                                        </div>
                                        <div class="tools"> </div>
                                </div>
                                <div class="portlet-body">
                                    <form name="form1" id="my_form" onsubmit="return confirm('Are you sure you want to submit?') " method="post" action="processresult.php">
                                    <div class="table-scrollable">
                                        <table width="100%" border="0">
                                            <tr align="right"><input value="<?php echo $qsession; ?>" type="hidden" name="qsession">
                                            <td style="float:right">
                                            <div><?php echo 'Remaining Time: '?> <span style="border:none;background-color: transparent;color:blue;font-size: 20px;" id="counter"></span></div>
                                                <script type="text/javascript">
                                                <!-- 
                                                // 
                                                var tick = 60; // every 60 seconds
                                                var examtime = "<?php echo $_SESSION['TIMER']?>";
                                                console.log(examtime);
                                                var seconds=parseInt(examtime)+tick;
                                                function display_counter() { 
                                                seconds-=tick;
                                                if (seconds<0){ 
                                                    seconds=0; 
                                                } 
                                                if(seconds===0){
                                                    document.getElementById('my_form').submit();
                                                }
                                                else {
                                                    if (seconds<300) {  // 5 minutes
                                                    tick=1;  // every second
                                                    }
                                                    var s = parseInt(seconds / tick);
                                                    if (tick==1) {
                                                    s += ' seconds';
                                                    }
                                                    else {
                                                    s += ' minutes';
                                                    }
                                                    var e=document.getElementById('counter');
                                                    e.parentNode.style.visibility = "visible";    
                                                    e.innerHTML=s;
                                                    setTimeout("display_counter()",tick*1000);
                                                }
                                                } 
                                                display_counter();
                                                -->
                                                </script>
                                            </td>
                                            </tr>
                                        </table>
                                        <table class="table " id="sample_11">
                                        <thead>
                                        <tr>
                                            <th align="right">
                                                Instructions 
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        
                                            <?php
                                            $n=0;
                                                $qpv = mysqli_query($conn, $query);
                                                $cnt = 1;
                                                while($pvs = mysqli_fetch_array($qpv)){
                                                    $n++;
                                                    $questid = $pvs['questionid'];
                                                    $optione = $pvs['optione'];
                                                    $qtype = $pvs['qtype'];
                                                    $quest = $pvs['question'];
                                                    $tseries = $pvs['testseries'];
                                            ?>
                                        <tr>
                                        <td>
                                        <?php
                                                if($qtype=="1"){
                                            ?>
                                            <table width="100%" align="left">
                                                <tr>
                                                    <td colspan="2"> <?php echo $n ?>
                                                    <input type="hidden" class="key" value="<?php echo $questid; ?>" name="key[]">
                                                    <input type="hidden" value="<?php echo $tseries; ?>" name="tseries">
                                                    <!--<input value="<?php //echo $quest; ?>" type="hidden" name="quest<?php //echo $cnt; ?>">-->
                                                    <?php echo $pvs['question'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td valign="bottom">A.
                                                    <input type="radio" class="mt-radio" name="option<?php echo $cnt;?>" value="A" />&nbsp;
                                                    <?php echo $pvs['optiona'] ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td valign="bottom">B.
                                                    <input type="radio" class="mt-radio" name="option<?php echo $cnt;?>" value="B" />&nbsp;
                                                    <?php echo $pvs['optionb'] ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td valign="bottom">C.
                                                    <input type="radio" class="mt-radio" name="option<?php echo $cnt;?>" value="C" />&nbsp;
                                                    <?php echo $pvs['optionc'] ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td valign="bottom">D.
                                                    <input type="radio" class="mt-radio" name="option<?php echo $cnt;?>" value="D" />&nbsp;
                                                    <?php echo $pvs['optiond'] ?>
                                                    </td>
                                                </tr>
                                                <?php
                                                    if($optione!=''){
                                                ?>
                                                <tr>
                                                    <td valign="bottom">E.
                                                    <input type="radio" class="mt-radio" name="option<?php echo $cnt;?>" value="E" />&nbsp;
                                                    <?php echo $pvs['optione'] ?>
                                                    </td>
                                                </tr>
                                                <?php } ?>
                                            </table>
                                            <?php
                                            }elseif($qtype=='2'){
                                        ?>
                                        <table width="100%" align="left">
                                                <tr>
                                                    <td colspan="2"> <?php echo $n ?>
                                                    <input type="hidden" class="key" value="<?php echo $questid; ?>" name="key[]">
                                                    <input type="hidden" value="<?php echo $tseries; ?>" name="tseries">
                                                    <!--<input value="<?php //echo $quest; ?>" type="hidden" name="quest<?php //echo $cnt; ?>">-->
                                                    <?php echo $pvs['question'] ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td valign="bottom">A.
                                                    <input type="checkbox" class="mt-checkbox" name="checklist<?php echo $cnt;?>[]" value="A" />&nbsp;
                                                    <?php echo $pvs['optiona'] ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td valign="bottom">B.
                                                    <input type="checkbox" class="mt-checkbox" name="checklist<?php echo $cnt;?>[]" value="B" />&nbsp;
                                                    <?php echo $pvs['optionb'] ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td valign="bottom">C.
                                                    <input type="checkbox" class="mt-checkbox" name="checklist<?php echo $cnt;?>[]" value="C" />&nbsp;
                                                    <?php echo $pvs['optionc'] ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td valign="bottom">D.
                                                    <input type="checkbox" class="mt-checkbox" name="checklist<?php echo $cnt;?>[]" value="D" />&nbsp;
                                                    <?php echo $pvs['optiond'] ?>
                                                    </td>
                                                </tr>
                                                <?php
                                                    if($optione!=''){
                                                ?>
                                                <tr>
                                                    <td valign="bottom">E.
                                                    <input type="checkbox" class="mt-checkbox" name="checklist<?php echo $cnt;?>[]" value="E" />&nbsp;
                                                    <?php echo $pvs['optione'] ?>
                                                    </td>
                                                </tr>
                                                <?php } ?>
                                            </table>
                                            <?php
                                            }elseif($qtype=='3'){
                                                ?>
                                                <table width="100%" align="left">
                                                <tr>
                                                    <td colspan="2" align="center"> <a data-toggle="modal" id="cs" data-test-id="<?php echo $pvs['casestudy']?>" data-target="#myModal" class="btn btn-primary">Case Study </a></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2"> <?php echo $n ?>
                                                    <input type="hidden" class="key" value="<?php echo $questid; ?>" name="key[]">
                                                    <input type="hidden" value="<?php echo $tseries; ?>" name="tseries">
                                                    <!--<input value="<?php //echo $quest; ?>" type="hidden" name="quest<?php //echo $cnt; ?>">-->
                                                    <?php echo $pvs['question'] ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td valign="bottom">A.
                                                    <input type="radio" class="mt-radio" name="option<?php echo $cnt;?>" value="A" />&nbsp;
                                                    <?php echo $pvs['optiona'] ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td valign="bottom">B.
                                                    <input type="radio" class="mt-radio" name="option<?php echo $cnt;?>" value="B" />&nbsp;
                                                    <?php echo $pvs['optionb'] ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td valign="bottom">C.
                                                    <input type="radio" class="mt-radio" name="option<?php echo $cnt;?>" value="C" />&nbsp;
                                                    <?php echo $pvs['optionc'] ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td valign="bottom">D.
                                                    <input type="radio" class="mt-radio" name="option<?php echo $cnt;?>" value="D" />&nbsp;
                                                    <?php echo $pvs['optiond'] ?>
                                                    </td>
                                                </tr>
                                                <?php
                                                    if($optione!=''){
                                                ?>
                                                <tr>
                                                    <td valign="bottom">E.
                                                    <input type="radio" class="mt-radio" name="option<?php echo $cnt;?>" value="E" />&nbsp;
                                                    <?php echo $pvs['optione'] ?>
                                                    </td>
                                                </tr>
                                                <?php } ?>
                                            </table>
                                            <?php }elseif($qtype=='4'){
                                                ?>
                                                <table width="100%" align="left">
                                                <tr>
                                                    <td colspan="2" align="center"> <a data-toggle="modal" id="cs" data-test-id="<?php echo $pvs['casestudy']?>" data-target="#myModal" class="btn btn-primary">Case Study </a></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2"> <?php echo $n ?>
                                                    <input type="hidden" class="key" value="<?php echo $questid; ?>" name="key[]">
                                                    <input type="hidden" value="<?php echo $tseries; ?>" name="tseries">
                                                    <!--<input value="<?php //echo $quest; ?>" type="hidden" name="quest<?php //echo $cnt; ?>">-->
                                                    <?php echo $pvs['question'] ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td valign="bottom">A.
                                                    <input type="checkbox" class="mt-checkbox" name="checklist<?php echo $cnt;?>[]" value="A" />&nbsp;
                                                    <?php echo $pvs['optiona'] ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td valign="bottom">B.
                                                    <input type="checkbox" class="mt-checkbox" name="checklist<?php echo $cnt;?>[]" value="B" />&nbsp;
                                                    <?php echo $pvs['optionb'] ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td valign="bottom">C.
                                                    <input type="checkbox" class="mt-checkbox" name="checklist<?php echo $cnt;?>[]" value="C" />&nbsp;
                                                    <?php echo $pvs['optionc'] ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td valign="bottom">D.
                                                    <input type="checkbox" class="mt-checkbox" name="checklist<?php echo $cnt;?>[]" value="D" />&nbsp;
                                                    <?php echo $pvs['optiond'] ?>
                                                    </td>
                                                </tr>
                                                <?php
                                                    if($optione!=''){
                                                ?>
                                                <tr>
                                                    <td valign="bottom">E.
                                                    <input type="checkbox" class="mt-checkbox" name="checklist<?php echo $cnt;?>[]" value="E" />&nbsp;
                                                    <?php echo $pvs['optione'] ?>
                                                    </td>
                                                </tr>
                                                <?php } ?>
                                            </table>
                                                <? }elseif($qtype=='5'){
                                            ?>
                                            <table width="100%" align="left">
                                                <tr>
                                                    <td colspan="2"> <?php echo $n ?>
                                                    <input type="hidden" class="key" value="<?php echo $questid; ?>" name="key[]">
                                                    <input type="hidden" value="<?php echo $tseries; ?>" name="tseries">
                                                    <!--<input value="<?php //echo $quest; ?>" type="hidden" name="quest<?php //echo $cnt; ?>">-->
                                                    <?php echo $pvs['question'] ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">Your Answer: <input type="text" name="fillanswer<?php echo $cnt;?>" autocomplete="off" class="form-control" id="fillanswer" /></td>
                                                    
                                                </tr>
                                                
                                            </table>
                                            <?php } ?>
                                        </td>
                                        </tr>
                                        <?php 
                                        $cnt++;
                                        } 
                                        ?>
                                        
                                        </tbody>
                                        </table>
                                        <div class="margin-top-10">
                                            <button type="button" id="end" name="end" class="btn default">Review Exam </button>&nbsp;&nbsp;
                                            <button type="submit" id="finish" name="finish" class="btn green">Submit </button>
                                        
                                        </div>
                                    </div>
                                    </form>
                                </div>
                            </div>
					    <!-- END SAMPLE TABLE PORTLET-->
                        <?php
                        /*if (isset($_POST['finish'])) {
                        $key = isset($_POST['key'])?$_POST['key']:'';
                        $tseries = isset($_POST['tseries'])?$_POST['tseries']:'';
                        $s_cnt = 1;
                        $qsession = $user . date('YmdHis');
                        foreach ($key as $lp3) {
                            echo $s_cnt;
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
                            $ins_query = mysqli_query($conn, "insert into result values('$result_id', '$s_exam_id', '$user', '$s_score', '$tseries','$qsession')");
                            $s_cnt++;
                        }
                        $getresult = mysqli_fetch_array(mysqli_query($conn,"select count(score) as t from result where user_id='".$user."' and score=1 and qsession='".$qsession."'"));
                        $tscore = $getresult['t'];
                        mysqli_query($conn, "insert into scores (candidateid,score,testseries) values('$user', '$tscore', '$tseries')");
                        if (!mysqli_error($conn)) {
                            echo $s_cnt;
                            //header("location:result.php?rep=yes");
                        } else {
                            //header("location:result.php?rep=no");
                        }
                    }*/
                    ?>
				    </div>
                    </div>

                    </div>
                    <!-- END CONTENT BODY -->
                </div>
                <!-- END CONTENT -->
                <!-- BEGIN QUICK SIDEBAR -->
                <?php //include 'includes/quicksidebar.php'?>
                <!-- END QUICK SIDEBAR -->
            </div>
            <!-- END CONTAINER -->
            <!-- BEGIN FOOTER -->
            <?php include 'includes/footer.php'?>
            <!-- END FOOTER -->
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
            <link th:href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" media="all">
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

            <div class="container">
                <!-- Trigger the modal with a button -->
                <!--<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>-->

                <!-- Modal -->
                <script src="https://code.jquery.com/jquery-1.11.0.js" integrity="sha256-zgND4db0iXaO7v4CLBIYHGoIIudWI5hRMQrPB20j0Qw="
                        crossorigin="anonymous"></script>
                <script>
                    $(document).ready(function () {
                        $('#myModal').on('show.bs.modal', function(e) {
                            var bookId = $(e.relatedTarget).data('test-id');
                            console.log(bookId);
                            $('#csd').text(bookId);
                        });
                    });
                </script>
                <div class="modal fade" id="myModal" role="dialog">
                    <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">QUESTION CASE STUDY</h4>
                                <button type="button" class="close" data-dismiss="modal" onclick = "$('.modal').removeClass('show').addClass('fade');">&times;</button>
                            </div>
                            <div class="modal-body">
                                
                                    <div class="row mb-0">
                                        <div class="row justify-content-start">
                                            <div class="col-12">
                                                <div class="row" style="margin-left:50px"> <span id="csd"></span> </div> 
                                            </div>
                                        </div>
                                    </div>
                                    
                            </div>
                            <div class="modal-footer">
                                <!--<button type="button" class="btn btn-default close" data-dismiss="modal" onclick = "$('.modal').removeClass('show').addClass('fade');">Close</button>
                                <div class="col-2 justify-content-start m-0 p-0"> <button type="button" class="btn btn-success box-shadow--16dp" data-dismiss="modal">OK</button> </div>-->
                            </div>
                        </div>

                    </div>
                </div>
                
            </div>
            <!--end modal -->
        </div>
        <!-- BEGIN QUICK NAV -->
        <?php //include 'includes/quicknav.php' ?>
        <!-- END QUICK NAV -->
        <!--[if lt IE 9]>
<script src="../assets/global/plugins/respond.min.js"></script>
<script src="../assets/global/plugins/excanvas.min.js"></script> 
<script src="../assets/global/plugins/ie8.fix.min.js"></script> 
<![endif]-->
        <!-- BEGIN CORE PLUGINS -->
        <script src="../assets/global/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="../assets/global/plugins/jquery-repeater/jquery.repeater.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
        <script src="../assets/global/scripts/datatable.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="../assets/global/scripts/app.min.js" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="../assets/pages/scripts/ui-sweetalert.min.js" type="text/javascript"></script>
        <script src="../assets/pages/scripts/form-samples.min.js" type="text/javascript"></script>
        <script src="../assets/pages/scripts/form-repeater.min.js" type="text/javascript"></script>
        <script src="../assets/pages/scripts/components-date-time-pickers.min.js" type="text/javascript"></script>
        <script src="../assets/pages/scripts/table-datatables-rowreorder.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <script src="../assets/layouts/layout/scripts/layout.min.js" type="text/javascript"></script>
        <script src="../assets/layouts/layout/scripts/demo.min.js" type="text/javascript"></script>
        <script src="../assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
        <script src="../assets/layouts/global/scripts/quick-nav.min.js" type="text/javascript"></script>
        <!-- END THEME LAYOUT SCRIPTS -->
        <script>
            $(document).ready(function()
            {
                $('#clickmewow').click(function()
                {
                    $('#radio1003').attr('checked', 'checked');
                });
            })
        </script>
        <script>
        $(document).ready(function()
            {
            $('#finish').hide();
        })
        </script>
        <script type="text/javascript" src="../assets/global/scripts/fnGetHiddenNodes.js"></script>
        
        <script type="text/javascript">
            $(function() {
                var table = $('#sample_11').dataTable({
                    "bPaginate": true,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": false,
                    "bInfo": true,
                    "pageLength": 1,
                    "bAutoWidth": false,
                    "retrieve": true
                });
                $('#end').click( function () {
                    //var hidden = table.fnGetHiddenNodes();
                    //alert( hidden.length +' nodes were returned' );
                    table.DataTable().destroy();
                    $("#end").html('Continue Exam');
                    $("#finish").show();
                } );
                
                /*$('#finish').click( function(e){
                    e.preventDefault();

                    var data = table.$('.key').serializeArray();
                    /*var frmData = $("#my_form").serializeArray();
                    $(".common_class").each(function(){
                        frmData.push({name: "key[]", value: $(this).val()},
                                     {name: "testseries", value: $(this).val()}); 
                    });*/

                    // Include extra data if necessary
                    // data.push({'name': 'extra_param', 'value': 'extra_value'});

                   /* $.ajax({
                        url: 'processresult.php',
                        data: data
                    }).done(function(response){
                        console.log('Response', response);
                    });
                    });*/
            });
        </script>
    </body>

</html>