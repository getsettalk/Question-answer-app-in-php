<?php
session_start();
require('config.php');
if(!isset($_SESSION['auth'])){
header('location:'.$logoutLocation);
}else{
$class =trim(mysqli_real_escape_string($conn,$_POST['addQuesToClassName']));
$addQuesTochapterName =trim(mysqli_real_escape_string($conn,$_POST['addQuesTochapterName']));
$questionNoInBook =trim(mysqli_real_escape_string($conn,$_POST['questionNoInBook']));
$questionStatus =trim(mysqli_real_escape_string($conn,$_POST['questionStatus']));
$questionText =trim(mysqli_real_escape_string($conn,$_POST['questionText']));
$questionMetakey =trim(mysqli_real_escape_string($conn,$_POST['questionMetakey']));

    if(!empty($questionText) && !empty($class)){
  // check this question already exist or not with save questin seral number data
  $sqlToCheck = "SELECT * FROM `question` WHERE `q_number` ='$questionNoInBook' &&`q_class_name`='$class' AND `q_chapter`='$addQuesTochapterName'";
  $run = mysqli_query($conn,$sqlToCheck) or die($conn->error);
      if (mysqli_num_rows($run)>0) {
        echo "Error: As per your selected options and given input we found one questtion Already Exist. please check again ?";
      }else{
        $sql ="INSERT INTO `question` (`q_number`,`q_class_name`, `q_chapter`, `q_text`, `q_meta_data`, `q_status`, `q_added`, `q_added_by`)
        VALUES ( '$questionNoInBook','$class','$addQuesTochapterName', '$questionText', '$questionMetakey', '$questionStatus', '$date', '$adminId')"; 
      
        if (mysqli_query($conn,$sql) or die($conn->error)) {
          echo "success";
        } else{
            echo "failed";
        }
      }


    }
    

}
?>