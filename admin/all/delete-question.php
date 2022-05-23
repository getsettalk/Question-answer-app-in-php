<?php
session_start();
require('config.php');
if(!isset($_SESSION['auth'])){
    header('location:'.$logoutLocation);
}else{
    if (isset($_POST['id'])) {
        $id = mysqli_real_escape_string($conn,$_POST['id']);
        $sql ="DELETE FROM `question` WHERE q_id ='$id'";
        if(mysqli_query($conn,$sql) or die($conn->error)){
            echo "success";
        }else{
            echo "failed";
        }
    }else{

    }
}
?>