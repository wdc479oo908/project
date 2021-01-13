<?php // query_API.php
    session_start();
    include 'connect_db.php';
    $connect = new mysqli($host, $user, $passwd, $database);
    if ($connect->connect_error) die("連線失敗: " . $connect->connect_error);
    $connect->query("SET NAMES 'utf8'");


    $postId=$_SESSION['postId'];
    $query="DELETE FROM comment WHERE postId = '$postId'";
    $connect->query($query);
	 $query="DELETE FROM rating_favorite WHERE postId = '$postId'";
     $connect->query($query);
	 $query="DELETE FROM rating_info WHERE postId = '$postId'";
     $connect->query($query);
	  $query="DELETE FROM rating_com WHERE postId = '$postId'";
     $connect->query($query);
    $query="DELETE FROM poster WHERE postId = '$postId'";
     $connect->query($query);
    

?>

<script type="text/javascript"> 
        alert("刪除成功"); 
        window.location.href="check_article.html"; 
</script>