<?php
$host = "localhost";
$user = "root";
$password = "newton";
$database = "examportaldb";
$conn = mysqli_connect($host, $user, $password, $database);
if (!$conn) {
    echo 'Access Denied';
}
$app_name = "Exam Portal Application";
$app_address = "Benue";
?>