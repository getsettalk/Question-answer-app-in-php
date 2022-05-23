<?php
require('assets/header.php');
?>
<!-- =======add chapter and view edit === -->
<section class="container">
        <div class="manage-chap pt-2 ">
            <h3>Add Chapter & Manage:</h3>
          <div class="d-flex justify-content-center align-items-center">
          <div class="card w-50 mw-100">
                <div class="card-header header-bg">
                    ADD chapter Name:
                </div>
                <div class="card-body">
                    <form id="addChapter">
                        <div>
                            <label for="chapterName" class="form-label">Chapter Name:</label>
                            <input type="text" name="chapterName" id="chapterName" placeholder="Enter Chapter Name" class="form-control ">
                        </div>
                        <div class="mt-2">
                            <label for="className" class="form-label">Which Class:</label>
                            <select name="className" id="className" class="form-control ">
                                <option value="none" selected>Select</option>
                                <?php $arry= get_classNameAsOption($conn , 1);
                                    foreach($arry as $x => $val) {
                                        echo "<option value='{$val}'>{$x } </option>";
                                      }
                                ?>
                              
                            </select>
                        </div>
                        <div class="mt-2">
                            <label for="chapterStatus" class="form-label">Chapter Status:</label>
                            <select name="chapterStatus" id="chapterStatus" class="form-control">
                                <option value="1">Active</option>
                                <option value="0">Deactive</option>
                            </select>
                        </div>
                        <div class="mt-2">
                            <label for="chapterStatus" class="form-label">Meta Keywords:</label>
                            <input type="text" name="metakey" id="metakey" class="form-control" placeholder="Enter Meta keyword for search and seo">
                        </div>
                        <div class="mt-3 text-center">
                      <button type="button " id="addChapName" class="btn btn-info text-light fw-bold " >Create Chapter</button>
                        </div>
                    </form>
                
                </div>
            </div>
          </div>

        </div>

        <div class="mt-3 mb-4">
            <h5 class="text-secondary">All Chapter :</h5>

            <div class="table-responsive" id="chapterTable">
                    
            </div>
        </div>

    </section>

    
<?php
require('assets/footer.php');
?>