<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Apiclass {

    public $CI;

    /**
          * 中国电信号码格式验证 手机段： 133,153,180,181,189,177,1700
          * **/
    private  $CHINA_TELECOM_PATTERN = "(^1(33|53|77|8[019])\\d{8}$)|(^1700\\d{7}$)";

    /**
    * 中国联通号码格式验证 手机段：130,131,132,155,156,185,186,145,176,1709
    * **/
    private  $CHINA_UNICOM_PATTERN = "(^1(3[0-2]|4[5]|5[56]|7[6]|8[56])\\d{8}$)|(^1709\\d{7}$)";

     /**
    * 中国移动号码格式验证
    * 手机段：134,135,136,137,138,139,150,151,152,157,158,159,182,183,184
    * ,187,188,147,178,1705
    * **/
    private $CHINA_MOBILE_PATTERN = "(^1(3[4-9]|4[7]|5[0-27-9]|7[8]|8[2-478])\\d{8}$)|(^1705\\d{7}$)";

    public function __construct()
    {
        $this->CI = & get_instance();
        $this->CI->load->model('Api_model','api_model');
        $this->CI->config->load('api', TRUE);
    }

    public function validate()
    {
        $appkey = $this->CI->input->server("HTTP_APPKEY");
        $api = $this->CI->router->fetch_method();
        switch($userid = $this->validateuser($appkey))
        {
            case 103:
            case 104:
                return $userid;
            default:
                return $this->validateuserapi($userid,$api);
        }
    }

    public function validateuser($appkey)
    {
        $resault = false;
        $user = $this->CI->api_model->getuser($appkey);
        if($user == null)
        {
            return 103;
        }
        if ($user->isable != "1")
        {
            return 104;
        }
        return $user->id;
    }

    public function validateuserapi($userid,$api)
    {
        $userapi = $this->CI->api_model->getuserapi($userid,$api);
        if($userapi == null)
        {
            return 105;
        }
        if(!($userapi->charge_count < $userapi->all_count))
        {
            return 106;
        }
        $arr = array('userproid'=>$userapi->id,'userid'=>$userid,'proid'=>$userapi->proid);
        return $arr;
    }

    public function response($code,$arr = null,$orderno = null)
    {
        $jsondata["code"] = "$code";
        //$jsondata["time"] = date("Y-m-d H:i:s");
        if ($arr)
        {
            $jsondata["data"] = $arr;
        }
        if ($orderno)
        {
            $jsondata["orderNo"] = $orderno;
        }
        $jsondata["message"] = $this->CI->config->item('msg','api')[$code];
        $data = json_encode($jsondata,JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES |JSON_PRETTY_PRINT);
        $this->CI->output->set_output($data);
    }

    public function updatedb($userproid,$userid,$proid,$detail,$state,$ischarge,$orderno,$apistatis)
    {
        $time = date("Y-m-d H:i:s");
        //$orderno = $this->createorderno();
        $this->CI->api_model->insertorder($orderno,$userid,$proid,$detail,$ischarge,$state,$time);
        $this->CI->api_model->updateuserpro($userproid,$ischarge,$time);
        $this->CI->api_model->updatestatis($apistatis,$time);
    }

    public function createorderno()
    {
        $order_id_main = date('YmdHis') . rand(10000000,99999999);

        //订单号码主体长度

        $order_id_len = strlen($order_id_main);

        $order_id_sum = 0;

        for($i=0; $i<$order_id_len; $i++){

            $order_id_sum += (int)(substr($order_id_main,$i,1));

        }

        //唯一订单号码（YYYYMMDDHHIISSNNNNNNNNCC）

        $orderno = $order_id_main . str_pad((100 - $order_id_sum % 100) % 100,2,'0',STR_PAD_LEFT);
        return $orderno;
    }

    public function decrypt($jsondata)
    {
        $isencrypt = empty($this->CI->input->server("HTTP_ENCRYPT"))?0:$this->CI->input->server("HTTP_ENCRYPT");
        if ($isencrypt == 1)
        {
            $appkey = $this->CI->input->server("HTTP_APPKEY");
            $user = $this->CI->api_model->getuser($appkey);
            $publickey = $user->public_key;
            $data_json_de = base64_decode($jsondata);
            $data_json_de = openssl_decrypt($data_json_de, 'AES-128-ECB', $publickey, OPENSSL_RAW_DATA);
            return $data_json_de;
        }
        else
        {
            return $jsondata;
        }
    }

    public function isMobile($phone){
        if (preg_match($this->CHINA_MOBILE_PATTERN,$phone)){
            return true;
        }else{
            return false;
        }
    }

    public function isTelcom($phone){
        if (preg_match($this->CHINA_TELECOM_PATTERN,$phone)){
            return true;
        }else{
            return false;
        }
    }

    public function isUnicom($phone){
        if (preg_match($this->CHINA_UNICOM_PATTERN,$phone)){
            return true;
        }else{
            return false;
        }
    }


}