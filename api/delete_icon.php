<?php
include 'settings.php';

$method = $_SERVER['REQUEST_METHOD'];
$pathFile = __DIR__."/../".$icons_folder."/";

if($method == 'POST'){
    $out = new stdClass();
    $post = json_decode(file_get_contents('php://input'),true);

    $out -> resalt = unlink($pathFile.$post["filename"]);
    if($out->resalt) $out->success = 'success';
}

if(is_string($out)) echo($out);
else{
    header('Content-type: application/json');
    echo json_encode($out);
}

?>