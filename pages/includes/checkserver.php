<?php
$dt=date("Y-m-d H:i:s");
	$getlock = mysqli_fetch_array(mysqli_query($conn, "select * from lockserver where sn='1'"));
	if($dt < $getlock['startdate'] || $dt > $getlock['enddate']){
		?>
        <meta http-equiv="refresh" content="0; url=404.php" />
        <?php
	}
?>