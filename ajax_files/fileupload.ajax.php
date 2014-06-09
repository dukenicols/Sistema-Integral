<?php

	$error = "";
	$msg = "";
	$fileElementName = 'files';
	$filesize = 5120;
	
	
	if (empty($_FILES[$fileElementName]['error']) && !empty($_FILES[$fileElementName]['tmp_name']) && $_FILES[$fileElementName]['tmp_name'] != 'none')
	{
		$msg .= " File Name: " . $_FILES[$fileElementName]['name'] . ", ";
		
		$tmpname = $_FILES[$fileElementName]['tmp_name'];
		$extensiones = array('jpg', 'png', 'bmp', 'jpeg', 'gif');
		$name = date('h:i:s').'-'.$_FILES[$fileElementName]['name'];
		$ext = strtolower(pathinfo($name, PATHINFO_EXTENSION));
		$size = $_FILES[$fileElementName]['size'] / 1024;
		
		if (!in_array($ext, $extensiones))
			$error .= 'El archivo no cumple con el formato requerido (jpg, bmp, png).\n';
		if ($size > $filesize)
			$error .= 'El archivo supera el peso permitido.';
		
		if (!$error) {
			// mandale las consultas para q inserte y toda la bola
			
			move_uploaded_file($tmpname, '../uploads/' . $name);
			
			$array = array('url' => 'http://192.168.0.132/Sistema-Integral/uploads/'.$name);
			echo json_encode($array);
		}
	}
	
	
	
	
?>