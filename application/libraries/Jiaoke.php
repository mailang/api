<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jiaoke {
    private $url = "http://api.jkcredit.com:8080/idcheck";
    private $appid = "anshuoshuju";
    private $appkey = "962c0f796728cf4e7e311a9712713879";

    function getIDcheck($name,$idNo)
    {
        try
        {
            $sign = md5($idNo.$name.$this->appkey);

            $arr = array(
                'Appid'=>$this->appid,
                'Name'=>$name,
                'IdCode'=>$idNo,
                'Sign'=>$sign
            );
            $data_string =  json_encode($arr,JSON_UNESCAPED_UNICODE);
            //log_message('info',"111");
            //print_r($data_string);
            $ch = curl_init();
            curl_setopt($ch,CURLOPT_URL,$this->url);
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST,true);
            curl_setopt($ch, CURLOPT_POSTFIELDS,$data_string);
            curl_setopt($ch, CURLOPT_TIMEOUT,5);
            curl_setopt($ch, CURLOPT_HTTPHEADER,array(
                'Content-Type: application/json; charset=utf-8',
            ));
            $out = curl_exec($ch);
            if(curl_errno($ch))
            {
                log_message('error',$data_string."---curlerr---time:".date("Y-m-d H:i:s"));
                return "500";
            }
            curl_close($ch);
            log_message('info','source返回:'.$out);
            return $out;
        }
        catch(Exception $e)
        {
            log_message('error',$data_string."---ex---time:".date("Y-m-d H:i:s"));
            log_message('error',$e->getMessage());
            return "500";
        }
    }

}