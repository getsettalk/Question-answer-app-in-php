<?php
session_start();
require('config.php');
if(!isset($_SESSION['auth'])){
    header('location:'.$logoutLocation);
}else{
$comingid = mysqli_real_escape_string($conn,$_POST['id']);
if (!empty($comingid)) {
    $sql ="SELECT * FROM `answer` where ans_question_id = '$comingid'";
    $run= mysqli_query($conn,$sql) or die($conn->error);
    if (mysqli_num_rows($run)>0) {
       $row =mysqli_fetch_assoc($run);
       $qid = $row['ans_question_id'];
       $ansid = $row['ansid'];
       $anstext = $row['ans_text'];
       $ansphoto = $row['ans_photo'];
    
       $sqltogetqus= "SELECT * FROM `question` where q_id = '$qid'";
       $run1 = mysqli_query($conn,$sqltogetqus);
       if (mysqli_num_rows($run1)==1) {
           $row1 =mysqli_fetch_assoc($run1);
           $qusText =$row1['q_text'];
           $ClassId =$row1['q_class_name'];
           $chapterId =$row1['q_chapter'];

         $sqlToGetClass ="SELECT * FROM `class`  where cl_id = '$ClassId'";
         $run2 =mysqli_query($conn,$sqlToGetClass) or die($conn->error);

         if (mysqli_num_rows($run2)>0) {
             $row2= mysqli_fetch_assoc($run2);
             $classname= $row2['cl_name'];
            $sqlToGetChapter ="SELECT * FROM `chapter` where c_related_class ='$ClassId'";
            $run3 =mysqli_query($conn,$sqlToGetChapter) or die($conn->error);
            if (mysqli_num_rows($run3)>0) {
               $row3 = mysqli_fetch_assoc($run3);

            $chaptername = $row3['c_name'];
                // now place html

                ?>
                <div class="card ">
                <div class="card-header search-header">Search Result:</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 bg-of-question-head">
                            <h5 class=" text-center newFonts1">
                                Class : <span class="text-success "> <?php echo $classname; ?></span>
                            </h5>
                        </div>
                        <div class="col-12 bg-of-question-head text-center newFonts1">
                            <h5 >Chapter Name: <span class="text-primary "><?php echo $chaptername; ?></span></h5>
                        </div>
                        <div class="col-12 bg-of-question rounded text-center">
                            <h5 class="newFonts1 fw-bold ">Question: </h5> <p><?php echo $qusText; ?></p>
                        </div>

                        <div class="col-12 pt-2">
                            <h5 class="newFonts1 fw-bold">Answer:</h5>
                            <p><?php echo $anstext; ?></p>
                           <div class="mt-2">
                               <?php
                                $ansArrayPhoto = preg_split ("/\,/", $ansphoto); 
                                // prt($str_arr);
                                
                                foreach($ansArrayPhoto as $x => $val) {
                                    $number =$x+1;
                                    echo "<div class='p-2'><span class='answerStep'>{$number} </span> <img src='answer/{$val}' alt='AnsPhoto' width='100%'  onContextMenu='return false;' ></div >";
                                  }
                               ?>
                           
                           </div>
                           
                        </div>
                    </div>
                    <div class=" d-flex text-center align-items-center justify-content-center gap-5 mt-3">
                        <button  class="btn btn-dark EditAnswer" data-id=" <?php echo $ansid; ?>" >Edit</button>
                        <button class="btn btn-danger DeleteAnswer" data-id=" <?php echo $ansid; ?>">Delete</button>
                    </div>
                </div>
            </div>


            <?php

            }else{
                echo "Don't find Chapter name with ID".$comingid;
            }
         }else{
             echo " Don't Find any class name with id".$comingid;
         }


       }else{
           echo "Related comimg ID from you, that's can't find any Question";
       }
    }else{
        echo "Related Id don't found Answer anything";
    }
}else {
    echo "Empty Data ID received";
}
}
?>