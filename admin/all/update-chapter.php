<?php
session_start();
require('config.php');
require('top-fun.php');
if(!isset($_SESSION['auth'])){
header('location:'.$logoutLocation);
}else{
    $cname = trim(mysqli_real_escape_string($conn,$_POST['EchapterName']));
    $rowid = mysqli_real_escape_string($conn,$_POST['rowid']);
    $class = mysqli_real_escape_string($conn,$_POST['EclassName']);
    $status = mysqli_real_escape_string($conn,$_POST['EchapterStatus']);
    $metakey = trim(mysqli_real_escape_string($conn,$_POST['Emetakey']));
    if (!empty($cname)) {
        $sql ="UPDATE `chapter` SET `c_name`='$cname',`c_related_class`='$class',`key_name`='$metakey',`c_status`='$status' WHERE `c_id` ='$rowid'";
       
        if(mysqli_query($conn,$sql) or die($conn->error)){
            echo "success";
        }else{
            echo "failed";
        }
    }else{
        echo "empty data Received";
    }
}
?>