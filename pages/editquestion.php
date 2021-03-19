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
$questtype = "1";
$getexamno = mysqli_fetch_array(mysqli_query($conn,"select * from exam where examid='".$examid."'"));
$examtitle = $getexamno['title'];
$qno = mysqli_num_rows(mysqli_query($conn, "select * from questions where testseries = '".$testseries."'"));
$qno1 = $qno + 1;
//$examno = "EX".sprintf("%08d", mt_rand(1, 99999999));
$getQuest=NULL;
$qnum = isset($_GET['qnum'])?$_GET['qnum']:'';
if($qnum!=""){
    $getQuest = mysqli_fetch_array(mysqli_query($conn,"select * from questions where questionid='".$qnum."'"));
    $questtype = $getQuest['qtype'];
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
        <title><?php echo $app_name; ?> | Modify Question</title>
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
        <!-- BEGIN PAGE LEVEL STYLES -->
        <link rel="stylesheet" type="text/css" href="../assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css"/>
        <link rel="stylesheet" type="text/css" href="../assets/global/plugins/bootstrap-markdown/css/bootstrap-markdown.min.css">
        <link rel="stylesheet" type="text/css" href="../assets/global/plugins/bootstrap-summernote/summernote.css">
        <!-- END PAGE LEVEL STYLES -->
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
                        Question Setup <small>&nbsp;</small>
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
                                    <span>Modify Question</span>
                                </li>
                            </ul>
                            
                        </div>
                        <!-- END PAGE BAR -->
                        <?php
                            $d = date("d/m/Y H:i:s");
                            $dt = date("dmYHis");
                            if(array_key_exists("save",$_POST)){
                                if($questtype=='1'){ //start qtype 1

                                    //$qid = "t-".$dt;
                                    $question = $_POST['question'];
                                    $casestudy = '';
                                    $optiona = $_POST['a'];
                                    $optionb = $_POST['b'];
                                    $optionc = $_POST['c'];
                                    $optiond = $_POST['d'];
                                    $optione = isset($_POST['e'])? $_POST['e']:"";
                                    $ans = $_POST['optionsRadios'];
                                    $questionmarks = '';
                                    $hint = $_POST['hint'];
    
                                    $q = mysqli_query($conn, "update questions set question='$question',casestudy='$casestudy',optiona='$optiona',
                                        optionb='$optionb',optionc='$optionc',optiond='$optiond',optione='$optione',ans='$ans',testseries='$testseries',
                                        questionmarks='$questionmarks',hint='$hint',qtype='$questtype' where questionid='$qnum'") or die(mysqli_error($conn));
                                    if($q){
                                        header("location:addtestseries.php?examid=$examid&testseries=$testseries");
                                    }else{
                                        ?>
                                        <script>
                                            swal("Error", "An Error Occurred while trying to add question! Try again", "error")</script>
                                        <?php
                                    } 

                                }elseif($questtype=='2'){

                                   // $qid = "t-".$dt;
                                    $question = $_POST['question'];
                                    $casestudy = '';
                                    $optiona = $_POST['a'];
                                    $optionb = $_POST['b'];
                                    $optionc = $_POST['c'];
                                    $optiond = $_POST['d'];
                                    $optione = isset($_POST['e'])? $_POST['e']:"";
                                    $count = count($_POST['checklist']);
                                    $ans[]=NULL;
                                        foreach($_POST['checklist'] as $selected){
                                            if(isset($_POST['checklist'])){
                                                $ans[] = $selected;
                                            }
                                        }
                                    $fans = implode(",", $ans);
                                    $questionmarks = '';
                                    $hint = $_POST['hint'];
    
                                    $q = mysqli_query($conn, "update questions set question='$question',casestudy='$casestudy',optiona='$optiona',
                                        optionb='$optionb',optionc='$optionc',optiond='$optiond',optione='$optione',ans='$fans',testseries='$testseries',
                                        questionmarks='$questionmarks',hint='$hint',qtype='$questtype' where questionid='$qnum'") or die(mysqli_error($conn));
                                    if($q){
                                        header("location:addtestseries.php?examid=$examid&testseries=$testseries");
                                    }else{
                                        ?>
                                        <script>
                                            swal("Error", "An Error Occurred while trying to add question! Try again", "error")</script>
                                        <?php
                                    } 

                                }elseif($questtype=='3'){
                                    
                                    //$qid = "t-".$dt;
                                    $question = $_POST['question'];
                                    $casestudy = $_POST['casestudy'];
                                    $optiona = $_POST['a'];
                                    $optionb = $_POST['b'];
                                    $optionc = $_POST['c'];
                                    $optiond = $_POST['d'];
                                    $optione = isset($_POST['e'])? $_POST['e']:"";
                                    $ans = $_POST['optionsRadios'];
                                    $questionmarks = '';
                                    $hint = $_POST['hint'];
    
                                    $q = mysqli_query($conn, "update questions set question='$question',casestudy='$casestudy',optiona='$optiona',
                                        optionb='$optionb',optionc='$optionc',optiond='$optiond',optione='$optione',ans='$ans',testseries='$testseries',
                                        questionmarks='$questionmarks',hint='$hint',qtype='$questtype' where questionid='$qnum'") or die(mysqli_error($conn));
                                    if($q){
                                        header("location:addtestseries.php?examid=$examid&testseries=$testseries");
                                    }else{
                                        ?>
                                        <script>
                                            swal("Error", "An Error Occurred while trying to add question! Try again", "error")</script>
                                        <?php
                                    } 

                                }elseif($questtype=='4'){

                                    //$qid = "t-".$dt;
                                    $question = $_POST['question'];
                                    $casestudy = $_POST['casestudy'];
                                    $optiona = $_POST['a'];
                                    $optionb = $_POST['b'];
                                    $optionc = $_POST['c'];
                                    $optiond = $_POST['d'];
                                    $optione = isset($_POST['e'])? $_POST['e']:"";
                                    $count = count($_POST['checklist']);
                                    $ans[]=NULL;
                                        foreach($_POST['checklist'] as $selected){
                                            if(isset($_POST['checklist'])){
                                                $ans[] = $selected;
                                            }
                                        }
                                    $fans = implode(",", $ans);
                                    $questionmarks = '';
                                    $hint = $_POST['hint'];
    
                                    $q = mysqli_query($conn, "update questions set question='$question',casestudy='$casestudy',optiona='$optiona',
                                        optionb='$optionb',optionc='$optionc',optiond='$optiond',optione='$optione',ans='$fans',testseries='$testseries',
                                        questionmarks='$questionmarks',hint='$hint',qtype='$questtype' where questionid='$qnum'") or die(mysqli_error($conn));
                                    if($q){
                                        header("location:addtestseries.php?examid=$examid&testseries=$testseries");
                                    }else{
                                        ?>
                                        <script>
                                            swal("Error", "An Error Occurred while trying to add question! Try again", "error")</script>
                                        <?php
                                    } 

                                }elseif($questtype=='5'){

                                    //$qid = "t-".$dt;
                                    $question = $_POST['question'];
                                    $casestudy = '';
                                    $optiona = '';
                                    $optionb = '';
                                    $optionc = '';
                                    $optiond = '';
                                    $optione = '';
                                    $ans = $_POST['fillanswer'];
                                    $questionmarks = '';
                                    $hint = $_POST['hint'];
    
                                    $q = mysqli_query($conn, "update questions set question='$question',casestudy='$casestudy',optiona='$optiona',
                                        optionb='$optionb',optionc='$optionc',optiond='$optiond',optione='$optione',ans='$ans',testseries='$testseries',
                                        questionmarks='$questionmarks',hint='$hint',qtype='$questtype' where questionid='$qnum'") or die(mysqli_error($conn));
                                    if($q){
                                        header("location:addtestseries.php?examid=$examid&testseries=$testseries");
                                    }else{
                                        ?>
                                        <script>
                                            swal("Error", "An Error Occurred while trying to add question! Try again", "error")</script>
                                        <?php
                                    } 

                                }
                                
                            }
                        ?>
                        <!-- END PAGE HEADER-->
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
                                                                <a data-toggle="modal" data-target="#myModal" >
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
								<i class="fa fa-comments"></i>Update Question for <?php echo $gettest['testseries']?>
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
                        <form role="form" method="post" action="">
                                    <table class="table table-striped table-hover">
                                        <tr valign="top">
                                            <td >Qtn <?php echo $qno1?></td>
                                            <td > <textarea name="question" id="summernote_1"><?php echo $getQuest['question']?>	</textarea>
                                            <!--<textarea name="question" cols="60" class="form-control" rows="3" id="question" placeholder="Question Here"></textarea>-->
                                            <input type="hidden" name="testseriesid" value="<?php echo $testseries?>" />
                                                <input type="hidden" name="qtype" value="<?php echo $questtype?>" />
                                        </td>
                                        </tr>
                                        <?php include("updatequesttypeform.php");?>
                                        <tr>
                                            <td colspan="2"> Explanation/Hint</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2"><input type="text" name="hint" class="form-control" />  </td>
                                        </tr>
                                    </table>  
                                            <div class="margin-top-10">
                                                <button type="submit" name="save" class="btn green">Save Changes </button>
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
            <!--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">-->
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
            <link th:href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" media="all">
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

            <div class="container">
                <!-- Trigger the modal with a button -->
                <!--<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>-->

                <!-- Modal -->
                <div class="modal fade" id="myModal" role="dialog">
                    <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">SELECT QUESTION TYPE</h4>
                                <button type="button" class="close" data-dismiss="modal" onclick = "$('.modal').removeClass('show').addClass('fade');">&times;</button>
                            </div>
                            <div class="modal-body">
                                <form action="" id="formEntry" class="customRadio customCheckbox m-0 p-0">
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
            <!-- end modal -->
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
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script type="text/javascript" src="../assets/global/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js"></script>
        <script type="text/javascript" src="../assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js"></script>
        <script src="../assets/global/plugins/bootstrap-markdown/lib/markdown.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/bootstrap-markdown/js/bootstrap-markdown.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/bootstrap-summernote/summernote.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->
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
        <script>
        $(document).ready(function() {       
        // initiate layout and plugins
        $('#summernote_1').summernote({
        placeholder: 'Type Question here',
        tabsize: 2,
        height: 100
        });
        });   
        </script>
    </body>

</html>