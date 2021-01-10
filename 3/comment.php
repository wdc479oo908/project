<!doctype html> 
<html> 
<head> 
<meta charset="UTF-8"> 
<title>留言</title> 
</head> 
<body> 
<?php
 session_start();
 include 'connect_db.php';
 $connect = new mysqli($host, $user, $passwd, $database);
 if ($connect->connect_error) die("連線失敗: " . $connect->connect_error);
 $connect->query("SET NAMES 'utf8'");

$postId=$_SESSION['postId'];

$result = $connect -> query("SELECT * FROM comment"); 
$count = $result -> num_rows;


if($count==0){$count='cmt001';}
else{
    $Result = $connect->query("select * from comment ORDER BY comment_ID DESC LIMIT 0 , 1");
    $Result->data_seek(0);
    $count = 'cmt'.substr((string)(substr($Result->fetch_array()['comment_ID'],-3)+1001),-3);
}


if(isset($_POST["check"])){
	$accountName="匿名";
}
else{
	$accountName=$_SESSION['nickname'];
}
$comment_ID=$count;
$comment=$_POST['comment'];
//$time_query="select now()";
$time= date("Y-m-d H:i:s",mktime(date('H')+7,date('i'),date('s'),date('m'),date('d'),date('Y'))) ;//$db->query($time_query);//YYYY-MM-DD HH:MI:SS
$likenum=0;
$dislikenum=0;

$full_query="insert into comment values('$postId','$accountName','$comment_ID','$comment','$time','$likenum','$dislikenum')"; 
$stmt1=$connect->query($full_query);

?> 
<script type="text/javascript"> 
alert("留言成功"); 
window.location.href="article.php"; 
</script> 
</body> 
</html>