<?php
require_once 'settings.php';
//include 'get_XML_path.php';

//function getXMLpath(){
//    global $configJSON;
//    $config =json_decode(file_get_contents($configJSON));
////    var_dump($config);
//    $fileXML = $config->fileXML_path.$config->fileXML;
//    return $fileXML;
//}

//$XML_timestamp = filemtime(getXMLpath());
$XML_timestamp = filemtime($fileXML);
$room_data_timestamp = filemtime($room_data_path);

if($XML_timestamp > $room_data_timestamp){
    include_once 'room-data-5.php';
    $changes = $XML_timestamp;
    echo json_encode($changes);
//    echo 'true';
} else {
    $changes = false;
    echo json_encode($changes);
//    echo 'false';
}

//
//
//if(!isset($XML_timestamp)){
//    echo '11111';
//    $rooms = new stdClass();
//    $XML_timestamp = filemtime(getXMLpath());
//    $XML_timestamp_new = filemtime(getXMLpath());
//    $rooms -> XML_timestamp = $XML_timestamp;
//} else {
//    echo '22222';
//    $XML_timestamp_new = filemtime(getXMLpath());
//};
//
//if($XML_timestamp < $XML_timestamp_new){
//    echo '1 $XML_timestamp '.$XML_timestamp.'<br>';
//    echo '1 $XML_timestamp_new '.$XML_timestamp_new.'<br>';
//    $XML_timestamp = filemtime(getXMLpath());
//    echo '2 $XML_timestamp '.$XML_timestamp.'<br>';
//    echo '2 $XML_timestamp_new '.$XML_timestamp_new.'<br>';
//};



//var_dump(getXMLpath());

//var_dump($XML_timestamp);
//var_dump($room_data_timestamp);
//
//echo '$XML_timestamp '.$XML_timestamp;
//echo '<br>';
//echo '$room_data_timestamp '.$room_data_timestamp;

//if (file_exists($fileXML2)) {
//    echo "в последний раз файл $fileXML2 был изменен: " . date ("F d Y H:i:s.", filemtime($fileXML2));
//};