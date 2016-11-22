<?php
//ini_set('display_errors', 1);
//error_reporting(E_ALL ^ E_NOTICE);

$fileXML='./data/Sample_TEST.xml';
$file_rooms='data/rooms.json';

$fileXML_5='./data/XMLSampleNov152016.xml';
$file_rooms_5='data/rooms_5.json';

$iconsJSON='./data/icons.json';
$iconsPath='app/icons/';

$main_arr = array();
$columns = array();
$data = array();
$ip_room_arr = array();

$iconsName = array();
$iconsFileName = array();


function getDataXML($filepath){
    $out= array();
    $xml = simplexml_load_file($filepath);
    $json = json_encode($xml);
    $out = json_decode($json,TRUE);
    return $out["ROOM"];
}

function getDataJSON($filepath){
    $out= array();
    $json = file_get_contents($filepath);
    $out = json_decode($json,TRUE);
    return $out;
}

function saveDataJSON($filepath, $dataJSON){
    $fp = fopen($filepath, 'w+'); //a
    flock($fp, LOCK_EX); // Блокирование файла для записи
    fwrite($fp, $dataJSON); // строка записи
    flock($fp, LOCK_UN); // Снятие блокировки
    fclose($fp);
}

function parseRooms($rooms_arr){
    $rooms = array();
    foreach ($rooms_arr as $value){
        $room = new stdClass();
        $room -> ID = $value['ID'];
        $room -> Date = $value['Date'];
        $room -> BedName = $value['BED']['Name'];
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
    echo json_encode($rooms);
    file_put_contents($file_rooms, json_encode($rooms));
}


function getColumns($rowData){
//    print_r(array_keys($rowData[0]));
    return array_keys($rowData[0]);
}

function checkFields($columns, $item){
    $row = array();

    for($i=0; $i<count($columns); $i++){
        if (array_key_exists($columns[$i], $item)) $row[] = $item[$columns[$i]];
        else $row[] = null;
    }

    return $row;
}

function getData($rowData, $columns){
    $out= array();
    foreach ($rowData as $item) {
        $out[] = checkFields($columns, $item);
    }
    return $out;
}

function getIconsName($data){
    $out= array();
    $arr= array();

    foreach ($data as $value) {
        for($i=3; $i<count($value); $i++){
            $arr[]= $value[$i];
        }
    }
    $arr = array_unique($arr);
    foreach($arr as $value){
        $out[] = $value;
    }
    return $out;
}

function getIconsFilename($iconsName){
    $out= array();

    foreach ($iconsName as $value) {
        $value = str_replace("/","__",$value);
        $value = str_replace(" ","--",$value);
        $value = str_replace(",","___",$value);
        $out[] = $value.'.png';
    }
//    print_r(json_encode($out));
    return $out;
}

function saveIcons($iconsName,$iconsFileName){
    global $iconsPath,$iconsJSON;
    $arr= array();
    $out= array();

    for($i=0; $i<count($iconsName); $i++){
        $icon = new stdClass();
        $icon -> label = $iconsName[$i];
        $icon -> filename = $iconsFileName[$i];
        $icon -> iconPath = $iconsPath.$iconsFileName[$i];
        $arr[]= $icon;
    }
    $out["icons"] = $arr;
//    print_r(json_encode($out));
    saveDataJSON($iconsJSON, json_encode($out));
}

//echo json_encode(getDataXML($fileXML));

$rowData = getDataXML($fileXML);
$rowData_2 = getDataXML($fileXML_5);

$columns = getColumns($rowData);
$data = getData($rowData, $columns);

$main_arr["columns"] = $columns;
$main_arr["data"] = $data;

$iconsName = getIconsName($data);
$iconsFileName = getIconsFilename($iconsName);

parseRooms($rowData_2);

saveRooms(parseRooms($rowData_2),$file_rooms_5);

//saveRooms($rowData_2,$file_rooms_5);

saveIcons($iconsName,$iconsFileName);


?>