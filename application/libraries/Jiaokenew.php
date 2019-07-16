<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Jiaokenew {
    private $url = "http://api.jkcredit.com:58080/gateway?api=credit.sec.data";

    function getdata($api,$data,$time=5)
    {
        try
        {

            $postdata = new postdata();

            switch ($api){
                case 'idcheck':
                    $postdata->api = "IDCARD_2ND_CHECK";
                    break;
                case 'idphoto':
                    $postdata->api = "ST_FACE_CHECK";
                    break;
                case 'mobile':
                    $postdata->api = "SCM_CMCC_3ND_CHECK";
                    break;
                case 'bankthree':
                    $postdata->api = "BANK_THREE_INFO";
                    break;
                case 'bankfour':
                    $postdata->api = "BANK_FOUR_INFO";
                    break;
                case 'cmcconline':
                    $postdata->api = "CMCC_ONLINE_CHECK";
                    break;
                case 'cmccstatus':
                    $postdata->api = "CMCC_STATUS_CHECK";
                    break;
                case 'cucconline':
                    $postdata->api = "CUCC_ONLINE_CHECK";
                    break;
                case 'cuccstatus':
                    $postdata->api = "CUCC_STATUS_CHECK";
                    break;
                case 'ctcconline':
                    $postdata->api = "CTCC_ONLINE_CHECK";
                    break;
                case 'ctccstatus':
                    $postdata->api = "CTCC_STATUS_CHECK";
                    break;
                default:
                    return "500";
            }


            $sign = $data;

            $sign["appSecret"] = "6E7B4149CCB50522E92BFE205D60C9A413D057EB";
            ksort($sign);

            $arr2 = [];
            foreach ($sign as $key=> $value){
                $arr2[] = $key.'='.$value;
            }

            $signstr = strtoupper(md5(implode("&",$arr2)));

            $data["sign"] = $signstr;


            $postdata->data = $data;

            $data_string =  json_encode($postdata,JSON_UNESCAPED_UNICODE);


            $ch = curl_init();
            curl_setopt($ch,CURLOPT_URL,$this->url);
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST,true);
            curl_setopt($ch, CURLOPT_POSTFIELDS,$data_string);
            curl_setopt($ch, CURLOPT_TIMEOUT,$time);
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
            log_message('info','data:'.$data_string.'source返回:'.$out);
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

class postdata{
    public $api = "";
    public $appKey = "xinhuashuju";
    public $data;
    public $appSecret = "6E7B4149CCB50522E92BFE205D60C9A413D057EB";
}