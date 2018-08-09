<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Apiclass {

    public $CI;
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

}