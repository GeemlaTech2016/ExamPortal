<?php
session_start();
include_once 'includes/authen.php';
include 'includes/secure.php';
include 'includes/functions.php';
$user = isset($_SESSION["uid"]) ? $_SESSION["uid"] : "";
$user_role = isset($_SESSION["user_role"]) ? $_SESSION["user_role"] : "";
$query=NULL;
$tseries = isset($_GET['testseries'])?$_GET['testseries']:'';
$qsession = isset($_GET['qsession'])?$_GET['qsession']:'';
$getexamuser = mysqli_fetch_array(mysqli_query($conn, "select userid from trackexam where testseries='".$tseries."' and qsession='".$qsession."'"));
$user1 = $getexamuser['userid'];
$getuser1 = mysqli_fetch_array(mysqli_query($conn, "select * from login where username='".$user1."'"));
$gettest = mysqli_fetch_array(mysqli_query($conn, "select * from testseries where id='".$tseries."'"));
$getexam = mysqli_fetch_array(mysqli_query($conn, "select * from exam where examid='".$gettest['examid']."'"));
$getscore = mysqli_fetch_array(mysqli_query($conn, "select * from scores where candidateid='".$user1."' and testseries='".$tseries."' and qsession='".$qsession."'"));
$getexamtrack = mysqli_fetch_array(mysqli_query($conn, "select * from trackexam where userid='".$user1."' and testseries='".$tseries."' and qsession='".$qsession."'"));
$getitems = mysqli_num_rows(mysqli_query($conn, "select * from questions where testseries='".$tseries."'"));
$showresult = $getexam['showresult'];
$avgscore = 1000 / $getitems;
$score = $getscore['score'] * floor($avgscore);
$passscore = $getexam['passscore'];
$pscore = $passscore / 10;
$getgrade = 'Fail';
if($score < $passscore){
    $getgrade = 'Fail';
}else{
    $getgrade = 'Pass';
}

$percent = (($score / 1000) * 100);

$date_a = new DateTime($getexamtrack['starttime']);
$date_b = new DateTime($getexamtrack['endtime']);

$interval = date_diff($date_a,$date_b);
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
        <title><?php echo $app_name; ?> | Completed Exams</title>
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
        <link rel="shortcut icon" href="favicon.ico" /> </head>
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
                        Result of Exam <small>&nbsp;</small>
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
                                    <span>Results</span>
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
                                            <i class="fa fa-globe"></i>Your Exam </div>
                                        <div class="tools"> </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="table-scrollable">
                                    <?php
                                        if($user_role=="admin" || ($user_role=="testtaker" && $showresult=="Yes")){
                                    ?>
                                    <table width="700" border="0" align="center" id="tab">
                                        <tr>
                                            <td colspan="2" align="center"><h1>EXAMINATION SCORE REPORT</h1></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" align="center"><h3><?php echo $getexam['title']?></h3></td>
                                        </tr>
                                        <tr>
                                            <td><strong>CANDIDATE NAME: </strong><?php echo $getuser1['fname']." ".$getuser1['sname']?></td>
                                            <td><strong>EXAM: </strong><?php echo $gettest['testseries']?></td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Started: </strong><?php echo $getexamtrack['starttime']?></td>
                                            <td><strong>Ended: </strong> <?php echo $getexamtrack['endtime']?></td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td><strong>EXAM NUMBER: </strong>00-000</td>
                                            <td><strong>TIME ELAPSED: </strong><?php echo $interval->format('%h:%i:%s');?></td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                        <td colspan="2"><strong>Required Score:</strong><br>
                                            <div class="progress progress-striped">
                                                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="<?php echo $getexam['passscore']?>" aria-valuemin="0" aria-valuemax="1000" style="width: <?php echo $pscore."%"?>">
                                                    <span class="sr-only"> 80% Complete (success) </span>
                                                </div>
                                            </div>
                                        </td>
                                        </tr>
                                        <tr>
                                        <td colspan="2"><strong>Your Score:</strong><br>
                                            <div class="progress progress-striped">
                                                <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="<?php echo $score;?>" aria-valuemin="0" aria-valuemax="1000" style="width: <?php echo $percent."%"?>">
                                                    <span class="sr-only"> 60% Complete (danger) </span>
                                                </div>
                                            </div>
                                        </td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2"><table width="700" border="0">
                                            <tr>
                                                <td><strong>Passing Score: </strong> <?php echo $getexam['passscore']."/1000"?></td>
                                                <td><strong>Your Score: </strong><?php echo $score?>/1000 </td>
                                                <td><strong>Grade: </strong><?php echo $getgrade;?></td>
                                            </tr>
                                            </table></td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Items: </strong> <?php echo $getitems?></td>
                                            <td><strong>Percent Correct: </strong> <?php echo $percent."%"?></td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td><a onclick="javascript:printDiv('tab');"><i class="icon-printer"> Print Report</a></td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        </table>
                                        <?php
                                        }elseif($user_role=="testtaker" && $showresult=="No"){
                                        ?>
                                        <table width="700" border="0" align="center" id="tab">
                                        <tr>
                                            <td colspan="2" align="center"><h1>EXAMINATION SCORE REPORT</h1></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" align="center"><h3><?php echo $getexam['title']?></h3></td>
                                        </tr>
                                        <tr>
                                            <td><strong>CANDIDATE NAME: </strong><?php echo $getuser1['fname']." ".$getuser1['sname']?></td>
                                            <td><strong>EXAM: </strong><?php echo $gettest['testseries']?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" align="center"><h1>Thank You for Taking this Exam</h1></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" align="center"><h3>Contact Test Administrator for your result. Good bye!</h3></td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td><a onclick="javascript:printDiv('tab');"><i class="icon-printer"> Print Report</a></td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        </table>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
					    <!-- END SAMPLE TABLE PORTLET-->
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
        <script src="../assets/global/plugins/jquery.pulsate.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/jquery-bootpag/jquery.bootpag.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/holder.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="../assets/global/scripts/app.min.js" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="../assets/pages/scripts/ui-general.min.js" type="text/javascript"></script>
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
        <script type="text/javascript">
              function printDiv(divID) {
              //Get the HTML of div
              var divElements = document.getElementById(divID).innerHTML;
              //Get the HTML of whole page
              var oldPage = document.body.innerHTML;
              //Reset the page's HTML with div's HTML only
              document.body.innerHTML = 
                "<html><head><title></title></head><body>" + 
                divElements + "</body>";
              //Print Page
              window.print();
              //Restore orignal HTML
              document.body.innerHTML = oldPage;

          }
        </script>
    </body>

</html>