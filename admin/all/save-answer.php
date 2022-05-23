<?php
session_start();
require('config.php');
if(!isset($_SESSION['auth'])){
header('location:'.$logoutLocation);
}else{
require('top-fun.php');
$qid= mysqli_real_escape_string($conn,$_POST['searchQuestionId']);
$fetchedQuestion= mysqli_real_escape_string($conn,$_POST['fetchedQuestion']);
$answerStatus= mysqli_real_escape_string($conn,$_POST['answerStatus']);
$ansText= mysqli_real_escape_string($conn,$_POST['ansText']);
$metakey= mysqli_real_escape_string($conn,$_POST['metakey']);
$file= $_FILES['ansMedia']['name'];
if(!empty($qid) &&  !empty($_POST['ansText'])){
    // checking question id exist or not
$sqlToCheckExistID ="SELECT * FROM `question` where q_id ='$qid'";
$run = mysqli_query($conn,$sqlToCheckExistID);
if (mysqli_num_rows($run)==1) {
   // now check related question have already answred or not 
   $sqlToCheckAlreadyAnswre="SELECT * FROM `answer` where ans_question_id ='$qid'";
   $run1 = mysqli_query($conn,$sqlToCheckAlreadyAnswre);
   if(mysqli_num_rows($run1)>0){
    echo "As per given Question ID  has been already Answred, Please check Again ?";

   }else {
    if(isset($_FILES['ansMedia']['tmp_name']))
    {
        $allfilename='';
        $targetDir = "../answer/"; 
      
       for ($i=0; $i <count($file); $i++) { 
   
         $targetFilePath = $targetDir .time().$file[$i]; 
        // die();
         if(move_uploaded_file($_FILES["ansMedia"]["tmp_name"][$i], $targetFilePath)){ 
           $fileStatus =1;
         }else {
            $fileStatus =0;
         }
         $allfilename.= time().$file[$i].",";
       }
      
       if ($fileStatus ===1) {
        $allfilename=rtrim(  $allfilename,",");
         $sqlToInsert= "INSERT INTO `answer` (`ans_question_id`, `ans_text`, `ans_photo`, `ans_status`, `ans_added_date`, `ans_meta`)
          VALUES ('$qid', '$ansText', '$allfilename', '$answerStatus', '$date', '$metakey')";

          if(mysqli_query($conn,$sqlToInsert) or die($conn->error)){
              echo "success";
          }else{
            echo "failed";
          }

       }else {
           echo "eeeeee";
       }
    } else{
        echo "Media file not found !";
    }

   }

}else {
    echo "Error: Question ID don't Match, Please Enter Valid Question ID";
}
}else{
 echo "Error: Empty Data Received ?";
}
}
?>