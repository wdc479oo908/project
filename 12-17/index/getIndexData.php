<?php // query_API.php
  session_start();
  include 'connect_db.php';
  $connect = new mysqli($host, $user, $passwd, $database);
  if ($connect->connect_error) die("連線失敗: " . $connect->connect_error);
  $connect->query("SET NAMES 'utf8'");



  $class = $_POST['class'];

  if(isset($_POST['class'])){
    if($class=="all")$query = "SELECT * FROM poster ORDER BY postDate DESC";
    else $query = "SELECT * FROM poster WHERE class = '$class' ORDER BY postDate DESC";
   $result =  $connect->query($query);
   
   $arr = array();
   while($row = $result->fetch_assoc())
  {
    array_push($arr,$row);
  }
    header("content-Type: application/json; charset=utf-8");
    echo json_encode($arr, JSON_UNESCAPED_UNICODE + JSON_PRETTY_PRINT);
   }
  else echo 'no class';
    
?>