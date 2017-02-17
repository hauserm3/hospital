<?php
require_once 'settings.php';

class FileInfo{

    var $errHandling;

    function __construct(){
        $this->errHandling = new ErrorHandling();
    }
//1
    function getTimestamp($filepath){
        try{
            if(file_exists($filepath)){
                return filemtime($filepath);
            } else {
                $this->errHandling->createError(101, $filepath.' - file not found!!!'); //XML file not found!
//                throw new Exception('APP XML file not found!! filemtime unknown!!');
                return 0;
            }
        }catch (Exception $e){
            $this->errHandling->writeError($e->getMessage());
//            error_log($e->getMessage());
//            error_log( $e->getMessage(), 3, $errors_app );
        }
    }

    function checkFileUpdate($XML_timestamp,$configFile,$rooms_path_timestamp){
        if($XML_timestamp > $rooms_path_timestamp || $configFile > $rooms_path_timestamp){
            return true;
        } else {
            return false;
        }
    }
}