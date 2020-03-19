<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Zhongchengxin {
    private $url = "http://apidata.credittone.com:51666/api/query";
    //private $url = "http://www.163.com";
    private $username = "Xinhuashe";
    private $password = "TdfdY6dhdLhBiRHg";
    private $key = "0bnAaVkCKNoV6ToU";

    public function getmobile($name,$idNo,$phone)
    {
        try {
            $protocol_data_type_name = "phone3dVerifyRealName";
            $arr = array(
                'id_no' => $idNo,
                'protocol_data_type_name' => array($protocol_data_type_name),
                'name' => $name,
                'mobile_no' => $phone
            );
            $data_json = json_encode($arr, JSON_UNESCAPED_UNICODE);
            $data_json_en = openssl_encrypt($data_json, 'AES-128-ECB', $this->key, OPENSSL_RAW_DATA);
            $data_json_en = strtoupper(bin2hex($data_json_en));

            $password_en =  openssl_encrypt($this->password, 'AES-128-ECB', $this->key, OPENSSL_RAW_DATA);
            $password_en = strtoupper(bin2hex($password_en));
            $postdata = array(
                "params" => $data_json_en,
                "username" => $this->username,
                "password" => $password_en
            );
            $poststr = http_build_query($postdata);
            $ch = curl_init();
            //curl_setopt($ch,CURLOPT_PROXY,'10.0.2.2:8888');
            curl_setopt($ch,CURLOPT_URL,$this->url);
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST,true);
            curl_setopt($ch, CURLOPT_POSTFIELDS,$poststr);
            curl_setopt($ch, CURLOPT_TIMEOUT,10);
            curl_setopt($ch, CURLOPT_HTTPHEADER,array(
                'Content-Type: application/x-www-form-urlencoded'
            ));
            $out = curl_exec($ch);
            //log_message('info',$poststr."---curlarr---time:".date("Y-m-d H:i:s"));
            //$out = "";
            if(curl_errno($ch))
            {
                log_message('error',$poststr."---curlerr---time:".date("Y-m-d H:i:s"));
                return "500";
            }
            curl_close($ch);
            log_message('info','source返回:'.$out);
            return $out;
        }
        catch(Exception $e)
        {
            log_message('error',$postdata."---ex---time:".date("Y-m-d H:i:s"));
            log_message('error',$e->getMessage());
            return "500";
        }
    }

    public function mobileonline($phone)
    {
        try {
            $protocol_data_type_name = "phoneNetworkPeriods";
            $arr = array(
                'id_no' => "12022219990101925x",
                'protocol_data_type_name' => array($protocol_data_type_name),
                'name' => "张三",
                'mobile_no' => $phone
            );
            $data_json = json_encode($arr, JSON_UNESCAPED_UNICODE);
            $data_json_en = openssl_encrypt($data_json, 'AES-128-ECB', $this->key, OPENSSL_RAW_DATA);
            $data_json_en = strtoupper(bin2hex($data_json_en));

            $password_en =  openssl_encrypt($this->password, 'AES-128-ECB', $this->key, OPENSSL_RAW_DATA);
            $password_en = strtoupper(bin2hex($password_en));
            $postdata = array(
                "params" => $data_json_en,
                "username" => $this->username,
                "password" => $password_en
            );
            $poststr = http_build_query($postdata);
            $ch = curl_init();
            //curl_setopt($ch,CURLOPT_PROXY,'10.0.2.2:8888');
            curl_setopt($ch,CURLOPT_URL,$this->url);
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST,true);
            curl_setopt($ch, CURLOPT_POSTFIELDS,$poststr);
            curl_setopt($ch, CURLOPT_TIMEOUT,10);
            curl_setopt($ch, CURLOPT_HTTPHEADER,array(
                'Content-Type: application/x-www-form-urlencoded'
            ));
            $out = curl_exec($ch);
            //log_message('info',$poststr."---curlarr---time:".date("Y-m-d H:i:s"));
            //$out = "";
            if(curl_errno($ch))
            {
                log_message('error',$poststr."---curlerr---time:".date("Y-m-d H:i:s"));
                return "500";
            }
            curl_close($ch);
            log_message('info','source返回:'.$out);
            return $out;
        }
        catch(Exception $e)
        {
            log_message('error',$postdata."---ex---time:".date("Y-m-d H:i:s"));
            log_message('error',$e->getMessage());
            return "500";
        }
    }

    public function mobilestatus($phone)
    {
        try {
            $protocol_data_type_name = "phoneNetworkStatus";
            $arr = array(
                'id_no' => "12022219990101925x",
                'protocol_data_type_name' => array($protocol_data_type_name),
                'name' => "张三",
                'mobile_no' => $phone
            );
            $data_json = json_encode($arr, JSON_UNESCAPED_UNICODE);
            $data_json_en = openssl_encrypt($data_json, 'AES-128-ECB', $this->key, OPENSSL_RAW_DATA);
            $data_json_en = strtoupper(bin2hex($data_json_en));

            $password_en =  openssl_encrypt($this->password, 'AES-128-ECB', $this->key, OPENSSL_RAW_DATA);
            $password_en = strtoupper(bin2hex($password_en));
            $postdata = array(
                "params" => $data_json_en,
                "username" => $this->username,
                "password" => $password_en
            );
            $poststr = http_build_query($postdata);
            $ch = curl_init();
            //curl_setopt($ch,CURLOPT_PROXY,'10.0.2.2:8888');
            curl_setopt($ch,CURLOPT_URL,$this->url);
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST,true);
            curl_setopt($ch, CURLOPT_POSTFIELDS,$poststr);
            curl_setopt($ch, CURLOPT_TIMEOUT,10);
            curl_setopt($ch, CURLOPT_HTTPHEADER,array(
                'Content-Type: application/x-www-form-urlencoded'
            ));
            $out = curl_exec($ch);
            //log_message('info',$poststr."---curlarr---time:".date("Y-m-d H:i:s"));
            //$out = "";
            if(curl_errno($ch))
            {
                log_message('error',$poststr."---curlerr---time:".date("Y-m-d H:i:s"));
                return "500";
            }
            curl_close($ch);
            log_message('info','source返回:'.$out);
            return $out;
        }
        catch(Exception $e)
        {
            log_message('error',$postdata."---ex---time:".date("Y-m-d H:i:s"));
            log_message('error',$e->getMessage());
            return "500";
        }
    }

    public function bankthree($name,$idNo,$bankcard)
    {
        try {
            $protocol_data_type_name = "bankCard3dVerify";
            $arr = array(
                'id_no' => $idNo,
                'protocol_data_type_name' => array($protocol_data_type_name),
                'name' => $name,
                'bank_card_no' => $bankcard
            );
            $data_json = json_encode($arr, JSON_UNESCAPED_UNICODE);
            $data_json_en = openssl_encrypt($data_json, 'AES-128-ECB', $this->key, OPENSSL_RAW_DATA);
            $data_json_en = strtoupper(bin2hex($data_json_en));

            $password_en =  openssl_encrypt($this->password, 'AES-128-ECB', $this->key, OPENSSL_RAW_DATA);
            $password_en = strtoupper(bin2hex($password_en));
            $postdata = array(
                "params" => $data_json_en,
                "username" => $this->username,
                "password" => $password_en
            );
            $poststr = http_build_query($postdata);
            $ch = curl_init();
            //curl_setopt($ch,CURLOPT_PROXY,'10.0.2.2:8888');
            curl_setopt($ch,CURLOPT_URL,$this->url);
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST,true);
            curl_setopt($ch, CURLOPT_POSTFIELDS,$poststr);
            curl_setopt($ch, CURLOPT_TIMEOUT,10);
            curl_setopt($ch, CURLOPT_HTTPHEADER,array(
                'Content-Type: application/x-www-form-urlencoded'
            ));
            $out = curl_exec($ch);
            //log_message('info',$poststr."---curlarr---time:".date("Y-m-d H:i:s"));
            //$out = "";
            if(curl_errno($ch))
            {
                log_message('error',$poststr."---curlerr---time:".date("Y-m-d H:i:s"));
                return "500";
            }
            curl_close($ch);
            log_message('info','source返回:'.$out);
            return $out;
        }
        catch(Exception $e)
        {
            log_message('error',$postdata."---ex---time:".date("Y-m-d H:i:s"));
            log_message('error',$e->getMessage());
            return "500";
        }
    }

    public function bankfour($name,$idNo,$bankcard,$phone)
    {
        try {
            $protocol_data_type_name = "bankCard4dVerify";
            $arr = array(
                'id_no' => $idNo,
                'protocol_data_type_name' => array($protocol_data_type_name),
                'name' => $name,
                'bank_card_no' => $bankcard,
                'obligate_mobile_no' => $phone
            );
            $data_json = json_encode($arr, JSON_UNESCAPED_UNICODE);
            $data_json_en = openssl_encrypt($data_json, 'AES-128-ECB', $this->key, OPENSSL_RAW_DATA);
            $data_json_en = strtoupper(bin2hex($data_json_en));

            $password_en =  openssl_encrypt($this->password, 'AES-128-ECB', $this->key, OPENSSL_RAW_DATA);
            $password_en = strtoupper(bin2hex($password_en));
            $postdata = array(
                "params" => $data_json_en,
                "username" => $this->username,
                "password" => $password_en
            );
            $poststr = http_build_query($postdata);
            $ch = curl_init();
            //curl_setopt($ch,CURLOPT_PROXY,'10.0.2.2:8888');
            curl_setopt($ch,CURLOPT_URL,$this->url);
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST,true);
            curl_setopt($ch, CURLOPT_POSTFIELDS,$poststr);
            curl_setopt($ch, CURLOPT_TIMEOUT,10);
            curl_setopt($ch, CURLOPT_HTTPHEADER,array(
                'Content-Type: application/x-www-form-urlencoded'
            ));
            $out = curl_exec($ch);
            //log_message('info',$poststr."---curlarr---time:".date("Y-m-d H:i:s"));
            //$out = "";
            if(curl_errno($ch))
            {
                log_message('error',$poststr."---curlerr---time:".date("Y-m-d H:i:s"));
                return "500";
            }
            curl_close($ch);
            log_message('info','source返回:'.$out);
            return $out;
        }
        catch(Exception $e)
        {
            log_message('error',$postdata."---ex---time:".date("Y-m-d H:i:s"));
            log_message('error',$e->getMessage());
            return "500";
        }
    }


}