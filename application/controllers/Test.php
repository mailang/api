<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {
    public function index(){
        $this->benchmark->mark('function_start');
        $time1 = $this->benchmark->elapsed_time('total_execution_time_start', 'function_start');
        echo $time1;
        $key = "xinhua8c7720a7ff";
        $str = "123456";
        $data_json_en = openssl_encrypt($str, 'AES-128-ECB', $key, OPENSSL_RAW_DATA);
        //$data_json_en = strtoupper(bin2hex($data_json_en));
        $data_json_en = base64_encode($data_json_en);

        $str1 = "123456";
        $data_json_en1 = openssl_encrypt($str1, 'AES-128-ECB', $key, OPENSSL_RAW_DATA);
        //$data_json_en = strtoupper(bin2hex($data_json_en));
        $data_json_en1 = base64_encode($data_json_en1);


        echo $data_json_en1;
        echo "<br/>";
//        echo $data_json_en;
//        echo "<br/>";
        $str3 = $data_json_en1;
        $data_json_de3 = base64_decode("$str3");
        $data_json_de3 = openssl_decrypt($data_json_de3, 'AES-128-ECB', $key, OPENSSL_RAW_DATA);
        echo $data_json_de3;
        //$this->load->library('apiclass');
        //echo $this->apiclass->decrypt($str3);
        //$data = json_decode($str3);
//        $name = !empty($data["name"])?$data["name"]:null;
//        var_dump($name);
    }

    public function test1(){
        $this->benchmark->mark('function_start');
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,"http://www.baidu.com");
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT,5);
        curl_setopt($ch, CURLOPT_HTTPHEADER,array(
            'Content-Type: application/json; charset=utf-8',
        ));
        $out = curl_exec($ch);
        $this->benchmark->mark('function_end');
        log_message("info",$this->benchmark->elapsed_time('total_execution_time_start', 'function_start'));
        if(curl_errno($ch))
        {
            log_message('error',"testbaidu---curlerr---time:".date("Y-m-d H:i:s"));
            return "500";
        }
        curl_close($ch);
        echo $out;
    }
}