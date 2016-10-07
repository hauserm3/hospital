<?php
ini_set('html_errors', false);
$method = $_SERVER['REQUEST_METHOD'];
$pathFile = __DIR__."/../app/icons/";

//echo $method;

if($method == 'POST'){
    $out = new stdClass();
    $post = json_decode(file_get_contents('php://input'),true);
//    $pathFile = $_SERVER['DOCUMENT_ROOT'] ."room/app/icons/";

//    print_r($post["IP"] );
//    print_r($data -> rooms);

    $out -> resalt = unlink($pathFile.$post["filename"]);
    if($out->resalt) $out->success = 'success';
}

if(is_string($out)) echo($out);
else{
    header('Content-type: application/json');
    echo json_encode($out);
}

?>