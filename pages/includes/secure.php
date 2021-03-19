<?php
$test = isset($_SESSION['is_logged'])?$_SESSION['is_logged']:'';
$uid = isset($_SESSION['uid'])? $_SESSION['uid']:'';
if(!$test){
	die("Access Denied. <a href='login.php'>Go Back</a>");
}
?>