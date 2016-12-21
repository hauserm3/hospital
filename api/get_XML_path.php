<?php
function getXMLpath(){
    global $configJSON;
    $config =json_decode(file_get_contents($configJSON));
//    var_dump($config);
    $fileXML = $config->fileXML_path.$config->fileXML;
    return $fileXML;
}

$fileXML = getXMLpath();