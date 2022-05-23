<?php
session_start();
require('config.php');
if(!isset($_SESSION['auth'])){
    header('location:'.$logoutLocation);
}else{
    $id = mysqli_real_escape_string($conn,$_POST['id']);
    if (!empty($id)) {
    $sql ="SELECT * FROM `question` INNER JOIN `class` ON class.cl_id = `question`.q_class_name INNER JOIN `chapter` ON chapter.c_id = question.q_chapter INNER JOIN `admin` ON `admin`.aid = question.q_added_by  where q_id = '$id'";
    $run = mysqli_query($conn,$sql);
        if (mysqli_num_rows($run)> 0) {
            $row = mysqli_fetch_assoc($run);
            $data = "Class: ".$row['cl_name'] ."\n";
            $data .= "Chapter name : ".$row['c_name'] ."\n \n";
            $data .= "Question  : ".$row['q_text'] ."\n";
            echo $data;
        }else{
            echo "data not found.";
        }
    }else{
        echo "Empty data ";
    }
}
?>