<?php
require_once 'settings.php';
require_once 'ErrorHandling.php';

//classes
//ifFileUpToDate() - 1 reurn boolean вниз
//checkTimestamp() - 2 reurn boolean
//detectRoomID
//ParsRoomIDDAta
//OutPutDate


$errHandling = new ErrorHandling($emails_dev,$emails_customer);
///TODO all loading and parsing in try/catch block with error handling
//1
try{
    if(file_exists(FILE_XML)){
        $XML_timestamp = filemtime(FILE_XML);
    } else {
        $errHandling->createError(101,'XML file not found!! filemtime unknown!!');
//        throw new Exception('APP XML file not found!! filemtime unknown!!');
    }
}catch (Exception $e){
    $errHandling->writeError($e->getMessage());
//    error_log($e->getMessage());
//    error_log( $e->getMessage(), 3, $errors_app );
}
$configFile= filemtime($configJSON);
$rooms_path_timestamp = filemtime($rooms_path);
// only for testing
//include_once 'room-data-5.php';
// for production
if($XML_timestamp > $rooms_path_timestamp || $configFile > $rooms_path_timestamp){
    include_once 'room-data-5.php';
}
//TODO try/catch parsing data
//13
try{
    $indexes = json_decode(file_get_contents($ip_room_path));
    $indexes = $indexes->rooms;
    if(!$indexes){
        $errHandling->createError(602,'ip_room.json - empty file!!!');
    }
}catch (Exception $e){
    $errHandling->writeError($e->getMessage());
}
//TODO try/catch
//14
try{
    $all_rooms = json_decode(file_get_contents($rooms_path));
    $main_arr = $all_rooms -> rooms;
    if(!$main_arr){
        $errHandling->createError(410,'rooms_5.json - empty file!!!');
    }
}catch (Exception $e){
    $errHandling->writeError($e->getMessage());
}
$room_id = isset($_GET['room_id']) ? $_GET['room_id'] : 0;
$room_ip = isset($_GET['room_ip']) ? $_GET['room_ip'] : 0;
//TODO if no room_id and no $room_ip  Data missing. Send message on  screen  "Room or IP not registered by administrator "
//15 //16
try{
    if($room_id != 0){
        $room = getDataByID($room_id, $main_arr);
        if(!$room) $errHandling->createError(702,'Data missing! Room ID('.$room_id.') not registered by administrator!!!');
    } else {
        if($room_ip == 0) $room_ip = $_SERVER['REMOTE_ADDR'];
        $room_id = getRoomIdByIP($room_ip, $indexes);
        if($room_id){
            $room = getDataByID($room_id, $main_arr);
            if(!$room) $errHandling->createError(704,'Data missing! Room('.$room_id.') not in parsed file!!!'); //17
        }else{
            $errHandling->createError(703,'Data missing! Room IP('.$room_ip.') not registered by administrator!!!');
        }
    }
    sendResponse($room);
}catch (Exception $e){
    $errHandling->writeError($e->getMessage());
}
//17
//if(!$room) {
//    $room_id = 1;
//    $room = getDataByID($room_id, $main_arr);
//}
function sendResponse($room){
    $out = new stdClass();
    $out->result = $room;
    header('Content-type: application/json');
    echo json_encode($out);
}
function getDataByID($room_id, $data){
    foreach ($data as $value){
        if($value->ID == $room_id) return $value;
    }
    return 0;
}
function getRoomIdByIP($room_ip, $arr){
    foreach ($arr as $value){
        if($value->IP == $room_ip) return $value->ID;
    }
    return 0;
}


?>