<?php

$configJSON = "../config.json";

if(file_exists($configJSON)){
    $config = json_decode(file_get_contents($configJSON));
    $fileXML = $config->fileXML;
}

//echo $fileXML;
//$fileXML = $config->fileXML_path.$config->fileXML;
//$fileXML ='data/XMLSampleNov152016.xml';
//$fileXML = $config->fileXML_path.$config->fileXML;

//??????????????????????????????????????????????????????????????
//function getXMLpath(){
//    global $configJSON;
//    $config =json_decode(file_get_contents($configJSON));
////    var_dump($config);
//    $fileXML = $config->fileXML_path.$config->fileXML;
//    return $fileXML;
//}
//$fileXML = getXMLpath();

$get_room_path = 'api/get-room-5.php';
$room_data = 'api/room-data-5.php';

$ip_room_path = 'data/ip_room.json';
$icons_path = 'data/icons5.json';
$room_data_path = 'data/rooms_5.json';

$img_folder = "app/img";
$icons_folder = "app/icons";

//
//
//$configJSON =
////print_r($configJSON);
//
//$fileXML2 = $configJSON->fileXML_path.$configJSON->fileXML;
//print_r($fileXML2);
//if (file_exists($fileXML2)) {
//    echo "в последний раз файл $fileXML2 был изменен: " . date ("F d Y H:i:s.", filemtime($fileXML2));
//};