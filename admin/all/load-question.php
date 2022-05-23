<?php
session_start();
require('config.php');
if(!isset($_SESSION['auth'])){
    header('location:'.$logoutLocation);
}else{
    $limit_per_page =20;
    $page= "";
    if(isset($_POST['pno'])){
        $page=$_POST['pno'];
    }else{
        $page = 1;
    }

    $offset = ($page - 1)* $limit_per_page;
    $sql= "SELECT * FROM `question` INNER JOIN `class` ON class.cl_id = `question`.q_class_name INNER JOIN `chapter` ON chapter.c_id = question.q_chapter INNER JOIN `admin` ON `admin`.aid = question.q_added_by ORDER BY q_id DESC   LIMIT {$offset},{$limit_per_page}";
    $run = mysqli_query($conn,$sql);
    if (mysqli_num_rows($run)>0) {
        ?>
        <div class="table-responsive" >
       <table >
       <col style="width:30%">
    <thead>
        <tr>
        <th>ID</th>
        <th>Book S.n</th>
        <th>Related Class</th>
        <th>Related chapter Name</th>
        <th class="w-50" width="100px">Question</th>
        <th>Meta keywords</th>
        <th>Added on</th>
        <th>Status</th>
        <th>Added By</th>
        <th>Edit</th>
        <th>Delete</th>
    </tr>
    </thead>
        <?php

        while($row = mysqli_fetch_assoc($run)){
        ?>
            <tr>
                <td><?php echo $row['q_id']; ?></td>
                <td><?php echo $row['q_number']; ?></td>
                <td><?php echo $row['cl_name']; ?></td>
                <td><?php echo $row['c_name']; ?></td>
                <td class="questionColor" ><?php echo $row['q_text']; ?> <i class="fa-solid fa-circle-info"></i></td>
                <td><?php echo $row['q_meta_data']; ?></td>
                <td><?php echo $row['q_added']; ?></td>
              
              
                <td><?php if($row['q_status'] ==1){
                    echo "<span class='text-success fw-bold'>Active </span>";
                } else { echo "<span class='text-danger fw-bold'>Deactive </span>"; }?></td>
                  <td><?php echo $row['a_name']; ?></td>
              
                <td><button class="btn btn-small btn-dark editQuestion" data-id="<?php echo $row['q_id']; ?>">Edit</button></td>
                <td><button class="btn btn-small btn-danger deleteQuestion" data-id="<?php echo $row['q_id']; ?>">Delete</button></td>
            </tr>
        <?php
        
        }

        ?>
        </table>
        </div>
            
        <nav aria-label="Page navigation ">
        <ul class="pagination justify-content-center mt-4 questionPagination">
           <?php 
           $sqltocount = "SELECT * FROM `question`";
           $res=mysqli_query($conn,$sqltocount) or die($conn->error);
            $total_rec = mysqli_num_rows($res);
            $total_pages =ceil($total_rec/$limit_per_page);
           
            for ($i=1; $i<=$total_pages; $i++) { 
           ?>
            <li class="page-item "><a class="page-link <?php if($i == $page){ echo "paged"; } ?>" href="#"  id="<?php echo $i; ?>">  <?php echo $i; ?></a></li>
           <?php } ?>
         
        </ul>
        </nav>

        <?php
    }
}


?>