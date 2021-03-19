<?php
session_start();
include_once 'includes/authen.php';
include 'includes/secure.php';
include 'includes/functions.php';
$user = isset($_SESSION["uid"]) ? $_SESSION["uid"] : "";
$user_role = isset($_SESSION["user_role"]) ? $_SESSION["user_role"] : "";
$query=NULL;
$sdat = date("Y-m-d")." 00:00:00";
$edat = date("Y-m-d")." 23:59:59";
if($user_role=="admin" || $user_role=="supervisor"){
    $query = "select * from trackexam where examstatus = 'completed' order by starttime desc";
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
                        Completed Exams <small>&nbsp;</small>
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
                                    <span>Completed Exams</span>
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
                                            <i class="fa fa-globe"></i>Completed Exams </div>
                                        <div class="tools"> </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="table-scrollable">
                                        <table class="table table-striped table-hover" id="sample_1">
                                        <thead>
                                        <tr>
                                            <th>
                                                #
                                            </th>
                                            <th>
                                                User
                                            </th>
                                            <th>
                                                Exam
                                            </th>
                                            <th>
                                                Score
                                            </th>
                                            <th>
                                                Grade
                                            </th>
                                            <th>
                                                Start Time
                                            </th>
                                            <th>
                                                End Time
                                            </th>
                                            <th>
                                                No. of Ques.
                                            </th>
                                            
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <br><br><br>
                                            <?php
                                            $n=0;
                                                $qpv = mysqli_query($conn, $query);
                                                while($pvs = mysqli_fetch_array($qpv)){
                                                    $n++;
                                                    $gettest = mysqli_fetch_array(mysqli_query($conn, "select * from testseries where id ='".$pvs['testseries']."'"));
                                                    $getexam = mysqli_fetch_array(mysqli_query($conn, "select * from exam where examid ='".$gettest['examid']."'"));
                                                    $getscore = mysqli_fetch_array(mysqli_query($conn, "select * from scores where candidateid ='".$pvs['userid']."' and testseries='".$pvs['testseries']."' and qsession='".$pvs['qsession']."'"));
                                                    $getitems = mysqli_num_rows(mysqli_query($conn, "select * from questions where testseries='".$pvs['testseries']."'"));
                                                    $avgscore = 1000 / intVal($getitems);
                                                    
                                                    $score = $getscore['score'] * floor($avgscore);
                                                    
                                                    $passscore = $getexam['passscore'];
                                                    $getgrade = 'Fail';
                                                    if($score < $passscore){
                                                        $getgrade = 'Fail';
                                                    }else{
                                                        $getgrade = 'Pass';
                                                    }
                                            ?>
                                        <tr>
                                            <td>
                                                <?php echo $n?>
                                            </td>
                                            <td>
                                            <a href="result.php?testseries=<?php echo $pvs['testseries']?>&qsession=<?php echo $pvs['qsession']?>"><?php echo $pvs['userid']?></a>
                                            </td>
                                            <td>
                                            <?php echo $getexam['title'] ." (".$pvs['testseries'].")";?>
                                            </td>
                                            <td>
                                            <?php echo $score ?>/1000
                                            </td>
                                            <td>
                                            <?php echo $getgrade; ?>
                                            </td>
                                            <td>
                                            <?php echo $pvs['starttime']?>
                                            </td>
                                            <td>
                                            <?php echo $pvs['endtime']?>
                                            </td>
                                            <td>
                                            <?php echo $pvs['numofques'] ?>
                                            </td>
                                            
                                        </tr>
                                        <?php
                                                }
                                        ?>
                                        
                                        </tbody>
                                        </table>
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
    </body>

</html>