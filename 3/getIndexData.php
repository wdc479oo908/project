<?php // query_API.php
  session_start();
  include 'connect_db.php';
  $connect = new mysqli($host, $user, $passwd, $database);
  if ($connect->connect_error) die("連線失敗: " . $connect->connect_error);
  $connect->query("SET NAMES 'utf8'");



  $class = $_POST['class'];
	$sort = $_POST['sort'];

  if(isset($_POST['class'])){
    if($class=="all" && $sort=="1")$query = "SELECT * FROM poster WHERE  status=1 ORDER BY postDate DESC";
    else if($class=="all" && $sort=="2")$query = "SELECT * FROM poster WHERE status=1 ORDER BY good DESC , postDate DESC";
    else if($class!="all" && $sort=="1")$query = "SELECT * FROM poster WHERE class = '$class' AND status=1 ORDER BY postDate DESC";
    else if($class!="all" && $sort=="2")$query = "SELECT * FROM poster WHERE class = '$class' AND status=1 ORDER BY good DESC , postDate DESC";
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