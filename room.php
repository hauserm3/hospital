<?php

$indexes = json_decode(file_get_contents('server/data/ip_room.json'));

$indexes = $indexes->rooms;

$room_data = json_decode(file_get_contents('server/data/Sample_TEST_2.json'));

$main_arr = $room_data -> data;

$room_id = isset($_GET['room_id']) ? $_GET['room_id'] : 0;
$room_ip = isset($_GET['room_ip']) ? $_GET['room_ip'] : 0;



$room_json = 0;

if($room_id != 0) $arr = getDataByID($room_id,0,$main_arr);
else {
    if($room_ip == 0) $room_ip = $_SERVER['REMOTE_ADDR'];
    $arr = getDataByID(getRoomIdByIP($room_ip, $indexes), 0, $main_arr);
}

if($arr != 0) $room_json = json_encode(mergeData($room_data->columns, $arr));


function mergeData($columns, $data){
    return array_combine($columns,$data);
}

function getDataByID($room_id, $column_index, $data){
    foreach ($data as $value){
        if($value[$column_index] == $room_id) return $value;
    }
    return 0;
}

function getRoomIdByIP($room_ip, $arr){
    foreach ($arr as $value){
        if($value->IP == $room_ip) return $value->ID;
    }
    return 0;
}

?>
<!DOCTYPE html>
<html>
  <head>
    <title>Admin panel</title>
      <base href="/room/">
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

    <script src="systemjs.config.js"></script>
    <script >var $room_json = '<?php echo $room_json;?>'</script>
    <script>
System.import('app').catch(function(err){ console.error(err); });
    </script>
  </head>

  <body>
    <my-app>Loading...</my-app>
  </body>
</html>