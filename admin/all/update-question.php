<?php
session_start();
require('config.php');
if(!isset($_SESSION['auth'])){
    header('location:'.$logoutLocation);
}else{
      $classname = mysqli_real_escape_string($conn,$_POST['editQuesToClassName']);
    if (!empty($classname) && !empty($_POST['editQuesTochapterName'])) {
      
        $chapter = mysqli_real_escape_string($conn,$_POST['editQuesTochapterName']);
        // book serial number booksn
        $booksn = mysqli_real_escape_string($conn,$_POST['editquestionNoInBook']);
        $status = mysqli_real_escape_string($conn,$_POST['editquestionStatus']);
        $questionId = mysqli_real_escape_string($conn,$_POST['questionId']);
        $newQuestion = mysqli_real_escape_string($conn,$_POST['editquestionText']);
        $meta = mysqli_real_escape_string($conn,$_POST['editquestionMetakey']);
        $sql = "UPDATE `question` SET `q_number`='$booksn',`q_class_name`='$classname',`q_chapter`='$chapter',`q_text`='$newQuestion',`q_meta_data`='$meta',`q_status`='$status' WHERE q_id='$questionId'";
        if (mysqli_query($conn,$sql) or die($conn->error)) {
            echo "success";
        } else{
            echo "failed";
        }

    }else{
        echo "empty data found";
    }
}
?>