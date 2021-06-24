<?php
require('database_connection/connection.inc.php');

session_start();
if(empty($_SESSION['USER_NAME'])){
	$msh="You Need To Login First";
	echo $msh;
    exit();
}

$usernameforcomment=$_SESSION['USER_NAME'];

$fortitle="";

if (isset($_POST['add_comment'])) {
	$sql_for_username="select * from userdata where user_email='$usernameforcomment'";
	$res_for_feed_comment=mysqli_query($connection,$sql_for_username);
	$for_commenter_name=mysqli_fetch_assoc($res_for_feed_comment);
	$comment_writer=$for_commenter_name['user_name'];

	$commentfor_title =$_POST['commentfor'];
	$comment_insert=$_POST['comment'];

	$comment_query="insert into comments (commenter_name,comment_feed_title,comment) values ('$comment_writer','$commentfor_title','$comment_insert')";
	mysqli_query($connection,$comment_query);
}

if (isset($_POST['add_like'])) {
	$postId =$_POST['postId'];
	$comment_query="insert into likes (user_id, post_id) values ('$usernameforcomment', '$postId')";
	mysqli_query($connection,$comment_query);
}

if (isset($_POST['add_dislike'])) {
	$postId =$_POST['postId'];
	$comment_query="delete from likes where likes.post_id = '$postId' and likes.user_id = '$usernameforcomment'";
	mysqli_query($connection,$comment_query);
}



?>