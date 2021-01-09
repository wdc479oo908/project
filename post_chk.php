<?php
	session_start();
	include 'connect_db.php';
	$connect = new mysqli($host, $user, $passwd, $database);
	if ($connect->connect_error) die("連線失敗: " . $connect->connect_error);
	$connect->query("SET NAMES 'utf8'");


	// if(
	// 	isset($_POST['class'])&&
	// 	isset($_POST['title'])&&
	// 	isset($_POST['context'])&&
	// 	isset($_FILES['picture'])
	// ){
	// 	$class = $_POST['class'];
	// 	$title = $_POST['title'];
	// 	$context = $_POST['context'];
	// 	//$picture_name = $_POST['picture']['name'];
	// 	echo 'success';
	// }
	// else echo $class.'____'.$_SESSION['accountName'];

	// if($_SESSION['accountName'])
	// {
	// 	$accountName =$_SESSION['accountName'];
	// }else{
	// 	$accountName ='no session';
	// }
	foreach ($_FILES["myFile"]["error"] as $key => $error) {
		if($error == 0){
			$name = $_FILES["myFile"]["name"][$key];
			$type = $_FILES["myFile"]["type"][$key];
			$uploadPath = "picture/" . $name;
			if(move_uploaded_file( $_FILES["myFile"]["tmp_name"][$key], $uploadPath)){
				//echo "<a href='".$uploadPath."' target='_BLANK'>".$name."</a><br>";
				//echo $_POST['class'];
				//echo $_FILES["myFile"]["tmp_name"][0] ;
				//return;
		    }
		}
		else {
			echo 'error';
			return;
		}
	}
	$result = $connect -> query("SELECT * FROM poster");
	$count = $result -> num_rows;
	$postId;
	if($count>0){
		$Result = $connect->query("select * from poster ORDER BY postId DESC LIMIT 0 , 1");
    	if($Result){
	        $Result->data_seek(0);
	        $postId = 'post'.substr((string)(substr($Result->fetch_array()['postId'],-8)+100000001),-8);
	    }
	}
	else $postId='post00000001';

	// $tmp_name = $_FILES['myFile']['tmp_name'][0];
	// $size= $_FILES['myFile']['size'][0];
	
	$picture = "picture/" . $_FILES["myFile"]["name"][0];
	$class=$_POST['class'];
	$title=$_POST['title'];
	$context=$_POST['context'];
	$nickname=$_SESSION['nickname'];
	$accountName=$_SESSION['accountName'];

	$good = 0;
	$dislike = 0;
	$postDate = date("Y-m-d H:i:s",mktime(date('H')+7,date('i'),date('s'),date('m'),date('d'),date('Y'))) ;


	$insertSql = "INSERT INTO poster (accountName,class,postId,postDate,picture,title,good,dislike,context,nickname) VALUES ('$accountName','$class','$postId','$postDate','$picture','$title','$good','$dislike','$context','$nickname')";
    $status = $connect->query($insertSql);

	if ($status)echo 'success';

?>
