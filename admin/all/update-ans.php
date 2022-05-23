<?php
session_start();
require('config.php');
require('top-fun.php');
if(!isset($_SESSION['auth'])){
header('location:'.$logoutLocation);
}else{

  $ansid = mysqli_real_escape_string($conn,$_POST['ansid']);
  $EditanswerStatus = mysqli_real_escape_string($conn,$_POST['EditanswerStatus']);
  $EditansText = mysqli_real_escape_string($conn,$_POST['EditansText']);

  $Metadata = mysqli_real_escape_string($conn,$_POST['Metadata']);
 if (!empty($ansid) && !empty( $EditansText)) {

 if($_FILES['EditformFileSm']['name'][0] == ''){
    $sql ="UPDATE `answer` SET `ans_text`='$EditansText',`ans_status`='$EditanswerStatus',`ans_updated_on`='$date',`ans_meta`='$Metadata' WHERE ansid = '$ansid'";
    if(mysqli_query($conn,$sql) or die($conn->error)){
        echo "Answer has been Updated without any Media Files, Old Files is Working with this.";
    }else{
        echo "Filed to Update Answer";
    }
 }else{
     $sqlToFilneName="SELECT * FROM `answer` where ansid ='$ansid'";
     $run = mysqli_query($conn,$sqlToFilneName) or die($conn->error);
     if(mysqli_num_rows($run)==1){
         $row = mysqli_fetch_assoc($run);
         // databse ans_photo column naver shoud be empty name
        $oldPhotoname = $row['ans_photo'];
        $str_arr = preg_split ("/\,/", $oldPhotoname); 
        $targetDir = "../answer/";
      
        foreach($str_arr as $x => $val) {
            if(unlink($targetDir.$val)){
                $unlinkstatus =1;
            }else{
                $unlinkstatus =0;
            }
          }
        if($unlinkstatus ==1){
            // now upload  all photo in file
            $allfilename='';

            $files = $_FILES['EditformFileSm']['name'];
           for ($i=0; $i <count($files); $i++) { 
        
             $targetFilePath = $targetDir.time().$files[$i]; 
            // die();
             if(move_uploaded_file($_FILES["EditformFileSm"]["tmp_name"][$i], $targetFilePath)){ 
               $fileuploadStatus =1;
             }else {
                $fileuploadStatus =0;
             }
             $allfilename.= time().$files[$i].",";
          
           }
           $allfilename=rtrim($allfilename,",");
           if ($fileuploadStatus==1) {
               // now insert query with file infomation for photo
               $sql2 ="UPDATE `answer` SET `ans_text`='$EditansText',`ans_photo`='$allfilename',`ans_status`='$EditanswerStatus',`ans_updated_on`='$date',`ans_meta`='$Metadata' WHERE ansid = '$ansid'";
               if (mysqli_query($conn,$sql2) or die($conn->error)) {
                   echo "Answer has been updated. Done";
               }else{
                echo "Failed to Insert Data of anser Data edition";
               }
           }else{
               echo "having an Issue to Upload Media file in folder.";
           }
        }else{
            echo "Old Photo Deletion Problem Found, I think Old Photos not available";
        }
     }else{
        echo "Something Wrong !!, can't find Data in Answer Table with Answer Id";
     }
  
 
 }

 }else{
     echo "Empty Value Receicved";
 }
}
?>