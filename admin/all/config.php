<?php
date_default_timezone_set('Asia/Kolkata');
$conn= new mysqli('localhost','root','','quesapp') or die($conn->errno);
$date=date("d-m-Y");
$time=date("h:i:sa");
$logoutLocation="../logout.php";
$adminId= $_SESSION['aid'];
//******* */ always use this config file blow of session_start() function
?>