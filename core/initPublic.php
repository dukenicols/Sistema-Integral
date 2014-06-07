<?php
	session_start();
	
	ini_set('display_errors', 'on');
	error_reporting(E_ALL & ~E_DEPRECATED & ~E_STRICT);
	
	define('SYSTEM_EURL' , '/Sistema-Integral/'); //css /js
	define('SYSTEM_URL' , $_SERVER['DOCUMENT_ROOT'] . SYSTEM_EURL); //php
	
	$GLOBALS['config'] = array(
		'mysql'		=> array(
			'host'		=> '127.0.0.1',
			'username'	=> 'root',
			'password'	=> '',
			'db'		=> 'socialmedia',
		),
		'remember'	=> array(
			'cookieName'	=> 'hash',
			'cookieExpiry'	=> 604800,	//1 Week
		),
		'session'	=> array(
			'sessionName'	=> 'user',
			'tokenName'		=> 'token'
		)
	);
	
	spl_autoload_register(function($class) {
		require_once 'classes/'.$class.'.php';
	});

	require_once 'functions/sanitize.func.php';

	if (Cookie::exists(Config::get('remember/cookieName')) && !Session::exists(Config::get('session/sessionName'))) {
		$hash = Cookie::get(Config::get('remember/cookieName'));
		$hashCheck = Database::getInstance()->get('usersSessions', array('hash', '=', $hash));
		if ($hashCheck->count()) {
			$user = new User($hashCheck->first()->userID);
			$user->login();
		}
	}
	require_once(SYSTEM_URL.'includes/langs/es.php');
?>