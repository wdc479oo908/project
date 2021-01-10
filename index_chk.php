<?php
session_start();

include 'connect_db.php';
$connect = new mysqli($host, $user, $passwd, $database);
if ($connect->connect_error) die("連線失敗: " . $connect->connect_error);
$connect->query("SET NAMES 'utf8'");



if(isset($_POST["postId"])){
	$_SESSION['postId']=$_POST["postId"];
	echo $_SESSION['postId']."---".$_SESSION['nickname'];
}
else{
	echo 'qq';
} 
?>