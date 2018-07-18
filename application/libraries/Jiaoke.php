<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jiaoke {
    private $url = "http://api.jkcredit.com:8080/";
    private $appid = "xinhuashuju";
    private $appkey = "0d15fba357ab3b4dbfda23517153a640";

    function getIDcheck($name,$idNo)
    {
        try
        {
            $apiurl = "idcheck";
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
            curl_setopt($ch,CURLOPT_URL,$this->url.$apiurl);
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

    function mobile($name,$idNo,$phone)
    {
        try
        {
            $apiurl = "mobile";
            $sign = md5($idNo.$name.$phone.$this->appkey);

            $arr = array(
                'Appid'=>$this->appid,
                'Name'=>$name,
                'IdCode'=>$idNo,
                'Phone'=>$phone,
                'Sign'=>$sign
            );
            $data_string =  json_encode($arr,JSON_UNESCAPED_UNICODE);
            //log_message('info',"111");
            //print_r($data_string);
            $ch = curl_init();
            curl_setopt($ch,CURLOPT_URL,$this->url.$apiurl);
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

    function szmcmcch($name,$idNo,$phone)
    {
        try
        {
            $apiurl = "szmcmcch";
            $sign = md5($idNo.$phone.$name.$this->appkey);

            $arr = array(
                'Appid'=>$this->appid,
                'Name'=>$name,
                'IdCode'=>$idNo,
                'Mobile'=>$phone,
                'Sign'=>$sign
            );
            $data_string =  json_encode($arr,JSON_UNESCAPED_UNICODE);
            //log_message('info',"111");
            //print_r($data_string);
            $ch = curl_init();
            curl_setopt($ch,CURLOPT_URL,$this->url.$apiurl);
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

    function bankthree($name,$idNo,$bankcard)
    {
        try
        {
            $apiurl = "bankthree";
            $sign = md5($bankcard.$idNo.$name.$this->appkey);

            $arr = array(
                'Appid'=>$this->appid,
                'Name'=>$name,
                'IdentityCard'=>$idNo,
                'Bankcard'=>$bankcard,
                'Sign'=>$sign
            );
            $data_string =  json_encode($arr,JSON_UNESCAPED_UNICODE);
            //log_message('info',"111");
            //print_r($data_string);
            $ch = curl_init();
            curl_setopt($ch,CURLOPT_URL,$this->url.$apiurl);
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST,true);
            curl_setopt($ch, CURLOPT_POSTFIELDS,$data_string);
            curl_setopt($ch, CURLOPT_TIMEOUT,10);
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

    function bankfour($name,$idNo,$bankcard,$phone)
    {
        try
        {
            $apiurl = "bankfour";
            $sign = md5($bankcard.$idNo.$name.$phone.$this->appkey);

            $arr = array(
                'Appid'=>$this->appid,
                'Name'=>$name,
                'IdentityCard'=>$idNo,
                'Bankcard'=>$bankcard,
                'Phone'=>$phone,
                'Sign'=>$sign
            );
            $data_string =  json_encode($arr,JSON_UNESCAPED_UNICODE);
            //log_message('info',"111");
            //print_r($data_string);
            $ch = curl_init();
            curl_setopt($ch,CURLOPT_URL,$this->url.$apiurl);
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST,true);
            curl_setopt($ch, CURLOPT_POSTFIELDS,$data_string);
            curl_setopt($ch, CURLOPT_TIMEOUT,10);
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