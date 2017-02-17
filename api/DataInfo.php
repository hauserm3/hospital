<?php

class DataInfo{

    function __construct(){
        $this->errHandling = new ErrorHandling();
    }

    function getContent($file_path){
        try{
            $indexes = json_decode(file_get_contents($file_path));
            if(!$indexes){
                $this->errHandling->createError(602,$file_path.' - empty file!!!'); //13 //14
                return 0;
            } else {
                $indexes = $indexes->rooms;
                return $indexes;
            }
        }catch (Exception $e){
            $this->errHandling->writeError($e->getMessage());
        }
    }

    function getRoomById($room_id,$main_arr){
        try{
            $room = $this->getDataByID($room_id, $main_arr);
            if(!$room) $this->errHandling->createError(702,'Data missing! Room ID('.$room_id.') not registered by administrator!!!'); //15
            return $room;
        } catch (Exception $e){
            $this->errHandling->writeError($e->getMessage());
        }
    }

    function getRoomByIp($room_ip,$main_arr,$indexes){
        try{
            $room_id = $this->getRoomIdByIP($room_ip, $indexes);
            if($room_id){
                $room = $this->getDataByID($room_id, $main_arr);
                if(!$room) $this->errHandling->createError(704,'Data missing! Room('.$room_id.') not in parsed file!!!'); //17
                return $room;
            }else{
                $this->errHandling->createError(703,'Data missing! Room IP('.$room_ip.') not registered by administrator!!!'); //16
            }
        }catch (Exception $e){
            $this->errHandling->writeError($e->getMessage());
        }
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

    function sendResponse($room){
        $out = new stdClass();
        $out->result = $room;

        header('Content-type: application/json');
        echo json_encode($out);
    }

}