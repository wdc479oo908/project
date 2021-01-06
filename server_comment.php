<?php 
// connect to database
 include 'connect_db.php';
$conn = new mysqli($host, $user, $passwd, $database);
  if ($conn->connect_error) die("連線失敗: " . $conn->connect_error);
  $conn->query("SET NAMES 'utf8'"); 


// lets assume a user is logged in with id $user_id
$accountId = $_SESSION['accountName'];
$postId = $_SESSION['postId'];


if (!$conn) {
  die("Error connecting to database: " . mysqli_connect_error($conn));
  exit();
}

// if user clicks like or dislike button
if (isset($_POST['action2'])) {
  $comment_ID = $_POST['comment_ID'];
 // global $postId;
 // global $accountId;
  $action = $_POST['action2'];
  switch ($action) {
  	case 'like':
         $sql="INSERT INTO rating_com (accountId, postId, comment_ID, rating_action) 
         	   VALUES ('$accountId', '$postId','$comment_ID', 'like') 
         	   ON DUPLICATE KEY UPDATE rating_action='like'";
         break;
  	case 'dislike':
          $sql="INSERT INTO rating_com (accountId, postId, comment_ID, rating_action) 
               VALUES ('$accountId', '$postId','$comment_ID', 'dislike') 
         	   ON DUPLICATE KEY UPDATE rating_action='dislike'";
         break;
  	case 'unlike':
	      $sql="DELETE FROM rating_com WHERE accountId='$accountId' AND comment_ID='$comment_ID'";
	      break;
  	case 'undislike':
      	  $sql="DELETE FROM rating_com WHERE accountId='$accountId' AND comment_ID='$comment_ID'";
      break;
  	default:
  		break;
  }

  // execute query to effect changes in the database ...
  mysqli_query($conn, $sql);
  echo getRating2($comment_ID);

  exit(0);
}

// Get total number of likes for a particular post
function getLikes2($id)
{
  global $conn;
  $sql = "SELECT COUNT(*) FROM rating_com 
  		  WHERE comment_ID = '$id' AND rating_action='like'";
  $rs = mysqli_query($conn, $sql);
  $result = mysqli_fetch_array($rs);
  
  return $result[0];
}

// Get total number of dislikes for a particular post
function getDislikes2($id)
{
  global $conn;
  $sql = "SELECT COUNT(*) FROM rating_com 
  		  WHERE comment_ID = '$id' AND rating_action='dislike'";
  $rs = mysqli_query($conn, $sql);
  $result = mysqli_fetch_array($rs);
  return $result[0];
}

// Get total number of likes and dislikes for a particular post
function getRating2($id)
{
  global $conn;
  $rating = array();
  $likes_query = "SELECT COUNT(*) FROM rating_com WHERE comment_ID = '$id' AND rating_action='like'";
  $dislikes_query = "SELECT COUNT(*) FROM rating_com 
		  			WHERE comment_ID = '$id' AND rating_action='dislike'";
  $likes_rs = mysqli_query($conn, $likes_query);
  $dislikes_rs = mysqli_query($conn, $dislikes_query);
  $likes = mysqli_fetch_array($likes_rs);
  $dislikes = mysqli_fetch_array($dislikes_rs);
  $rating = [
  	'likes' => $likes[0],
  	'dislikes' => $dislikes[0]
  ];
  return json_encode($rating);
}

// Check if user already likes post or not
function userLiked2($comment_ID)
{
  global $conn;
  global $accountId;
  $sql = "SELECT * FROM rating_com WHERE accountId='$accountId'
  		  AND comment_ID='$comment_ID' AND rating_action='like'";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
  	return true;
  }else{
  	return false;
  }
}

// Check if user already dislikes post or not
function userDisliked2($comment_ID)
{
  global $conn;
  global $accountId;
  $sql = "SELECT * FROM rating_com WHERE accountId='$accountId'
  		  AND comment_ID='$comment_ID' AND rating_action='dislike'";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
  	return true;
  }else{
  	return false;
  }
}


$query = " select * from poster natural right join comment  where comment.postId='$postId'";
  $result =  $conn->query($query);
    
$comments = mysqli_fetch_all($result, MYSQLI_ASSOC);



