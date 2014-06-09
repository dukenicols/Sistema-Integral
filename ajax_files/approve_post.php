<?php
require_once ('../../core/classes/database.class.php');
require_once('../classes/posts.class.php');


$posts = new Posts();

$posts->rowid 	= $_POST['post'];
$posts->user_id = $_POST['user'];



if(isset($_POST)){
		
		if($data = $posts->approve_post())
		{
			print 'success';
		} 
		else
		{
			print 'error';
		}
	} 
	



?>