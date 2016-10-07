<?php
ini_set('html_errors', false);

$icons = array();
$icons_out = array();
$out = array();

//$key = 'ID';
//$value = 'Name';
//
//$array[$key] = $value;



$icons = array_filter(scandir('../app/icons'), function($item) {
    return !is_dir('../app/icons' . $item);
});

//foreach ($icons as $key => $value) {
////    $icons_out["ID"][] = $key;
////    $icons_out["Name"][] = $value;
//    $icons_out[]["ID"] = $key;
//    $icons_out[][]["Name"] = $value;
//
//}

foreach ($icons as $key => $value) {
    $icons_out[$key]["name"] = $value;
    $icons_out[$key]["path"] = $value;
}

foreach ($icons_out as $key => $value) {
    $out[] = $value;
}

header('Content-type: application/json');
echo json_encode($out);


?>