<?php
session_start();
    session_destroy();
    unset($_SESSION['auth']);
    unset($_SESSION['adminName']);
    unset($_SESSION['aid']);
    header('location:ad-login.php');
?>