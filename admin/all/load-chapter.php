<?php
session_start();
require('config.php');
if(!isset($_SESSION['auth'])){
    header('location:'.$logoutLocation);
}else{
   
    $sql= "SELECT * FROM `chapter` INNER JOIN `class` ON class.cl_id = chapter.	c_related_class ORDER BY c_id DESC";
    $run = mysqli_query($conn,$sql);
    if (mysqli_num_rows($run)>0) {
        ?>
       <table>
    <thead>
        <tr>
        <th>Id</th>
        <th>Chapter_Name</th>
        <th>Related Class</th>
        <th>Status</th>
        <th>Meta keys</th>
        <th>Created on</th>
        <th>Edit</th>
    </tr>
    </thead>
        <?php

        while($row = mysqli_fetch_assoc($run)){
        ?>
            <tr>
                <td><?php echo $row['c_id']; ?></td>
                <td><?php echo $row['c_name']; ?></td>
                <td><?php echo $row['cl_name']; ?></td>
              
                <td><?php if($row['c_status'] ==1){
                    echo "Active";;
                } else { echo "Deactive"; }?></td>
                <td><?php echo $row['key_name']; ?></td>
                <td><?php echo $row['created_at']; ?></td>
              
                <td><button class="btn btn-small btn-dark editChapterName" data-id="<?php echo $row['c_id']; ?>">Edit</button></td>
            </tr>
        <?php
        
        }

        ?>
        </table>
        <?php
    }
}


?>