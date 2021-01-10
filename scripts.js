$(document).ready(function(){

// if the user clicks on the like button ...
$('.like-btn').on('click', function(){
  var postId = $(this).data('postId');
  $clicked_btn = $(this);
  if ($clicked_btn.hasClass('fa-thumbs-o-up')) {
  	action = 'like';
  } else if($clicked_btn.hasClass('fa-thumbs-up')){
  	action = 'unlike';
  }
  $.ajax({
  	url: 'article.php',
  	type: 'post',
	
  	data: {
  		'action': action,
		  'postId': postId
		  
  	},
  	success: function(data){
  		 
		console.log(data);
		res = JSON.parse(data);
  		if (action == "like") {
  			$clicked_btn.removeClass('fa-thumbs-o-up');
  			$clicked_btn.addClass('fa-thumbs-up');
  		} else if(action == "unlike") {
  			$clicked_btn.removeClass('fa-thumbs-up');
  			$clicked_btn.addClass('fa-thumbs-o-up');
  		}
		
  		// display the number of likes and dislikes
  		$clicked_btn.siblings('span.likes').text(res.likes);
  		$clicked_btn.siblings('span.dislikes').text(res.dislikes);

  		// change button styling of the other button if user is reacting the second time to post
  		$clicked_btn.siblings('i.fa-thumbs-down').removeClass('fa-thumbs-down').addClass('fa-thumbs-o-down');
  	}
  });		

});





	$('.dislike-btn').on('click', function(){
		var postId = $(this).data('postId');
		$clicked_btn = $(this);
		if ($clicked_btn.hasClass('fa-thumbs-o-down')) {
			action = 'dislike';
		} else if($clicked_btn.hasClass('fa-thumbs-down')){
			action = 'undislike';
		}
		$.ajax({
			url: 'article.php',
			type: 'post',
		  
			data: {
				'action': action,
				'postId': postId
			},
			success: function(data){
				
			  res = JSON.parse(data);
				if (action == "dislike") {
					$clicked_btn.removeClass('fa-thumbs-o-down');
					$clicked_btn.addClass('fa-thumbs-down');
				} else if(action == "undislike") {
					$clicked_btn.removeClass('fa-thumbs-down');
					$clicked_btn.addClass('fa-thumbs-o-down');
				}
				// display the number of likes and dislikes
			  
				$clicked_btn.siblings('span.likes').text(res.likes);
				$clicked_btn.siblings('span.dislikes').text(res.dislikes);
				
				// change button styling of the other button if user is reacting the second time to post
				$clicked_btn.siblings('i.fa-thumbs-up').removeClass('fa-thumbs-up').addClass('fa-thumbs-o-up');
			}
		});	
	  
	  });


// if the user clicks on the dislike button ...

$('.like-btn2').on('click', function(){
	var postId = $(this).data('postId');
	var comment_ID=  $(this).data('id');
	$clicked_btn = $(this);
	if ($clicked_btn.hasClass('fa-thumbs-o-up')) {
		action = 'like';
	} else if($clicked_btn.hasClass('fa-thumbs-up')){
		action = 'unlike';
	}
	$.ajax({
		url: 'article.php',
		type: 'post',
	  
		data: {
			'action2': action,
			'postId': postId,
			'comment_ID': comment_ID
		},
		success: function(data){
			 
		  console.log(data);
		  res = JSON.parse(data);
			if (action == "like") {
				$clicked_btn.removeClass('fa-thumbs-o-up');
				$clicked_btn.addClass('fa-thumbs-up');
			} else if(action == "unlike") {
				$clicked_btn.removeClass('fa-thumbs-up');
				$clicked_btn.addClass('fa-thumbs-o-up');
			}
		  
			// display the number of likes and dislikes
			$clicked_btn.siblings('span.likes2').text(res.likes);
			$clicked_btn.siblings('span.dislikes2').text(res.dislikes);
  
			// change button styling of the other button if user is reacting the second time to post
			$clicked_btn.siblings('i.fa-thumbs-down').removeClass('fa-thumbs-down').addClass('fa-thumbs-o-down');
		}
	});		
  
  });

  $('.dislike-btn2').on('click', function(){
	var postId = $(this).data('postId');
	var comment_ID=  $(this).data('id');
	$clicked_btn = $(this);
	if ($clicked_btn.hasClass('fa-thumbs-o-down')) {
		action = 'dislike';
	} else if($clicked_btn.hasClass('fa-thumbs-down')){
		action = 'undislike';
	}
	$.ajax({
		url: 'article.php',
		type: 'post',
	  
		data: {
			'action2': action,
			'postId': postId,
			'comment_ID': comment_ID
		},
		success: function(data){
			
		  res = JSON.parse(data);
		  console.log(data);
			if (action == "dislike") {
				$clicked_btn.removeClass('fa-thumbs-o-down');
				$clicked_btn.addClass('fa-thumbs-down');
			} else if(action == "undislike") {
				$clicked_btn.removeClass('fa-thumbs-down');
				$clicked_btn.addClass('fa-thumbs-o-down');
			}
			// display the number of likes and dislikes
		  
			$clicked_btn.siblings('span.likes2').text(res.likes);
			$clicked_btn.siblings('span.dislikes2').text(res.dislikes);
			
			// change button styling of the other button if user is reacting the second time to post
			$clicked_btn.siblings('i.fa-thumbs-up').removeClass('fa-thumbs-up').addClass('fa-thumbs-o-up');
		}
	});	
  
  });




});
