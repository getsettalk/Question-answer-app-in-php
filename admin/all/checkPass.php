<?php
session_start();
require('config.php');
if(!isset($_SESSION['auth'])){
    header('location:'.$logoutLocation);
}else{
    if(isset($_POST['p']) && !empty($_POST)){
        $pass = md5(mysqli_real_escape_string($conn,$_POST['p']));
        $sql = "SELECT * FROM `admin` where aid = '$adminId' And a_passcode ='$pass'";
        $run = mysqli_query($conn,$sql) or die($conn->error);
        if(mysqli_num_rows($run) === 1){
            echo "yes";
        }else{
            echo "no";
        }
    }
}
?>