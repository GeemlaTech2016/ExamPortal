<?php
session_start();
include_once 'includes/authen.php';
include 'includes/secure.php';
include 'includes/functions.php';
include 'includes/simplexlsx.class.php';
$user = isset($_SESSION["uid"]) ? $_SESSION["uid"] : "";
$user_role = isset($_SESSION["user_role"]) ? $_SESSION["user_role"] : "";
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
                        Manage System Users <small>Add users and view list</small>
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
                                    <span>New User</span>
                                </li>
                            </ul>
                            
                        </div>
                        <!-- END PAGE BAR -->
                        <?php
                            if (isset($_POST['upload'])) {
                                $file = trim($_FILES['file']['tmp_name']);
                                $temp = $_FILES["file"]["name"];
                                $ext = strtolower(substr($temp, strpos($temp, ".") + 1));
                                if ($ext != 'xls' && $ext != 'xlsx') {
                                    echo "<script>alert('Error: Please select a valid excel (.xlsx or .xls) file')</script>";
                                } else {
                                    $xlsx = new SimpleXLSX($file);
                                    list($cols, $rows) = $xlsx->dimension();
                                    foreach ($xlsx->rows() as $k => $r) {
                                                $r[0] = "rid". rand(1,9999999);
                                                mysqli_query($conn, "insert into login values ('$r[0]', '$r[1]', '$r[2]', '$r[3]', 'null', '$r[4]', 'nil')");
                                    }
                                    echo "<script>alert('Candidates uploaded successfully')</script>";
                                }
                            }

                            $d = date("d/m/Y H:i:s");
                            if(array_key_exists("save",$_POST)){
                                $fullname = $_POST['fullname'];
                                $fname = substr($fullname, 0, strpos($fullname, ' '));
                                $sname = trim(substr($fullname, strpos($fullname, ' ')));
                                $email = $_POST['email'];
                                $mobile = $_POST['mobile'];
                                $gender = $_POST['gender'];
                                $userrole = $_POST['userrole'];
                                $pass = strtolower($sname);

                                $q = mysqli_query($conn, "insert into login(username,sname,fname,gender,mobile,userrole,regdate,password,ip,status1)
                                        values('$email','$sname','$fname','$gender','$mobile','$userrole','$d','$pass','0.0.0.0','active')") or die(mysqli_error($conn));
                                if($q){
                                    ?>
                                    <script>
                                        swal("Success", "User Entered Successfully", "success")</script>
                                    <?php
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
                                            <span class="caption-subject bold font-green uppercase">User Profile</span>
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
                                                <label class="control-label">Name</label>
                                                <input type="text" placeholder="John Smith" required name="fullname" class="form-control" /> </div>
                                            <div class="form-group">
                                                <label class="control-label">Username/E-mail</label>
                                                <input type="text" name="email" placeholder="Username" class="form-control" /> </div>
                                            <div class="form-group mt-repeater">
                                                <div data-repeater-list="group-b">
                                                    <div class="mt-repeater-item">
                                                        <label class="control-label">Mobile Number</label>
                                                        <input type="text" name="mobile" placeholder="+234646580284" class="form-control" /> </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Gender</label>
                                                    <select class="form-control input-sm" name="gender">
                                                        <option value="Male">Male</option>
                                                        <option value="Female">Female</option>
                                                    </select>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">User Type</label>
                                                    <select class="form-control input-sm" name="userrole">
                                                        <option value="admin">Admin</option>
                                                        <option selected value="testtaker">Test Taker</option>
                                                        <option value="supervisor">Supervisor</option>
                                                    </select>
                                            </div>
                                            <div class="margin-top-10">
                                                <button type="submit" name="save" class="btn green">Add User </button>
                                                <button type="reset" class="btn default">Cancel </button>
                                            
                                            </div>
                                        </form>
                                        <p>&nbsp;</p>
                                        <div>You can Upload Test takers list using Excel file. Download Sample file <a href="#">here</a></div>
                                        <form role="form" name="form2" method="post" enctype="multipart/form-data" action="">
                                        <div class="form-group">
                                                <label class="control-label">Select File</label>
                                                <input type="file" required name="file" class="form-control" /> </div>
                                        <div class="margin-top-10">
                                            <button type="submit" name="upload" class="btn blue">Upload File </button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                        </div>
                    <div class="col-md-8">
					<!-- BEGIN SAMPLE TABLE PORTLET-->
					<div class="portlet box purple">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-comments"></i>Users List
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
										 ID
									</th>
									<th>
										 Full Name
									</th>
                                    <th>
										 Phone
									</th>
									<th>
										 User Role
									</th>
									<th>
										 Status
									</th>
								</tr>
								</thead>
								<tbody>
                                    <?php
                                    $n=0;
                                    $status = "inactive";
                                        $qusers = mysqli_query($conn, "select * from login order by regdate desc limit 10");
                                        while($users = mysqli_fetch_array($qusers)){
                                            $n++;
                                            $status = $users['status1'];
                                    ?>
								<tr>
									<td>
                                        <?php echo $n?>
									</td>
									<td>
										 <?php echo $users['username']?>
									</td>
									<td>
                                    <?php echo $users['sname'].", ".$users['fname']?>
									</td>
                                    <td>
                                    <?php echo $users['mobile']?>
									</td>
									<td>
                                    <?php echo $users['userrole']?>
									</td>
									<td>
                                        <?php if($status=="active"){ ?>
										<span class="label label-sm label-success">
                                        Active </span>
                                        <?php }else{ ?>
                                        <span class="label label-sm label-info">
                                        Inactive </span>
                                        <?php } ?>
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