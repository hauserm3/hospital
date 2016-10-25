<?php

$indexes = json_decode(file_get_contents('server/data/ip_room.json'));
$indexes = $indexes->rooms;

//$icons = json_decode(file_get_contents('server/data/icons.json'));
//$icons = $icons->icons;

$room_data = json_decode(file_get_contents('server/data/rooms_3.json'));
$main_arr = $room_data -> rooms;

$room_id = isset($_GET['room_id']) ? $_GET['room_id'] : 0;
$room_ip = isset($_GET['room_ip']) ? $_GET['room_ip'] : 0;

$room_json = 0;

if($room_id != 0){ $room = getDataByID($room_id, $main_arr); }//echo json_encode($room);
else {
    if($room_ip == 0) $room_ip = $_SERVER['REMOTE_ADDR'];
    $room = getDataByID(getRoomIdByIP($room_ip, $indexes), $main_arr);
}

if($room) {
//    $room_json = json_encode(setIcon($room_json,$icons));
    $room_json = json_encode($room);
//    echo json_encode($room_json);
}

function getDataByID($room_id, $data){
    foreach ($data as $value){
        if($value->ID == $room_id) return $value;
    }
    return 0;
}

function getRoomIdByIP($room_ip, $arr){
    foreach ($arr as $value){
        if($value->IP == $room_ip) return $value->ID;
    }
    return 0;
}

function setIcon($room_json, $icons){
    $out = $room_json;
    foreach ($room_json as $key=>$value){
        foreach ($icons as $val){
            if($value === $val->label){
                $out[$key."_f"]=$val->filename;
                $out[$key."_i"]=$val->iconPath;
            }
        }
    }
    return $out;
}

?>
<!DOCTYPE html>
<html>
  <head>
    <title>Client</title>
<!--      <base href="/room/">-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

      <link rel="stylesheet" href="libs/bootstrap.min.css">
      <link rel="stylesheet" href="libs/font-awesome.css">
      <link rel="stylesheet" href="styles.css">

    <!-- Polyfill(s) for older browsers -->
      <script src="libs/jquery-3.1.0.min.js"></script>
    <script src="node_modules/core-js/client/shim.min.js"></script>

    <script src="node_modules/zone.js/dist/zone.js"></script>
    <script src="node_modules/reflect-metadata/Reflect.js"></script>
    <script src="node_modules/systemjs/dist/system.src.js"></script>

    <script src="systemjs.config3.js"></script>
    <script >var $room_json = '<?php echo $room_json;?>';console.log('$room_json ', JSON.parse($room_json));</script>
    <script>
        System.import('client').catch(function(err){ console.error(err); });
    </script>
  </head>

  <body>
    <client>Loading...</client>
  </body>
</html>