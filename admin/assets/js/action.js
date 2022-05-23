$(function(){
/* ===================universal function start */
function cns(data){
    console.log(data);
}



function hideModal(){
    $(".modal").modal('hide');
}
// shpw only edit data modal 
function ShowEditModal(){
    $(".modal").modal('show');
}


// for hide loader 
function remLoader(){
    $("#divLoading").removeClass('show');
}
// for show loader 
function addLoader(){
    $("#divLoading").addClass('show');
}


// toaster js function 
toastr.options = {
    "closeButton": false,
    "debug": false,
    "newestOnTop": false,
    "progressBar": true,
    "positionClass": "toast-top-right",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "8000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
  }

// loader chapter table data
function load_chapter(){
    addLoader();
    $.ajax({
        url:"./all/load-chapter.php",
        type:"post",
        success:(data)=>{
            remLoader();
          $("#chapterTable").html(data);
        }
    });
}
load_chapter();

// loader for question load with pagination
function load_question(pageno){
    $.ajax({
        url:"./all/load-question.php",
        type:"post",
        data:{pno:pageno},
        success:(data)=>{
          $("#questionTable").html(data);
        }
    });
}
load_question();

// for clear msg box after few sec
function MsgOfFunction() {
    $(".msgNew").html('');
   }

 
/* ================= universal function end  */

/* ================================form here all work for chapter  */
// add chapter name in database
$("#addChapter").on('submit',(e)=>{
e.preventDefault();
    var name =$("#chapterName").val();
    var cname =$("#className").val();
    if (name.trim() ==null || name.trim() ==undefined || name.trim().length ==0) {
        alert('Please Enter Chapter Name ?');
    } else {
        if (cname.trim() =='none' ) {
            alert('Please Select Class Name ?');
        } else {
          if (confirm('Are You sure !!!')) {
            addLoader();
              $("#addChapName").attr('disabled',true);
              $("#addChapName").text('Please wait...');
              $.ajax({
                url:"./all/save-chapter.php",
                type:"post",
                data:$("#addChapter").serialize(),
                success:(data)=>{
                    remLoader();
                    $("#addChapName").text('Create Chapter');
                    $("#addChapName").attr('disabled',false);
                    if (data == "success") {
                        $("#addChapter").trigger('reset');
                        load_chapter();
                        navigator.vibrate(410);
                        toastr["success"]("Chapter Name has been inserted.");
                    }else{
                        toastr["error"](data);
                    }
                }
              });
          } else {
              return false;
          }
        }
    }
});

//  edit chapter load form  
$(document).on("click",".editChapterName",function(){
 var id = $(this).data('id');
 addLoader();
    $.ajax({
        url:'./all/edit-chapter-load-form.php',
        type:'post',
        data:{id:id},
        success:(data)=>{
            navigator.vibrate(300);
            $(".editModalBody").html(data);
            remLoader();
            ShowEditModal();
           
        }
    });
});

// now update edited chapter   name and all data
$(document).on('click','#saveEditedChapter',(e)=>{
    e.preventDefault();
   if( $("#EchapterName").val().trim().length ===0){
       alert("Please Type Chapter Name ?");
   }else{
       if (confirm("Really !!!, you want to Update data")) {
        addLoader();
           $.ajax({
            url:'./all/update-chapter.php',
            type:'post',
            data:$('#EditedChapterForm').serialize(),
            success:(data)=>{
                navigator.vibrate(200);
                load_chapter();
                remLoader()
                if(data == "success"){
                    hideModal();
                    toastr["success"]("Chapter Data has been updated.");
                }else if(data == "failed"){
                    toastr["error"]("Sorry to update data?");
                }else{
                    toastr["warning"](data);
                }
            }
           });
       } else {
           return false;
       }
   }
});

/*  finished chapter* all work here  */


/* ========== now work start for add question in db================ */
$(document).on("change",".univerSalClass",function(){
    var thisvalue = $(this).val();
   if (thisvalue == "none") {
       toastr["info"]("Please select valid class name ?");
       return false;
   }else{
    addLoader();
    $.ajax({
        url:'./all/load-chapter-option-for-add.php',
        type:'post',
        data:{id:thisvalue},
        success:(data)=>{
          $('.univerSalChapter').html(data);
          remLoader();
        }
    });
   }
});

// now save new question data
$("#addQuestion").on("submit",(e)=>{
    e.preventDefault();
    if($("#addQuesToClassName").val()== "none"){
        toastr["warning"]("Select Valid Class Name ?");
        return false;
    }else{
        if($("#addQuesTochapterName").val()=="none"){
            toastr["warning"]("Select Chapter Name as per Class Name ?");
        }else{
            if ($("#questionNoInBook").val() !=="") {
                if ($("#questionNoInBook").val()>0){
                    if ($("#questionText").val().trim().length >0) {
                        if(confirm("Are You sure. Do you want to save this Question ?")){
                            addLoader()
                            $.ajax({
                                url:'./all/save-question.php',
                                type:'post',
                                data:$("#addQuestion").serialize(),
                                success:(data)=>{
                                   
                                    $("#addQuestion").trigger('reset');
                                    remLoader()
                                   if (data == "success") {
                                    $(".msgNew").html("<div class='alert alert-success'>New Question has been saved. got to view question page to see all question.</div>");
                                    toastr["success"]("Your new question has been saved!!!");
                                   }else{
                                    $(".msgNew").html("<div class='alert alert-danger'>Something Wrong ?</div>");
                                    toastr["error"](data);
                                   }
                                   setTimeout(MsgOfFunction, 19000);

                                }
                            });
                        }
                    }else{
                        toastr["info"]("Please type valid question text for save?");
                    }
                }else{
                    toastr["warning"]("Question Number should be grater than 0 , do not have negative number.");
                }
            }else{
                toastr["warning"]("Please enter serial number or as per book question number .");
            }
        }
    }
});

//  this is for pagination 
$(document).on("click",".questionPagination li a",function(e){
    e.preventDefault();
    var id = $(this).attr('id');
    load_question(id);
});
// edit question 
$(document).on("click",".editQuestion",function(e){
     var id = $(this).data('id');
    $.ajax({
        url:'./all/edit-question-load-form.php',
        type:'post',
        data:{id:id},
        success:(data)=>{
            navigator.vibrate(300);
            $(".editModalBody").html(data);
            ShowEditModal();
        }
    });
});

//submit edited data
$(document).on("submit","#UpdateQuestion",function(e){
e.preventDefault();
    if ($("#editQuesToClassName").val() == "none") {
        toastr["warning"]("Please select Class / faculty name ?");
    }else{
        if($("#editQuesTochapterName").val() == "none"){
            toastr["warning"]("Please select Chapter name make sure validate chapter name as par class/faculty name ?");
        }else{
            if($("#editquestionNoInBook").val()<=0 || $("#editquestionNoInBook").val()== '' ){
                toastr["error"]("Question Serial Number as per book must be filed and grater than 0 .");
            }else{
               if($("#editquestionText").val().trim().length <=0){
                toastr["error"]("PLease type your valid Question to save.");
               }else{
                // now send request to passcode
                var passc =prompt("Enter Your Passcode");
               if( passc !==''){
                addLoader();
                    $.ajax({
                        url:'./all/checkPass.php',
                        type:'post',
                        data:{p:passc},
                        success:(data)=>{
                            remLoader();
                        if(data == 'yes'){
                            Swal.fire({
                                title: 'Are you sure?',
                                text: "You won't be able to revert this!",
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Yes, Update it!'
                              }).then((result) => {
                                if (result.isConfirmed) {
                                    addLoader();
                               $.ajax({
                                url:'./all/update-question.php',
                                type:'post',
                                data:$("#UpdateQuestion").serialize(),
                                success:(data)=>{
                                    remLoader();
                                    if(data == "success"){
                                        hideModal();
                                        toastr["success"]("Question has been updated.");
                                    load_question();
                                    }else{
                                        toastr["error"]("Failed to update question"+data);
                                    }
                                  
                                }
                               });
                                }
                              })
                        }else{
                            toastr["error"]("Passcode Not Match,Passcode is Wrong ?");
                            return false;
                        }
                        }
                    });
               }else{
                   return false;
               }
               }
            }
        }
    }
});

//delete question 
$(document).on("click",".deleteQuestion",function(e){
    var id= $(this).data('id');
    Swal.fire({
        title: 'Are you sure?',
        text: "You want to delete this permanently!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
       var ans = prompt("Enter your passcode to delete selected question?");
            if (ans !=='') {
                $.ajax({
                    url:'./all/checkPass.php',
                    type:'post',
                    data:{p:ans},
                    success:(data)=>{
                        if (data == "yes") {
                            $.ajax({
                                url:'./all/delete-question.php',
                                type:'post',
                                data:{id:id},
                                success:(data)=>{
                                    load_question();
                                    if(data=="success"){
                                        toastr["success"]("Question has been Deleted which id:"+id);
                                    }else{
                                        toastr["error"]("Failed to delete, which id:"+id);
                                    }
                                }
                            });
                        } else {
                            toastr["error"]("Passcode Not Match,Passcode is Wrong ?");
                        }
                    }
                });
            }else{
                return false;
            }
        }
      });
});
  
/* // =================now code for set answer each question =====*/
// fetch only question
$("#getQuestion").click(function(){
    if($("#searchQuestionForAns").val() <=0 || $("#searchQuestionForAns").val().trim().length <0){
        toastr["info"]("Enter Question valid ID.");
    }else{
        addLoader();
        $.ajax({
            url:'./all/fetch-question-data.php',
            type:'post',
            data:{id:$("#searchQuestionForAns").val()},
            success:(data)=>{
             $("#fetchedQuestion").val(data);
             remLoader();
            }
        });
    }
});



// now submit answer 
$("#addAnswer").on("submit",function(e){
e.preventDefault();
if($("#searchQuestionForAns").val() =='' || $("#searchQuestionForAns").val() <=0 || $("#searchQuestionForAns").val().trim().length <0 ){
    toastr['warning']("Please Validate Question ID , Must be Filed Question Id in Search box. if you are entred new id than must be search.");
}else{
    if($("#fetchedQuestion").val() =='' || $("#fetchedQuestion").val().trim().length <0 ){
        toastr["warning"]("Fetched Question Box Must be filed. for fill box search question");
    }else{
        if($("#ansText").val() =='' || $("#ansText").val().trim().length <= 0 ){
            toastr["info"]("Answer Box Must be Filed, with some or full explain words.");
        }else{
            if($("#formFileSm").val() !=='' || $("#formFileSm").val().trim().length > 0 ){
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You want save this answer ?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, save!'
                  }).then((result) => {
                    if (result.isConfirmed) {
                        // var fvalue= $('#addAnswer');
                        var fdata =  new FormData(this);
                        addLoader();
                    $.ajax({
                        url:'./all/save-answer.php',
                        enctype: 'multipart/form-data',
                        type:'post',
                        data:fdata,
                        processData: false,
                        contentType: false,
                        cache: false,
                        success:(data)=>{
                            remLoader();
                            if (data =="success") {
                                toastr["success"]("Answer has been saved!!!");
                                $('#addAnswer').trigger('reset');
                            }else{
                                toastr["error"](data);
                            }
                        }
                    });
                    }
                  });
            }else{
                toastr["info"]("You have not selected any document/media file.");
            }
        }
    }
}
});

 /* ============== find answer end edit ===== */
