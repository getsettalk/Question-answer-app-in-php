<?php
session_start();
require('config.php');
if(!isset($_SESSION['auth'])){
header('location:'.$logoutLocation);
}else{
require('top-fun.php');
$chname = trim(mysqli_escape_string($conn,$_POST['chapterName']));
$clname = mysqli_escape_string($conn,$_POST['className']);
$cstatus = mysqli_escape_string($conn,$_POST['chapterStatus']);
$metakey = trim(mysqli_escape_string($conn,$_POST['metakey']));

if (!empty($chname) && !empty($clname)) {
    $sql = "INSERT INTO `chapter` (`c_id`, `c_name`,`c_related_class`, `key_name`, `c_status`, `created_at`)
     VALUES (NULL, '$chname','$clname', '$metakey', '$cstatus', '$date')";

    if(mysqli_query($conn,$sql) or die($conn->error)){
        echo "success";
    }else {
        echo "failed";
    }
}else{
    echo "Empty Data Received";
}
}
?>