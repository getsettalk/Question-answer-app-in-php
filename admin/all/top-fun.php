<?php
// universal  function 
function prt($data){
    echo "<pre>";
    print_r($data);
    echo "</pre>";
}

//function to fetch class name as option tag
/* function get_classNameAsOption($conn , $stat) {
    $sql = "SELECT * FROM `class` where cl_status ='$stat'";
    $run =mysqli_query($conn,$sql) or die($conn->error);
    if(mysqli_num_rows($run)>0){
        while($row=mysqli_fetch_assoc($run)){
            ?>
            <option value="<?php echo $row['cl_id'] ?>"> <?php echo $row['cl_name'] ?></option>
            <?php
        }
    }
} */

//function to fetch class name and id
function get_classNameAsOption($conn , $stat) {
    $sql = "SELECT * FROM `class` where cl_status ='$stat'";
    $run =mysqli_query($conn,$sql) or die($conn->error);
    if(mysqli_num_rows($run)>0){
        $arr=[];
        while($row=mysqli_fetch_assoc($run)){
           $arr[$row['cl_name']]=$row['cl_id'];
           
        }
        return $arr;
    }
}
?>