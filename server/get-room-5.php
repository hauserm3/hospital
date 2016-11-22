<?php
$indexes = json_decode(file_get_contents('./data/ip_room.json'));
$indexes = $indexes->rooms;

$icons = json_decode(file_get_contents('./data/icons5.json'));
$icons = $icons->icons;

$room_data = json_decode(file_get_contents('./data/rooms_5.json'));
$main_arr = $room_data -> rooms;

$room_id = isset($_GET['room_id']) ? $_GET['room_id'] : 0;
$room_ip = isset($_GET['room_ip']) ? $_GET['room_ip'] : 0;

$room_json = 0;

if($room_id != 0){
    $room = getDataByID($room_id, $main_arr);
}
else {
    if($room_ip == 0) $room_ip = $_SERVER['REMOTE_ADDR'];
    $room = getDataByID(getRoomIdByIP($room_ip, $indexes), $main_arr);
}

if($room) {
    $room = setIconsLabel($room,$icons);
    header('Content-type: application/json');
    echo json_encode($room);
//    $room_json = json_encode($room);
} else {
    $room_id = 1;
    $room = getDataByID($room_id, $main_arr);
    $room = setIconsLabel($room,$icons);
    header('Content-type: application/json');
    echo json_encode($room);
//    $room_json = json_encode($room);
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

function setIconsLabel($room,$icons){
    if(array_key_exists('RoutinePractices',$room)){
        foreach ($icons as $value){
            if($value -> filename == $room -> RoutinePractices){
                $room -> RP_label_en = $value -> label_en;
//                $room -> RP_label_fr =  $value -> label_fr;
            }
        }
    }

    if(array_key_exists('CautionAttention',$room)){
        foreach ($icons as $value){
            if($value -> filename == $room -> CautionAttention){
                $room -> CA_label_en = $value -> label_en;
//                $room -> CA_label_fr =  $value -> label_fr;
            }
        }
    }

    if(array_key_exists('ContactPrecautions',$room)){
        $room -> CP_label_en = array();
        $room -> CP_label_fr = array();
        foreach ($icons as $value){
            foreach ($room -> ContactPrecautions as $val){
                if($value -> filename == $val){
                    $room -> CP_label_en[] = $value -> label_en;
//                    $room -> CP_label_fr[] =  $value -> label_fr;
                }
            }
        }
    }

    return $room;
}

?>