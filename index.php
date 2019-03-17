<?php

session_start();
?>

<!doctype html>
<html>
	<head>
		<meta charset=utf-8>
		<meta name=description content="">
		<meta name=viewport content="width=device-width, initial-scale=1">
		<title>Snack</title>
		
		<link rel="icon" href="Bluecircle.jpg">
		<!-- Styles -->
		<link rel="stylesheet" type="text/css" href="css/jquery-comments.css">
		<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="css/style.css">

		<!-- Data -->
		<script type="text/javascript" src="data/comments-data.js"></script>

		<!-- Libraries -->
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.textcomplete/1.8.0/jquery.textcomplete.js"></script>
		<script type="text/javascript" src="js/jquery-comments.js"></script>
		

		<style type="text/css">
			body {
				padding: 15px;
				margin: 0px;
				font-size: 14px;
				font-family: "Arial", Georgia, Serif;
			}
		</style>

		<!-- Init jquery-comments -->
		<script type="text/javascript">
		function startSnack(){
			$(function() {
				var saveComment = function(data) {

					// Convert pings to human readable format
					$(data.pings).each(function(index, id) {
						var user = usersArray.filter(function(user){return user.id == id})[0];
						data.content = data.content.replace('@' + id, '@' + user.fullname);
					});

					return data;
				}
				$('#comments-container').comments({
					getUsers: function(success, error) {
						  $.ajax({
                              type: 'get',
                              url: 'includes/loadUsers.inc.php',
                              success: function(usersArray) {
                              	// alert(usersArray);
                                 success(JSON.parse(usersArray));
                              },
          			  error: error
                          });
						    },
					getComments: function(success, error) {						
						  $.ajax({
                              type: 'get',
                              url: 'includes/loadComments.inc.php',
                              success: function(commentsArray) {
                              	// alert(commentsArray);                  
                                 success(JSON.parse(commentsArray));   
                              },
            error: error
                          });
						    },
					postComment: function(commentJSON, success, error) {
							        $.ajax({
							            type: 'post',
							            url: 'includes/form.inc.php',
							            data: commentJSON,
							            success: function(comment) {
							            if(comment == "Not Logged in!"){
							       	    	alert("Login to Comment");
							       }else {
							       	//alert(comment);
											success(JSON.parse(comment));
										}
							            },
							            error: error
							        });
							    },
					putComment: function(commentJSON, success, error) {
								$.ajax({
						            type: 'post',
						            url: 'includes/editComment.inc.php',
						            data: commentJSON,
						            success: function(commentJSON) {
					            	// alert(commentJSON);
						                success(JSON.parse(commentJSON));
						            },
						            error: error
						        });
						    },
					deleteComment: function(commentJSON, success, error) {
						        $.ajax({
						            type: 'post',
						            url: 'includes/deleteComment.inc.php',
						            data: commentJSON,
						            success: success,
						            error: error
						        });
					},
				    upvoteComment: function(commentJSON, success, error) {
				        if(commentJSON.user_has_upvoted) {
				            $.ajax({
				                type: 'post',
				                url: 'includes/upvote.inc.php',
				                data:commentJSON,
				                success: function() {
				                   success(commentJSON); 
				                },
				                error: error
				            });
				        } else {
				        	
				            $.ajax({
				                type: 'post',
				                url: 'includes/downvote.inc.php',
				                data:commentJSON,
				                success: function(Yolo) {
				      //          	alert(Yolo);
				                   success(commentJSON); 
				                },
				                error: error
				            });
				        }
    

					},
					uploadAttachments: function(dataArray, success, error) {
						setTimeout(function() {
							success(dataArray);
						}, 500);
					},
				});
			});
}
				$('.my-form').on('submit', function () {
					alert('Form submitted!');
					return false;
				});
				
				// Ajax URL
				$(document).ready(function(){

					$(".Title").change(function(){
					var name = $(".Title").val();
					$.post("includes/title.inc.php", {
						suggestion: name
					}, function(data, status) {
						$("#test1").html(data);
					});
				});


				$(".Url").change(function(){
					var name = $(".Url").val();
					$.post("includes/url.inc.php", {
						suggestion: name
					}, function(data, status) {
						$("#test2").html(data);
						startSnack();
					});
				});
			});

		</script>

	</head>
	<body>
<?php include 'Header.php'; ?>


				<!-- Comment Section -->
<div id="comments-container"></div>

				<!-- MODAL -->
<?php include 'Modal.php'; ?>
	</body>
</html>