<?php
include 'settings.php';

$method = $_SERVER['REQUEST_METHOD'];

if($method == 'GET'){
    $out = file_get_contents(Settings::$icons_path);
}

if(is_string($out)) echo($out);
else{
    header('Content-type: application/json');
    echo json_encode($out);
}

?>