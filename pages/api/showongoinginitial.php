<?php

    $query222 = "select * from trackexam where examstatus='ongoing'";
    $gn = mysqli_num_rows(mysqli_query($conn, $query222));
    echo $gn;
?>