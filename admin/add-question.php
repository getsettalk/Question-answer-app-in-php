<?php
require('assets/header.php');
?>
<section class="container">
        <div class="manage-chap pt-2 ">
            <h3>Add New Question & Manage:</h3>
          <div class="d-flex justify-content-center align-items-center">
          <div class="card w-50 mw-100">
                <div class="card-header header-bg">
                    ADD Question:
                </div>
                <div class="card-body">
                    <div class="msgNew text-center"></div>
                    <form id="addQuestion">
                        
                        <div class="mt-2">
                            <label for="addQuesToClassName" class="form-label">Which Class:</label>
                            <select name="addQuesToClassName" id="addQuesToClassName" class="form-control univerSalClass">
                                <option value="none" selected>Select</option>
                                <?php $arry= get_classNameAsOption($conn , 1);
                                    foreach($arry as $x => $val) {
                                        echo "<option value='{$val}'>{$x } </option>";
                                      }
                                ?>
                              
                            </select>
                        </div>

                        <div class="mt-2">
                            <label for="addQuesTochapterName" class="form-label">Which chapter:</label>
                            <select name="addQuesTochapterName" id="addQuesTochapterName" class="form-control univerSalChapter">
                                <option value="none" selected disabled>Select</option>
                            </select>
                        </div>
                        
                        <div class="mt-2">
                            <label for="questionNoInBook" class="form-label">Question Number (In Book):</label>
                            <input type="number" name="questionNoInBook" id="questionNoInBook" class="form-control" placeholder="Enter Question Number related to Book or serial number">
                        </div>

                        <div class="mt-2">
                            <label for="questionStatus" class="form-label">Question Status:</label>
                            <select name="questionStatus" id="questionStatus" class="form-control">
                                <option value="1" selected>Active</option>
                                <option value="0">Deactive</option>
                            </select>
                        </div>

                        <div class="mt-2">
                            <label for="questionText" class="form-label">Enter Question(in Eng.):</label>
                           <textarea name="questionText" id="questionText" cols="30" rows="5" class="form-control"></textarea>
                        </div>
                        <div class="mt-2">
                            <label for="questionMetakey" class="form-label">Meta keywords(in Eng.):</label>
                            <input type="text" name="questionMetakey" id="questionMetakey" class="form-control">
                        </div>
                       
                        <div class="mt-3 text-center">
                      <button type="button " id="addQuestionBtn" class="btn btn-success text-light fw-bold " >Add Question</button>
                        </div>
                    </form>
                
                </div>
            </div>
          </div>

        </div>

      

    </section>

<?php
require('assets/footer.php');
?>