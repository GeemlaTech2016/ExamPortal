<?php
ob_start();
session_start();
include_once 'includes/authen.php';
include 'includes/secure.php';
include 'includes/functions.php';
$user = isset($_SESSION["uid"]) ? $_SESSION["uid"] : "";
$user_role = isset($_SESSION["user_role"]) ? $_SESSION["user_role"] : "";
$getexamno = mysqli_num_rows(mysqli_query($conn,"select * from exam"));
$examtitle = $getexamno+1;
$examno = "EX".sprintf("%08d", mt_rand(1, 99999999));

$getexam = NULL;
$examid = isset($_GET['pv'])?$_GET['pv']:'';
if(isset($_GET['pv']) && $examid != ''){
    $getexam = mysqli_fetch_array(mysqli_query($conn,"select * from exam where examid='".$examid."'"));
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
        <title><?php echo $app_name; ?> | New Exam</title>
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

        <script type="text/javascript" language="javascript">
            function enableTextBox()
                {
                    if (document.getElementById("liveexam").checked == true){
                        document.getElementById("starttime").disabled = false;
                        document.getElementById("startdate").disabled = false;
                    }else {
                        document.getElementById("starttime").disabled = true;
                        document.getElementById("startdate").disabled = false;
                    }
                }
            function EnableDisableTextBox() {
                var chkYes = document.getElementById("liveexam");
                var starttime = document.getElementById("starttime");
                var startdate = document.getElementById("startdate");
                starttime.disabled = chkYes.checked ? false : true;
                startdate.disabled = chkYes.checked ? false : true;
                if (!starttime.disabled && !startdate.disabled) {
                    startdate.focus();
                }else{
                    starttime.disabled = true;
                    startdate.disabled = true;
                }
            }
        </script>
        <script>
            function isNumber(evt) {
            var iKeyCode = (evt.which) ? evt.which : evt.keyCode
            if (iKeyCode != 46 && iKeyCode > 31 && (iKeyCode < 48 || iKeyCode > 57))
                return false;

            return true;
            }
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
                        Manage System Exams <small>Add Exams and Test Series</small>
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
                                    <span>New Exam</span>
                                </li>
                            </ul>
                            
                        </div>
                        <!-- END PAGE BAR -->
                        <?php
                            $d = date("d/m/Y H:i:s");
                            if(array_key_exists("save",$_POST)){
                                $title = $_POST['title'];
                                $quest_num = $_POST['quest_num'];
                                $passscore = $_POST['passscore'];
                                $timelimit = $_POST['timelimit'];
                                $description = $_POST['desc1'];
                                $showresult = isset($_POST['showresult'])? "Yes":"No";
                                $examtype = $_POST['examtype'];
                                $starttime = isset($_POST['starttime'])?$_POST['starttime']:"";
                                $startdate = isset($_POST['startdate'])?$_POST['startdate']:"";

                                $q = mysqli_query($conn, "insert into exam(examid,title,quest_num,passscore,timelimit,description,
                                            showresult,examtype,starttime,startdate)
                                        values('$examno','$title','$quest_num','$passscore','$timelimit','$description','$showresult','$examtype',
                                        '$starttime','$startdate')") or die(mysqli_error($conn));
                                if($q){
                                    ?>
                                    <script>
                                        swal("Success", "New Exam Created Successfully", "success")</script>
                                    <?php
                                    redirect("addtestseries.php?examid=$examno");
                                }else{
                                    ?>
                                    <script>
                                        swal("Error", "An Error Occurred! Try again", "error")</script>
                                    <?php
                                }
                            }

                            //updates
                            if(array_key_exists("ok",$_POST)){
                                $title = $_POST['title'];
                                $quest_num = $_POST['quest_num'];
                                $passscore = $_POST['passscore'];
                                $timelimit = $_POST['timelimit'];
                                $description = $_POST['desc1'];
                                $showresult = isset($_POST['showresult'])? "Yes":"No";
                                $examtype = $_POST['examtype'];
                                $starttime = isset($_POST['starttime'])?$_POST['starttime']:"";
                                $startdate = isset($_POST['startdate'])?$_POST['startdate']:"";

                                $q = mysqli_query($conn, "update exam set title='$title',quest_num='$quest_num',passscore='$passscore',
                                    timelimit='$timelimit',description='$description',showresult='$showresult',examtype='$examtype',
                                    starttime='$starttime',startdate='$startdate' where examid='$examid'") or die(mysqli_error($conn));
                                if($q){
                                    ?>
                                    <script>
                                        swal("Success", "Exam updated Successfully", "success")</script>
                                    <?php
                                    redirect("addtestseries.php?examid=$examid");
                                }else{
                                    ?>
                                    <script>
                                        swal("Error", "An Error Occurred! Try again", "error")</script>
                                    <?php
                                }
                            }
                        ?>
                        <!-- END PAGE HEADER-->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="portlet light bordered">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="icon-speech font-green"></i>
                                            <span class="caption-subject bold font-green uppercase">Exam Form</span>
                                        </div>
                                        <div class="actions">
                                            <!--<a href="javascript:;" class="btn btn-circle btn-outline green">
                                                <i class="fa fa-pencil"></i> Edit </a>
                                            <a href="javascript:;" class="btn btn-circle blue-steel btn-outline">
                                                <i class="fa fa-plus"></i> Add </a>-->
                                            <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;"> </a>
                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                        <form role="form" method="post" action="">
                                            <div class="form-group">
                                                <label class="control-label">Title</label>
                                                <input type="text" value="<?php echo "Exam ".$examtitle?>" required name="title" class="form-control" /> </div>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label class="control-label">Number of Questions</label>
                                                        <input type="number" name="quest_num" value="50" 
                                                        onpaste="return false" onautocomplete="return false" onkeypress="javascript:return isNumber(event)" class="form-control" /> </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label class="control-label">Passing Score</label>
                                                        <input type="number" name="passscore" value="800" min="200" max="1000" step="50"
                                                        onpaste="return false" onautocomplete="return false" onkeypress="javascript:return isNumber(event)" class="form-control" /> </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Time Limit (Minutes)</label>
                                                <input type="number" name="timelimit" value="120"
                                                 onpaste="return false" onautocomplete="return false" onkeypress="javascript:return isNumber(event)" class="form-control" /> </div>
                                            <div class="mt-checkbox-list">
                                                <label class="mt-checkbox mt-checkbox-outline"> Show Result on Completion
                                                    <input type="checkbox" class="chk" value="Yes" checked name="showresult" id="showresult" />
                                                    <span></span>
                                                </label>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label>Exam Type</label>
                                                <div class="mt-radio-inline">
                                                    <label class="mt-radio">
                                                        <input type="radio" name="examtype" id="optionsRadios4" onclick="EnableDisableTextBox()" value="Test" checked> Test Bed
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-radio">
                                                        <input type="radio" name="examtype" id="liveexam" onclick="EnableDisableTextBox()" value="Live"> Live
                                                        <span></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Start Date</label>
                                                <input type="text" name="startdate" id="startdate" disabled class="form-control date date-picker" value="<?php echo date('d/m/Y')?>" data-date-format="dd/mm/yyyy" /> </div>
                                                <div class="form-group">
                                                <label class="control-label">Start Time</label>
                                                <input type="time" name="starttime" id="starttime" disabled class="form-control time time-picker" value="<?php echo date('h:i:s')?>" data-date-format="h:i:s" /> </div>
                                            <div class="form-group">
                                                <label class="control-label">Description (Exam description will show before the exam)</label>
                                                <textarea name="desc1" class="form-control" rows="4"></textarea>
                                            </div>
                                            <div class="margin-top-10">
                                            <?php if($getexam!=NULL){?>
												<input type="submit" value="Update" class="btn green" name="ok">
                                                <?php }else{?>
                                                <button type="submit" name="save" class="btn green">Proceed </button>
                                                <button type="reset" class="btn default">Cancel </button>
                                                <?php } ?>
                                            
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
					<!-- BEGIN SAMPLE TABLE PORTLET-->
					<div class="portlet box purple">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-comments"></i>Exam List
							</div>
							<div class="tools">
								<a href="javascript:;" class="collapse">
								</a>
								<a href="#portlet-config" data-toggle="modal" class="config">
								</a>
								<a href="javascript:;" class="reload">
								</a>
								<a href="javascript:;" class="remove">
								</a>
							</div>
						</div>
						<div class="portlet-body">
							<div class="table-scrollable">
								<table class="table table-striped table-hover">
								<thead>
								<tr>
									<th>
										 #
									</th>
									<th>
										 Title
									</th>
									<th>
										 Passing Score
									</th>
									<th>
										 Exam Type
									</th>
								</tr>
								</thead>
								<tbody>
                                    <?php
                                    $n=0;
                                        $qusers = mysqli_query($conn, "select * from exam limit 10");
                                        while($users = mysqli_fetch_array($qusers)){
                                            $n++;
                                    ?>
								<tr>
									<td>
                                        <?php echo $n?>
									</td>
									<td>
                                    <a href="addtestseries.php?examid=<?php echo $users['examid']?>"><?php echo $users['title']?></a>
									</td>
									<td>
                                    <?php echo $users['passscore']."/".$users['quest_num']?>
									</td>
									<td>
                                        <?php echo $users['examtype'] ?>
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
        <script src="../assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="../assets/global/scripts/app.min.js" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="../assets/pages/scripts/form-validation.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="../assets/pages/scripts/ui-sweetalert.min.js" type="text/javascript"></script>
        <script src="../assets/pages/scripts/form-samples.min.js" type="text/javascript"></script>
        <script src="../assets/pages/scripts/form-repeater.min.js" type="text/javascript"></script>
        <script src="../assets/pages/scripts/components-date-time-pickers.min.js" type="text/javascript"></script>
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