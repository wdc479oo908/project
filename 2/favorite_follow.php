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

 $sql = "SELECT accountName FROM poster WHERE postId='$postId'";
	$res = mysqli_query($conn, $sql);
	$Result = mysqli_fetch_array($res);
$authorName=$Result[0];


// if user clicks like or dislike button
if (isset($_POST['action'])) {
  
  global $postId;
  $action = $_POST['action'];
	

  switch ($action) {
  	case 'favorite':
         $sql="INSERT INTO rating_favorite (accountId, postId, rating_action) 
         	   VALUES ('$accountId', '$postId', 'favorite') 
         	   ON DUPLICATE KEY UPDATE rating_action='favorite'";
         break;
  	case 'follow':
          $sql="INSERT INTO rating_follow (accountId, authorName, rating_action) 
               VALUES ('$accountId', '$authorName', 'follow') 
         	   ON DUPLICATE KEY UPDATE rating_action='follow'";
         break;
  	case 'unfavorite':
	      $sql="DELETE FROM rating_favorite WHERE accountId='$accountId' AND postId='$postId'";
	      break;
  	case 'unfollow':
      	  $sql="DELETE FROM rating_follow WHERE accountId='$accountId' AND authorName='$authorName'";
      break;
  	default:
  		break;
  }

  // execute query to effect changes in the database ...
  mysqli_query($conn, $sql);

  exit(0);
}

// Get total number of likes for a particular post


// Get total number of dislikes for a particular post

// Get total number of likes and dislikes for a particular post


// Check if user already likes post or not
function userFavorited($postId)
{
  global $conn;
  global $accountId;
  $sql = "SELECT * FROM rating_favorite WHERE accountId='$accountId'
  		  AND postId='$postId' AND rating_action='favorite'";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
  	return true;
  }else{
  	return false;
  }
}

// Check if user already dislikes post or not
function userFollowed($postId)
{
  global $conn;
  global $accountId;
  $sql = "SELECT accountName FROM poster WHERE postId='$postId'";//文章作者
  $Result = mysqli_query($conn, $sql);
  global $authorName;
  $res=mysqli_fetch_row($Result);
  echo $res[0];
  $authorName=$res[0];
  echo $authorName;
  $sql = "SELECT * FROM rating_follow WHERE accountId='$accountId'and authorName='$authorName'
  		   AND rating_action='follow'";
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



