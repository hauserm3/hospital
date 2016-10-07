<?php
ini_set('html_errors', false);
$method = $_SERVER['REQUEST_METHOD'];

//echo $method;

if($method == 'POST'){
    $out = new stdClass();
    $arr = array();

    $post = json_decode(file_get_contents('php://input'),true);
    $data = json_decode(file_get_contents('data/ip_room.json'));
//    print_r($post["IP"] );
//    print_r($data -> rooms);
    foreach ($data -> rooms as $key => $value){
        if($post["IP"] == $value -> IP && $post["ID"] == $value -> ID) unset($data -> rooms[$key]);
    }
    foreach ($data -> rooms as $key => $value){
        $arr[] = $value;
    }
    $data -> rooms = $arr;

    $out -> resalt = file_put_contents('data/ip_room.json', json_encode($data));
    if($out->resalt) $out->success = 'success';
}

if(is_string($out)) echo($out);
else{
    header('Content-type: application/json');
    echo json_encode($out);
}

?>