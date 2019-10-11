<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Apiclass {

    public $CI;

    /**
     * 中国电信：China Telecom
     * 133、149、153、173、177、180、181、189、199
     */
    private $ct = "/^1((33|49|53|73|77|80|81|89|99)[0-9])\d{7}$/";

    /**
     * 中国联通：China Unicom
     * 130、131、132、145、155、156、166、171、175、176、185、186
     */
    private $cu = "/^1(30|31|32|45|55|56|66|71|75|76|85|86)\d{8}$/";

    /**
     * 中国移动：China Mobile
     * 134(0-8)、135、136、137、138、139、147、150、151、152、157、158、159、178、182、183、184、187、188、198
     */
    private $cm = "/^1(34[0-8]|(3[5-9]|47|5[012789]|78|8[23478]|98)[0-9])\d{7}$/";

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
        $this->CI->api_model->insertorder($orderno,$userid,$proid,$detail,$ischarge,$state,$apistatis,$time);
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
        if (preg_match($this->cm,$phone)){
            return true;
        }else{
            return false;
        }
    }

    public function isTelecom($phone){
        if (preg_match($this->ct,$phone)){
            return true;
        }else{
            return false;
        }
    }

    public function isUnicom($phone){
        if (preg_match($this->cu,$phone)){
            return true;
        }else{
            return false;
        }
    }


}