<?php 
// connect to database
 include 'connect_db.php';
$conn = new mysqli($host, $user, $passwd, $database);
  if ($conn->connect_error) die("連線失敗: " . $conn->connect_error);
  $conn->query("SET NAMES 'utf8'"); 

session_start();
// lets assume a user is logged in with id $user_id
$accountId = $_SESSION['accountName'];
$postId = $_SESSION['postId'];

if (!$conn) {
  die("Error connecting to database: " . mysqli_connect_error($conn));
  exit();
}

// if user clicks like or dislike button
if (isset($_POST['action'])) {
  
  global $postId;
  $action = $_POST['action'];
  switch ($action) {
  	case 'like':
         $sql="INSERT INTO rating_info (accountId, postId, rating_action) 
         	   VALUES ('$accountId', '$postId', 'like') 
         	   ON DUPLICATE KEY UPDATE rating_action='like'";
         break;
  	case 'dislike':
          $sql="INSERT INTO rating_info (accountId, postId, rating_action) 
               VALUES ('$accountId', '$postId', 'dislike') 
         	   ON DUPLICATE KEY UPDATE rating_action='dislike'";
         break;
  	case 'unlike':
	      $sql="DELETE FROM rating_info WHERE accountId='$accountId' AND postId='$postId'";
	      break;
  	case 'undislike':
      	  $sql="DELETE FROM rating_info WHERE accountId='$accountId' AND postId='$postId'";
      break;
  	default:
  		break;
  }

  // execute query to effect changes in the database ...
  mysqli_query($conn, $sql);
  echo getRating($postId);

  exit(0);
}

// Get total number of likes for a particular post
function getLikes($id)
{
  global $conn;
  $sql = "SELECT COUNT(*) FROM rating_info 
  		  WHERE postId = '$id' AND rating_action='like'";
  $rs = mysqli_query($conn, $sql);
  $result = mysqli_fetch_array($rs);
  
  return $result[0];
}

// Get total number of dislikes for a particular post
function getDislikes($id)
{
  global $conn;
  $sql = "SELECT COUNT(*) FROM rating_info 
  		  WHERE postId = '$id' AND rating_action='dislike'";
  $rs = mysqli_query($conn, $sql);
  $result = mysqli_fetch_array($rs);
  return $result[0];
}

// Get total number of likes and dislikes for a particular post
function getRating($id)
{
  global $conn;
  $rating = array();
  $likes_query = "SELECT COUNT(*) FROM rating_info WHERE postId = '$id' AND rating_action='like'";
  $dislikes_query = "SELECT COUNT(*) FROM rating_info 
		  			WHERE postId = '$id' AND rating_action='dislike'";
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
function userLiked($postId)
{
  global $conn;
  global $accountId;
  $sql = "SELECT * FROM rating_info WHERE accountId='$accountId'
  		  AND postId='$postId' AND rating_action='like'";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
  	return true;
  }else{
  	return false;
  }
}

// Check if user already dislikes post or not
function userDisliked($postId)
{
  global $conn;
  global $accountId;
  $sql = "SELECT * FROM rating_info WHERE accountId='$accountId'
  		  AND postId='$postId' AND rating_action='dislike'";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
  	return true;
  }else{
  	return false;
  }
}

$sql = "SELECT * FROM poster WHERE postId='$postId'";

$result = $conn->query($sql);
 if (!$result) {
            printf("Error");
            exit();
        }
// fetch all posts from database
// return them as an associative array called $posts
$posts = mysqli_fetch_array($result, MYSQLI_ASSOC);



