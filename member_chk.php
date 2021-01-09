<?php // query_API.php
  session_start();
  include 'connect_db.php';
  $connect = new mysqli($host, $user, $passwd, $database);
  if ($connect->connect_error) die("連線失敗: " . $connect->connect_error);
  $connect->query("SET NAMES 'utf8'");

  $accountName = $_SESSION['accountName'];
  $password=$_POST['password'];
  $nickname=$_POST['nickname'];
  $birthday=$_POST['birthday'];
  $gender=$_POST['gender'];
  $introction=$_POST['introction'];

  if(isset($_FILES["myFile"]["name"][0])){
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
        echo 'picture error';
        return;
      }
    }
    $picture = "picture/" . $_FILES["myFile"]["name"][0];
  }
  if($accountName)
  {
    $result =  $connect->query("UPDATE register SET password = '$password',nickname='$nickname' WHERE accountName = '$accountName'");
    $result2 = $connect->query("SELECT * FROM member where accountName = '$accountName'");
    $count=$result2 -> num_rows;
    if( $count>0){
      if(isset($_FILES["myFile"]["name"][0])){
        $result3 =  $connect->query("UPDATE member SET birthday = '$birthday',gender='$gender' , introction = '$introction',picture = '$picture' where accountName = '$accountName'");
      }
      else{
        $connect->query("UPDATE member SET birthday = '$birthday',gender='$gender' , introction = '$introction' where accountName = '$accountName'");
      }
     
    }
    else{
      if(isset($_FILES["myFile"]["name"][0])){
        $insertSql = "INSERT INTO member (accountName,birthday,gender,introction,picture) VALUES ('$accountName','$birthday','$gender','$introction','$picture')";
        $status = $connect->query($insertSql);
      }
      else{
        $insertSql = "INSERT INTO member (accountName,birthday,gender,introction) VALUES ('$accountName','$birthday','$gender','$introction')";
        $status = $connect->query($insertSql);
      }
    }
    echo 'update success';
 }
 else echo "no name";
  //  $arr = array();
  //  while($row = $result->fetch_assoc())
  //  {
  //   array_push($arr,$row);
  // }
  //   header("content-Type: application/json; charset=utf-8");
  //   echo json_encode($arr, JSON_UNESCAPED_UNICODE + JSON_PRETTY_PRINT);
?>