<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Xiaoshi {


    function bankthree($name,$idNo,$bankcard,$time = 5){
        $postdata = new postdata();
        $arr = array(
            'name' => $name,
            'idCard' => $idNo,
            'accountNo' => $bankcard
        );

        $datastr = json_encode($arr, JSON_UNESCAPED_UNICODE);
        log_message('info',$datastr);

        $alldata = array(
            "loginName" => $postdata->account,
            "pwd" => $postdata->key,
            "serviceName" => $postdata->servicename3,
            "param" => $arr
        );

        $randStr = str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890');
        $rand = substr($randStr,0,6);

        $mvTrackId = date("YmdHis")."_".$postdata->servicename3."_".$postdata->account.$rand;


        $alldatastr = json_encode($alldata, JSON_UNESCAPED_UNICODE);

        log_message('info',$alldatastr);
        $ch = curl_init();

        curl_setopt($ch,CURLOPT_URL,$postdata->url3);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST,true);
        curl_setopt($ch, CURLOPT_POSTFIELDS,$alldatastr);
        curl_setopt($ch, CURLOPT_TIMEOUT,$time);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_HTTPHEADER,array(
            'Content-Type: application/x-www-form-urlencoded;charset=utf-8,mvTrackId:'.$mvTrackId
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


    function bankfour($name,$idNo,$bankcard,$phone,$time = 5){
        $postdata = new postdata();
        $arr = array(
            'name' => $name,
            'idCard' => $idNo,
            'accountNo' => $bankcard,
            'mobile' => $phone
        );

        $datastr = json_encode($arr, JSON_UNESCAPED_UNICODE);
        log_message('info',$datastr);

        $alldata = array(
            "loginName" => $postdata->account,
            "pwd" => $postdata->key,
            "serviceName" => $postdata->servicename4,
            "param" => $arr
        );

        $randStr = str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890');
        $rand = substr($randStr,0,6);

        $mvTrackId = date("YmdHis")."_".$postdata->servicename4."_".$postdata->account.$rand;


        $alldatastr = json_encode($alldata, JSON_UNESCAPED_UNICODE);

        log_message('info',$alldatastr);
        $ch = curl_init();

        curl_setopt($ch,CURLOPT_URL,$postdata->url4);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST,true);
        curl_setopt($ch, CURLOPT_POSTFIELDS,$alldatastr);
        curl_setopt($ch, CURLOPT_TIMEOUT,$time);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_HTTPHEADER,array(
            'Content-Type: application/x-www-form-urlencoded;charset=utf-8,mvTrackId:'.$mvTrackId
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

    function http_build_query($arr){
        $paramsJoined  = array();
        foreach ($arr as $param=>$value){
            $paramsJoined[] = $param."=".$value;
        }
        $query = implode('&', $paramsJoined);
        return $query;

    }
}

class postdata{
    public $account = "huasheng"; //账号
    public $key = "huasheng0225";//密码
    public $servicename3 = "NameIDCardAccountVerify";
    public $servicename4 = "NameIDCardPhoneAccountVerify";
    public $url3 = "https://www.miniscores.cn:8313/CreditFunc/v2.1/NameIDCardAccountVerify";// 测试地址
    public $url4 = "https://www.miniscores.cn:8313/CreditFunc/v2.1/NameIDCardPhoneAccountVerify";// 测试地址
}