<?php

ini_set('html_errors', false);
$method = $_SERVER['REQUEST_METHOD'];

if($method == 'POST'){
    $out = new stdClass();

    $post = json_decode(file_get_contents('php://input'),true);
    $pathFile = $_SERVER['DOCUMENT_ROOT'] ."room/app/icons/";

    foreach ($post["icons"] as $value){
    //        echo ($value["path"]);
    //        echo ($value["name"]);
        $out -> resalt = rename ($pathFile.$value["path"], $pathFile.$value["name"]);
    }
}

if($out->resalt) $out->success = 'success';
if(is_string($out)) echo($out);
else{
    header('Content-type: application/json');
    echo json_encode($out);
}

//if(is_string($out)) echo($out);
//else{
//    header('Content-type: application/json');
//    echo json_encode($out);
//}

?>