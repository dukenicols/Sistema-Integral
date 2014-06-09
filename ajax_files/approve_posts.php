<?php
require_once ('../../core/classes/database.class.php');
require_once('../classes/posts.class.php');


$posts = new Posts();

$posts2		    = $_POST['posts'];
$posts->user_id = $_POST['user'];

$postsArray = explode(',', $posts2);




if(isset($_POST)){


		foreach($postsArray as $post)
		{
			$posts->rowid = $post;
			$posts->approve_post();
			
		}
		
	} 
	



?>