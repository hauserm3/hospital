<?php
//production
ini_set('html_errors', false);
date_default_timezone_set('America/Toronto');
ini_set("log_errors", 1);
ini_set("error_log", "api/data/error.log");
//error_log( "Hello, errors!" );

$configJSON = "../config.json";

if(file_exists($configJSON)){
    $config = json_decode(file_get_contents($configJSON));
    $fileXML = $config->fileXML;
}

$get_room_path = 'api/get-room-5.php';
$room_data = 'api/room-data-5.php';

$ip_room_path = 'data/ip_room.json';
$icons_path = 'data/icons5.json';
$room_data_path = 'data/rooms_5.json';

$img_folder = "app/img";
$icons_folder = "app/icons";