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
//        $row = array();
//        foreach($item as $key => $value){
//            if (in_array($key, $columns)) $row[] = $value;
//        }
//        $out[] = $row;
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
    print_r(json_encode($out));
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
//print_r(json_encode($rowData));


//print_r(json_encode($main_arr));

saveDataJSON($fileJSON, json_encode($main_arr));

function getRoom($room, $main_arr){

    foreach($main_arr["data"] as $val){
//        echo "<br><b> $val[0] ITERATION</b><br>";
//        print_r($columns);
        if($val[0] == $room) print_r($val);
    }

//    $out= array();
//    foreach ($rowData as $item) {
////        $row = array();
////        foreach($item as $key => $value){
////            if (in_array($key, $columns)) $row[] = $value;
////        }
////        $out[] = $row;
//        $out[] = checkFields($columns, $item);
//    }
//    return $out;
}

function getDataByID($room_id, $column_index, $data){
    foreach ($data as $value){
        if($value[$column_index] == $room_id) return $value;
    }
    return 0;
}

//echo json_encode(getDataByID(5,0,$main_arr));
//echo json_encode(getDataByID("MHS-U13-1067-2",2,$main_arr));

function getRoomByID($room){
    $out = array();
    $arr = array();
    global $fileJSON;

    $arr = getDataJSON($fileJSON);

//    print_r($arr);

    foreach($arr["data"] as $val){
//        echo "<br><b> $val[0] ITERATION</b><br>";
//        print_r($columns);
        if($val[0] == $room) {
            $out = array_combine($arr["columns"],$val);
//            print_r($val);
//            $out = $val;
        }
    }
    return $out;
}

function getRoomByIP($ip){
    $out = array();
    global $file_ip_room;

    $arr = getDataJSON($file_ip_room);

//    print_r($arr);

    foreach($arr["IP"] as $key=>$val){
//        echo "<br><b> $val[0] ITERATION</b><br>";
//        print_r($columns);
        if($val == $ip) {
//            $out = array_combine($val,$arr["ID"]);
            $out = getRoomByID($arr["ID"][$key]);
//            print_r($key);
//            print_r($val);
//            $out = $val;
        }
    }
    return $out;

//    foreach($main_arr["data"] as $val){
////        echo "<br><b> $val[0] ITERATION</b><br>";
////        print_r($columns);
//        if($val[0] == $room) {
////            print_r($val);
//            $out = $val;
//        }
//    }
//    return json_encode($out);
}

//function setOutArray($arr){
//    $out = array();
//
//    foreach($main_arr["data"] as $val){
////        echo "<br><b> $val[0] ITERATION</b><br>";
////        print_r($columns);
//        if($val[0] == $room) {
////            print_r($val);
//            $out = $val;
//            echo json_encode($out);
//        }
//    }
//    return json_encode($out);
//}

$ip = isset($_GET['ip'])?$_GET['ip']:null;
$room = isset($_GET['room'])?$_GET['room']:null;
$ip_room = isset($_GET['ip_room'])?$_GET['ip_room']:null;

$post = json_decode(file_get_contents('php://input'),true);



//echo json_encode($post);
//var_dump($_POST);
//print_r($_REQUEST);

//if(!$room) die('oops');

//if($room) echo $_GET["room"];
if($ip_room) {
    $arr = array();

    $arr = json_decode($ip_room,true);
    $ip_room_arr = getDataJSON($ip_roomJSON);

    if($ip_room_arr) {
        $ip_room_arr["IP"][] = $arr["IP"];
        $ip_room_arr["ID"][] = $arr["ID"];
        saveDataJSON($ip_roomJSON,json_encode($ip_room_arr));
        echo json_encode($ip_room_arr);
    } else {
        $ip_room_arr["IP"] = (array) $arr["IP"];
        $ip_room_arr["ID"] = (array) $arr["ID"];
        saveDataJSON($file_ip_room,json_encode($ip_room_arr));
        echo json_encode($ip_room_arr);
    }
}

if($room){
//    getRoomByID($room);
    $out = getRoomByID($room);
//    echo json_encode($out);
    if(is_string($out)) echo($out);
    else{
        header('Content-type: application/json');
//        echo json_encode($out);
    }
}

if($ip){
    $out = getRoomByIP($ip);
//    echo json_encode($out);
}

//getRoom($room,$main_arr);

////// first json

//foreach($rowData["ROOM"] as $value){
////        echo "$key = $value <br />";
////        print_r($val["ID"]);
////        print_r($val["BedName"]);
////        print_r($val);
////        echo "<br><b>ITERATION</b><br>";
//    foreach($val as $key => $val){
//        $сolumns[$key][] = $val;
////        echo "<br><b> $key => $v ITERATION</b><br>";
//    }
//}

////// second json

//foreach($rowData["ROOM"] as $value){
//    $row = array();
//    foreach($value as $key => $val){
//        if (!in_array($key, $columns)) {
//            $columns[] = $key;
//        }
//        $row[] = $val;
//    }
//    $data[] = $row;
//}

?>