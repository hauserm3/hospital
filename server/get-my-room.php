<?php
// http://server/room-data.php?room=302
// http://server/room-data.php?ip=192.168.2.12
// http://server/room-data.php

$indexes = json_decode(file_get_contents('data/ip_room.json'));

$indexes = $indexes->rooms;

$room_data = json_decode(file_get_contents('data/Sample_TEST_2.json'));

$main_arr = $room_data -> data;

$room_id = isset($_GET['room_id']) ? $_GET['room_id'] : 0;
$room_ip = isset($_GET['room_ip']) ? $_GET['room_ip'] : 0;

$room_ip2 = $_SERVER['REMOTE_ADDR'];

if($room_id != 0){
    $arr = getDataByID($room_id,0,$main_arr);
    if($arr != 0){
        echo json_encode(mergeData($room_data->columns,$arr));
    } else {
        echo 0;
    }
    exit();
}

if($room_ip != 0){
    $arr = getDataByID(getRoomIdByIP($room_ip, $indexes), 0, $main_arr);
    if($arr != 0) {
        echo json_encode(mergeData($room_data->columns, $arr));
    }else {
        echo 0;
    }
    exit();
}

if(!$room_id && !$room_ip){
    echo $room_ip2;
    exit();
}



function mergeData($columns, $data){
    return array_combine($columns,$data);
}

function getDataByID($room_id, $column_index, $data){
    foreach ($data as $value){
        if($value[$column_index] == $room_id) return $value;
    }
    return 0;
}

function getRoomIdByIP($room_ip, $arr){
    foreach ($arr as $value){
        if($value->IP == $room_ip) return $value->ID;
    }
    return 0;
}

echo json_encode(getDataByID("MHS-U13-1067-2",2,$main_arr));

?>