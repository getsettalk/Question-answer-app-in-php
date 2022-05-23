<?php
require('assets/header.php');
?>
<section class="container">
        <div class="manage-chap pt-2 ">
            <h3>Add Question's answer:</h3>
          <div class="d-flex justify-content-center align-items-center">
          <div class="card w-50 mw-100">
                <div class="card-header header-bg">
                    ADD Answer:
                </div>
                <div class="card-body">
                    <form id="addAnswer"  enctype="multipart/form-data" >

                    <div class="input-group mb-3">
                    <input type="number" class="form-control" id="searchQuestionForAns" name="searchQuestionId" placeholder="Enter Question ID" aria-label="Enter Question ID" aria-describedby="button-addon2">
                    <button class="btn btn-success" type="button" id="getQuestion">Search</button>
                    </div>
                        
                        <div class="mt-2">
                            <label for="fetchedQuestion" class="form-label">Fetched Question:</label>
                         <textarea name="fetchedQuestion" id="fetchedQuestion" cols="10" rows="5" class="form-control" readonly></textarea>
                        </div>

                        <div class="mt-2">
                            <label for="answerStatus" class="form-label">Question Status:</label>
                            <select name="answerStatus" id="answerStatus" class="form-control">
                                <option value="1">Active</option>
                                <option value="0">Deactive</option>
                            </select>
                        </div>
                        
                        <div class="mt-2">
                            <label for="ansText" class="form-label">Write Answer (Acording to Selected Question):</label>
                         <textarea name="ansText" id="ansText" cols="10" rows="5" class="form-control" ></textarea>
                        </div>

                        <div class="mt-3">
                        <label for="formFileSm" class="form-label">Select Answer Media file:</label>
                        <input class="form-control form-control-sm " id="formFileSm" name="ansMedia[]" type="file" multiple onchange="validFile(this);">
                        </div>

                        <div class="mt-2">
                            <label for="chapterStatus" class="form-label">Meta Keywords:</label>
                            <input type="text" name="metakey" id="metakey" class="form-control" placeholder="Enter Meta keyword for SEO">
                        </div>
                        <div class="mt-3 text-center">
                      <button type="button " id="addQuesAns" class="btn btn-info text-light fw-bold " >Set Answer</button>
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