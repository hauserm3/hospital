<?php
include 'settings.php';

function getXMLpath(){
    global $configJSON;
    $config =json_decode(file_get_contents($configJSON));
//    var_dump($config);
    $fileXML = $config->fileXML_path.$config->fileXML;
    return $fileXML;
}

$files_timestamp = array();
print_r($rooms);
//$XML_timestamp;
//$XML_timestamp_new;

if(!isset($XML_timestamp)){
    echo '11111';
    $rooms = new stdClass();
    $XML_timestamp = filemtime(getXMLpath());
    $XML_timestamp_new = filemtime(getXMLpath());
    $rooms -> XML_timestamp = $XML_timestamp;
} else {
    echo '22222';
    $XML_timestamp_new = filemtime(getXMLpath());
};

if($XML_timestamp < $XML_timestamp_new){
    echo '1 $XML_timestamp '.$XML_timestamp.'<br>';
    echo '1 $XML_timestamp_new '.$XML_timestamp_new.'<br>';
    $XML_timestamp = filemtime(getXMLpath());
    echo '2 $XML_timestamp '.$XML_timestamp.'<br>';
    echo '2 $XML_timestamp_new '.$XML_timestamp_new.'<br>';
};



var_dump(getXMLpath());
var_dump($XML_timestamp);
var_dump($XML_timestamp_new);
//if (file_exists($fileXML2)) {
//    echo "в последний раз файл $fileXML2 был изменен: " . date ("F d Y H:i:s.", filemtime($fileXML2));
//};