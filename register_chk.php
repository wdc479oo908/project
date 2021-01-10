<?php

include 'connect_db.php';
$connect = new mysqli($host, $user, $passwd, $database);
if ($connect->connect_error) die("連線失敗: " . $connect->connect_error);
$connect-> query("SET NAMES 'utf8'");

$accountName = isset($_POST["accountName"]) ? $_POST["accountName"] : $_GET["accountName"];
$email = isset($_POST["email"]) ? $_POST["email"] : $_GET["email"]; 
$password1 = isset($_POST["password1"]) ? $_POST["password1"] : $_GET["password1"]; 
$password2 = isset($_POST["password2"]) ? $_POST["password2"] : $_GET["password2"]; 
$nickname = isset($_POST["nickname"]) ? $_POST["nickname"] : $_GET["nickname"]; 

$result = $connect -> query("SELECT * FROM register WHERE accountName = '$accountName'");
$count = $result -> num_rows;


if($count > 0){
	echo 'qq';
}else if($password1==$password2){
    if($count>0){
         $count='user001';
    }
	else{
        $Result = $connect->query("select * from register ORDER BY accountId DESC LIMIT 0 , 1");
        $Result->data_seek(0);
        $count= 'user'.substr((string)(substr($Result->fetch_array()['accountId'],-3)+1001),-3);
    }
    $insertSql = "INSERT INTO register (accountId,accountName,email,password,nickname) VALUES ('$count','$accountName', '$email','$password1','$nickname')";
    $status = $connect->query($insertSql);
	echo 'success';
}
else{
    echo 'qq1';
} 

?>
 