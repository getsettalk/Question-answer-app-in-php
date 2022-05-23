<?php
session_start();
require('config.php');
if(!isset($_SESSION['auth'])){
header('location:'.$logoutLocation);
}else{
    // this page is for load dynamic chapter name asa per class name id
$cid =trim(mysqli_real_escape_string($conn,$_POST['id']));
    if(!empty($cid)){
        $sql = "SELECT * FROM `chapter` where c_related_class = '$cid'";
        $run= mysqli_query($conn,$sql) or die($conn->error);
        if(mysqli_num_rows($run)>0){
            echo '<option value="none">Select</option>';
            while($row= mysqli_fetch_assoc($run)){
                ?>
                <option value="<?php echo $row['c_id']; ?>"><?php echo $row['c_name']; ?></option>
                <?php
            }
        }else{
            echo '<option value="none">Select</option>';
        }
    }
}
?>