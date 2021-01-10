<?php
session_start();

include 'connect_db.php';
$connect = new mysqli($host, $user, $passwd, $database);
if ($connect->connect_error) die("連線失敗: " . $connect->connect_error);
$connect->query("SET NAMES 'utf8'");

$name = isset($_POST["accountName"]) ? $_POST["accountName"] : $_GET["accountName"]; 
$password = isset($_POST["password"]) ? $_POST["password"] : $_GET["password"]; 


$result = $connect -> query("SELECT * FROM register WHERE accountName = '$name' and password = '$password'");

$count = $result -> num_rows;

if($count > 0){
	$row = $result->fetch_array();
	$nickname=$row['nickname'];
	$_SESSION['nickname']=$nickname;
	$_SESSION['accountName']=$name;
	echo 'qq';
}else{
    //若有這筆資料則回傳success
	echo 'success';
	//echo $row['first_name'].$row['last_name'];    for debug use
} 
?>
 