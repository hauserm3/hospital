<?php
require_once 'settings.php';
require_once 'ErrorHandling.php';
require_once 'FileInfo.php';
require_once 'DataInfo.php';
require_once 'Parser.php';


$errHandling = new ErrorHandling();
$fileInfo = new FileInfo();
$dataInfo = new DataInfo();
$parser = new Parser();

$XML_timestamp = $fileInfo->getTimestamp(FILE_XML);
$configFile= filemtime(Settings::$configJSON);
$rooms_path_timestamp = filemtime(Settings::$rooms_path);

if($fileInfo->checkFileUpdate($XML_timestamp,$configFile,$rooms_path_timestamp)){
    $rowData = $parser->getDataXML(FILE_XML);
    $parsedData = $parser->parseRooms($rowData);
    $parser->saveRooms($parsedData,Settings::$rooms_path);
}

$indexes = $dataInfo->getContent(Settings::$ip_room_path);

$room_id = isset($_GET['room_id']) ? $_GET['room_id'] : 0;
$room_ip = isset($_GET['room_ip']) ? $_GET['room_ip'] : $_SERVER['REMOTE_ADDR'];

$main_arr = $dataInfo->getContent(Settings::$rooms_path);

if($room_id){
    $room = $dataInfo->getRoomById($room_id,$main_arr);
} else {
    $indexes = $dataInfo->getContent(Settings::$ip_room_path);
    $room = $dataInfo->getRoomByIp($room_ip,$main_arr,$indexes);
}

$dataInfo->sendResponse($room);

?>