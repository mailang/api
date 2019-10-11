<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Zhongsheng {
    function getdata($api,$data,$time = 5){

        $zsapi = "";
        switch ($api) {
            case 'bank':
                $actionname = "bankcdvefy";
                break;
            case 'gongshangthree':
                $actionname = "saic3vld";
                break;
            case 'gongshangfour':
                $actionname = "saic4vld";
                break;
            case 'fapiao':
                $actionname = "Synchronousinvoice";
                break;
            case 'vin':
                $actionname = "VINCheck";
                break;
            case 'fangjia':
                $actionname = "EstatesPriceSim";
                break;
            case 'company':
                $actionname = "compybasic";
                break;
            default:
                return "500";
        }



        $queryInfo = $data;


        $postdata = new postdata();
        $order = $this->getorder($postdata->account);
        $baseInfo = array(
            "account" => $postdata->account,
            "order" => $order,
            "sign" => strtoupper(substr(md5($postdata->account.$postdata->password.json_encode($queryInfo,JSON_UNESCAPED_UNICODE).$order),8,16))
        );

        $datao = array(
            "baseInfo" => $baseInfo,
            "queryInfo" => $queryInfo
        );

        $enjson = json_encode($datao,JSON_UNESCAPED_UNICODE);
        $datastr = "actionName=".$actionname."&encrypt=2&api=s&params=".base64_encode(urlencode($enjson));

        //echo $datastr;
        //exit();

        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,$postdata->url);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST,true);
        curl_setopt($ch, CURLOPT_POSTFIELDS,$datastr);
        curl_setopt($ch, CURLOPT_TIMEOUT,$time);
        curl_setopt($ch, CURLOPT_HTTPHEADER,array(
            'Content-Type: application/x-www-form-urlencoded'
        ));
        $out = curl_exec($ch);
        log_message('info',$datastr."---curlarr---time:".date("Y-m-d H:i:s"));
        
        if(curl_errno($ch))
        {
            log_message('error',$datastr."---curlerr---time:".date("Y-m-d H:i:s"));
            return "500";
        }
        curl_close($ch);
        log_message('info','source返回:'.$out);
        return $out;
    }

    function getorder($account){
        $time = date('YmdHis');
        mt_srand((double)microtime() * 1000000);
        $strand = str_pad(mt_rand(1, 9999999999),6,"0",STR_PAD_LEFT);
        return strtoupper($account).date('Ymd').$strand;
    }

}

class postdata{
    public $account = "yszh"; //账号
    public $password = "E6gODz86";//密码
    public $url = "http://apt.zhixin.net:8711/wndc_newapi";// 测试地址
}