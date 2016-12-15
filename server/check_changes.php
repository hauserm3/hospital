<?php
include 'settings.php';

$XML_timestamp = filemtime(getXMLpath());
$XML_timestamp_new = 0;

var_dump(getXMLpath());
var_dump($XML_timestamp);
var_dump($XML_timestamp_new);
//if (file_exists($fileXML2)) {
//    echo "в последний раз файл $fileXML2 был изменен: " . date ("F d Y H:i:s.", filemtime($fileXML2));
//};