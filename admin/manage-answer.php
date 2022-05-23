<?php
require('assets/header.php');
?>
<!-- =======add chapter and view edit === -->
<section class="container-fluid">
        <div class="manage-ans text-secondary pt-2 ">
            <h5>Manage Answer:</h5>
          <div class=" d-flex justify-content-center">
                <div class="card w-50">
                    <div class="card-header  header-bg ">
                        Search Question Answer :
                    </div>
                    <div class="card-body">
                        <form id="searchAnsWer">
                            <div class="flex flex-direction-column">
                                <div>
                                    <input type="number" name="quid" id="quid" class="form-control" placeholder="Enter Question ID to search Answer">
                                </div>
                                <div class="text-center mt-2">
                                <button type="submit"  class="btn btn-danger" >Search</button>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
                
          </div>

       
        </div>

        <div class="container ">
          <div class="d-flex justify-content-center align-items-center ">
            <div class="allAnswerData mt-2">
            </div>
          </div>
          </div>
    </section>

    
<?php
require('assets/footer.php');
?>