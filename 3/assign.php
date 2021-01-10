<?php // query_API.php
  //session_start();
  include 'connect_db.php';
  $connect = new mysqli($host, $user, $passwd, $database);
  if ($connect->connect_error) die("連線失敗: " . $connect->connect_error);
  $connect->query("SET NAMES 'utf8'");



  $accountName = $_POST['accountName'];

  $query = "UPDATE register SET identity='1' WHERE accountName = '$accountName' ";
  
  $result =  $connect->query($query);
  
  
?>
<script>
	window.location.href="index.html";
	</script>