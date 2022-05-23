<?php
$conn= new mysqli('localhost','root','','quesapp') or die($conn->error);
// print_r($_POST);
$e= mysqli_real_escape_string($conn,$_POST['e']);
$p= mysqli_real_escape_string($conn,$_POST['p']);
if(!empty($e) && !empty($p) && $e !==' '){
    $sql="SELECT * FROM admin where a_email ='$e' And a_pass ='$p'";
    $run = mysqli_query($conn,$sql) or die($conn->error);
    if(mysqli_num_rows($run)>0){
        $row = mysqli_fetch_assoc($run);
      session_start();
      $_SESSION['adminName'] =$row['a_name'];
      $_SESSION['aid'] =$row['aid'];
      $_SESSION['photo'] =$row['a_photo'];
      $_SESSION['auth'] =md5($row['a_name'].$row['a_email'].$row['a_phone']);
      echo 'success';
    }else{
       
        echo 'failed';
        
    }
}else{
    echo 'empty value received';
}
?>