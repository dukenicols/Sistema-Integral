<?php

	class Menu {
		
		private $_db;
		
	public	function __construct(){
			
			$this->_db = Database::getInstance();
		}
		
	public function isActive($path)
	{
		$url = $_SERVER['SCRIPT_NAME'];
		$url = parse_url($url);
		return strstr($url['path'], $path) ? true : false;
	}
	
	public function get_menu_array($userType){
		$db_obj    = $this->_db->get('groups', array('name','=',$userType));
		$db_result = ($db_obj->first());
		$str = $db_result->menu;
		return json_decode($str,true);
	}
	
	
	
	
		
	}
