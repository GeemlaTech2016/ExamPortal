<?php
session_start();
include_once 'includes/authen.php';
include 'includes/secure.php';
include 'includes/functions.php';
$user = isset($_SESSION["uid"]) ? $_SESSION["uid"] : "";
$user_role = isset($_SESSION["user_role"]) ? $_SESSION["user_role"] : "";

$getExam = NULL;
$eid = isset($_GET['eid'])?$_GET['eid']:'';
if($eid!=""){
    $getExam = mysqli_fetch_array(mysqli_query($conn, "select * from exam where examid ='".$eid."'"));
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
        <title><?php echo $app_name; ?> | New User</title>
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
    
        <script src="../assets/dist/sweetalert-dev.js"></script>
<link rel="stylesheet" href="../assets/dist/sweetalert.css">
<script>
function openFeedback(){
    //recertid = "<?php echo $user?>";
  swal({   
    title: "",   
    text: "Provide Feedback:",
    type: "input",
    showCancelButton: true,
    closeOnConfirm: false,
    animation: "slide-from-top",
    inputPlaceholder: "Provide feedback"
  }, 
    function(inputValue){   
        if (inputValue) 
    {   
        swal({
          title: "", 
          text: "Feedback sent!",
          type: "success"
        }, function(){
          window.location = "api/addfeedback.php?input=" + inputValue + "&userid="+recertid;
        }
        );   
        } else {
            //return false;     
            swal({
              title: "",
              text: "No action taken!",
              type: "error",
              timer: 1000
              });   
            } 
        });
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
                        Take Exam <small>&nbsp;</small>
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
                                    <span>Start Exam</span>
                                </li>
                            </ul>
                            
                        </div>
                        <!-- END PAGE BAR -->
                        
                        <!-- END PAGE HEADER-->
                        <div class="row">
                            <div class="col-md-4">
                                <div class="portlet light bordered">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="icon-speech font-green"></i>
                                            <span class="caption-subject bold font-green uppercase">Exam List</span>
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
                                    <?php
                                        $q = mysqli_query($conn,"select * from exam order by title");
                                        while($rs = mysqli_fetch_array($q)){
                                            $examid = $rs['examid'];
                                            ?>
                                            <div class="btn-group btn-group-md">
                                                <a href="takeexam.php?eid=<?php echo $examid?>" class="btn btn-primary"><?php echo $rs['title']?></a>
                                                
                                            </div><br><br>
                                            <?php
                                        }
                                    ?>
                                    </div>
                                </div>
                        </div>
                    <div class="col-md-8">
					<!-- BEGIN SAMPLE TABLE PORTLET-->
					<div class="portlet box purple">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-comments"></i>Exam Details
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
                        <form role="form" method="post" onsubmit="return confirm('Are you sure you want to start? Your timer will start automatically') " action="examproper.php">
                            
                            <div class="form-group">
                                <label class="control-label">Take Selected Exam</label>
                                    <select class="form-control input-sm" name="testseries">
                                    <?php
                                                $q = mysqli_query($conn,"select * from testseries where examid='".$eid."' order by createdon");
                                                while($rs = mysqli_fetch_array($q)){
                                                    $test = $rs['testseries'];
                                                    ?>
                                        <option value="<?php echo $rs['id']?>"><?php echo $test?></option>
                                        <?php
                                                }
                                        ?>
                                    </select>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Total Questions</label>
                                <input type="text" name="totqtn" value="<?php echo $getExam['quest_num']?>" readonly class="form-control" /> </div>
                            <div class="form-group ">
                                <label class="control-label">Pass Score</label>
                                <input type="text" name="passscore" value="<?php echo $getExam['passscore']?>" readonly class="form-control" />   
                            </div>
                            <div class="form-group ">
                                <label class="control-label">Time Limit (minutes)</label>
                                <input type="number" name="timelimit" value="<?php echo $getExam['timelimit']?>" readonly class="form-control" />   
                            </div>
                            <div class="form-group ">
                                <label class="control-label">Start Time</label>
                                <input type="text" name="starttime" value="<?php echo $getExam['starttime']?>" readonly class="form-control" />   
                            </div>
                            
                            <div class="margin-top-10">
                                <button type="submit" name="save" class="btn green">Proceed </button>
                                <button type="reset" class="btn default">Cancel </button>
                            
                            </div>
                        </form>
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
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="../assets/global/scripts/app.min.js" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
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