<?php
require('database_connection/connection.inc.php');
require('php/include_server.php');


?>

<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feeds</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">

    

    <link rel="stylesheet" type="text/css" href="css/feed.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script src="https://kit.fontawesome.com/90dbf666eb.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" ></script>
    
</head>
<body>
	
	<section>
		<div class="container">
			<h4 class="mb-4"> <?php  if(isset($_SESSION['USER_NAME'])){  echo "Welcome: ".$_SESSION['USER_NAME']; }else{} ?> </h4>
			
			<button type="button"  class="btn btn-danger"><a style="text-decoration: none;color: white;" href="logout.php"> Logout</a></button>
			
			<div class="row ">
				<?php
					$product_query = "select * from feeds";
					$product_query_run=mysqli_query($connection,$product_query);
					$product_array=array();
					while ($row=mysqli_fetch_assoc($product_query_run)) {
						$product_array[]=$row;
					}
				?>
				<?php
					foreach ($product_array as $list) {
				?>	
					<div class="card gy-3">
						<div class="card-header">
						    News Feed's
						</div>
						<div class="card-body">
						    <h3 class="card-title"><?php echo $list['feed_title']; $title_name=$list['feed_title']; ?></h3>
						    <p class="card-text"><?php echo $list['feed_text'] ?></p>
							<form method="POST">
							<div class="my-3">
								<?php
					$feedId=$list['feed_id'];
					$like_query = "select user_id from likes where likes.user_id = '$usernameforcomment' and post_id = '$feedId'";
					$like_query_run=mysqli_query($connection,$like_query);
					$likes_array=mysqli_fetch_assoc($like_query_run);
					 $liked=mysqli_num_rows($like_query_run);

				?>
				
								
				<?php if($liked < 1){ 
					echo '<button type="input" name="add_like" class="btn btn-primary my-3" style="float: left;">❤ Like</button>
					 ';
				} else{
				echo '<button  name="add_dislike" type="input" class="btn btn-primary my-3" style="float: left;">💔 Dislike</button>';
			}

				?>
									
									
								
							</div>
							<textarea rows="2" name="comment" style="width: 100%" placeholder="Add Public Comment"></textarea>

							<input type="text" name="commentfor" hidden value=<?php echo $list['feed_title'];  ?>  >
							<input type="text" name="postId" hidden value=<?php echo $list['feed_id'];  ?>  >
							<button type="submit" name="add_comment" class="btn btn-primary" style="float: right;">Add Comment</button>
							</form>

							<div class="my-4">
								<h5><b>Comments</b></h5>
							<?php
																						
								$comment_query="select * from comments where comment_feed_title='$title_name'";
								$comment_query_run=mysqli_query($connection,$comment_query);
								$comment_array=array();
								while ($row_comment=mysqli_fetch_assoc($comment_query_run)) {
									$comment_array[]=$row_comment;
								}
							
							?>
							<?php
								foreach ($comment_array as $comment_post) {
							?>
							<p><b><?php echo $comment_post['commenter_name']?></b>: <?php echo $comment_post['comment'] ?></p>
							<?php } ?>
						</div>
					</div>
				<?php } ?>
			</div>
		</div>
						
	</section>
	
	
	
	
	
</body>
</html>

