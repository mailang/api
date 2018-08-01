<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Identity {
    private $url = "http://122.14.204.130:7968/api/data.do";
    private $appcode = "473801580198494208";

    function gettwncard($name,$cardNo,$birthDay,$validity)
    {
        try
        {
            $arr = array(
                'cardType'=>'16',
                'name'=>$name,
                'cardNum'=>$cardNo,
                'birthDay'=>$birthDay,
                'validity'=>$validity
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
                'AppCode: ' . $this->appcode,
                'pcode: E_001_0501'
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

    function gethkmacard($name,$cardNo,$birthDay,$validity)
    {
        try
        {
            $arr = array(
                'cardType'=>'24',
                'name'=>$name,
                'cardNum'=>$cardNo,
                'birthDay'=>$birthDay,
                'validity'=>$validity
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
                'AppCode: ' . $this->appcode,
                'pcode: E_001_0601'
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

    function getgreencard($enName,$cardNo,$birthDay,$validity)
    {
        try
        {
            $arr = array(
                'cardType'=>'34',
                'enName'=>$enName,
                'cardNum'=>$cardNo,
                'birthDay'=>$birthDay,
                'validity'=>$validity
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
                'AppCode: ' . $this->appcode,
                'pcode: E_001_0401'
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

    function getIDvalidity($beginDate,$name,$idNo)
    {
        try
        {
            $arr = array(
                'beginDate'=>$beginDate,
                'name'=>$name,
                'idNo'=>$idNo
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
                'AppCode: ' . $this->appcode,
                'pcode: E_001_0301'
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

    function getIDcheck($name,$idNo)
    {
        try
        {
            $arr = array(
                'name'=>$name,
                'idNo'=>$idNo
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
                'AppCode: ' . $this->appcode,
                'pcode: P_001_0001'
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