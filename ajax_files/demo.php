<?php
session_start();
require_once ('../../core/classes/database.class.php');
require_once('../classes/posts.class.php');
require_once('../classes/clientes.class.php');
require_once('../classes/socialmediausers.class.php');
require_once('../classes/notifications.class.php');

ini_set('display_errors', 'on');
error_reporting(E_ALL & ~E_DEPRECATED & ~E_STRICT);
$posts = new Posts();
$clientes = new Clientes(); 
$users = new SocialMediaUsers();

$notificaciones = new Notifications();

$posts->rowid = '70';
$posts->user_id = '73';
$data = $posts->cancel_approve();
var_dump($data);



	
//var_dump($send_to);
//print_r($data);



//$data1 = $posts->get_post_current_autorization($post);
//$data2  = $posts->get_client_needed_autorization($client);
//var_dump($posts->get_post_current_autorization($posts->rowid));
//var_dump(array_diff($data2, $data1));




/*
var_dump($posts->approve_post());

if(isset($_POST)){
	
	$action = $_POST['action'];
	if($action == 'approve')
	{
		
		
		if($data = $posts->approve_post())
		{
			print 'success';
		} 
		else
		{
			print 'error';
		}
	} 
	
}
*/

?>