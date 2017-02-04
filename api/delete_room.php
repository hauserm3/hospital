<?php
include 'settings.php';

$method = $_SERVER['REQUEST_METHOD'];

if($method == 'POST'){
    $out = new stdClass();
    $arr = array();

    $post = json_decode(file_get_contents('php://input'),true);
    $data = json_decode(file_get_contents($ip_room_path));

    foreach ($data -> rooms as $key => $value){
        if($post["IP"] == $value -> IP && $post["ID"] == $value -> ID) unset($data -> rooms[$key]);
    }
    foreach ($data -> rooms as $key => $value){
        $arr[] = $value;
    }
    $data -> rooms = $arr;

    $out -> resalt = file_put_contents($ip_room_path, json_encode($data));
    if($out->resalt) $out->success = 'success';
}

if(is_string($out)) echo($out);
else{
    header('Content-type: application/json');
    echo json_encode($out);
}

?>