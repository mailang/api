<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Tanzhen {
    public $CI;
    public $token;
    public function __construct() {
        $this->CI = & get_instance();
        $this->CI->load->driver('cache');
        $this->getcache();
    }

    function ishascache(){
        return $this->CI->cache->file->get("token")?true:false;
    }

    function getcache(){
        if ($token = $this->CI->cache->file->get("token"))
        {
            $this->token = $token;
        }
        else
        {
            $postdata = new postdata();
            $url = $postdata->url."auth/getToken";
            $datastr = "username=".$postdata->account."&password=".$postdata->password;
            $ch = curl_init();
            curl_setopt($ch,CURLOPT_URL,$url);
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST,true);
            curl_setopt($ch, CURLOPT_POSTFIELDS,$datastr);
            curl_setopt($ch, CURLOPT_TIMEOUT,5);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
            curl_setopt($ch, CURLOPT_HTTPHEADER,array(
                'Content-Type: application/x-www-form-urlencoded;charset=utf-8'
            ));
            $out = curl_exec($ch);

            if(curl_errno($ch))
            {
                echo curl_error($ch);
            }
            curl_close($ch);

            $outo = json_decode($out);

            if ($outo->token){
                $this->CI->cache->file->save("token",$outo->token,60*60*10);
                $this->token = $outo->token;
            }else{
                throw new Exception("获取token失败！");
            }
        }
    }

    function test(){
        return $this->CI->cache->file->get("token");
    }

    function change(){
        $this->CI->cache->file->save("token","change",1);
        return $this->CI->cache->file->get("token");
    }


    function getdata($api,$data,$time = 5){
        switch ($api) {
            case 'telecomonline':
                $actionname = "api/ctcc/duration?";
                break;
            case 'unicomonline':
                $actionname = "api/cucc/duration?";
                break;
            case 'status':
                $actionname = "api/state/v2?";
                break;
            case 'three':
                $actionname = "api/threefactor/v2/verify?";
                break;
            case 'threemd5':
                $actionname = "api/threefactor/md5/v2/verify?";
                break;
            default:
                return "500";
        }
        $postdata = new postdata();
        $datastr = http_build_query($data);
        $ch = curl_init();

        curl_setopt($ch,CURLOPT_URL,$postdata->url.$actionname.$datastr);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST,true);
        curl_setopt($ch, CURLOPT_POSTFIELDS,"");
        curl_setopt($ch, CURLOPT_TIMEOUT,$time);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_HTTPHEADER,array(
            'Content-Type: application/x-www-form-urlencoded;charset=utf-8',"auth-user:$postdata->account","auth-token:$this->token"
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
        if ($jsonout["code"] == 6){
            $this->getcache();
            return $this->getdata($api,$data,$time);
        }
        return $out;
    }
}

class postdata{
    public $account = "hskj"; //账号
    public $password = "PRHWVMjs";//密码
    public $url = "https://api.tanzhen.io/";// 测试地址
}