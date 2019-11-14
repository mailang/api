<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Alading {


    function getdata($api,$data,$time = 5){
        switch ($api) {
            case 'idcheck':
                $apikey = "B01010";
                break;
            case 'idphoto':
                $apikey = "21024";
                break;
            default:
                return "500";
        }
        $postdata = new postdata();
        $datastr = http_build_query($data);
        $endatastr = base64_encode(openssl_encrypt($datastr, 'DES-CBC',$postdata->key,OPENSSL_RAW_DATA,$postdata->key));
        log_message('info',$datastr."  ".$endatastr);
        $alldata = array(
            "apiKey" => $apikey,
            "username" => $postdata->account,
            "format" => "json",
            "params" => $endatastr
        );


        $alldatastr = http_build_query($alldata);
        log_message('info',$alldatastr);
        $ch = curl_init();

        curl_setopt($ch,CURLOPT_URL,$postdata->url);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST,true);
        curl_setopt($ch, CURLOPT_POSTFIELDS,$alldatastr);
        curl_setopt($ch, CURLOPT_TIMEOUT,$time);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_HTTPHEADER,array(
            'Content-Type: application/x-www-form-urlencoded;charset=utf-8'
        ));
        $out = curl_exec($ch);

        if(curl_errno($ch))
        {
            log_message('error',$datastr."---curlerr---time:".date("Y-m-d H:i:s").$ch);
            return "500";
        }
        curl_close($ch);
        log_message('info','source返回:'.$out);
        $jsonout = json_decode($out,true);

        return $out;
    }
}

class postdata{
    public $account = "anhuixinhua"; //账号
    public $key = "NQiF72xz";//密码
    public $url = "http://47.102.14.122/hbws/api/rest/main";// 测试地址
}