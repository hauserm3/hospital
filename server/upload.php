<?php
//require_once('dbDriver.php');
ini_set('html_errors', false);

$_SERVER['DOCUMENT_ROOT'] ."room/app/icons/";

//$root = '../';
//$folder= '../app/icons';
//$file = $_FILES["file"];
//$fileName = $_GET['fileName'];

$root = $_SERVER['DOCUMENT_ROOT'];
$folder= "room/app/icons";
$file = $_FILES["file"];
$fileName = $_GET['fileName'];

if(isset($_GET['api'])){
	$api= explode('/',$_GET['api']);
}


header('Content-type: application/json');


$out = new stdClass();
$err = checkFoErrors($file);
if($err)$out = $err;
else{
	$filename = uploadImage($root,$folder,$file,$fileName);
	if($filename){
		$out->success='success';
		$out->result= $filename;	
		
	}else $out->error='error move file';
}
	
echo json_encode($out);	
function uploadImage($root,$folder,$file,$fileName){		
		if (!file_exists($root.$folder)) mkdir($root.$folder, 0755, true);
		$filename = $folder.'/'.$fileName;		
		if(move_uploaded_file($file["tmp_name"],$root.$filename))return $filename;			
		return 0;		
	}
	
	function checkFoErrors($file){
		$out=new stdClass();
		if ($file["error"] > 0){
			$out->error= $file["error"];
				switch ($file["error"]) {
					case UPLOAD_ERR_OK:
						$out->result = 'UPLOAD_ERR_OK';
					break;
					case UPLOAD_ERR_NO_FILE:
						$out->result = 'UPLOAD_ERR_NO_FILE';            
					case UPLOAD_ERR_INI_SIZE:
					case UPLOAD_ERR_FORM_SIZE:
						$out->result = 'UPLOAD_ERR_INI_SIZE';
					default:
						$out->result = 'UNKNOWN_ERROR';
				}
					
			return $out;
		}
		return 0;
	}


?>