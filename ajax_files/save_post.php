<?php
session_start();
require_once('../../core/classes/database.class.php');
require_once('../classes/posts.class.php');
require_once('../classes/clientes.class.php');
require_once('../classes/notifications.class.php');
$posts = new  Posts();
$clientes = new Clientes();
$notificaciones = new Notifications();



ini_set('display_errors', 'on');
error_reporting(E_ALL & ~E_DEPRECATED & ~E_STRICT);
if(isset($_POST))
{
	if(isset($_POST['action']))
	{
		$action = $_POST['action'];
	} 
	else
	{
		$action = '';
	}

	/* NOTIFICATION CODE */
	$clients_codes = explode(',', $_POST['networks']);
	
	
	$clients_id = array();
	foreach($clients_codes as $client_code)
	{	//Extraemos a traves de cada service code el id del cliente que corresponde
		$clients_id[$clientes->get_clientid_by_service_code($client_code)] = $clientes->get_clientid_by_service_code($client_code); 
	}

	$users_id = array();
	foreach($clients_id as $k => $client_id){
		$users_id[$k] = $clientes->get_client_needed_autorization($client_id); 
		$users_id[$k] = $users_id[$k][0];
	}
	
	if($action == 'submit')
	{
			$posts->create_new_posts($_POST);
			$notificaciones->send_notification('new', $_SESSION['rowid'], $users_id);
	}

	if($action == 'edit')
	{
		$posts->edit_post($_POST);
	}
	
	
}

?>