<?php


function getDataByID($room_id, $column_index, $data){
    foreach ($data as $value){
        if($value[$column_index] == $room_id) return $value;
    }
    return 0;
}

echo json_encode(getDataByID(5,0,$main_arr));
echo json_encode(getDataByID("MHS-U13-1067-2",2,$main_arr));

?>