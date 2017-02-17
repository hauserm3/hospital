<?php
include 'settings.php';

$method = $_SERVER['REQUEST_METHOD'];

if($method == 'GET'){
    $id_room = array();
    $room_id = array();

    $rooms = json_decode(file_get_contents(Settings::$rooms_path));
    foreach ($rooms -> rooms as $value){
        $id_room[] = $value -> ID;
    }

    $room_ip_id = json_decode(file_get_contents(Settings::$ip_room_path));
    foreach ($room_ip_id -> rooms as $value){
        $room_id[] = $value -> ID;
    }

    $id_room = array_diff($id_room,$room_id);

    foreach ($id_room as $value){
        $val = new stdClass();
        $val -> IP = "";
        $val -> ID = $value;
        array_push($room_ip_id -> rooms, $val);
    }

    usort($room_ip_id -> rooms,"roomSort");

    $out = $room_ip_id;
} else {
    $out = new stdClass();

    $post = json_decode(file_get_contents('php://input'),true);

    $out -> resalt = file_put_contents(Settings::$ip_room_path, json_encode($post));

    if($out->resalt) $out->success = 'success';
}

if(is_string($out)) echo($out);
else{
    header('Content-type: application/json');
    echo json_encode($out);
}

function roomSort($v1, $v2){
    if($v1->ID < $v2->ID) return -1;
    elseif ($v1->ID > $v2->ID) return 1;
    else return 0;
}

?>