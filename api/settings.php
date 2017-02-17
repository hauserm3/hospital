<?php
//production
ini_set('html_errors', false);
date_default_timezone_set('America/Toronto');
ini_set("log_errors", 1);
ini_set("error_log", "data/errors_".date("F").".log");
//ini_set("error_log", "data/errors_".date("F").".log");
//$errors_app = "data/errors_app.log";
//error_log( "Hello, errors!" );
//error_log("Error log is work!", 1,"hauserm555@gmail.com");

class Settings{
//    var $emails_dev = "aren@herotech.ca,uplight.ca@gmail.com,hauserm555@gmail.com";
//    var $emails_customer = "customer1@gmail.com,customer2@gmail.com";
    public static $configJSON = "../config.json";
    public static $client_controller = 'api/client_controller.php';

    public static $ip_room_path = 'data/ip_room.json';
    public static $icons_path = 'data/icons.json';
    public static $rooms_path = 'data/rooms.json';

    public static $img_folder = "app/img";
    public static $icons_folder = "app/icons";

    public static $emails_dev = "aren@herotech.ca,uplight.ca@gmail.com,hauserm555@gmail.com";
    public static $emails_customer = "customer1@gmail.com,customer2@gmail.com";

    private static $instance;           // object instance
    private function __construct(){;}   //constructor block
    private function __clone(){;}       //cloning block
    private function __wakeup(){;}      //unserialize block

    public static function getInstance(){
        return !isset(self::$instance) ? self::$instance = new self() : self::$instance;
    }

    public static function getXMLPath(){
        $config = json_decode(file_get_contents(self::$configJSON));
        return $config->fileXML;
    }
}
