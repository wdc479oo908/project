<?php // query_API.php
  session_start();
  include 'connect_db.php';
  $connect = new mysqli($host, $user, $passwd, $database);
  if ($connect->connect_error) die("連線失敗: " . $connect->connect_error);
  $connect->query("SET NAMES 'utf8'");



  $postId = $_SESSION['postId'];

  if(!isset($_SESSION['postId'])){
    echo 'no postId';
    return;
  }

  $query = "SELECT * FROM poster WHERE postId = '$postId' ";
  
  $result =  $connect->query($query);
  $row = $result->fetch_assoc();
  
  if($_SESSION['accountName']==$row['accountName'])echo 1;
  else echo 0;
   
?>