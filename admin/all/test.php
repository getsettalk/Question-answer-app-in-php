<?php
require('config.php');
require('top-fun.php');

$sql ="SELECT * FROM `chapter` where c_id =4 ";
$run = mysqli_query($conn,$sql) or die($conn->error);
$row = mysqli_fetch_assoc($run);
// print_r($row);
$metakey = $row['key_name'];
$str_arr = preg_split ("/\,/", $metakey); 
// prt($str_arr);

foreach($str_arr as $x => $val) {
    echo "$val<br>";
  }
?>