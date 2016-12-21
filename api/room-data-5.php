<?php
require_once 'settings.php';
//include 'get_XML_path.php';
//if(!function_exists("getXMLpath")) {
//    // declare your function
//    include 'get_XML_path.php';
//}
//ini_set('display_errors', 1);
//error_reporting(E_ALL ^ E_NOTICE);

//$fileXML_5='./data/XMLSampleNov152016.xml';
//$file_rooms_5='data/rooms_5.json';

//function getXMLpath(){
//    global $configJSON;
//    $config =json_decode(file_get_contents($configJSON));
////    var_dump($config);
//    $fileXML = $config->fileXML_path.$config->fileXML;
//    return $fileXML;
//}

function getDataXML($filepath){
    $out= array();
    $xml = simplexml_load_file($filepath);
    $json = json_encode($xml);
    $out = json_decode($json,TRUE);
    return $out["ROOM"];
}

function parseRooms($rooms_arr){
    $rooms = array();
    foreach ($rooms_arr as $value){
        $room = new stdClass();
        $room -> ID = $value['ID'];
//        $room -> Date = $value['Date'];
        $room -> Date = $value['DATE'];
//        $room -> BedName = $value['BED']['Name'];
        $room -> BedName = $value['BED']['NAME'];
        $room -> RoutinePractices = $value['RoutinePractices']['Image'];
//        if(array_key_exists('Image',$value['CautionAttention']) && $value['CautionAttention']['Image'] != 'FALSE'){
//            $room -> CautionAttention = $value['CautionAttention']['Image'];
//        }

//        echo $value['ID']." "; print_r($value['CautionAttention']['Image']); echo '<br/>';
        if(array_key_exists('Image',$value['CautionAttention']) && $value['CautionAttention']['Image'] != 'FALSE'){
            if(is_array($value['CautionAttention']['Image'])){
                $room -> CautionAttention = $value['CautionAttention']['Image'];
            } else {
                $room -> CautionAttention = (array) $value['CautionAttention']['Image'];
            }
        }
        if($value['HazardousMedications']['Image'] != 'FALSE'){
            if(is_array($value['HazardousMedications']['Image'])){
                $room -> HazardousMedications = $value['HazardousMedications']['Image'];
            } else {
                $room -> HazardousMedications = (array) $value['HazardousMedications']['Image'];
            }
        }
//        if($value['HazardousMedications']['Image'] != 'FALSE'){
//            $room -> HazardousMedications = true;
//        }
        if($value['ContactPrecautions']['Image'] != 'FALSE'){
            if(is_array($value['ContactPrecautions']['Image'])){
                $room -> ContactPrecautions = $value['ContactPrecautions']['Image'];
            } else {
                $room -> ContactPrecautions = (array) $value['ContactPrecautions']['Image'];
            }
        }
        $rooms[]=$room;
    }
//    echo json_encode($rooms);
    return $rooms;
}

function saveRooms($rooms_arr,$file_rooms){
    $rooms = new stdClass();
    $rooms -> rooms = $rooms_arr;
//    echo json_encode($rooms);
    file_put_contents($file_rooms, json_encode($rooms));
}

//echo json_encode(getDataXML($fileXML));
//echo getXMLpath();
//$fileXML = getXMLpath();
$rowData = getDataXML($fileXML);

//parseRooms($rowData);

saveRooms(parseRooms($rowData),$room_data_path);

?>