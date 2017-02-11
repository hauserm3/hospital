<?php

class ErrorHandling {
    var $num;
    var $msg;
    var $err;
//    var $emails_dev = "aren@herotech.ca,uplight.ca@gmail.com,hauserm555@gmail.com";
//    var $emails_customer = "customer1@gmail.com,customer2@gmail.com";

    var $emails_dev;
    var $emails_customer;

    function __construct($emails_dev,$emails_customer){
        $this->emails_dev = $emails_dev;
        $this->emails_customer = $emails_customer;
    }

    function writeError($err){
        error_log($err);
    }

    function createError($num,$msg){
        $this->err = 'APP ERROR '.$num.' '.$msg;
        echo $this->err;
        throw new Exception($this->err);
    }

    function sendEmail($num,$msg){
        if($num>=100 and $num<300){
            error_log($msg, 1,$this->emails_dev.','.$this->emails_customer);
        } elseif ($num>=300 and $num<500){
            error_log($msg, 1,$this->emails_dev);
        } elseif ($num>500){
            error_log($msg, 1,$this->emails_customer);
        }
    }

    function exitApp(){
        exit();
    }

}