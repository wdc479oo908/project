<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>註冊PHP</title>
    <link rel="stylesheet" href="register.css">
</head>
    <body background="blue-snow.png">
    </body>
</html>
<?php session_start(); ?>
<?php
include("connect_register.php");

$accountId;
$email=$_POST['email']; 
$accountName=$_POST['accountName'];
$password=$_POST['password1'];
$nickname=$_POST['nickname'];


// $Result = $connect->query("select * from register ORDER BY accountId DESC LIMIT 0 , 1");
// if($Result){
//     $Result->data_seek(0);
//     $count= 'user'.substr((string)(substr($Result->fetch_array()['accountId'],-3)+1001),-3);
// }
// else{
//     $count='user001';
// }



// $insertSql = "INSERT INTO register (accountID,accountName,email,password,nickname) VALUES ('$count','$accountName', '$email','$password','$nickname')";
// $status = $connect->query($insertSql);
// if ($status) {
//     echo '新增成功'.'<br>';
// } 
// else {
//     echo "錯誤: " . $insertSql . "<br>" . $connect->error;
// }  

$selectSql = "SELECT * FROM register";
$memberData = $connect->query($selectSql);
//有資料筆數大於0時才執行
if ($memberData->num_rows > 0) {
//讀取剛才取回的資料
    while ($row = $memberData->fetch_assoc()) {
    	echo '<br>';
		foreach($row as $key=>$value)
		echo $key.'&ensp;'.'&ensp;'." -->> ".'&ensp;'.'&ensp;'.$value.'<br>';
        // print_r($row);
    }
}
else{
    echo '0筆資料';
}

?>