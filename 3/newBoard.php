<?php
session_start();
//connect to DB
$conn = mysqli_connect('localhost', 'root', 'ntoukai', 'ntoudiscuss');
if (!$conn) {
  die("Error connecting to database: " . mysqli_connect_error($conn));
  exit();
}

$query=("select count(boardId) from  board ORDER BY boardId DESC LIMIT 0 , 1");

$Result=mysqli_query($conn, $query);

$result = mysqli_fetch_array($Result);

if($result){
    //$Result->data_seek(0);
    $count= 'brd'.substr((string)(substr($result[0][0],-3)+1001),-3);
}
else{
    $count='brd001';
}

$boardId=$count;
$class=$_POST['class'];
$hashtag='';

$query=("SELECT count(*) FROM poster WHERE class = '$class'");
$Result=mysqli_query($conn, $query);
$result = mysqli_fetch_array($Result);

$postNumber=$result[0][0];
$adminName=$_SESSION['accountName'];
$rule=$_POST['rule'];

$sql="INSERT INTO board(boardId,class,hashtag,postNumber,adminName,rule) 
             VALUES ('$boardId','$class','$hashtag',$postNumber,'$adminName','$rule')";
mysqli_query($conn, $sql);



?>



<script type="text/javascript"> 
        alert("新建成功"); 
        window.location.href="index.html"; 
</script>