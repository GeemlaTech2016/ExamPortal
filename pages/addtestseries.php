<?php
ob_start();
session_start();
include_once 'includes/authen.php';
include 'includes/secure.php';
include 'includes/functions.php';
$user = isset($_SESSION["uid"]) ? $_SESSION["uid"] : "";
$user_role = isset($_SESSION["user_role"]) ? $_SESSION["user_role"] : "";
$examid = isset($_GET['examid'])?$_GET['examid']:"";
$testseries = isset($_GET['testseries'])?$_GET['testseries']:"";
$gettest = mysqli_fetch_array(mysqli_query($conn,"select * from testseries where id='".$testseries."'"));
$questtype = isset($_GET['questtype'])?$_GET['questtype']:"";
$getexamno = mysqli_fetch_array(mysqli_query($conn,"select * from exam where examid='".$examid."'"));
$examtitle = $getexamno['title'];
//$examno = "EX".sprintf("%08d", mt_rand(1, 99999999));
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
        <title><?php echo $app_name; ?> | New Test Series</title>
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
                    }else {
                        document.getElementById("starttime").disabled = true;
                    }
                }
            function EnableDisableTextBox() {
                var chkYes = document.getElementById("liveexam");
                var txtPassportNumber = document.getElementById("starttime");
                txtPassportNumber.disabled = chkYes.checked ? false : true;
                if (!txtPassportNumber.disabled) {
                    txtPassportNumber.focus();
                }else{
                    txtPassportNumber.disabled = true;
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

<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>

<!-- This is what you need -->
<script src="../assets/dist/sweetalert-dev.js"></script>
<link rel="stylesheet" href="../assets/dist/sweetalert.css">
<script>
function myFunction(){
    recertid = document.getElementById('recertid').value;//"EX49534875";
  swal({   
    title: "",   
    text: "Enter name of Test:",
    type: "input",
    showCancelButton: true,
    closeOnConfirm: false,
    animation: "slide-from-top",
    inputPlaceholder: "Exam A"
  }, 
    function(inputValue){   
        if (inputValue) 
    {   
        swal({
          title: "", 
          text: "Test Name Added!",
          type: "success"
        }, function(){
          window.location = "api/addtest.php?input=" + inputValue + "&examid="+recertid;
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
                        Manage Test Series <small>Add Test series and Questions</small>
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
                                    <span>Add Test series</span>
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

                                $q = mysqli_query($conn, "insert into exam(examid,title,quest_num,passscore,timelimit,description,
                                            showresult,examtype,starttime)
                                        values('$examno','$title','$quest_num','$passscore','$timelimit','$description','$showresult','$examtype',
                                        '$starttime')") or die(mysqli_error($conn));
                                if($q){
                                    ?>
                                    <script>
                                        swal("Success", "New Exam Created Successfully", "success")</script>
                                    <?php
                                    header("addtestseries.php?examid=$examno");
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
                            <div class="col-md-4">
                                <div class="portlet light bordered">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="icon-speech font-green"></i>
                                            <span class="caption-subject bold font-green uppercase">Exam Details</span>
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
                                                <input type="text" value="<?php echo $examtitle?>" readonly name="title" class="form-control" /> </div>
                                                <input type="hidden" id="recertid" value="<?php echo $examid; ?>"/>
                                            <div class="form-group">
                                                <a name="addtest" class="btn green" onclick="myFunction()">Add Test Series </a>
                                            </div>
                                            <?php
                                                $q = mysqli_query($conn,"select * from testseries where examid='".$examid."' order by createdon");
                                                while($rs = mysqli_fetch_array($q)){
                                                    $test = $rs['testseries'];
                                                    ?>
                                                    <!--<a href="addtestseries.php?examid=$examid&testseries=$test"><?php //echo $rs['testseries']?></a><br>-->
                                                    <!--<label><?php //echo $rs['testseries']?></label><br>-->
                                                    <div class="btn-group btn-group-xs">
                                                        <a href="addtestseries.php?examid=<?php echo $examid?>&testseries=<?php echo $rs['id']?>" class="btn btn-primary"><?php echo $rs['testseries']?></a>
                                                        <button type="button" class="btn btn-circle-right btn-primary dropdown-toggle" data-toggle="dropdown">
                                                            <i class="fa fa-angle-down"></i>
                                                        </button>
                                                        <ul class="dropdown-menu" role="menu">
                                                            <li>
                                                                <a href="#myModal" data-toggle="modal" data-test-id="<?php echo $rs['id']?>" data-target="#myModal" >
                                                                    <i class="fa fa-plus"></i> Add </a>
                                                            </li>
                                                            <!--<li>
                                                                <a href="javascript:;">
                                                                    <i class="fa fa-pencil"></i> Edit </a>
                                                            </li>
                                                            <li>
                                                                <a href="javascript:;">
                                                                    <i class="fa fa-trash-o"></i> Delete </a>
                                                            </li>-->
                                                        </ul>
                                                    </div><br><br>
                                                    <?php
                                                }
                                            ?>
                                            
                                            <!--<div class="form-group">
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
                                            </div>-->
                                            
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
					<!-- BEGIN SAMPLE TABLE PORTLET-->
					<div class="portlet box purple">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-comments"></i>Question List for <?php echo $gettest['testseries']?>
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
										 Item ID
									</th>
									<th>
										 Type
									</th>
                                    <th>
										 &nbsp;
									</th>
								</tr>
								</thead>
								<tbody>
                                    <?php
                                    $n=0;
                                        //$qusers = mysqli_query($conn, "select * from questions where testseries='".$_GET['testseries']."' order by questionid");
                                        $qusers = mysqli_query($conn, "select * from questions where testseries='".$testseries."'
                                                             order by questionid");
                                        while($users = mysqli_fetch_array($qusers)){
                                            $n++;
                                    ?>
								<tr>
									<td>
                                        <a href="editquestion.php?questtype=<?php echo $users['qtype']?>&examid=<?php echo $examid?>&testseries=<?php echo $testseries?>&qnum=<?php echo $users['questionid']?>"><?php echo "Question ".$n?></a>
									</td>
									<td>
                                    <?php echo convertQtype($users['qtype'])?>
									</td>
									<td>
                                    <a title="Delete Question" href="addtestseries.php?&exid=<?php echo $examid?>&tsid=<?php echo $testseries?>&delid=<?php echo $users['questionid']?>" onclick="return confirm('Do you want to delete?')"><i class="icon-trash"></i></a>
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
                    <?php
                        $delid = isset($_GET['delid'])?$_GET['delid']:'';
                        $exid = isset($_GET['exid'])?$_GET['exid']:'';
                        $tsid = isset($_GET['tsid'])?$_GET['tsid']:'';
                        if($delid!=""){
                            mysqli_query($conn,"delete from questions where questionid='".$delid."'");
                            header("location:addtestseries.php?examid=$exid&testseries=$tsid");
                        }
                    ?>
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
            <!--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">-->
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
                            console.log('got here--'+bookId);
                            $(e.currentTarget).find('input[name="testseries"]').val(bookId);
                        });
                    });
                </script>
                <div class="modal fade" id="myModal" role="dialog">
                    <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">SELECT QUESTION TYPE</h4>
                                <button type="button" class="close" data-dismiss="modal" onclick = "$('.modal').removeClass('show').addClass('fade');">&times;</button>
                            </div>
                            <div class="modal-body">
                                <form action="addquestion.php" id="formEntry" class="customRadio customCheckbox m-0 p-0">
                                    <div class="row mb-0">
                                        <div class="row justify-content-start">
                                            <div class="col-12">
                                                <div class="row" style="margin-left:50px"> <input type="radio" name="questtype" value="1" id="mcsl" checked> <label for="dreamweaver">Multiple Choice (Single Select)</label> </div>
                                                <div class="row" style="margin-left:50px"> <input type="radio" name="questtype" value="2" id="mcml"> <label for="sublime">Multiple Choice (Multiple Select)</label> </div>
                                                <div class="row" style="margin-left:50px"> <input type="radio" name="questtype" value="3" id="mcslc"> <label for="multi">Single Select with Case study</label> </div>
                                                <div class="row" style="margin-left:50px"> <input type="radio" name="questtype" value="4" id="mcmlc"> <label for="multic">Multiple Select with Case study</label> </div>
                                                <div class="row" style="margin-left:50px"> <input type="radio" name="questtype" value="5" id="fitg"> <label for="fillin">Fill in the gap </label> </div>
                                                <div class="row" style="margin-left:50px"> <input type="radio" name="questtype" value="6" id="dnd"> <label for="dnd">Drag n Drop </label> </div>
                                                <input type="hidden" name="examid" value="<?php echo $examid?>" id="">
                                                <input type="hidden" name="testseries" value="<?php echo $testseries?>" id="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-2 justify-content-start m-0 p-0"> <button type="submit" id="submitBtn" class="btn btn-success box-shadow--16dp" data-dismiss="modal">Proceed</button> </div>    
                                </form>
                            </div>
                            <div class="modal-footer">
                                <!--<button type="button" class="btn btn-default close" data-dismiss="modal" onclick = "$('.modal').removeClass('show').addClass('fade');">Close</button>
                                <div class="col-2 justify-content-start m-0 p-0"> <button type="button" class="btn btn-success box-shadow--16dp" data-dismiss="modal">OK</button> </div>-->
                            </div>
                        </div>

                    </div>
                </div>

                <script>
                    $('#submitBtn').click(function () {

                    $('#mcsl').html($('#mcsl').val());
                    $('#mcml').html($('#mcml').val());
                    /*$('#emailM').html($('#email').val());
                    $('#phoneM').html($('#phone').val());
                    $('#addressM').html($('#address').val());
                    $('#cityM').html($('#city').val());
                    $('#stateM').html($('#state').val());
                    $('#zipM').html($('#zip').val());
                    $('#newJobM').html($('input[name=newJob]:checked').val());*/
                    //alert('Your form has been submitted');
                    $('#formEntry').submit();
                    });

                    

                </script>

            </div>

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