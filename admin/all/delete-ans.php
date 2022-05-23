<?php
session_start();
require('config.php');
if(!isset($_SESSION['auth'])){
    header('location:'.$logoutLocation);
}else{
$ansid = mysqli_real_escape_string($conn,$_POST['id']);
if (!empty($ansid)) {
    // for find all data to  remove images
    $sql = "SELECT * FROM `answer` WHERE ansid ='$ansid'";
    $run =mysqli_query($conn,$sql) or die($conn->error);
    if(mysqli_num_rows($run) >0){
        $row = mysqli_fetch_assoc($run);
       $imagename = $row['ans_photo'];
       $str_arr = preg_split ("/\,/", $imagename); 
       $targetdir='../answer/';
       $unlinkStatus;
        foreach($str_arr as $x => $val) {
          if(unlink($targetdir.$val)){
            $unlinkStatus =1;
           }else{
               $unlinkStatus=0;
           }
        }

        if($unlinkStatus ==1){
            $sqlToDelete = "DELETE FROM `answer` WHERE ansid ='$ansid'";
            if(mysqli_query($conn,$sqlToDelete) or die($conn->error)){
                // success 
                echo 222;
            }else{
                // faild to delete
                echo 333;
            }
        }else{
            // somethiong wrong to unlink photo ans can't Delete photos
            echo 999;
        }
    }else{
        // not match found with id so this is res code
        echo 777;
    }

}else{
    echo "Empty Data Received as Id";
}
}

?>