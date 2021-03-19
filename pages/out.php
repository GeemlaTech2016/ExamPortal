<?php
include 'includes/authen.php';
include 'includes/functions.php';
session_start();
if(isset($_SESSION['uid'])){
    mysqli_query($conn, "delete from user_token where username = '".$_SESSION["uid"]."'");
    session_unset($_SESSION["is_logged"]);
    session_unset($_SESSION["uid"]);
    session_destroy();
    $url="login.php";
    redirect($url);
}else{
    $url="login.php";
    redirect($url);
}
?>