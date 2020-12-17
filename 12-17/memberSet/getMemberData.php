<?php // query_API.php
  session_start();
  include 'connect_db.php';
  $connect = new mysqli($host, $user, $passwd, $database);
  if ($connect->connect_error) die("連線失敗: " . $connect->connect_error);
  $connect->query("SET NAMES 'utf8'");


  // $name=$_SESSION['accountName'];
  // $query  = "SELECT * FROM register WHERE accountName LIKE '$name' ";
  // $result = $connect->query($query);
  // if (!$result) die("Fatal Error");

  // $rows = $result->num_rows;
  
  // $arr = array();

  // for ($j = 0 ; $j < $rows ; $j++)
  // {
  //   $result->data_seek($j);
  //   $row = $result->fetch_assoc();
  //   array_push($arr,$row);
  // }
  
  // //set encoding
  // header("content-Type: application/json; charset=utf-8");

  // //convert to json
  // echo json_encode($arr, JSON_UNESCAPED_UNICODE + JSON_PRETTY_PRINT);

  // // $result->close();
  // // $connect->close();
  $accountName = $_SESSION['accountName'];
  if($accountName)
  {
   $query = "SELECT * FROM register WHERE accountName = '$accountName'";
   $result =  $connect->query($query);
   $arr = array();
   while($row = $result->fetch_assoc())
   {
    array_push($arr,$row);
    }

    $query = "SELECT * FROM member WHERE accountName = '$accountName'";
   $result1 =  $connect->query($query);
   while($row1 = $result1->fetch_assoc())
   {
    array_push($arr,$row1);
    }
    if(!isset($arr[1]['gender'])) $arr[1]['gender']= null;
    if(!isset($arr[1]['birthday'])) $arr[1]['birthday']= "";
    if(!isset($arr[1]['introction'])) $arr[1]['introction']= null;
    if(!isset($arr[1]['picture'])) $arr[1]['picture']= "memberPicture.png";
    
    header("content-Type: application/json; charset=utf-8");
    echo json_encode($arr, JSON_UNESCAPED_UNICODE + JSON_PRETTY_PRINT);
    
 }
 else echo "qqqqqq";
?>