function LoadeSearchedAns(id){
    addLoader();
    $.ajax({
        url:'./all/load-ans-for-edit.php',
        type:'post',
        data:{id:id},
        success:(data)=>{
            remLoader();
            $(".allAnswerData").html(data);
        }
    });
}

$("#searchAnsWer").on("submit",function(e){
    e.preventDefault();
    if ($("#quid").val() =="") {
        alert("Please Enter Question ID, for Search Answer ?")
    } else {
        LoadeSearchedAns($("#quid").val());
    }
});

$(document).on("click",".EditAnswer",function(){
 var id = $(this).data('id');
 addLoader();
 $.ajax({
    url:'./all/load-ans-form-edit.php',
    type:'post',
    data:{id:id},
    success:(data)=>{
        ShowEditModal();
       $(".editModalBody").html(data);
       remLoader();
    }
 });
});

$(document).on("submit","#editAnswerForm",function(e){
    e.preventDefault();
    if ($("#EditansText").val()==''|| $("#EditansText").val().trim().length <=0) {
        toastr["warning"]("Please write a valid answer in Answer Box.");
    } else {
        var EditAnswerData =new FormData(this);
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, update it!'
          }).then((result) => {
            if (result.isConfirmed) {
                var passc = prompt("Enter Your Passcode to Validate ?");
                if (passc !=='') {
                    addLoader();
                    $.ajax({
                        url:'./all/checkPass.php',
                        type:'post',
                        data:{p:passc},
                        success:(data)=>{
                            remLoader();
                        if(data == 'yes'){
                            addLoader();
                          $.ajax({
                            url:'./all/update-ans.php',
                            type:'post',
                            data:EditAnswerData,
                            processData: false,
                            contentType: false,
                            cache: false,
                            success:(data)=>{
                                remLoader();
                                hideModal();
                                Swal.fire(
                                    'The Message?',
                                    data,
                                    'info'
                                  );
                                  LoadeSearchedAns($("#quid").val());
                            }
                          });
                        }else{
                            toastr["error"]("Passcode Not Match,Passcode is Wrong ?");
                            return false;
                        }
                    }
                    }); 
                }else{
                    return false;
                }
               
            }
          });
    }
});

