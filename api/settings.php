<?php
//production
ini_set('html_errors', false);
date_default_timezone_set('America/Toronto');
ini_set("log_errors", 1);
ini_set("error_log", "data/errors_".date("F").".log");
//ini_set("error_log", "data/errors_".date("F").".log");
//$errors_app = "data/errors_app.log";
//error_log( "Hello, errors!" );
//error_log("Error log is work!", 1,"hauserm555@gmail.com");


$configJSON = "../config.json";

if(file_exists($configJSON)){
    //It does not refer to a XML file from the client5.php
    $config = json_decode(file_get_contents($configJSON));
    $fileXML = $config->fileXML;
    define("FILE_XML",$fileXML);
}

$get_room_path = 'api/get-room-5.php';
$room_data_path = 'api/room-data-5.php';

$ip_room_path = 'data/ip_room.json';
$icons_path = 'data/icons5.json';
$rooms_path = 'data/rooms_5.json';

$img_folder = "app/img";
$icons_folder = "app/icons";