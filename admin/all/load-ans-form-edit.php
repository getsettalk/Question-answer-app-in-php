<?php
session_start();
require('config.php');
if(!isset($_SESSION['auth'])){
    header('location:'.$logoutLocation);
}else{
$ansId = mysqli_real_escape_string($conn,$_POST['id']);
if (!empty($ansId)) {
    // echo $ansId;
    $sql="SELECT * FROM `answer` where  ansid ='$ansId'";
    $run= mysqli_query($conn,$sql) or die($conn->error);
    if (mysqli_num_rows($run)==1) {
       $row = mysqli_fetch_assoc($run);
       $qid = $row['ans_question_id'];
       $sqltogetqus= "SELECT * FROM `question` where q_id = '$qid'";
       $run1 = mysqli_query($conn,$sqltogetqus);
       if (mysqli_num_rows($run1)==1) {
        $row1 =mysqli_fetch_assoc($run1);
        $qusText =$row1['q_text'];
       }
     ?>
     <form id="editAnswerForm"  enctype="multipart/form-data" >
        <div class="alertbg">
            If you have submited Wrong Question's answer than you want to change Question, so its not possiable, if you you want to change than you have Delect that answer than again Submit New Answer !!!.
        </div>
    <div class="mt-2">
        <label for="editfetchedQuestion" class="form-label">Saved With This Question:</label>
     <textarea name="editfetchedQuestion" id="editfetchedQuestion" cols="10" rows="5" class="form-control" readonly><?php echo $qusText; ?></textarea>
    </div>

    <div class="mt-2">
        <label for="EditanswerStatus" class="form-label">Question Status:</label>
        <select name="EditanswerStatus" id="EditanswerStatus" class="form-control">
            <option value="1" <?php if( $row['ans_status'] ==1 ){echo "selected"; } ?>>Active</option>
            <option value="0" <?php if( $row['ans_status'] ==0 ){echo "selected"; } ?>>Deactive</option>
        </select>
    </div>
    <div class="mt-2">
        <input type="hidden" name="ansid" value="<?php echo $row['ansid'];  ?>">
    </div>
    
    <div class="mt-2">
        <label for="EditansText" class="form-label">Write Answer (Acording to Selected Question):</label>
     <textarea name="EditansText" id="EditansText" cols="10" rows="5" class="form-control" ><?php echo $row['ans_text']; ?></textarea>
    </div>

    <div class="mt-3">
    <label for="EditformFileSm" class="form-label">Select Answer New Media file :</label>
    <small class="text-danger">If You are Selected new Media files than old Media files will deleted which is related with this question. if you want to see old saved image so check search result.</small>
    <input class="form-control form-control-sm " id="EditformFileSm" name="EditformFileSm[]" type="file" multiple  onchange="validFile(this);">
    </div>

    <div class="mt-2">
        <label for="Metadata" class="form-label">Meta Keywords:</label>
        <input type="text" name="Metadata" id="Metadata" class="form-control" placeholder="Enter Meta keyword for SEO" value="<?php echo $row['ans_meta']; ?>">
    </div>
    <div class="mt-3 text-center">
  <button type="button " id="EditedaddQuesAns" class="btn btn-warning text-light fw-bold " >Update Answer</button>
    </div>
</form>


    <?php
    }else{
        echo "Sorry, Not Match Answer ID";
    }
}else{
    echo "ID Don't Received of Answer";
}
}
?>