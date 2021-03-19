<?php

if (isset($_SESSION['uid'])) {
  $tokenresult = mysqli_query($conn, "SELECT token FROM user_token where username='".$_SESSION['uid']."'");
 
  if (mysqli_num_rows($tokenresult) > 0) {
 
    $row = mysqli_fetch_array($tokenresult); 
    $token = $row['token']; 

    if($_SESSION['token'] != $token){
      $currentdate = date("Y-m-d H:i:s");
      mysqli_query($conn, "update trackexam set endtime='".$currentdate."', examstatus='completed', userstatus='finished' where userid='".$_SESSION['uid']."'");
        session_unset($_SESSION["is_logged"]);
        session_unset($_SESSION["uid"]);
        session_destroy();
        header('Location: login.php');
    }
  }
}
?>