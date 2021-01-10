 <?php // query_API.php
    session_start();
    include 'connect_db.php';
    $connect = new mysqli($host, $user, $passwd, $database);
    if ($connect->connect_error) die("連線失敗: " . $connect->connect_error);
    $connect->query("SET NAMES 'utf8'");

	
    $postId=$_SESSION['postId'];
    $query="UPDATE poster set status=1	where postId = '$postId'";
     $connect->query($query);
    

?>

<script type="text/javascript"> 
        alert("審核通過"); 
        window.location.href="check_article.html"; 
</script>