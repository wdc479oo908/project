<?php 
  session_start();
  include 'connect_db.php';
  $connect = new mysqli($host, $user, $passwd, $database);
  if ($connect->connect_error) die("連線失敗: " . $connect->connect_error);
  $connect->query("SET NAMES 'utf8'");


  if(isset($_POST['email'])){
    $email=$_POST['email'];

    $query = "SELECT * FROM register WHERE email = '$email'";
    $result =  $connect->query($query);
    if(($result -> num_rows)>0){
      $row = $result->fetch_assoc(); 
      require_once "phpmailer/class.phpmailer.php";
      $mail = new PHPMailer();
      $mail->SMTPSecure = "ssl";
      $mail->Host = "smtp.gmail.com";
      $mail->Port = 465;
      $mail->CharSet = "utf-8";    //信件編碼
      $mail->Username = "ntou0320@gmail.com";        //帳號，例:example@gmail.com
      $mail->Password = "ab26712137";        //密碼
      $mail->IsSMTP();
      $mail->SMTPAuth = true;
      $mail->SMTPDebug  = 1;
      $mail->Encoding = "base64";
      $mail->IsHTML(true);     //內容HTML格式
      $mail->From = "ntou0320@gmail.com";        //寄件者信箱
      $mail->FromName = "海大討論區";    //寄信者姓名
      $mail->Subject = "找回密碼";     //信件主旨
      $mail->Body = "你的帳號是: ".$row["accountName"]."<br>"."你的密碼是: ".$row["password"];        //信件內容
      $mail->AddAddress($email);   //收件者信箱
      if($mail->Send()){
          echo "寄信成功";
      }else{
          echo "寄信失敗";
          //echo "Mailer Error: " . $mail->ErrorInfo;
      }
    }
    else{
      echo 'not find';
    }
  }

 //  if($accountName)
 //  {
 //   $query = "SELECT * FROM register WHERE accountName = '$accountName'";
 //   $result =  $connect->query($query);
 //   $arr = array();
 //   while($row = $result->fetch_assoc())
 //   {
 //    array_push($arr,$row);
 //    }

 //    $query = "SELECT * FROM member WHERE accountName = '$accountName'";
 //   $result1 =  $connect->query($query);
 //   while($row1 = $result1->fetch_assoc())
 //   {
 //    array_push($arr,$row1);
 //    }
 //    if(!isset($arr[1]['gender'])) $arr[1]['gender']= null;
 //    if(!isset($arr[1]['birthday'])) $arr[1]['birthday']= "";
 //    if(!isset($arr[1]['introction'])) $arr[1]['introction']= null;
 //    if(!isset($arr[1]['picture'])) $arr[1]['picture']= "memberPicture.png";
    
 //    header("content-Type: application/json; charset=utf-8");
 //    echo json_encode($arr, JSON_UNESCAPED_UNICODE + JSON_PRETTY_PRINT);
    
 // }
 // else echo "qqqqqq";
?>