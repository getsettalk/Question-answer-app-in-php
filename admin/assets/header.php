<?php
session_start();
require('./all/config.php');
require('./all/top-fun.php');
if (!isset($_SESSION['auth'])) {
    header('location:'.$logoutLocation);
}else{
    $title ="";
    $filename =basename($_SERVER['PHP_SELF']);
   switch($filename){
       case "dash.php";
       $title= "Admin Dashboard";
       break;
       case "add-chapter.php";
       $title= "Admin: Add Chapter";
       break;
       case "add-question.php";
       $title= "Admin: Add Question";
       break;
       case "manage-question.php";
       $title= "Admin: Manage Question";
       break;
       case "add-answer.php";
       $title= "Admin: Upload Answer";
       break;
       case "manage-answer.php";
       $title= "Admin: Manage Answer";
       break;
   }
  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <header>
        <div class="logo">   <img src="assets/logo/logo1.png" alt="" srcset=""></div>
         <div class="wrapper d-none ">
            <nav  id="sidebar" class="d-none">
                <div class="weblogo">
                    <img src="<?php echo 'assets/admin-photo/'.$_SESSION['photo']; ?>" alt="userp">
                    <span> <?php echo $_SESSION['adminName']; ?> </span>
                </div>
                <ul>
                    <li><a href="dash" class="<?php if($filename =="dash.php"){echo "linkActive";} ?>"><i class="fa-solid fa-gauge-high"></i><span>Dashboard</span></a></li>
                    <li><a href="add-chapter" class="<?php if($filename =="add-chapter.php"){echo "linkActive";} ?>"><i class="fa-solid fa-bolt"></i> <span>Manage chapter</span></a></li>
                    <li><a href="manage-class" class="<?php if($filename =="manage-class.php"){echo "linkActive";} ?>"><i class="fa-solid fa-satellite-dish"></i> <span>Manage Class</span></a></li>
                    <li><a href="add-question" class="<?php if($filename =="add-question.php"){echo "linkActive";} ?>"><i class="fa-solid fa-clipboard-question"></i> <span>Add Question</span></a></li>
                    <li><a href="manage-question" class="<?php if($filename =="manage-question.php"){echo "linkActive";} ?>"><i class="fa-solid fa-list-check"></i> <span>Manage Question</span></a></li>
                    <li><a href="add-answer" class="<?php if($filename =="add-answer.php"){echo "linkActive";} ?>"><i class="fa-solid fa-voicemail"></i> <span>Add Answer</span></a></li>
                    <li><a href="manage-answer" class="<?php if($filename =="manage-answer.php"){echo "linkActive";} ?>"><i class="fa-solid fa-voicemail"></i> <span>Manage Answer</span></a></li>
                    <li><a href=""><i class="fa-solid fa-users"></i> <span>Manage User</span></a></li>
                    <li><a href="admin-profile" class="<?php if($filename =="admin-profile.php"){echo "linkActive";} ?>"><i class="fa-solid fa-user-shield"></i> <span>profile</span></a></li>
                    <li><a href="../logout?logout" class="<?php if($filename =="logout.php"){echo "linkActive";} ?>"><i class="fa-solid fa-right-from-bracket"></i> <span>Logout</span></a></li>
           
            </nav>
         </div>

        <div class="navbtn">
            <i class="fa-solid fa-bars"></i>
        </div>
    </header>
    <!--loader-->  
    <div id="divLoading" ></div>
    <?php } ?>