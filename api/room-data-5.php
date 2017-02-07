<?php
require_once 'settings.php';

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
        $room -> Date = $value['DATE'];
        $room -> BedName = $value['BED']['NAME'];
        $room -> RoutinePractices = $value['RoutinePractices']['Image'];

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

try{
    if(file_exists($fileXML)){
        $rowData = getDataXML($fileXML);
    } else {
        throw new Exception('XML file not found!!');
    }
}catch (Exception $e){
    error_log( $e->getMessage() );
}

//$rowData = getDataXML($fileXML);

saveRooms(parseRooms($rowData),$room_data_path);

?>