// delete answer 
$(document).on("click",".DeleteAnswer",function(){
    var id = $(this).data('id');
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this! Final Delete !",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
            var passc = prompt("Enter Your Passcode to Validate ?");
            if( passc !== ''){
                $.ajax({
                    url:'./all/checkPass.php',
                    type:'post',
                    data:{p:passc},
                    success:(data)=>{
                            remLoader();
                            if(data =='yes'){
                                addLoader();
                                $.ajax({
                                    url:'./all/delete-ans.php',
                                    type:'post',
                                    data :{id:id},
                                    success:(data)=>{
                                        remLoader();
                                        cns(data);
                                        // in this LoadeSearchedAns function has search box value universal
                                        LoadeSearchedAns($("#quid").val());
                                        if(data == 222){
                                            toastr["success"]("Answe has been Deleted !!! Question ID"+id);
                                        }else if(data == 333){
                                            toastr["error"]("Failed to Delete Answer ??");
                                        }else if(data == 999){
                                            toastr["error"]("somethiong wrong to unlink photo ans can't Delete photos and Answer ?");
                                        } else{
                                            toastr["error"](data);
                                        }
                                    }
                                });
                            }else{
                                return false;
                            }
                        }
            });
            } else{
                toastr["error"]("Passcode Not Match,Passcode is Wrong ?");
                return false;
            }
       
        }
      })
});

// end of jquery
});

// validation of file selection for upload

function validFile(filedata){
    var datamsg ='';
    console.log(filedata.files.length);
    for (var i=0; i<filedata.files.length; i++) {
        var ext = filedata.files[i].name.substr(-3);
        if(ext!== "png" && ext!== "jpeg" && ext!== "jpg" && ext!== "gif")  {
            datamsg +='Not an accepted file extension.please Select only jpg,png,gif extension contain media file. \n';
            filedata.value='';
        }
    } 
    if(datamsg ==''){
    return false;
    }else{
        alert(datamsg);
    }  
}
