<?php
session_start();
require('config.php');
require('top-fun.php');
if(!isset($_SESSION['auth'])){
header('location:'.$logoutLocation);
}else{
if(!empty($_POST['id'])){
    $id= mysqli_real_escape_string($conn,$_POST['id']);
    $sql = "SELECT * FROM `chapter` where c_id = '$id'";
    $run = mysqli_query($conn,$sql);
    if (mysqli_num_rows($run)>0) {
        $row = mysqli_fetch_assoc($run);
        ?>
           <form id="EditedChapterForm">
                        <div>
                            <label for="chapterName" class="form-label">Chapter Name:</label>
                            <input type="text" name="EchapterName" id="EchapterName" placeholder="Enter Chapter Name" class="form-control " value="<?php echo $row['c_name']; ?>">
                        </div>
                        <div class="mt-2">
                            <label for="className" class="form-label">Which Class:</label>
                            <select name="EclassName" id="EclassName" class="form-control ">
                                
                                  <?php $arry= get_classNameAsOption($conn , 1);
                                    foreach($arry as $x => $val) { ?>
                                        <option value='<?php echo $val; ?>' <?php if($row['c_related_class'] == $val) { echo "selected"; } ?>><?php echo $x; ?> </option>
                                        <?php
                                      }
                                ?>
                              
                            </select>
                        <div class="mt-2">
                            <label for="EchapterStatus" class="form-label">Chapter Status:</label>
                            <select name="EchapterStatus" id="EchapterStatus" class="form-control">
                                <option value="1" <?php if($row['c_status']==1){echo "selected";} ?>>Active</option>
                                <option value="0" <?php if($row['c_status']==0){echo "selected";} ?>>Deactive</option>
                            </select>
                        </div>
                        <div class="mt-2">
                            
                            <input type="hidden" name="rowid" id="rowid" value="<?php echo $row['c_id']; ?>">
                        </div>
                        <div class="mt-2">
                            <label for="Emetakey" class="form-label">Meta Keywords:</label>
                            <input type="text" name="Emetakey" id="Emetakey" class="form-control" placeholder="Enter Meta keyword for search and seo" value="<?php echo $row['key_name']; ?>">
                        </div>
                        <div class="mt-3 text-center">
                      <button type="button " id="saveEditedChapter" class="btn btn-warning  fw-bold " >Update Chapter</button>
                        </div>
                    </form>
                
        <?php
    }else{
        echo "Data Not found to related id";
    }
}
}
?>