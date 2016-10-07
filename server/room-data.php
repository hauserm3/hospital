<?php
//ini_set('display_errors', 1);
//error_reporting(E_ALL ^ E_NOTICE);

$fileXML='./data/Sample_TEST.xml';
$fileJSON='./data/Sample_TEST_2.json';
$file_ip_room='./data/ip_room.json';
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


$rowData = getDataXML($fileXML);
$columns = getColumns($rowData);
$data = getData($rowData, $columns);

$main_arr["columns"] = $columns;
$main_arr["data"] = $data;

$iconsName = getIconsName($data);
$iconsFileName = getIconsFilename($iconsName);

saveIcons($iconsName,$iconsFileName);

saveDataJSON($fileJSON, json_encode($main_arr));


//function getDataByID($room_id, $column_index, $data){
//    foreach ($data as $value){
//        if($value[$column_index] == $room_id) return $value;
//    }
//    return 0;
//}

//echo json_encode(getDataByID(5,0,$main_arr));
//echo json_encode(getDataByID("MHS-U13-1067-2",2,$main_arr));


?>