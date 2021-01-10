<?php
session_start();
//connect to DB
$conn = mysqli_connect('localhost', 'root', 'ntougibyhan', 'mytest');
if (!$conn) {
  die("Error connecting to database: " . mysqli_connect_error($conn));
  exit();
}


$class=$_POST['class'];
$query =("SELECT rule FROM board WHERE class='$class'  ");
$result =  $conn->query($query);


$arr = array();
while($row = $result->fetch_assoc())
{
 array_push($arr,$row);
}
 header("content-Type: application/json; charset=utf-8");
 echo json_encode($arr, JSON_UNESCAPED_UNICODE + JSON_PRETTY_PRINT);








?>