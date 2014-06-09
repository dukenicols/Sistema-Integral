<?php

	class Services {
		
		private $data,
				$_db;
		
		public	function __construct(){
			
			$this->_db = Database::getInstance();
		}
		
		public function getServicios()
		{
			
		$db_obj = $this->_db->query("SELECT s.rowid, 
												s.label as service_name, 
												s.sendible_code, 
												s.client_id,
												c.label as client_label
										 FROM `llx_sm_clientservicescodes` as s 
										 LEFT JOIN llx_sm_clients as c ON s.client_id = c.rowid");
		$db_result = $db_obj->results();
		//return json_decode(json_encode($db_result),true);
		return $db_result;	

		}
		
		public function replaceImage($str)
		{	
			if (!getimagesize($str))
				return str_replace('files.sendible.com', 'snd-store', $str);
			
			return $str;
		}
		public function getTags($item)
		{
			$db_obj = $this->_db->query("SELECT label FROM llx_sm_tags",array("label","LIKE","'%".$item."%'"));
			
			return json_encode($db_obj->results());
			die();
	$response = '[';
			foreach ($db_obj->results() as $r){
	
				$response .= '{value: "'.$r->label.'"}';
			}
		$response .=']';
return $response;
			
		}
		
	}


?>