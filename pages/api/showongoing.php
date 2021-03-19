<?php
include_once '../includes/authen.php';
    $query223 = "select * from trackexam where examstatus='ongoing'";
    $gn = mysqli_num_rows(mysqli_query($conn, $query223));
    echo $gn;
?>