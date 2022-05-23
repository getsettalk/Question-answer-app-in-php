<?php
session_start();
require('config.php');
require('top-fun.php');
if(!isset($_SESSION['auth'])){
header('location:'.$logoutLocation);
}else{
    if (isset($_POST['id'])) {
        $id = mysqli_real_escape_string($conn,$_POST['id']);
    $sql ="SELECT * FROM `question` INNER JOIN chapter ON chapter.c_id = question.q_chapter where q_id = '$id'";
    $run =mysqli_query($conn,$sql);
        if (mysqli_num_rows($run)>0) {
            $row =mysqli_fetch_assoc($run);
            ?>  
            <div class="text-center">
                <div class="alertbg">
                    <span>If the name of the chapter is not visible in the input
                         field of the chapter, then you select any other class
                          once in the select box with the class, then again select 
                          the class you want to select, after this we will get the
                           chapter related to the class.
                         The name will start appearing.</span>
                </div>
            </div>
             <form id="UpdateQuestion">
                        
                        <div class="mt-2">
                            <label for="editQuesToClassName" class="form-label">Edit Class:</label>
                            <select name="editQuesToClassName" id="editQuesToClassName" class="form-control univerSalClass">
                                <option value="none" selected>Select</option>
                                <?php $arry= get_classNameAsOption($conn , 1);
                                    foreach($arry as $x => $val) {
                                        ?>
                                        <option value='<?php echo $val; ?>' <?php if($row['q_class_name'] == $val) { echo 'selected'; } ?> ><?php echo $x; ?> </option>;
                                        <?php
                                      }
                                ?>
                             
                            </select>
                        </div>

                        <div class="mt-2">
                            <label for="editQuesTochapterName"  class="form-label">Chapter(Again Select Chapter):<i class="fa-solid fa-circle-question" ></i><br> <small>Saved With :<?php echo $row['c_name']; ?></small></label>
                            <select name="editQuesTochapterName" id="editQuesTochapterName" class="form-control univerSalChapter">
                                <option value="none" selected >Select</option>
                            </select>
                        </div>
                        
                        <div class="mt-2">
                            <label for="editquestionNoInBook" class="form-label">Question Number (In Book):</label>
                            <input type="number" name="editquestionNoInBook" id="editquestionNoInBook" class="form-control" placeholder="Enter Question Number related to Book or serial number" value="<?php echo $row['q_number']; ?>">
                        </div>

                        <div class="mt-2">
                            <label for="editquestionStatus" class="form-label">Question Status:</label>
                            <select name="editquestionStatus" id="editquestionStatus" class="form-control">
                                <option value="1" <?php if($row['q_status'] == 1){ echo "selected"; }?>>Active</option>
                                <option value="0" <?php if($row['q_status'] == 0){ echo "selected"; }?>>Deactive</option>
                            </select>
                        </div>

                        <div class="mt-2">
                            <label for="editquestionText" class="form-label">Enter Question(in Eng.):</label>
                           <textarea name="editquestionText" id="editquestionText" cols="30" rows="5" class="form-control"><?php echo $row['q_text']; ?></textarea>
                        </div>
                        <div class="mt-2">
                            <label for="editquestionMetakey" class="form-label">Meta keywords(in Eng.):</label>
                            <input type="text" name="editquestionMetakey" value="<?php echo $row['q_meta_data']; ?>" id="questionMetakey" class="form-control" >
                        </div>
                        <div class="mt-2">
                           
                            <input type="hidden" name="questionId" value="<?php echo $row['q_id']; ?>" id="questionId" >
                        </div>
                       
                        <div class="mt-3 text-center">
                      <button type="button " id="updateQuestionBtn" class="btn btn-warning text-light fw-bold " >Update Question</button>
                        </div>
                    </form>
                

            <?php
        }else{
             echo "No data found with this id {$id}. ";
        }
    }else{
        echo "Empty or Invalid Id Data Received";
    }
}
?>