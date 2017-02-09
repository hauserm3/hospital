<?php
require_once 'settings.php';

///TODO all loading and parsing in try/catch block with error handling
//1
try{
    if(file_exists(FILE_XML)){
        $XML_timestamp = filemtime(FILE_XML);
    } else {
        throw new Exception('APP XML file not found!! filemtime unknown!!');
    }
}catch (Exception $e){
    error_log($e->getMessage());
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
$indexes = json_decode(file_get_contents($ip_room_path));
$indexes = $indexes->rooms;

//TODO try/catch
//14
$all_rooms = json_decode(file_get_contents($rooms_path));
$main_arr = $all_rooms -> rooms;

$room_id = isset($_GET['room_id']) ? $_GET['room_id'] : 0;
$room_ip = isset($_GET['room_ip']) ? $_GET['room_ip'] : 0;

//TODO if no room_id and no $room_ip  Data missing. Send message on  screen  "Room or IP not registered by administrator "
//15

if($room_id != 0){
    $room = getDataByID($room_id, $main_arr);
} else {
    if($room_ip == 0) $room_ip = $_SERVER['REMOTE_ADDR'];
    $room = getDataByID(getRoomIdByIP($room_ip, $indexes), $main_arr);
}
//16
if(!$room) {
    $room_id = 1;
    $room = getDataByID($room_id, $main_arr);
}

$out = new stdClass();
$out->result = $room;

header('Content-type: application/json');
echo json_encode($out);

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