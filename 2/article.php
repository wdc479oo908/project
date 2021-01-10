<?php include('server.php'); ?>
<?php include('server_comment.php'); ?>
<?php include('favorite_follow.php'); ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>文章</title>
    <link rel="stylesheet" href="article.css">
    <script src="jquery-3.5.1.js"></script>
    <script src='//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js'></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	
</head>

<body background="blue-snow.png">
    <div id="d1">
        <div id="d1-1"><span id="s1"><a href="index.html" style="text-decoration:none;color: white;">海大討論區</a></span></div>
        <div id="d1-2">
            <button type="button" class="butt1" id='butt1-0' onclick="javascript:location.href='favorite_article.html'"></button>
			<button type="button" class="butt1" id='butt1-1' onclick="javascript:location.href='post.html'"></button>
            <button type="button" class="butt1" id='butt1-3' onclick="javascript:location.href='memberSet.html'"></button>
            <button type="button" class="butt1" id='butt1-4'></button>
        </div>
    </div>
    <div id='d1-3'>
        <table id='feature' >
            <tr class='feature'><td id='logout' >登出</td></tr>
            <tr class='feature'><td id='otherFeature' onclick="javascript:location.href='follow_member.html'">追蹤</td></tr>
			<tr class='feature'><td id='check'  onclick="javascript:location.href='check_article.html'">審核</td></tr>
        </table>
    </div>
    <div id="d2">
        <span id="post_nickname">暱稱</span><br>
        <span id="post_accountName">@帳號</span><br>
        <span id="post_date">發布日期</span><br><br>
        <span id="post_title">標題</span>
        <span id="delete_article">
        <form action="delete.php" method="POST">
            <button type="submit" class="butt2" id="delete_button">
               刪除文章
            </button>
		<form  method="post" action="favorite_follow.php" > 
      	
		<div class="post-fafo">
		<i <?php if (userFavorited($posts['postId'])): ?>
      		  class="fa fa-star favorite-btn"
      	  <?php else: ?>
      		  class="fa fa-star-o favorite-btn"
      	  <?php endif ?>
      	  data-id="<?php echo $posts['postId'] ?>"></i>
			<span class="favorites">收藏文章</span>
		
      	&nbsp;&nbsp;&nbsp;&nbsp;

      	<i 
      	  <?php if (userFollowed($posts['postId'])): ?>
      		  class="fa fa-heart follow-btn"
      	  <?php else: ?>
      		  class="fa fa-heart-o follow-btn"
      	  <?php endif ?>
      	  data-id="<?php echo $posts['postId'] ?>"></i>
		  <span class="follows">追蹤作者</span>
		</div>
        </form>
        </span>
        <hr>
        <div id="d2-2">
			<img id="img1">
        </div>
        <span id="post_context">內文</span>
		
        <div class="posts-wrapper">
	
		
   	<div class="post">
     
      <div class="post-info">
	    <!-- if user likes post, style button differently -->
      	<i <?php if (userLiked($posts['postId'])): ?>
      		  class="fa fa-thumbs-up like-btn"
      	  <?php else: ?>
      		  class="fa fa-thumbs-o-up like-btn"
      	  <?php endif ?>
      	  data-id="<?php echo $post['postId'] ?>"></i>
      	<span class="likes"><?php echo getLikes($posts['postId']); ?></span>
      	
      	&nbsp;&nbsp;&nbsp;&nbsp;

	    <!-- if user dislikes post, style button differently -->
      	<i 
      	  <?php if (userDisliked($posts['postId'])): ?>
      		  class="fa fa-thumbs-down dislike-btn"
      	  <?php else: ?>
      		  class="fa fa-thumbs-o-down dislike-btn"
      	  <?php endif ?>
      	  data-id="<?php echo $post['postId'] ?>"></i>
      	<span class="dislikes"><?php echo getDislikes($posts['postId']); ?></span>
      </div>
   	</div>
  
  
  
        <div id="d3">
          
        </div>
        <div >
            <span id="accountName"></span>
            <span id="commentTime"></span>
            <span id="comment"></span>
            <span id="likenum"></span>
            <span id="dislikenum"></span>
        </div>
        <div>
            <form  method="post" action="comment.php" >  
                <textarea id="comment"  name="comment" placeholder="留言....."  maxlength="350"  required ></textarea>
				<input type="checkbox" name="check"  value=1  />匿名留言				
               <button  type="submit" >留言</button>
               
            </form>
                <!--<span id = 'tbody1' name='tbody1' class='tbody1' ></span>-->
               <div class="posts-wrapper">
	<?php foreach ($comments as $comment): ?>       
    <div class="post">
        <?php echo '<hr/>@'.$comment['accountName'];?>
        <?php echo '<br>';?>
        <?php echo $comment['commentTime'];?>
        <?php echo '<br>';?> 
        <?php echo $comment['comment'];    ?>


        <div class="post-info">
     <!-- if user likes post, style button differently -->
       <i <?php if (userLiked2($comment['comment_ID'])): ?>
             class="fa fa-thumbs-up like-btn2"
         <?php else: ?>
             class="fa fa-thumbs-o-up like-btn2"
         <?php endif ?>
         data-id="<?php echo $comment['comment_ID'] ?>"></i>
       <span class="likes2"><?php echo getLikes2($comment['comment_ID']); ?></span>
       
       &nbsp;&nbsp;&nbsp;&nbsp;

     <!-- if user dislikes post, style button differently -->
       <i 
         <?php if (userDisliked2($comment['comment_ID'])): ?>
             class="fa fa-thumbs-down dislike-btn2"
         <?php else: ?>
             class="fa fa-thumbs-o-down dislike-btn2"
         <?php endif ?>
         data-id="<?php echo $comment['comment_ID'] ?>"></i>
       <span class="dislikes2"><?php echo getDislikes2($comment['comment_ID']); ?></span>
   </div>
    </div>

    <?php endforeach?> 
</div>
       



        </div>
            
    </div>
         
  <script src="scripts.js"></script>
    <script src='article.js'></script>
</body>

</html>
 