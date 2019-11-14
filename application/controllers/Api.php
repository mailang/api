<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */

    public function __construct()
    {
        parent::__construct();
        $this->load->library('apiclass');
    }

    public function index()
    {
        $this->load->view('admin/login.html');
    }


//    public function twncard()
//    {
//        try{
//            //判断用户接口权限
//            $validitycode = $this->apiclass->validate();
//            $code = is_numeric($validitycode)?$validitycode:1;
//            if($code == 1)
//            {
//                $datajson = file_get_contents('php://input');
//                log_message('info',$datajson."---time:".date("Y-m-d H:i:s"));
//                $datajson = $this->apiclass->decrypt($datajson);
//                log_message('info',$datajson."---time:".date("Y-m-d H:i:s"));
//                $data = json_decode($datajson,true);
//                $name = !empty($data["name"])?$data["name"]:null;
//                $cardNo = !empty($data["cardNo"])?$data["cardNo"]:null;
//                $birthDay = !empty($data["birthDay"])?$data["birthDay"]:null;
//                $validity = !empty($data["validity"])?$data["validity"]:null;
//                //判断参数
//                if($name == null || $cardNo == null || $birthDay == null || $validity == null)
//                {
//                    $code = 110;
//                    $this->apiclass->response($code);
//                }
//                else
//                {
//                    $this->load->library('identity');
//                    $out = $this->identity->gettwncard($name,$cardNo,$birthDay,$validity);
//                    //判断返回值
//                    if($out == "500")
//                    {
//                        $this->apiclass->response($out);
//                    }
//                    else
//                    {
//                        $arr = json_decode($out,true);
//                        $code = !empty($arr["code"])?$arr["code"]:null;
//                        //判断返回json
//                        if ($code == "100")
//                        {
//                            $result = $arr["data"];
//                            $state = $result["state"];
//                            //var_dump($result);
//                            $ischarge = 0;
//                            switch ($state)
//                            {
//                                case  "1100":
//                                    $state = "1100";
//                                    $result = array(
//                                        "result"=>"一致",
//                                        "state"=>$state
//                                    );
//                                    $ischarge = 1;
//                                    break;
//                                case  "1101":
//                                case  "1102":
//                                case  "1103":
//                                case  "1106":
//                                    $state = "1101";
//                                    $result = array(
//                                        "result"=>"不一致",
//                                        "state"=>$state
//                                    );
//                                    $ischarge = 1;
//                                    break;
//                                case  "1104":
//                                    $state = "1102";
//                                    $result = array(
//                                        "result"=>"无匹配记录",
//                                        "state"=>$state
//                                    );
//                                    $ischarge = 0;
//                                    break;
//                                case  "1105":
//                                    $state = "1103";
//                                    $result = array(
//                                        "result"=>"参数错误",
//                                        "state"=>$state
//                                    );
//                                    $ischarge = 0;
//                                    break;
//                                default:
//                                    $this->apiclass->response(500);
//                                    return;
//                            }
//                            $orderno = $this->apiclass->createorderno();
//                            $this->apiclass->updatedb($validitycode["userproid"],$validitycode["userid"],$validitycode["proid"],$datajson,$state,$ischarge,$orderno,"indentitytwn");
//                            $this->apiclass->response($code,$result,$orderno);
//                        }
//                        else
//                        {
//                            $this->apiclass->response(500);
//                        }
//                    }
//                }
//            }
//            else
//            {
//                $this->apiclass->response($code);
//            }
//        }
//        catch (Exception $e)
//        {
//            log_message('error',$e->getMessage());
//            $this->apiclass->response(500);
//        }
//    }
//
//    public function hkmacard()
//    {
//        try{
//            //判断用户接口权限
//            $validitycode = $this->apiclass->validate();
//            $code = is_numeric($validitycode)?$validitycode:1;
//            if($code == 1)
//            {
//                $datajson = file_get_contents('php://input');
//                log_message('info',$datajson."---time:".date("Y-m-d H:i:s"));
//                $datajson = $this->apiclass->decrypt($datajson);
//                log_message('info',$datajson."---time:".date("Y-m-d H:i:s"));
//                $data = json_decode($datajson,true);
//                $name = !empty($data["name"])?$data["name"]:null;
//                $cardNo = !empty($data["cardNo"])?$data["cardNo"]:null;
//                $birthDay = !empty($data["birthDay"])?$data["birthDay"]:null;
//                $validity = !empty($data["validity"])?$data["validity"]:null;
//                //判断参数
//                if($name == null || $cardNo == null || $birthDay == null || $validity == null)
//                {
//                    $code = 110;
//                    $this->apiclass->response($code);
//                }
//                else
//                {
//                    $this->load->library('identity');
//                    $out = $this->identity->gethkmacard($name,$cardNo,$birthDay,$validity);
//                    //判断返回值
//                    if($out == "500")
//                    {
//                        $this->apiclass->response($out);
//                    }
//                    else
//                    {
//                        $arr = json_decode($out,true);
//                        $code = !empty($arr["code"])?$arr["code"]:null;
//                        //判断返回json
//                        if ($code == "100")
//                        {
//                            $result = $arr["data"];
//                            $state = $result["state"];
//                            //var_dump($result);
//                            $ischarge = 0;
//                            switch ($state)
//                            {
//                                case  "1100":
//                                    $state = "1100";
//                                    $result = array(
//                                        "result"=>"一致",
//                                        "state"=>$state
//                                    );
//                                    $ischarge = 1;
//                                    break;
//                                case  "1101":
//                                case  "1102":
//                                case  "1103":
//                                case  "1106":
//                                    $state = "1101";
//                                    $result = array(
//                                        "result"=>"不一致",
//                                        "state"=>$state
//                                    );
//                                    $ischarge = 1;
//                                    break;
//                                case  "1104":
//                                    $state = "1102";
//                                    $result = array(
//                                        "result"=>"无匹配记录",
//                                        "state"=>$state
//                                    );
//                                    $ischarge = 0;
//                                    break;
//                                case  "1105":
//                                    $state = "1103";
//                                    $result = array(
//                                        "result"=>"参数错误",
//                                        "state"=>$state
//                                    );
//                                    $ischarge = 0;
//                                    break;
//                                default:
//                                    $this->apiclass->response(500);
//                                    return;
//                            }
//                            $orderno = $this->apiclass->createorderno();
//                            $this->apiclass->updatedb($validitycode["userproid"],$validitycode["userid"],$validitycode["proid"],$datajson,$state,$ischarge,$orderno,"indentityhkma");
//                            $this->apiclass->response($code,$result,$orderno);
//                        }
//                        else
//                        {
//                            $this->apiclass->response(500);
//                        }
//                    }
//                }
//            }
//            else
//            {
//                $this->apiclass->response($code);
//            }
//        }
//        catch (Exception $e)
//        {
//            log_message('error',$e->getMessage());
//            $this->apiclass->response(500);
//
//        }
//    }
//
//    public function greencard()
//    {
//        try{
//            //判断用户接口权限
//            $validitycode = $this->apiclass->validate();
//            $code = is_numeric($validitycode)?$validitycode:1;
//            if($code == 1)
//            {
//                $datajson = file_get_contents('php://input');
//                log_message('info',$datajson."---time:".date("Y-m-d H:i:s"));
//                $datajson = $this->apiclass->decrypt($datajson);
//                log_message('info',$datajson."---time:".date("Y-m-d H:i:s"));
//                $data = json_decode($datajson,true);
//                $enName = !empty($data["enName"])?$data["enName"]:null;
//                $cardNo = !empty($data["cardNo"])?$data["cardNo"]:null;
//                $birthDay = !empty($data["birthDay"])?$data["birthDay"]:null;
//                $validity = !empty($data["validity"])?$data["validity"]:null;
//                //判断参数
//                if($enName == null || $cardNo == null || $birthDay == null || $validity == null)
//                {
//                    $code = 110;
//                    $this->apiclass->response($code);
//                }
//                else
//                {
//                    $this->load->library('identity');
//                    $out = $this->identity->getgreencard($enName,$cardNo,$birthDay,$validity);
//                    //判断返回值
//                    if($out == "500")
//                    {
//                        $this->apiclass->response($out);
//                    }
//                    else
//                    {
//                        $arr = json_decode($out,true);
//                        $code = !empty($arr["code"])?$arr["code"]:null;
//                        //判断返回json
//                        if ($code == "100")
//                        {
//                            $result = $arr["data"];
//                            $state = $result["state"];
//                            //var_dump($result);
//                            $ischarge = 0;
//                            switch ($state)
//                            {
//                                case  "1100":
//                                    $state = "1100";
//                                    $result = array(
//                                        "result"=>"一致",
//                                        "state"=>$state
//                                    );
//                                    $ischarge = 1;
//                                    break;
//                                case  "1101":
//                                case  "1102":
//                                case  "1103":
//                                case  "1106":
//                                    $state = "1101";
//                                    $result = array(
//                                        "result"=>"不一致",
//                                        "state"=>$state
//                                    );
//                                    $ischarge = 1;
//                                    break;
//                                case  "1104":
//                                    $state = "1102";
//                                    $result = array(
//                                        "result"=>"无匹配记录",
//                                        "state"=>$state
//                                    );
//                                    $ischarge = 0;
//                                    break;
//                                case  "1105":
//                                    $state = "1103";
//                                    $result = array(
//                                        "result"=>"参数错误",
//                                        "state"=>$state
//                                    );
//                                    $ischarge = 0;
//                                    break;
//                                default:
//                                    $this->apiclass->response(500);
//                                    return;
//                            }
//                            $orderno = $this->apiclass->createorderno();
//                            $this->apiclass->updatedb($validitycode["userproid"],$validitycode["userid"],$validitycode["proid"],$datajson,$state,$ischarge,$orderno,"indentitygreen");
//                            $this->apiclass->response($code,$result,$orderno);
//                        }
//                        else
//                        {
//                            $this->apiclass->response(500);
//                        }
//                    }
//                }
//            }
//            else
//            {
//                $this->apiclass->response($code);
//            }
//        }
//        catch (Exception $e)
//        {
//            log_message('error',$e->getMessage());
//            $this->apiclass->response(500);
//
//        }
//    }
//
//    public function idvalidity()
//    {
//        try{
//            //判断用户接口权限
//            $validitycode = $this->apiclass->validate();
//            $code = is_numeric($validitycode)?$validitycode:1;
//            if($code == 1)
//            {
//                $datajson = file_get_contents('php://input');
//                log_message('info',$datajson."---time:".date("Y-m-d H:i:s"));
//                $datajson = $this->apiclass->decrypt($datajson);
//                log_message('info',$datajson."---time:".date("Y-m-d H:i:s"));
//                $data = json_decode($datajson,true);
//                $beginDate = !empty($data["beginDate"])?$data["beginDate"]:null;
//                $name = !empty($data["name"])?$data["name"]:null;
//                $idNo = !empty($data["idNo"])?$data["idNo"]:null;
//                //判断参数
//                if($beginDate == null || $name == null || $idNo == null)
//                {
//                    $code = 110;
//                    $this->apiclass->response($code);
//                }
//                else
//                {
//                    $this->load->library('identity');
//                    $out = $this->identity->getIDvalidity($beginDate,$name,$idNo);
//                    //判断返回值
//                    if($out == "500")
//                    {
//                        $this->apiclass->response($out);
//                    }
//                    else
//                    {
//                        $arr = json_decode($out,true);
//                        $code = !empty($arr["code"])?$arr["code"]:null;
//                        //判断返回json
//                        if ($code == "100")
//                        {
//                            $result = $arr["data"];
//                            $state = $result["state"];
//                            //var_dump($result);
//                            $ischarge = 0;
//                            switch ($state)
//                            {
//                                case  "1100":
//                                case  "1101":
//                                case  "1102":
//                                    $ischarge = 1;
//                                    break;
//                                case  "1104":
//                                    $state = "1102";
//                                    $result = array(
//                                        "result"=>"不存在失效证件",
//                                        "state"=>$state
//                                    );
//                                    $ischarge = 1;
//                                    break;
//                                case  "1103":
//                                    $ischarge = 0;
//                                    break;
//                                default:
//                                    $this->apiclass->response(500);
//                                    return;
//                            }
//                            $orderno = $this->apiclass->createorderno();
//                            $this->apiclass->updatedb($validitycode["userproid"],$validitycode["userid"],$validitycode["proid"],$datajson,$state,$ischarge,$orderno,"indentityidvilidity");
//                            $this->apiclass->response($code,$result,$orderno);
//                        }
//                        else
//                        {
//                            $this->apiclass->response(500);
//                        }
//                    }
//                }
//            }
//            else
//            {
//                $this->apiclass->response($code);
//            }
//        }
//        catch (Exception $e)
//        {
//            log_message('error',$e->getMessage());
//            $this->apiclass->response(500);
//        }
//    }
//
//    public function idcheck()
//    {
//        try{
//            //判断用户接口权限
//            $validitycode = $this->apiclass->validate();
//            $code = is_numeric($validitycode)?$validitycode:1;
//            if($code == 1)
//            {
//                $datajson = file_get_contents('php://input');
//                log_message('info',$datajson."---time:".date("Y-m-d H:i:s"));
//                $datajson = $this->apiclass->decrypt($datajson);
//                log_message('info',$datajson."---time:".date("Y-m-d H:i:s"));
//                $data = json_decode($datajson,true);
//                $name = !empty($data["name"])?$data["name"]:null;
//                $idNo = !empty($data["idNo"])?$data["idNo"]:null;
//                //判断参数
//                if($name == null || $idNo == null)
//                {
//                    $code = 110;
//                    $this->apiclass->response($code);
//                }
//                else
//                {
//                    $this->load->library('identity');
//                    $out = $this->identity->getIDcheck($name,$idNo);
//                    //判断返回值
//                    if($out == "500")
//                    {
//                        $this->apiclass->response($out);
//                    }
//                    else
//                    {
//                        $arr = json_decode($out,true);
//                        $code = !empty($arr["code"])?$arr["code"]:null;
//                        //判断返回json
//                        if ($code == "100")
//                        {
//                            $result = $arr["data"];
//                            $state = $result["state"];
//                            //var_dump($result);
//                            $ischarge = 0;
//                            switch ($state)
//                            {
//                                case  "1100":
//                                case  "1101":
//                                    $ischarge = 1;
//                                    break;
//                                case  "1102":
//                                case  "1103":
//                                    $ischarge = 0;
//                                    break;
//                                default:
//                                    $this->apiclass->response(500);
//                                    return;
//                            }
//                            $orderno = $this->apiclass->createorderno();
//                            $this->apiclass->updatedb($validitycode["userproid"],$validitycode["userid"],$validitycode["proid"],$datajson,$state,$ischarge,$orderno,"indentityidcheck");
//                            $this->apiclass->response($code,$result,$orderno);
//                        }
//                        else
//                        {
//                            $this->apiclass->response(500);
//                        }
//                    }
//                }
//            }
//            else
//            {
//                $this->apiclass->response($code);
//            }
//        }
//        catch (Exception $e)
//        {
//            log_message('error',$e->getMessage());
//            $this->apiclass->response(500);
//        }
//    }




    public function szmcmcch()
    {
        try{
            //判断用户接口权限
            $this->benchmark->mark('function_start');
            $time1 = $this->benchmark->elapsed_time('total_execution_time_start', 'function_start');
            log_message('info',$time1);
            $validitycode = $this->apiclass->validate();
            $code = is_numeric($validitycode)?$validitycode:1;
            if($code == 1)
            {
                $datajson = file_get_contents('php://input');
                log_message('info',$datajson."---time:".date("Y-m-d H:i:s"));
                $datajson = $this->apiclass->decrypt($datajson);
                log_message('info',$datajson."---time:".date("Y-m-d H:i:s"));
                $data = json_decode($datajson,true);
                $name = !empty($data["name"])?$data["name"]:null;
                $idNo = !empty($data["idNo"])?$data["idNo"]:null;
                $phone = !empty($data["phone"])?$data["phone"]:null;
                //判断参数
                if($name == null || $idNo == null || $phone == null)
                {
                    $code = 110;
                    $this->apiclass->response($code);
                }
                else
                {
                    if (!$this->apiclass->isMobile($phone)){
                        $state = "1103";
                        $result = array(
                            "result"=>"参数错误",
                            "state"=>$state
                        );
                        $ischarge = 0;
                        $code = "100";
                        $orderno = $this->apiclass->createorderno();
                        $this->apiclass->updatedb($validitycode["userproid"],$validitycode["userid"],$validitycode["proid"],$datajson,$state,$ischarge,$orderno,"zhongchengxingetmobile");
                        $this->apiclass->response($code,$result,$orderno);
                        return;
                    }

                    $this->benchmark->mark('curl_start');
                    $time2 = $this->benchmark->elapsed_time('function_start', 'curl_start');
                    log_message('info',$time2);
                    $this->load->library('zhongchengxin');
                    $out = $this->zhongchengxin->getmobile($name,$idNo,$phone);
                    $this->benchmark->mark('curl_end');
                    $time3 = $this->benchmark->elapsed_time('curl_start', 'curl_end');
                    log_message('info',$time3);
                    //判断返回值
                    if($out == "500")
                    {
                        $this->apiclass->response($out);
                    }
                    else
                    {
                        $arr = json_decode($out,true);
                        $code = !empty($arr["status_code"])?$arr["status_code"]:null;
                        //判断返回json
                        if ($code == "200")
                        {
                            $result = $arr["data"];
                            $state = $result["verify_3d_real_name"];
                            //var_dump($result);
                            $ischarge = 0;
                            switch ($state)
                            {
                                case  "Y":
                                    $state = "1100";
                                    $result = array(
                                        "result"=>"一致",
                                        "state"=>$state
                                    );
                                    $ischarge = 1;
                                    break;
                                case  "N":
                                case  "F":
                                    $state = "1101";
                                    $result = array(
                                        "result"=>"不一致",
                                        "state"=>$state
                                    );
                                    $ischarge = 1;
                                    break;
                                case  "X":
                                    $state = "1102";
                                    $result = array(
                                        "result"=>"库中无此号",
                                        "state"=>$state
                                    );
                                    $ischarge = 0;
                                    break;
                                default:
                                    $this->apiclass->response(500);
                                    return;
                            }
                            $code = "100";
                            $orderno = $this->apiclass->createorderno();
                            $this->apiclass->updatedb($validitycode["userproid"],$validitycode["userid"],$validitycode["proid"],$datajson,$state,$ischarge,$orderno,"zhongchengxingetmobile");
                            $this->apiclass->response($code,$result,$orderno);
                        }
                        elseif ($code == "101" || $code == "101001" || $code == "101002" || $code == "101003" || $code == "101005")
                        {
                            $state = "1103";
                            $result = array(
                                "result"=>"参数错误",
                                "state"=>$state
                            );
                            $ischarge = 0;
                            $code = "100";
                            $orderno = $this->apiclass->createorderno();
                            $this->apiclass->updatedb($validitycode["userproid"],$validitycode["userid"],$validitycode["proid"],$datajson,$state,$ischarge,$orderno,"zhongchengxingetmobile");
                            $this->apiclass->response($code,$result,$orderno);
                        }
                        elseif ($code == "102")
                        {
                            $state = "1104";
                            $result = array(
                                "result"=>"查询错误",
                                "state"=>$state
                            );
                            $ischarge = 0;
                            $code = "100";
                            $orderno = $this->apiclass->createorderno();
                            $this->apiclass->updatedb($validitycode["userproid"],$validitycode["userid"],$validitycode["proid"],$datajson,$state,$ischarge,$orderno,"zhongchengxingetmobile");
                            $this->apiclass->response($code,$result,$orderno);
                        }
                        else
                        {
                            $this->apiclass->response(500);
                        }
                        $this->benchmark->mark('function_end');
                        $time4 = $this->benchmark->elapsed_time('curl_end', 'function_end');
                        log_message('info',$time4);
                    }
                }
            }
            else
            {
                $this->apiclass->response($code);
            }
        }
        catch (Exception $e)
        {
            log_message('error',$e->getMessage());
            $this->apiclass->response(500);
        }
    }

    public function mobilestatushj()
    {
        try{
            //判断用户接口权限
            $validitycode = $this->apiclass->validate();
            $code = is_numeric($validitycode)?$validitycode:1;
            if($code == 1)
            {
                $datajson = file_get_contents('php://input');
                log_message('info',$datajson."---time:".date("Y-m-d H:i:s"));
                $datajson = $this->apiclass->decrypt($datajson);
                log_message('info',$datajson."---time:".date("Y-m-d H:i:s"));
                $data = json_decode($datajson,true);
                $phone = !empty($data["phone"])?$data["phone"]:null;
                //判断参数
                if($phone == null)
                {
                    $code = 110;
                    $this->apiclass->response($code);
                }
                else
                {
                    if (!$this->apiclass->isMobile($phone)){
                        $state = "1101";
                        $result = array(
                            "result"=>"未查到",
                            "state"=>$state
                        );
                        $ischarge = 0;
                        $code = "100";
                        $orderno = $this->apiclass->createorderno();
                        $this->apiclass->updatedb($validitycode["userproid"],$validitycode["userid"],$validitycode["proid"],$datajson,$state,$ischarge,$orderno,"zhongchengxingmobilestatus");
                        $this->apiclass->response($code,$result,$orderno);
                        return;
                    }
                    $this->benchmark->mark('curl_start');
                    $this->load->library('zhongchengxin');
                    $out = $this->zhongchengxin->mobilestatus($phone);
                    $this->benchmark->mark('curl_end');
                    $time1 = $this->benchmark->elapsed_time('curl_start', 'curl_end');
                    log_message('info',$time1);

                    //判断返回值
                    if($out == "500")
                    {
                        $this->apiclass->response($out);
                    }
                    else
                    {
                        $arr = json_decode($out,true);
                        $code = !empty($arr["status_code"])?$arr["status_code"]:null;

                        //判断返回json
                        if ($code == "200")
                        {
                            $result = $arr["data"];
                            $state = $result["phone_network_status"];
                            //var_dump($result);
                            $ischarge = 0;
                            switch ($state)
                            {
                                case  "A":
                                    $state = "1100";
                                    $result = array(
                                        "result" => "正常在用",
                                        "state"=>$state
                                    );
                                    $ischarge = 1;
                                    break;
                                case  "B":
                                    $state = "1100";
                                    $result = array(
                                        "result" => "停机",
                                        "state"=>$state
                                    );
                                    $ischarge = 1;
                                    break;
                                case  "C":
                                    $state = "1100";
                                    $result = array(
                                        "result" => "在网但不可用",
                                        "state"=>$state
                                    );
                                    $ischarge = 1;
                                    break;
                                case  "D":
                                    $state = "1100";
                                    $result = array(
                                        "result" => "不在网",
                                        "state"=>$state
                                    );
                                    $ischarge = 1;
                                    break;
                                case  "E":
                                    $state = "1100";
                                    $result = array(
                                        "result" => "预销户或空号",
                                        "state"=>$state
                                    );
                                    $ischarge = 1;
                                    break;
                                case  "X":
                                    $state = "1101";
                                    $result = array(
                                        "result"=>"未查到",
                                        "state"=>$state
                                    );
                                    $ischarge = 0;
                                    break;
                                default:
                                    $this->apiclass->response(500);
                                    return;
                            }
                            $code = "100";
                            $orderno = $this->apiclass->createorderno();
                            $this->apiclass->updatedb($validitycode["userproid"],$validitycode["userid"],$validitycode["proid"],$datajson,$state,$ischarge,$orderno,"zhongchengxingmobilestatus");
                            $this->apiclass->response($code,$result,$orderno);
                        }
                        elseif ($code == "101" || $code == "102" || $code == "101001" || $code == "101002" || $code == "101003" || $code == "101005")
                        {
                            $state = "1102";
                            $result = array(
                                "result"=>"查询错误",
                                "state"=>$state
                            );
                            $ischarge = 0;
                            $code = "100";
                            $orderno = $this->apiclass->createorderno();
                            $this->apiclass->updatedb($validitycode["userproid"],$validitycode["userid"],$validitycode["proid"],$datajson,$state,$ischarge,$orderno,"zhongchengxingmobilestatus");
                            $this->apiclass->response($code,$result,$orderno);
                        }
                        else
                        {
                            $this->apiclass->response(500);
                        }
                    }
                }
            }
            else
            {
                $this->apiclass->response($code);
            }
        }
        catch (Exception $e)
        {
            log_message('error',$e->getMessage());
            $this->apiclass->response(500);
        }
    }

    public function mobilestatusjiaoke(){
        try{
            //判断用户接口权限
            $validitycode = $this->apiclass->validate();
            $code = is_numeric($validitycode)?$validitycode:1;
            $code = 1;
            if($code == 1)
            {
                $datajson = file_get_contents('php://input');
                log_message('info',$datajson."---time:".date("Y-m-d H:i:s"));
                $datajson = $this->apiclass->decrypt($datajson);
                log_message('info',$datajson."---time:".date("Y-m-d H:i:s"));
                $data = json_decode($datajson,true);
                $phone = !empty($data["phone"])?$data["phone"]:null;
                //判断参数
                if($phone == null)
                {
                    $code = 110;
                    $this->apiclass->response($code);
                }
                else
                {
                    $data = array(
                        "mobile"=>$phone
                    );

                    $this->load->library('jiaokenew');
                    $out = $this->jiaokenew->getdata("cmccstatus",$data);
                    //判断返回值
                    if($out == "500")
                    {
                        $this->apiclass->response($out);
                    }
                    else
                    {
                        $arr = json_decode($out,true);
                        $code = !empty($arr["code"])?$arr["code"]:null;
                        //var_dump($arr);
                        //判断返回json
                        if ($code == 200)
                        {

                            $result = "";
                            //$state = $result["state"];
                            $ischarge = 0;
                            switch ($arr["data"])
                            {
                                case  "1":
                                    $msg = json_decode($arr["msg"],true);
                                    $resultmsg = $msg["status"];
                                    switch ($resultmsg)
                                    {
                                        case "1":
                                            $state = "1100";
                                            $result = array(
                                                "result"=>"正常",
                                                "state"=>$state
                                            );
                                            break;
                                        case "2":
                                            $state = "1101";
                                            $result = array(
                                                "result"=>"停机",
                                                "state"=>$state
                                            );
                                            break;
                                        case "3":
                                            $state = "1102";
                                            $result = array(
                                                "result"=>"在网但不可用",
                                                "state"=>$state
                                            );
                                            break;
                                        case "4":
                                            $state = "1103";
                                            $result = array(
                                                "result"=>"销号/未启用",
                                                "state"=>$state
                                            );
                                            break;
                                        case "5":
                                            $state = "1104";
                                            $result = array(
                                                "result"=>"预销号",
                                                "state"=>$state
                                            );
                                            break;
                                        case "6":
                                            $state = "1105";
                                            $result = array(
                                                "result"=>"异常(号码状态异常)",
                                                "state"=>$state
                                            );
                                            break;
                                        default:
                                            $this->apiclass->response(500);
                                            return;
                                    }
                                    $ischarge = 1;
                                    break;
                                case  "2":
                                    $state = "1106";
                                    $result = array(
                                        "result"=>"未查到",
                                        "state"=>$state
                                    );
                                    $ischarge = 0;
                                    break;
                                default:
                                    $this->apiclass->response(500);
                                    return;
                            }
                            $code = "100";
                            $orderno = $this->apiclass->createorderno();
                            $this->apiclass->updatedb($validitycode["userproid"],$validitycode["userid"],$validitycode["proid"],$datajson,$state,$ischarge,$orderno,"jiaokecmccstatushj");
                            $this->apiclass->response($code,$result,$orderno);
                        }
                        else
                        {
                            $this->apiclass->response(500);
                        }
                    }
                }
            }
            else
            {
                $this->apiclass->response($code);
            }
        }
        catch (Exception $e)
        {
            log_message('error',$e->getMessage());
            $this->apiclass->response(500);
        }
    }


    public function mobileonlinehj()
    {
        try{
            //判断用户接口权限
            $validitycode = $this->apiclass->validate();
            $code = is_numeric($validitycode)?$validitycode:1;
            if($code == 1)
            {
                $datajson = file_get_contents('php://input');
                log_message('info',$datajson."---time:".date("Y-m-d H:i:s"));
                $datajson = $this->apiclass->decrypt($datajson);
                log_message('info',$datajson."---time:".date("Y-m-d H:i:s"));
                $data = json_decode($datajson,true);
                $phone = !empty($data["phone"])?$data["phone"]:null;
                //判断参数
                if($phone == null)
                {
                    $code = 110;
                    $this->apiclass->response($code);
                }
                else
                {
                    if (!$this->apiclass->isMobile($phone)){
                        $state = "1101";
                        $result = array(
                            "result"=>"未查到",
                            "state"=>$state
                        );
                        $ischarge = 0;
                        $code = "100";
                        $orderno = $this->apiclass->createorderno();
                        $this->apiclass->updatedb($validitycode["userproid"],$validitycode["userid"],$validitycode["proid"],$datajson,$state,$ischarge,$orderno,"zhongchengxingetmobileonline");
                        $this->apiclass->response($code,$result,$orderno);
                        return;
                    }
                    $this->benchmark->mark('curl_start');
                    $this->load->library('zhongchengxin');
                    $out = $this->zhongchengxin->mobileonline($phone);
                    $this->benchmark->mark('curl_end');
                    $time1 = $this->benchmark->elapsed_time('curl_start', 'curl_end');
                    log_message('info',$time1);

                    //判断返回值
                    if($out == "500")
                    {
                        $this->apiclass->response($out);
                    }
                    else
                    {
                        $arr = json_decode($out,true);
                        $code = !empty($arr["status_code"])?$arr["status_code"]:null;

                        //判断返回json
                        if ($code == "200")
                        {
                            $result = $arr["data"];
                            $state = $result["phone_network_periods"];
                            //var_dump($result);
                            $ischarge = 0;
                            switch ($state)
                            {
                                case  "A":
                                    $state = "1100";
                                    $result = array(
                                        "result" => array(
                                            "max"=>"0",
                                            "min"=>"3"
                                        ),
                                        "state"=>$state
                                    );
                                    $ischarge = 1;
                                    break;
                                case  "B":
                                    $state = "1100";
                                    $result = array(
                                        "result" => array(
                                            "max"=>"3",
                                            "min"=>"6"
                                        ),
                                        "state"=>$state
                                    );
                                    $ischarge = 1;
                                    break;
                                case  "C":
                                    $state = "1100";
                                    $result = array(
                                        "result" => array(
                                            "max"=>"6",
                                            "min"=>"12"
                                        ),
                                        "state"=>$state
                                    );
                                    $ischarge = 1;
                                    break;
                                case  "D":
                                    $state = "1100";
                                    $result = array(
                                        "result" => array(
                                            "max"=>"12",
                                            "min"=>"24"
                                        ),
                                        "state"=>$state
                                    );
                                    $ischarge = 1;
                                    break;
                                case  "E":
                                    $state = "1100";
                                    $result = array(
                                        "result" => array(
                                            "max"=>"24",
                                            "min"=>"-1"
                                        ),
                                        "state"=>$state
                                    );
                                    $ischarge = 1;
                                    break;
                                case  "X":
                                    $state = "1101";
                                    $result = array(
                                        "result"=>"未查到",
                                        "state"=>$state
                                    );
                                    $ischarge = 0;
                                    break;
                                default:
                                    $this->apiclass->response(500);
                                    return;
                            }
                            $code = "100";
                            $orderno = $this->apiclass->createorderno();
                            $this->apiclass->updatedb($validitycode["userproid"],$validitycode["userid"],$validitycode["proid"],$datajson,$state,$ischarge,$orderno,"zhongchengxinmobileonline");
                            $this->apiclass->response($code,$result,$orderno);
                        }
                        elseif ($code == "101" || $code == "102" || $code == "101001" || $code == "101002" || $code == "101003" || $code == "101005")
                        {
                            $state = "1102";
                            $result = array(
                                "result"=>"查询错误",
                                "state"=>$state
                            );
                            $ischarge = 0;
                            $code = "100";
                            $orderno = $this->apiclass->createorderno();
                            $this->apiclass->updatedb($validitycode["userproid"],$validitycode["userid"],$validitycode["proid"],$datajson,$state,$ischarge,$orderno,"zhongchengxinmobileonline");
                            $this->apiclass->response($code,$result,$orderno);
                        }
                        else
                        {
                            $this->apiclass->response(500);
                        }
                    }
                }
            }
            else
            {
                $this->apiclass->response($code);
            }
        }
        catch (Exception $e)
        {
            log_message('error',$e->getMessage());
            $this->apiclass->response(500);
        }
    }

    public function telecomonline()
    {
        try{
            //判断用户接口权限
            $validitycode = $this->apiclass->validate();
            $code = is_numeric($validitycode)?$validitycode:1;
            if($code == 1)
            {
                $datajson = file_get_contents('php://input');
                log_message('info',$datajson."---time:".date("Y-m-d H:i:s"));
                $datajson = $this->apiclass->decrypt($datajson);
                log_message('info',$datajson."---time:".date("Y-m-d H:i:s"));
                $data = json_decode($datajson,true);
                $phone = !empty($data["phone"])?$data["phone"]:null;
                //判断参数
                if($phone == null)
                {
                    $code = 110;
                    $this->apiclass->response($code);
                }
                else
                {
                    $this->benchmark->mark('curl_start');
                    $this->load->library('zhongchengxin');
                    $out = $this->zhongchengxin->mobileonline($phone);
                    $this->benchmark->mark('curl_end');
                    $time1 = $this->benchmark->elapsed_time('curl_start', 'curl_end');
                    log_message('info',$time1);

                    //判断返回值
                    if($out == "500")
                    {
                        $this->apiclass->response($out);
                    }
                    else
                    {
                        if (!$this->apiclass->isTelecom($phone)){
                            $state = "1101";
                            $result = array(
                                "result"=>"未查到",
                                "state"=>$state
                            );
                            $ischarge = 0;
                            $code = "100";
                            $orderno = $this->apiclass->createorderno();
                            $this->apiclass->updatedb($validitycode["userproid"],$validitycode["userid"],$validitycode["proid"],$datajson,$state,$ischarge,$orderno,"zhongchengxingettelecomonline");
                            $this->apiclass->response($code,$result,$orderno);
                            return;
                        }
                        $arr = json_decode($out,true);
                        $code = !empty($arr["status_code"])?$arr["status_code"]:null;

                        //判断返回json
                        if ($code == "200")
                        {
                            $result = $arr["data"];
                            $state = $result["phone_network_periods"];
                            //var_dump($result);
                            $ischarge = 0;
                            switch ($state)
                            {
                                case  "A":
                                    $state = "1100";
                                    $result = array(
                                        "result" => array(
                                            "max"=>"0",
                                            "min"=>"3"
                                        ),
                                        "state"=>$state
                                    );
                                    $ischarge = 1;
                                    break;
                                case  "B":
                                    $state = "1100";
                                    $result = array(
                                        "result" => array(
                                            "max"=>"3",
                                            "min"=>"6"
                                        ),
                                        "state"=>$state
                                    );
                                    $ischarge = 1;
                                    break;
                                case  "C":
                                    $state = "1100";
                                    $result = array(
                                        "result" => array(
                                            "max"=>"6",
                                            "min"=>"12"
                                        ),
                                        "state"=>$state
                                    );
                                    $ischarge = 1;
                                    break;
                                case  "D":
                                    $state = "1100";
                                    $result = array(
                                        "result" => array(
                                            "max"=>"12",
                                            "min"=>"24"
                                        ),
                                        "state"=>$state
                                    );
                                    $ischarge = 1;
                                    break;
                                case  "E":
                                    $state = "1100";
                                    $result = array(
                                        "result" => array(
                                            "max"=>"24",
                                            "min"=>"-1"
                                        ),
                                        "state"=>$state
                                    );
                                    $ischarge = 1;
                                    break;
                                case  "X":
                                    $state = "1101";
                                    $result = array(
                                        "result"=>"未查到",
                                        "state"=>$state
                                    );
                                    $ischarge = 0;
                                    break;
                                default:
                                    $this->apiclass->response(500);
                                    return;
                            }
                            $code = "100";
                            $orderno = $this->apiclass->createorderno();
                            $this->apiclass->updatedb($validitycode["userproid"],$validitycode["userid"],$validitycode["proid"],$datajson,$state,$ischarge,$orderno,"zhongchengxingettelecomonline");
                            $this->apiclass->response($code,$result,$orderno);
                        }
                        elseif ($code == "101" || $code == "102" || $code == "101001" || $code == "101002" || $code == "101003" || $code == "101005")
                        {
                            $state = "1102";
                            $result = array(
                                "result"=>"查询错误",
                                "state"=>$state
                            );
                            $ischarge = 0;
                            $code = "100";
                            $orderno = $this->apiclass->createorderno();
                            $this->apiclass->updatedb($validitycode["userproid"],$validitycode["userid"],$validitycode["proid"],$datajson,$state,$ischarge,$orderno,"zhongchengxingettelecomonline");
                            $this->apiclass->response($code,$result,$orderno);
                        }
                        else
                        {
                            $this->apiclass->response(500);
                        }
                    }
                }
            }
            else
            {
                $this->apiclass->response($code);
            }
        }
        catch (Exception $e)
        {
            log_message('error',$e->getMessage());
            $this->apiclass->response(500);
        }
    }

    public function unicomonlinebak()
    {
        try{
            //判断用户接口权限
            $validitycode = $this->apiclass->validate();
            $code = is_numeric($validitycode)?$validitycode:1;
            if($code == 1)
            {
                $datajson = file_get_contents('php://input');
                log_message('info',$datajson."---time:".date("Y-m-d H:i:s"));
                $datajson = $this->apiclass->decrypt($datajson);
                log_message('info',$datajson."---time:".date("Y-m-d H:i:s"));
                $data = json_decode($datajson,true);
                $phone = !empty($data["phone"])?$data["phone"]:null;
                //判断参数
                if($phone == null)
                {
                    $code = 110;
                    $this->apiclass->response($code);
                }
                else
                {
                    $this->benchmark->mark('curl_start');
                    $this->load->library('zhongchengxin');
                    $out = $this->zhongchengxin->mobileonline($phone);
                    $this->benchmark->mark('curl_end');
                    $time1 = $this->benchmark->elapsed_time('curl_start', 'curl_end');
                    log_message('info',$time1);

                    //判断返回值
                    if($out == "500")
                    {
                        $this->apiclass->response($out);
                    }
                    else
                    {
                        if (!$this->apiclass->isUnicom($phone)){
                            $state = "1101";
                            $result = array(
                                "result"=>"未查到",
                                "state"=>$state
                            );
                            $ischarge = 0;
                            $code = "100";
                            $orderno = $this->apiclass->createorderno();
                            $this->apiclass->updatedb($validitycode["userproid"],$validitycode["userid"],$validitycode["proid"],$datajson,$state,$ischarge,$orderno,"zhongchengxingetunionline");
                            $this->apiclass->response($code,$result,$orderno);
                            return;
                        }
                        $arr = json_decode($out,true);
                        $code = !empty($arr["status_code"])?$arr["status_code"]:null;

                        //判断返回json
                        if ($code == "200")
                        {
                            $result = $arr["data"];
                            $state = $result["phone_network_periods"];
                            //var_dump($result);
                            $ischarge = 0;
                            switch ($state)
                            {
                                case  "A":
                                    $state = "1100";
                                    $result = array(
                                        "result" => array(
                                            "max"=>"0",
                                            "min"=>"3"
                                        ),
                                        "state"=>$state
                                    );
                                    $ischarge = 1;
                                    break;
                                case  "B":
                                    $state = "1100";
                                    $result = array(
                                        "result" => array(
                                            "max"=>"3",
                                            "min"=>"6"
                                        ),
                                        "state"=>$state
                                    );
                                    $ischarge = 1;
                                    break;
                                case  "C":
                                    $state = "1100";
                                    $result = array(
                                        "result" => array(
                                            "max"=>"6",
                                            "min"=>"12"
                                        ),
                                        "state"=>$state
                                    );
                                    $ischarge = 1;
                                    break;
                                case  "D":
                                    $state = "1100";
                                    $result = array(
                                        "result" => array(
                                            "max"=>"12",
                                            "min"=>"24"
                                        ),
                                        "state"=>$state
                                    );
                                    $ischarge = 1;
                                    break;
                                case  "E":
                                    $state = "1100";
                                    $result = array(
                                        "result" => array(
                                            "max"=>"24",
                                            "min"=>"-1"
                                        ),
                                        "state"=>$state
                                    );
                                    $ischarge = 1;
                                    break;
                                case  "X":
                                    $state = "1101";
                                    $result = array(
                                        "result"=>"未查到",
                                        "state"=>$state
                                    );
                                    $ischarge = 0;
                                    break;
                                default:
                                    $this->apiclass->response(500);
                                    return;
                            }
                            $code = "100";
                            $orderno = $this->apiclass->createorderno();
                            $this->apiclass->updatedb($validitycode["userproid"],$validitycode["userid"],$validitycode["proid"],$datajson,$state,$ischarge,$orderno,"zhongchengxingetunionline");
                            $this->apiclass->response($code,$result,$orderno);
                        }
                        elseif ($code == "101" || $code == "102" || $code == "101001" || $code == "101002" || $code == "101003" || $code == "101005")
                        {
                            $state = "1102";
                            $result = array(
                                "result"=>"查询错误",
                                "state"=>$state
                            );
                            $ischarge = 0;
                            $code = "100";
                            $orderno = $this->apiclass->createorderno();
                            $this->apiclass->updatedb($validitycode["userproid"],$validitycode["userid"],$validitycode["proid"],$datajson,$state,$ischarge,$orderno,"zhongchengxingetunionline");
                            $this->apiclass->response($code,$result,$orderno);
                        }
                        else
                        {
                            $this->apiclass->response(500);
                        }
                    }
                }
            }
            else
            {
                $this->apiclass->response($code);
            }
        }
        catch (Exception $e)
        {
            log_message('error',$e->getMessage());
            $this->apiclass->response(500);
        }
    }

    public function mobileonline()
    {
        try{
            //判断用户接口权限
            $validitycode = $this->apiclass->validate();
            $code = is_numeric($validitycode)?$validitycode:1;
            if($code == 1)
            {
                $datajson = file_get_contents('php://input');
                log_message('info',$datajson."---time:".date("Y-m-d H:i:s"));
                $datajson = $this->apiclass->decrypt($datajson);
                log_message('info',$datajson."---time:".date("Y-m-d H:i:s"));
                $data = json_decode($datajson,true);
                $phone = !empty($data["phone"])?$data["phone"]:null;
                //判断参数
                if($phone == null)
                {
                    $code = 110;
                    $this->apiclass->response($code);
                }
                else
                {
                    if (!$this->apiclass->isMobile($phone)){
                        $state = "1101";
                        $result = array(
                            "result"=>"未查到",
                            "state"=>$state
                        );
                        $ischarge = 0;
                        $code = "100";
                        $orderno = $this->apiclass->createorderno();
                        $this->apiclass->updatedb($validitycode["userproid"],$validitycode["userid"],$validitycode["proid"],$datajson,$state,$ischarge,$orderno,"zhongchengxingetmobileonline");
                        $this->apiclass->response($code,$result,$orderno);
                        return;
                    }
                    $this->benchmark->mark('curl_start');
                    $this->load->library('zhongchengxin');
                    $out = $this->zhongchengxin->mobileonline($phone);
                    $this->benchmark->mark('curl_end');
                    $time1 = $this->benchmark->elapsed_time('curl_start', 'curl_end');
                    log_message('info',$time1);

                    //判断返回值
                    if($out == "500")
                    {
                        $this->apiclass->response($out);
                    }
                    else
                    {
                        $arr = json_decode($out,true);
                        $code = !empty($arr["status_code"])?$arr["status_code"]:null;

                        //判断返回json
                        if ($code == "200")
                        {
                            $result = $arr["data"];
                            $state = $result["phone_network_periods"];
                            //var_dump($result);
                            $ischarge = 0;
                            switch ($state)
                            {
                                case  "A":
                                    $state = "1100";
                                    $result = array(
                                        "result" => array(
                                            "max"=>"0",
                                            "min"=>"3"
                                        ),
                                        "state"=>$state
                                    );
                                    $ischarge = 1;
                                    break;
                                case  "B":
                                    $state = "1100";
                                    $result = array(
                                        "result" => array(
                                            "max"=>"3",
                                            "min"=>"6"
                                        ),
                                        "state"=>$state
                                    );
                                    $ischarge = 1;
                                    break;
                                case  "C":
                                    $state = "1100";
                                    $result = array(
                                        "result" => array(
                                            "max"=>"6",
                                            "min"=>"12"
                                        ),
                                        "state"=>$state
                                    );
                                    $ischarge = 1;
                                    break;
                                case  "D":
                                    $state = "1100";
                                    $result = array(
                                        "result" => array(
                                            "max"=>"12",
                                            "min"=>"24"
                                        ),
                                        "state"=>$state
                                    );
                                    $ischarge = 1;
                                    break;
                                case  "E":
                                    $state = "1100";
                                    $result = array(
                                        "result" => array(
                                            "max"=>"24",
                                            "min"=>"-1"
                                        ),
                                        "state"=>$state
                                    );
                                    $ischarge = 1;
                                    break;
                                case  "X":
                                    $state = "1101";
                                    $result = array(
                                        "result"=>"未查到",
                                        "state"=>$state
                                    );
                                    $ischarge = 0;
                                    break;
                                default:
                                    $this->apiclass->response(500);
                                    return;
                            }
                            $code = "100";
                            $orderno = $this->apiclass->createorderno();
                            $this->apiclass->updatedb($validitycode["userproid"],$validitycode["userid"],$validitycode["proid"],$datajson,$state,$ischarge,$orderno,"zhongchengxinmobileonline");
                            $this->apiclass->response($code,$result,$orderno);
                        }
                        elseif ($code == "101" || $code == "102" || $code == "101001" || $code == "101002" || $code == "101003" || $code == "101005")
                        {
                            $state = "1102";
                            $result = array(
                                "result"=>"查询错误",
                                "state"=>$state
                            );
                            $ischarge = 0;
                            $code = "100";
                            $orderno = $this->apiclass->createorderno();
                            $this->apiclass->updatedb($validitycode["userproid"],$validitycode["userid"],$validitycode["proid"],$datajson,$state,$ischarge,$orderno,"zhongchengxinmobileonline");
                            $this->apiclass->response($code,$result,$orderno);
                        }
                        else
                        {
                            $this->apiclass->response(500);
                        }
                    }
                }
            }
            else
            {
                $this->apiclass->response($code);
            }
        }
        catch (Exception $e)
        {
            log_message('error',$e->getMessage());
            $this->apiclass->response(500);
        }
    }

    public function mobileonlinejiaokebak()
    {
        try{
            //判断用户接口权限
            $validitycode = $this->apiclass->validate();
            $code = is_numeric($validitycode)?$validitycode:1;
            if($code == 1)
            {
                $datajson = file_get_contents('php://input');
                log_message('info',$datajson."---time:".date("Y-m-d H:i:s"));
                $datajson = $this->apiclass->decrypt($datajson);
                log_message('info',$datajson."---time:".date("Y-m-d H:i:s"));
                $data = json_decode($datajson,true);
                $phone = !empty($data["phone"])?$data["phone"]:null;
                //判断参数
                if($phone == null)
                {
                    $code = 110;
                    $this->apiclass->response($code);
                }
                else
                {
                    $this->load->library('jiaoke');
                    $out = $this->jiaoke->mobileonline($phone);
                    //判断返回值
                    if($out == "500")
                    {
                        $this->apiclass->response($out);
                    }
                    else
                    {
                        $arr = json_decode($out,true);
                        $code = !empty($arr["ResultCode"])?$arr["ResultCode"]:null;
                        //判断返回json
                        if ($code)
                        {
                            $result = "";
                            //$state = $result[" verify_3d_real_name"];
                            //var_dump($result);
                            $ischarge = 0;
                            switch ($code)
                            {
                                case  "1000":
                                    $state = "1100";
                                    $result = array(
                                        "result"=>$arr["Result"],
                                        "state"=>$state
                                    );
                                    $ischarge = 1;
                                    break;
                                case  "1001":
                                    $state = "1101";
                                    $result = array(
                                        "result"=>"未查到",
                                        "state"=>$state
                                    );
                                    $ischarge = 0;
                                    break;
                                case  "9901":
                                    $state = "1102";
                                    $result = array(
                                        "result"=>"查询错误",
                                        "state"=>$state
                                    );
                                    $ischarge = 0;
                                    break;
                                default:
                                    $this->apiclass->response(500);
                                    return;
                            }
                            $code = "100";
                            $orderno = $this->apiclass->createorderno();
                            $this->apiclass->updatedb($validitycode["userproid"],$validitycode["userid"],$validitycode["proid"],$datajson,$state,$ischarge,$orderno,"jiaokemobileonline");
                            $this->apiclass->response($code,$result,$orderno);
                        }
                        else
                        {
                            $this->apiclass->response(500);
                        }
                    }
                }
            }
            else
            {
                $this->apiclass->response($code);
            }
        }
        catch (Exception $e)
        {
            log_message('error',$e->getMessage());
            $this->apiclass->response(500);
        }
    }


    public function mobilestatus()
    {
        try{
            //判断用户接口权限
            $validitycode = $this->apiclass->validate();
            $code = is_numeric($validitycode)?$validitycode:1;
            if($code == 1)
            {
                $datajson = file_get_contents('php://input');
                log_message('info',$datajson."---time:".date("Y-m-d H:i:s"));
                $datajson = $this->apiclass->decrypt($datajson);
                log_message('info',$datajson."---time:".date("Y-m-d H:i:s"));
                $data = json_decode($datajson,true);
                $phone = !empty($data["phone"])?$data["phone"]:null;
                //判断参数
                if($phone == null)
                {
                    $code = 110;
                    $this->apiclass->response($code);
                }
                else
                {
                    if (!$this->apiclass->isMobile($phone)){
                        $state = "1101";
                        $result = array(
                            "result"=>"未查到",
                            "state"=>$state
                        );
                        $ischarge = 0;
                        $code = "100";
                        $orderno = $this->apiclass->createorderno();
                        $this->apiclass->updatedb($validitycode["userproid"],$validitycode["userid"],$validitycode["proid"],$datajson,$state,$ischarge,$orderno,"zhongchengxingmobilestatus");
                        $this->apiclass->response($code,$result,$orderno);
                        return;
                    }
                    $this->benchmark->mark('curl_start');
                    $this->load->library('zhongchengxin');
                    $out = $this->zhongchengxin->mobilestatus($phone);
                    $this->benchmark->mark('curl_end');
                    $time1 = $this->benchmark->elapsed_time('curl_start', 'curl_end');
                    log_message('info',$time1);

                    //判断返回值
                    if($out == "500")
                    {
                        $this->apiclass->response($out);
                    }
                    else
                    {
                        $arr = json_decode($out,true);
                        $code = !empty($arr["status_code"])?$arr["status_code"]:null;

                        //判断返回json
                        if ($code == "200")
                        {
                            $result = $arr["data"];
                            $state = $result["phone_network_status"];
                            //var_dump($result);
                            $ischarge = 0;
                            switch ($state)
                            {
                                case  "A":
                                    $state = "1100";
                                    $result = array(
                                        "result" => "正常在用",
                                        "state"=>$state
                                    );
                                    $ischarge = 1;
                                    break;
                                case  "B":
                                    $state = "1100";
                                    $result = array(
                                        "result" => "停机",
                                        "state"=>$state
                                    );
                                    $ischarge = 1;
                                    break;
                                case  "C":
                                    $state = "1100";
                                    $result = array(
                                        "result" => "在网但不可用",
                                        "state"=>$state
                                    );
                                    $ischarge = 1;
                                    break;
                                case  "D":
                                    $state = "1100";
                                    $result = array(
                                        "result" => "不在网",
                                        "state"=>$state
                                    );
                                    $ischarge = 1;
                                    break;
                                case  "E":
                                    $state = "1100";
                                    $result = array(
                                        "result" => "预销户或空号",
                                        "state"=>$state
                                    );
                                    $ischarge = 1;
                                    break;
                                case  "X":
                                    $state = "1101";
                                    $result = array(
                                        "result"=>"未查到",
                                        "state"=>$state
                                    );
                                    $ischarge = 0;
                                    break;
                                default:
                                    $this->apiclass->response(500);
                                    return;
                            }
                            $code = "100";
                            $orderno = $this->apiclass->createorderno();
                            $this->apiclass->updatedb($validitycode["userproid"],$validitycode["userid"],$validitycode["proid"],$datajson,$state,$ischarge,$orderno,"zhongchengxingmobilestatus");
                            $this->apiclass->response($code,$result,$orderno);
                        }
                        elseif ($code == "101" || $code == "102" || $code == "101001" || $code == "101002" || $code == "101003" || $code == "101005")
                        {
                            $state = "1102";
                            $result = array(
                                "result"=>"查询错误",
                                "state"=>$state
                            );
                            $ischarge = 0;
                            $code = "100";
                            $orderno = $this->apiclass->createorderno();
                            $this->apiclass->updatedb($validitycode["userproid"],$validitycode["userid"],$validitycode["proid"],$datajson,$state,$ischarge,$orderno,"zhongchengxingmobilestatus");
                            $this->apiclass->response($code,$result,$orderno);
                        }
                        else
                        {
                            $this->apiclass->response(500);
                        }
                    }
                }
            }
            else
            {
                $this->apiclass->response($code);
            }
        }
        catch (Exception $e)
        {
            log_message('error',$e->getMessage());
            $this->apiclass->response(500);
        }
    }


    public function telecomstatusbak()
    {
        try{
            //判断用户接口权限
            $validitycode = $this->apiclass->validate();
            $code = is_numeric($validitycode)?$validitycode:1;
            if($code == 1)
            {
                $datajson = file_get_contents('php://input');
                log_message('info',$datajson."---time:".date("Y-m-d H:i:s"));
                $datajson = $this->apiclass->decrypt($datajson);
                log_message('info',$datajson."---time:".date("Y-m-d H:i:s"));
                $data = json_decode($datajson,true);
                $phone = !empty($data["phone"])?$data["phone"]:null;
                //判断参数
                if($phone == null)
                {
                    $code = 110;
                    $this->apiclass->response($code);
                }
                else
                {
                        if (!$this->apiclass->isTelecom($phone)){
                            $state = "1101";
                            $result = array(
                                "result"=>"未查到",
                                "state"=>$state
                        );
                        $ischarge = 0;
                        $code = "100";
                        $orderno = $this->apiclass->createorderno();
                        $this->apiclass->updatedb($validitycode["userproid"],$validitycode["userid"],$validitycode["proid"],$datajson,$state,$ischarge,$orderno,"zhongchengxingtelecomstatus");
                        $this->apiclass->response($code,$result,$orderno);
                        return;
                    }
                    $this->benchmark->mark('curl_start');
                    $this->load->library('zhongchengxin');
                    $out = $this->zhongchengxin->mobilestatus($phone);
                    $this->benchmark->mark('curl_end');
                    $time1 = $this->benchmark->elapsed_time('curl_start', 'curl_end');
                    log_message('info',$time1);

                    //判断返回值
                    if($out == "500")
                    {
                        $this->apiclass->response($out);
                    }
                    else
                    {
                        $arr = json_decode($out,true);
                        $code = !empty($arr["status_code"])?$arr["status_code"]:null;

                        //判断返回json
                        if ($code == "200")
                        {
                            $result = $arr["data"];
                            $state = $result["phone_network_status"];
                            //var_dump($result);
                            $ischarge = 0;
                            switch ($state)
                            {
                                case  "A":
                                    $state = "1100";
                                    $result = array(
                                        "result" => "正常在用",
                                        "state"=>$state
                                    );
                                    $ischarge = 1;
                                    break;
                                case  "B":
                                    $state = "1100";
                                    $result = array(
                                        "result" => "停机",
                                        "state"=>$state
                                    );
                                    $ischarge = 1;
                                    break;
                                case  "C":
                                    $state = "1100";
                                    $result = array(
                                        "result" => "在网但不可用",
                                        "state"=>$state
                                    );
                                    $ischarge = 1;
                                    break;
                                case  "D":
                                    $state = "1100";
                                    $result = array(
                                        "result" => "不在网",
                                        "state"=>$state
                                    );
                                    $ischarge = 1;
                                    break;
                                case  "E":
                                    $state = "1100";
                                    $result = array(
                                        "result" => "预销户或空号",
                                        "state"=>$state
                                    );
                                    $ischarge = 1;
                                    break;
                                case  "X":
                                    $state = "1101";
                                    $result = array(
                                        "result"=>"未查到",
                                        "state"=>$state
                                    );
                                    $ischarge = 0;
                                    break;
                                default:
                                    $this->apiclass->response(500);
                                    return;
                            }
                            $code = "100";
                            $orderno = $this->apiclass->createorderno();
                            $this->apiclass->updatedb($validitycode["userproid"],$validitycode["userid"],$validitycode["proid"],$datajson,$state,$ischarge,$orderno,"zhongchengxingtelecomstatus");
                            $this->apiclass->response($code,$result,$orderno);
                        }
                        elseif ($code == "101" || $code == "102" || $code == "101001" || $code == "101002" || $code == "101003" || $code == "101005")
                        {
                            $state = "1102";
                            $result = array(
                                "result"=>"查询错误",
                                "state"=>$state
                            );
                            $ischarge = 0;
                            $code = "100";
                            $orderno = $this->apiclass->createorderno();
                            $this->apiclass->updatedb($validitycode["userproid"],$validitycode["userid"],$validitycode["proid"],$datajson,$state,$ischarge,$orderno,"zhongchengxingtelecomstatus");
                            $this->apiclass->response($code,$result,$orderno);
                        }
                        else
                        {
                            $this->apiclass->response(500);
                        }
                    }
                }
            }
            else
            {
                $this->apiclass->response($code);
            }
        }
        catch (Exception $e)
        {
            log_message('error',$e->getMessage());
            $this->apiclass->response(500);
        }
    }

    public function unicomstatus()
    {
        try{
            //判断用户接口权限
            $validitycode = $this->apiclass->validate();
            $code = is_numeric($validitycode)?$validitycode:1;
            if($code == 1)
            {
                $datajson = file_get_contents('php://input');
                log_message('info',$datajson."---time:".date("Y-m-d H:i:s"));
                $datajson = $this->apiclass->decrypt($datajson);
                log_message('info',$datajson."---time:".date("Y-m-d H:i:s"));
                $data = json_decode($datajson,true);
                $phone = !empty($data["phone"])?$data["phone"]:null;
                //判断参数
                if($phone == null)
                {
                    $code = 110;
                    $this->apiclass->response($code);
                }
                else
                {
                    if (!$this->apiclass->isUnicom($phone)){
                        $state = "1101";
                        $result = array(
                            "result"=>"未查到",
                            "state"=>$state
                        );
                        $ischarge = 0;
                        $code = "100";
                        $orderno = $this->apiclass->createorderno();
                        $this->apiclass->updatedb($validitycode["userproid"],$validitycode["userid"],$validitycode["proid"],$datajson,$state,$ischarge,$orderno,"zhongchengxingunicomstatus");
                        $this->apiclass->response($code,$result,$orderno);
                        return;
                    }
                    $this->benchmark->mark('curl_start');
                    $this->load->library('zhongchengxin');
                    $out = $this->zhongchengxin->mobilestatus($phone);
                    $this->benchmark->mark('curl_end');
                    $time1 = $this->benchmark->elapsed_time('curl_start', 'curl_end');
                    log_message('info',$time1);

                    //判断返回值
                    if($out == "500")
                    {
                        $this->apiclass->response($out);
                    }
                    else
                    {
                        $arr = json_decode($out,true);
                        $code = !empty($arr["status_code"])?$arr["status_code"]:null;

                        //判断返回json
                        if ($code == "200")
                        {
                            $result = $arr["data"];
                            $state = $result["phone_network_status"];
                            //var_dump($result);
                            $ischarge = 0;
                            switch ($state)
                            {
                                case  "A":
                                    $state = "1100";
                                    $result = array(
                                        "result" => "正常在用",
                                        "state"=>$state
                                    );
                                    $ischarge = 1;
                                    break;
                                case  "B":
                                    $state = "1100";
                                    $result = array(
                                        "result" => "停机",
                                        "state"=>$state
                                    );
                                    $ischarge = 1;
                                    break;
                                case  "C":
                                    $state = "1100";
                                    $result = array(
                                        "result" => "在网但不可用",
                                        "state"=>$state
                                    );
                                    $ischarge = 1;
                                    break;
                                case  "D":
                                    $state = "1100";
                                    $result = array(
                                        "result" => "不在网",
                                        "state"=>$state
                                    );
                                    $ischarge = 1;
                                    break;
                                case  "E":
                                    $state = "1100";
                                    $result = array(
                                        "result" => "预销户或空号",
                                        "state"=>$state
                                    );
                                    $ischarge = 1;
                                    break;
                                case  "X":
                                    $state = "1101";
                                    $result = array(
                                        "result"=>"未查到",
                                        "state"=>$state
                                    );
                                    $ischarge = 0;
                                    break;
                                default:
                                    $this->apiclass->response(500);
                                    return;
                            }
                            $code = "100";
                            $orderno = $this->apiclass->createorderno();
                            $this->apiclass->updatedb($validitycode["userproid"],$validitycode["userid"],$validitycode["proid"],$datajson,$state,$ischarge,$orderno,"zhongchengxingunicomstatus");
                            $this->apiclass->response($code,$result,$orderno);
                        }
                        elseif ($code == "101" || $code == "102" || $code == "101001" || $code == "101002" || $code == "101003" || $code == "101005")
                        {
                            $state = "1102";
                            $result = array(
                                "result"=>"查询错误",
                                "state"=>$state
                            );
                            $ischarge = 0;
                            $code = "100";
                            $orderno = $this->apiclass->createorderno();
                            $this->apiclass->updatedb($validitycode["userproid"],$validitycode["userid"],$validitycode["proid"],$datajson,$state,$ischarge,$orderno,"zhongchengxingunicomstatus");
                            $this->apiclass->response($code,$result,$orderno);
                        }
                        else
                        {
                            $this->apiclass->response(500);
                        }
                    }
                }
            }
            else
            {
                $this->apiclass->response($code);
            }
        }
        catch (Exception $e)
        {
            log_message('error',$e->getMessage());
            $this->apiclass->response(500);
        }
    }

    public function idnamecheck(){
        try{
            //判断用户接口权限
            $validitycode = $this->apiclass->validate();
            $code = is_numeric($validitycode)?$validitycode:1;
            if($code == 1)
            {
                $datajson = file_get_contents('php://input');
                log_message('info',$datajson."---time:".date("Y-m-d H:i:s"));
                $datajson = $this->apiclass->decrypt($datajson);
                log_message('info',$datajson."---time:".date("Y-m-d H:i:s"));
                $data = json_decode($datajson,true);
                $name = !empty($data["name"])?$data["name"]:null;
                $idNo = !empty($data["idNo"])?$data["idNo"]:null;
                //判断参数
                if($name == null || $idNo == null)
                {
                    $code = 110;
                    $this->apiclass->response($code);
                }
                else
                {
                    $data = array(
                        "name"=>$name,
                        "identityCard"=>$idNo
                    );

                    $this->load->library('alading');
                    $out = $this->alading->getdata("idcheck",$data);
                    //判断返回值
                    if($out == "500")
                    {
                        $this->apiclass->response($out);
                    }
                    else
                    {
                        $arr = json_decode($out,true);
                        $code = !empty($arr["code"])?$arr["code"]:null;
                        //var_dump($arr);
                        //判断返回json
                        if ($code == 0)
                        {
                            $data = $arr["data"];

                            $result = "";
                            //$state = $result["state"];
                            //var_dump($result);
                            $ischarge = 0;
                            switch ($data["compStatus"])
                            {
                                case  "1":
                                    $state = "1100";
                                    $result = array(
                                        "result"=>"一致",
                                        "state"=>$state
                                    );
                                    $ischarge = 1;
                                    break;
                                case  "2":
                                    $state = "1101";
                                    $result = array(
                                        "result"=>"不一致",
                                        "state"=>$state
                                    );
                                    $ischarge = 1;
                                    break;
                                case  "3":
                                    $state = "1102";
                                    $result = array(
                                        "result"=>"库中无此号",
                                        "state"=>$state
                                    );
                                    $ischarge = 0;
                                    break;
                                default:
                                    $this->apiclass->response(500);
                                    return;
                            }
                            $code = "100";
                            $orderno = $this->apiclass->createorderno();
                            $this->apiclass->updatedb($validitycode["userproid"],$validitycode["userid"],$validitycode["proid"],$datajson,$state,$ischarge,$orderno,"aladingidcheck");
                            $this->apiclass->response($code,$result,$orderno);
                        }
                        else
                        {
                            $this->apiclass->response(500);
                        }
                    }
                }
            }
            else
            {
                $this->apiclass->response($code);
            }
        }
        catch (Exception $e)
        {
            log_message('error',$e->getMessage());
            $this->apiclass->response(500);
        }
    }

    public function idnamecheckbak(){
        try{
            //判断用户接口权限
            $validitycode = $this->apiclass->validate();
            $code = is_numeric($validitycode)?$validitycode:1;
            if($code == 1)
            {
                $datajson = file_get_contents('php://input');
                log_message('info',$datajson."---time:".date("Y-m-d H:i:s"));
                $datajson = $this->apiclass->decrypt($datajson);
                log_message('info',$datajson."---time:".date("Y-m-d H:i:s"));
                $data = json_decode($datajson,true);
                $name = !empty($data["name"])?$data["name"]:null;
                $idNo = !empty($data["idNo"])?$data["idNo"]:null;
                //判断参数
                if($name == null || $idNo == null)
                {
                    $code = 110;
                    $this->apiclass->response($code);
                }
                else
                {
                    $data = array(
                        "name"=>$name,
                        "id_number"=>$idNo
                    );

                    $this->load->library('jiaokenew');
                    $out = $this->jiaokenew->getdata("idcheck",$data);
                    //判断返回值
                    if($out == "500")
                    {
                        $this->apiclass->response($out);
                    }
                    else
                    {
                        $arr = json_decode($out,true);
                        $code = !empty($arr["code"])?$arr["code"]:null;
                        //var_dump($arr);
                        //判断返回json
                        if ($code == 200)
                        {

                            $result = "";
                            //$state = $result["state"];
                            //var_dump($result);
                            $ischarge = 0;
                            switch ($arr["data"])
                            {
                                case  "1":
                                    $state = "1100";
                                    $result = array(
                                        "result"=>"一致",
                                        "state"=>$state
                                    );
                                    $ischarge = 1;
                                    break;
                                case  "0":
                                    $state = "1101";
                                    $result = array(
                                        "result"=>"不一致",
                                        "state"=>$state
                                    );
                                    $ischarge = 1;
                                    break;
                                case  "2":
                                    $state = "1102";
                                    $result = array(
                                        "result"=>"库中无此号",
                                        "state"=>$state
                                    );
                                    $ischarge = 0;
                                    break;
                                case  "3":
                                    $state = "1104";
                                    $result = array(
                                        "result"=>"查询错误",
                                        "state"=>$state
                                    );
                                    $ischarge = 0;
                                    break;
                                default:
                                    $this->apiclass->response(500);
                                    return;
                            }
                            $code = "100";
                            $orderno = $this->apiclass->createorderno();
                            $this->apiclass->updatedb($validitycode["userproid"],$validitycode["userid"],$validitycode["proid"],$datajson,$state,$ischarge,$orderno,"jiaokeidcheck");
                            $this->apiclass->response($code,$result,$orderno);
                        }
                        else
                        {
                            $this->apiclass->response(500);
                        }
                    }
                }
            }
            else
            {
                $this->apiclass->response($code);
            }
        }
        catch (Exception $e)
        {
            log_message('error',$e->getMessage());
            $this->apiclass->response(500);
        }
    }

    public function photoverification()
    {
        try{
            //判断用户接口权限
            $validitycode = $this->apiclass->validate();
            $code = is_numeric($validitycode)?$validitycode:1;
            if($code == 1)
            {
                $datajson = file_get_contents('php://input');
                log_message('info',$datajson."---time:".date("Y-m-d H:i:s"));
                $datajson = $this->apiclass->decrypt($datajson);
                log_message('info',$datajson."---time:".date("Y-m-d H:i:s"));
                $data = json_decode($datajson,true);
                $name = !empty($data["name"])?$data["name"]:null;
                $idNo = !empty($data["idNo"])?$data["idNo"]:null;
                $photo = !empty($data["photo"])?$data["photo"]:null;
                //判断参数
                if($name == null || $idNo == null || $photo == null)
                {
                    $code = 110;
                    $this->apiclass->response($code);
                }
                else
                {
                    $data = array(
                        "name"=>$name,
                        "id_number"=>$idNo,
                        "imgstr"=>$photo
                    );

                    $this->load->library('jiaokenew');
                    $out = $this->jiaokenew->getdata("idphoto",$data,20);
                    //判断返回值
                    if($out == "500")
                    {
                        $this->apiclass->response($out);
                    }
                    else
                    {
                        $arr = json_decode($out,true);
                        $code = !empty($arr["code"])?$arr["code"]:null;
                        //var_dump($arr);
                        //判断返回json
                        if ($code == 200)
                        {
                            $result = "";
                            //$state = $result["state"];
                            //var_dump($result);
                            $ischarge = 0;
                            switch ($arr["data"])
                            {
                                case  "0":
                                    $state = "1100";
                                    $result = array(
                                        "result"=>"对比成功",
                                        "state"=>$state,
                                        "grade"=>number_format($arr["msg"],2)
                                    );
                                    $ischarge = 1;
                                    break;
                                case  "1":
                                    $state = "1101";
                                    $result = array(
                                        "result"=>"姓名和身份证号不一致",
                                        "state"=>$state
                                    );
                                    $ischarge = 1;
                                    break;
                                case  "4":
                                    $state = "1102";
                                    $result = array(
                                        "result"=>"姓名和身份证号匹配,库无照片",
                                        "state"=>$state
                                    );
                                    $ischarge = 1;
                                    break;
                                case  "2":
                                    $state = "1103";
                                    $result = array(
                                        "result"=>"身份证无效",
                                        "state"=>$state
                                    );
                                    $ischarge = 1;
                                    break;
                                case "3":
                                    switch ($arr["msg"]){
                                        case "图片大小不符合要求" :
                                            $state = "1106";
                                            $result = array(
                                                "result"=>"图片大小不符合要求",
                                                "state"=>$state
                                            );
                                            $ischarge = 0;
                                            break;
                                        case "图片类型不符合要求":
                                            $state = "1107";
                                            $result = array(
                                                "result"=>"图片类型不符合要求",
                                                "state"=>$state
                                            );
                                            $ischarge = 0;
                                            break;
                                        case "图片损坏":
                                            $state = "1105";
                                            $result = array(
                                                "result"=>"图片不存在或已损坏",
                                                "state"=>$state
                                            );
                                            $ischarge = 0;
                                            break;
                                        default:
                                            $this->apiclass->response(500);
                                            return;
                                    }
                                    break;
                                default:
                                    $this->apiclass->response(500);
                                    return;
                            }
                            $code = "100";
                            $orderno = $this->apiclass->createorderno();
                            $this->apiclass->updatedb($validitycode["userproid"],$validitycode["userid"],$validitycode["proid"],$datajson,$state,$ischarge,$orderno,"jiaokephotoverification");
                            $this->apiclass->response($code,$result,$orderno);
                        }
                        else
                        {
                            $this->apiclass->response(500);
                        }
                    }
                }
            }
            else
            {
                $this->apiclass->response($code);
            }
        }
        catch (Exception $e)
        {
            log_message('error',$e->getMessage());
            $this->apiclass->response(500);
        }
    }


    public function mobilebak(){
        try{
            //判断用户接口权限
            $validitycode = $this->apiclass->validate();
            $code = is_numeric($validitycode)?$validitycode:1;
            $code = 1;
            if($code == 1)
            {
                $datajson = file_get_contents('php://input');
                log_message('info',$datajson."---time:".date("Y-m-d H:i:s"));
                $datajson = $this->apiclass->decrypt($datajson);
                log_message('info',$datajson."---time:".date("Y-m-d H:i:s"));
                $data = json_decode($datajson,true);
                $name = !empty($data["name"])?$data["name"]:null;
                $idNo = !empty($data["idNo"])?$data["idNo"]:null;
                $phone = !empty($data["phone"])?$data["phone"]:null;
                //判断参数
                if($name == null || $idNo == null || $phone == null)
                {
                    $code = 110;
                    $this->apiclass->response($code);
                }
                else
                {
                    $data = array(
                        "name"=>$name,
                        "id_number"=>$idNo,
                        "mobile"=>$phone

                    );

                    $this->load->library('jiaokenew');
                    $out = $this->jiaokenew->getdata("mobile",$data);
                    //判断返回值
                    if($out == "500")
                    {
                        $this->apiclass->response($out);
                    }
                    else
                    {
                        $arr = json_decode($out,true);
                        $code = !empty($arr["code"])?$arr["code"]:null;
                        //var_dump($arr);
                        //判断返回json
                        if ($code == 200)
                        {

                            $result = "";
                            //$state = $result["state"];
                            //var_dump($result);
                            $ischarge = 0;
                            switch ($arr["data"])
                            {
                                case  "0":
                                    $state = "1100";
                                    $result = array(
                                        "result"=>"一致",
                                        "state"=>$state
                                    );
                                    $ischarge = 1;
                                    break;
                                case  "1":
                                    $state = "1101";
                                    $result = array(
                                        "result"=>"不一致",
                                        "state"=>$state
                                    );
                                    $ischarge = 1;
                                    break;
                                case  "2":
                                    $state = "1102";
                                    $result = array(
                                        "result"=>"库中无此号",
                                        "state"=>$state
                                    );
                                    $ischarge = 0;
                                    break;
                                default:
                                    $this->apiclass->response(500);
                                    return;
                            }
                            $code = "100";
                            $orderno = $this->apiclass->createorderno();
                            $this->apiclass->updatedb($validitycode["userproid"],$validitycode["userid"],$validitycode["proid"],$datajson,$state,$ischarge,$orderno,"jiaokemobile");
                            $this->apiclass->response($code,$result,$orderno);
                        }
                        else
                        {
                            $this->apiclass->response(500);
                        }
                    }
                }
            }
            else
            {
                $this->apiclass->response($code);
            }
        }
        catch (Exception $e)
        {
            log_message('error',$e->getMessage());
            $this->apiclass->response(500);
        }
    }

    public function banktwo(){
        try{
            //判断用户接口权限
            $validitycode = $this->apiclass->validate();
            $code = is_numeric($validitycode)?$validitycode:1;
            $code = 1;
            if($code == 1)
            {
                $datajson = file_get_contents('php://input');
                log_message('info',$datajson."---time:".date("Y-m-d H:i:s"));
                $datajson = $this->apiclass->decrypt($datajson);
                log_message('info',$datajson."---time:".date("Y-m-d H:i:s"));
                $data = json_decode($datajson,true);
                $name = !empty($data["name"])?$data["name"]:null;
                $bankcard = !empty($data["bankcard"])?$data["bankcard"]:null;
                //$phone = !empty($data["phone"])?$data["phone"]:null;
                //判断参数
                if($name == null || $bankcard == null)
                {
                    $code = 110;
                    $this->apiclass->response($code);
                }
                else
                {
                    $data = array(
                        "name"=>$name,
                        "bank_card_number"=>$bankcard
                    );

                    $this->load->library('jiaokenew');
                    $out = $this->jiaokenew->getdata("banktwoinfo",$data);
                    //判断返回值
                    if($out == "500")
                    {
                        $this->apiclass->response($out);
                    }
                    else
                    {
                        $arr = json_decode($out,true);
                        $code = !empty($arr["code"])?$arr["code"]:null;
                        //var_dump($arr);
                        //判断返回json
                        if ($code)
                        {

                            $result = "";
                            //$state = $result["state"];
                            //var_dump($result);
                            $ischarge = 0;
                            switch ($arr["code"])
                            {
                                case  "2000":
                                    $state = "1100";
                                    $result = array(
                                        "result"=>"一致",
                                        "state"=>$state
                                    );
                                    $ischarge = 1;
                                    break;
                                case  "2001":
                                    $state = "1101";
                                    $result = array(
                                        "result"=>"不一致",
                                        "state"=>$state
                                    );
                                    $ischarge = 1;
                                    break;
                                case  "2002":
                                case  "2003":
                                case  "2004":
                                case  "2005":
                                case  "2006":
                                case  "2007":
                                case  "2008":
                                    $state = "1102";
                                    $result = array(
                                        "result"=>"库中无此号",
                                        "state"=>$state
                                    );
                                    $ischarge = 0;
                                    break;
                                default:
                                    $this->apiclass->response(500);
                                    return;
                            }
                            $code = "100";
                            $orderno = $this->apiclass->createorderno();
                            $this->apiclass->updatedb($validitycode["userproid"],$validitycode["userid"],$validitycode["proid"],$datajson,$state,$ischarge,$orderno,"jiaokebanktwoinfo");
                            $this->apiclass->response($code,$result,$orderno);
                        }
                        else
                        {
                            $this->apiclass->response(500);
                        }
                    }
                }
            }
            else
            {
                $this->apiclass->response($code);
            }
        }
        catch (Exception $e)
        {
            log_message('error',$e->getMessage());
            $this->apiclass->response(500);
        }
    }

    public function bankthreetest(){
        try{
            //判断用户接口权限
            $validitycode = $this->apiclass->validate();
            $code = is_numeric($validitycode)?$validitycode:1;
            if($code == 1)
            {
                $datajson = file_get_contents('php://input');
                log_message('info',$datajson."---time:".date("Y-m-d H:i:s"));
                $datajson = $this->apiclass->decrypt($datajson);
                log_message('info',$datajson."---time:".date("Y-m-d H:i:s"));
                $data = json_decode($datajson,true);
                $name = !empty($data["name"])?$data["name"]:null;
                $idNo = !empty($data["idNo"])?$data["idNo"]:null;
                $bankcard = !empty($data["bankcard"])?$data["bankcard"]:null;
                //$phone = !empty($data["phone"])?$data["phone"]:null;
                //判断参数
                if($name == null || $idNo == null || $bankcard == null)
                {
                    $code = 110;
                    $this->apiclass->response($code);
                }
                else
                {
                    $data = array(
                        "name"=>$name,
                        "idCard"=>$idNo,
                        "bankCard"=>$bankcard
                    );

                    $this->load->library('zhongsheng');
                    $out = $this->zhongsheng->getdata("bank",$data);
                    //判断返回值
                    if($out == "500")
                    {
                        $this->apiclass->response($out);
                    }
                    else
                    {
                        $arr = json_decode($out,true);

                        $resultinfo = !empty($arr["resultInfo"])?$arr["resultInfo"]:null;

                        //$code = !empty($arr["code"])?$arr["code"]:null;
                        //var_dump($arr);
                        //判断返回json
                        if ($resultinfo)
                        {

                            $resultinfoarr =  json_decode($resultinfo,true);

                            switch ($resultinfoarr["statcode"])
                            {
                                case  "1200":
                                    $state = "1100";
                                    $result = array(
                                        "result"=>"一致",
                                        "state"=>$state
                                    );
                                    $ischarge = 1;
                                    break;
                                case  "1201":
                                    $state = "1101";
                                    $result = array(
                                        "result"=>"不一致",
                                        "state"=>$state
                                    );
                                    $ischarge = 1;
                                    break;
                                case  "1203":
                                    $state = "1102";
                                    $result = array(
                                        "result"=>"银行卡状态错误",
                                        "state"=>$state
                                    );
                                    $ischarge = 0;
                                    break;
                                case  "1206":
                                    $state = "1103";
                                    $result = array(
                                        "result"=>"验证失败",
                                        "state"=>$state
                                    );
                                    $ischarge = 0;
                                    break;
                                case  "2018":
                                    $code = 110;
                                    $this->apiclass->response($code);
                                    break;
                                default:
                                    $this->apiclass->response(500);
                                    return;
                            }
                            $code = "100";
                            $orderno = $this->apiclass->createorderno();
                            $this->apiclass->updatedb($validitycode["userproid"],$validitycode["userid"],$validitycode["proid"],$datajson,$state,$ischarge,$orderno,"zhongshengvin");
                            $this->apiclass->response($code,$result,$orderno);
                        }
                        else
                        {
                            $this->apiclass->response(500);
                        }
                    }
                }
            }
            else
            {
                $this->apiclass->response($code);
            }
        }
        catch (Exception $e)
        {
            log_message('error',$e->getMessage());
            $this->apiclass->response(500);
        }
    }

    public function bankfourtest(){
        try{
            //判断用户接口权限
            $validitycode = $this->apiclass->validate();
            $code = is_numeric($validitycode)?$validitycode:1;
            if($code == 1)
            {
                $datajson = file_get_contents('php://input');
                log_message('info',$datajson."---time:".date("Y-m-d H:i:s"));
                $datajson = $this->apiclass->decrypt($datajson);
                log_message('info',$datajson."---time:".date("Y-m-d H:i:s"));
                $data = json_decode($datajson,true);
                $name = !empty($data["name"])?$data["name"]:null;
                $idNo = !empty($data["idNo"])?$data["idNo"]:null;
                $bankcard = !empty($data["bankcard"])?$data["bankcard"]:null;
                $phone = !empty($data["phone"])?$data["phone"]:null;
                //判断参数
                if($name == null || $idNo == null || $bankcard == null)
                {
                    $code = 110;
                    $this->apiclass->response($code);
                }
                else
                {
                    $data = array(
                        "name"=>$name,
                        "idCard"=>$idNo,
                        "bankCard"=>$bankcard,
                        "mobile"=>$phone
                    );

                    $this->load->library('zhongsheng');
                    $out = $this->zhongsheng->getdata("bank",$data);
                    //判断返回值
                    if($out == "500")
                    {
                        $this->apiclass->response($out);
                    }
                    else
                    {
                        $arr = json_decode($out,true);

                        $resultinfo = !empty($arr["resultInfo"])?$arr["resultInfo"]:null;

                        //$code = !empty($arr["code"])?$arr["code"]:null;
                        //var_dump($arr);
                        //判断返回json
                        if ($resultinfo)
                        {

                            $resultinfoarr =  json_decode($resultinfo,true);

                            switch ($resultinfoarr["statcode"])
                            {
                                case  "1200":
                                    $state = "1100";
                                    $result = array(
                                        "result"=>"一致",
                                        "state"=>$state
                                    );
                                    $ischarge = 1;
                                    break;
                                case  "1201":
                                    $state = "1101";
                                    $result = array(
                                        "result"=>"不一致",
                                        "state"=>$state
                                    );
                                    $ischarge = 1;
                                    break;
                                case  "1203":
                                    $state = "1102";
                                    $result = array(
                                        "result"=>"银行卡状态错误",
                                        "state"=>$state
                                    );
                                    $ischarge = 0;
                                    break;
                                case  "1206":
                                    $state = "1103";
                                    $result = array(
                                        "result"=>"验证失败",
                                        "state"=>$state
                                    );
                                    $ischarge = 0;
                                    break;
                                case  "2018":
                                    $code = 110;
                                    $this->apiclass->response($code);
                                    break;
                                default:
                                    $this->apiclass->response(500);
                                    return;
                            }
                            $code = "100";
                            $orderno = $this->apiclass->createorderno();
                            $this->apiclass->updatedb($validitycode["userproid"],$validitycode["userid"],$validitycode["proid"],$datajson,$state,$ischarge,$orderno,"zhongshengvin");
                            $this->apiclass->response($code,$result,$orderno);
                        }
                        else
                        {
                            $this->apiclass->response(500);
                        }
                    }
                }
            }
            else
            {
                $this->apiclass->response($code);
            }
        }
        catch (Exception $e)
        {
            log_message('error',$e->getMessage());
            $this->apiclass->response(500);
        }
    }

    public function bankthree(){
        try{
            //判断用户接口权限
            $validitycode = $this->apiclass->validate();
            $code = is_numeric($validitycode)?$validitycode:1;
            $code = 1;
            if($code == 1)
            {
                $datajson = file_get_contents('php://input');
                log_message('info',$datajson."---time:".date("Y-m-d H:i:s"));
                $datajson = $this->apiclass->decrypt($datajson);
                log_message('info',$datajson."---time:".date("Y-m-d H:i:s"));
                $data = json_decode($datajson,true);
                $name = !empty($data["name"])?$data["name"]:null;
                $idNo = !empty($data["idNo"])?$data["idNo"]:null;
                $bankcard = !empty($data["bankcard"])?$data["bankcard"]:null;
                //$phone = !empty($data["phone"])?$data["phone"]:null;
                //判断参数
                if($name == null || $idNo == null || $bankcard == null)
                {
                    $code = 110;
                    $this->apiclass->response($code);
                }
                else
                {
                    $data = array(
                        "name"=>$name,
                        "id_number"=>$idNo,
                        "bank_card_number"=>$bankcard
                    );

                    $this->load->library('jiaokenew');
                    $out = $this->jiaokenew->getdata("bankthreeinfo",$data);
                    //判断返回值
                    if($out == "500")
                    {
                        $this->apiclass->response($out);
                    }
                    else
                    {
                        $arr = json_decode($out,true);
                        $code = !empty($arr["code"])?$arr["code"]:null;
                        //var_dump($arr);
                        //判断返回json
                        if ($code)
                        {

                            $result = "";
                            //$state = $result["state"];
                            //var_dump($result);
                            $ischarge = 0;
                            switch ($arr["code"])
                            {
                                case  "2000":
                                    $state = "1100";
                                    $result = array(
                                        "result"=>"一致",
                                        "state"=>$state
                                    );
                                    $ischarge = 1;
                                    break;
                                case  "2001":
                                    $state = "1101";
                                    $result = array(
                                        "result"=>"不一致",
                                        "state"=>$state
                                    );
                                    $ischarge = 1;
                                    break;
                                case  "2002":
                                case  "2003":
                                case  "2004":
                                case  "2005":
                                case  "2006":
                                case  "2007":
                                case  "2008":
                                    $state = "1102";
                                    $result = array(
                                        "result"=>"库中无此号",
                                        "state"=>$state
                                    );
                                    $ischarge = 0;
                                    break;
                                default:
                                    $this->apiclass->response(500);
                                    return;
                            }
                            $code = "100";
                            $orderno = $this->apiclass->createorderno();
                            $this->apiclass->updatedb($validitycode["userproid"],$validitycode["userid"],$validitycode["proid"],$datajson,$state,$ischarge,$orderno,"jiaokebankthreeinfo");
                            $this->apiclass->response($code,$result,$orderno);
                        }
                        else
                        {
                            $this->apiclass->response(500);
                        }
                    }
                }
            }
            else
            {
                $this->apiclass->response($code);
            }
        }
        catch (Exception $e)
        {
            log_message('error',$e->getMessage());
            $this->apiclass->response(500);
        }
    }


    public function bankfour(){
        try{
            //判断用户接口权限
            $validitycode = $this->apiclass->validate();
            $code = is_numeric($validitycode)?$validitycode:1;
            $code = 1;
            if($code == 1)
            {
                $datajson = file_get_contents('php://input');
                log_message('info',$datajson."---time:".date("Y-m-d H:i:s"));
                $datajson = $this->apiclass->decrypt($datajson);
                log_message('info',$datajson."---time:".date("Y-m-d H:i:s"));
                $data = json_decode($datajson,true);
                $name = !empty($data["name"])?$data["name"]:null;
                $idNo = !empty($data["idNo"])?$data["idNo"]:null;
                $bankcard = !empty($data["bankcard"])?$data["bankcard"]:null;
                $phone = !empty($data["phone"])?$data["phone"]:null;
                //判断参数
                if($name == null || $idNo == null || $bankcard == null || $phone == null)
                {
                    $code = 110;
                    $this->apiclass->response($code);
                }
                else
                {
                    $data = array(
                        "name"=>$name,
                        "id_number"=>$idNo,
                        "bank_card_number"=>$bankcard,
                        "mobile"=>$phone
                    );

                    $this->load->library('jiaokenew');
                    $out = $this->jiaokenew->getdata("bankfourinfo",$data);
                    //判断返回值
                    if($out == "500")
                    {
                        $this->apiclass->response($out);
                    }
                    else
                    {
                        $arr = json_decode($out,true);
                        $code = !empty($arr["code"])?$arr["code"]:null;
                        //var_dump($arr);
                        //判断返回json
                        if ($code)
                        {

                            $result = "";
                            //$state = $result["state"];
                            //var_dump($result);
                            $ischarge = 0;
                            switch ($arr["code"])
                            {
                                case  "2000":
                                    $state = "1100";
                                    $result = array(
                                        "result"=>"一致",
                                        "state"=>$state
                                    );
                                    $ischarge = 1;
                                    break;
                                case  "2001":
                                    $state = "1101";
                                    $result = array(
                                        "result"=>"不一致",
                                        "state"=>$state
                                    );
                                    $ischarge = 1;
                                    break;
                                case  "2002":
                                case  "2003":
                                case  "2004":
                                case  "2005":
                                case  "2006":
                                case  "2007":
                                case  "2008":
                                    $state = "1102";
                                    $result = array(
                                        "result"=>"库中无此号",
                                        "state"=>$state
                                    );
                                    $ischarge = 0;
                                    break;
                                default:
                                    $this->apiclass->response(500);
                                    return;
                            }
                            $code = "100";
                            $orderno = $this->apiclass->createorderno();
                            $this->apiclass->updatedb($validitycode["userproid"],$validitycode["userid"],$validitycode["proid"],$datajson,$state,$ischarge,$orderno,"jiaokebankfourinfo");
                            $this->apiclass->response($code,$result,$orderno);
                        }
                        else
                        {
                            $this->apiclass->response(500);
                        }
                    }
                }
            }
            else
            {
                $this->apiclass->response($code);
            }
        }
        catch (Exception $e)
        {
            log_message('error',$e->getMessage());
            $this->apiclass->response(500);
        }
    }



    public function mobile()
    {
        try{
            //判断用户接口权限
            $this->benchmark->mark('function_start');
            $time1 = $this->benchmark->elapsed_time('total_execution_time_start', 'function_start');
            log_message('info',$time1);
            $validitycode = $this->apiclass->validate();
            $code = is_numeric($validitycode)?$validitycode:1;
            if($code == 1)
            {
                $datajson = file_get_contents('php://input');
                log_message('info',$datajson."---time:".date("Y-m-d H:i:s"));
                $datajson = $this->apiclass->decrypt($datajson);
                log_message('info',$datajson."---time:".date("Y-m-d H:i:s"));
                $data = json_decode($datajson,true);
                $name = !empty($data["name"])?$data["name"]:null;
                $idNo = !empty($data["idNo"])?$data["idNo"]:null;
                $phone = !empty($data["phone"])?$data["phone"]:null;
                //判断参数
                if($name == null || $idNo == null || $phone == null)
                {
                    $code = 110;
                    $this->apiclass->response($code);
                }
                else
                {
                    if (!$this->apiclass->isMobile($phone)){
                        $state = "1103";
                        $result = array(
                            "result"=>"参数错误",
                            "state"=>$state
                        );
                        $ischarge = 0;
                        $code = "100";
                        $orderno = $this->apiclass->createorderno();
                        $this->apiclass->updatedb($validitycode["userproid"],$validitycode["userid"],$validitycode["proid"],$datajson,$state,$ischarge,$orderno,"zhongchengxingetmobile");
                        $this->apiclass->response($code,$result,$orderno);
                        return;
                    }

                    $this->benchmark->mark('curl_start');
                    $time2 = $this->benchmark->elapsed_time('function_start', 'curl_start');
                    log_message('info',$time2);
                    $this->load->library('zhongchengxin');
                    $out = $this->zhongchengxin->getmobile($name,$idNo,$phone);
                    $this->benchmark->mark('curl_end');
                    $time3 = $this->benchmark->elapsed_time('curl_start', 'curl_end');
                    log_message('info',$time3);
                    //判断返回值
                    if($out == "500")
                    {
                        $this->apiclass->response($out);
                    }
                    else
                    {
                        $arr = json_decode($out,true);
                        $code = !empty($arr["status_code"])?$arr["status_code"]:null;
                        //判断返回json
                        if ($code == "200")
                        {
                            $result = $arr["data"];
                            $state = $result["verify_3d_real_name"];
                            //var_dump($result);
                            $ischarge = 0;
                            switch ($state)
                            {
                                case  "Y":
                                    $state = "1100";
                                    $result = array(
                                        "result"=>"一致",
                                        "state"=>$state
                                    );
                                    $ischarge = 1;
                                    break;
                                case  "N":
                                case  "F":
                                    $state = "1101";
                                    $result = array(
                                        "result"=>"不一致",
                                        "state"=>$state
                                    );
                                    $ischarge = 1;
                                    break;
                                case  "X":
                                    $state = "1102";
                                    $result = array(
                                        "result"=>"库中无此号",
                                        "state"=>$state
                                    );
                                    $ischarge = 0;
                                    break;
                                default:
                                    $this->apiclass->response(500);
                                    return;
                            }
                            $code = "100";
                            $orderno = $this->apiclass->createorderno();
                            $this->apiclass->updatedb($validitycode["userproid"],$validitycode["userid"],$validitycode["proid"],$datajson,$state,$ischarge,$orderno,"zhongchengxingetmobile");
                            $this->apiclass->response($code,$result,$orderno);
                        }
                        elseif ($code == "101" || $code == "101001" || $code == "101002" || $code == "101003" || $code == "101005")
                        {
                            $state = "1103";
                            $result = array(
                                "result"=>"参数错误",
                                "state"=>$state
                            );
                            $ischarge = 0;
                            $code = "100";
                            $orderno = $this->apiclass->createorderno();
                            $this->apiclass->updatedb($validitycode["userproid"],$validitycode["userid"],$validitycode["proid"],$datajson,$state,$ischarge,$orderno,"zhongchengxingetmobile");
                            $this->apiclass->response($code,$result,$orderno);
                        }
                        elseif ($code == "102")
                        {
                            $state = "1104";
                            $result = array(
                                "result"=>"查询错误",
                                "state"=>$state
                            );
                            $ischarge = 0;
                            $code = "100";
                            $orderno = $this->apiclass->createorderno();
                            $this->apiclass->updatedb($validitycode["userproid"],$validitycode["userid"],$validitycode["proid"],$datajson,$state,$ischarge,$orderno,"zhongchengxingetmobile");
                            $this->apiclass->response($code,$result,$orderno);
                        }
                        else
                        {
                            $this->apiclass->response(500);
                        }
                        $this->benchmark->mark('function_end');
                        $time4 = $this->benchmark->elapsed_time('curl_end', 'function_end');
                        log_message('info',$time4);
                    }
                }
            }
            else
            {
                $this->apiclass->response($code);
            }
        }
        catch (Exception $e)
        {
            log_message('error',$e->getMessage());
            $this->apiclass->response(500);
        }
    }


    public function telecombak()
    {
        try{
            //判断用户接口权限
            $this->benchmark->mark('function_start');
            $time1 = $this->benchmark->elapsed_time('total_execution_time_start', 'function_start');
            log_message('info',$time1);
            $validitycode = $this->apiclass->validate();
            $code = is_numeric($validitycode)?$validitycode:1;
            if($code == 1)
            {
                $datajson = file_get_contents('php://input');
                log_message('info',$datajson."---time:".date("Y-m-d H:i:s"));
                $datajson = $this->apiclass->decrypt($datajson);
                log_message('info',$datajson."---time:".date("Y-m-d H:i:s"));
                $data = json_decode($datajson,true);
                $name = !empty($data["name"])?$data["name"]:null;
                $idNo = !empty($data["idNo"])?$data["idNo"]:null;
                $phone = !empty($data["phone"])?$data["phone"]:null;
                //判断参数
                if($name == null || $idNo == null || $phone == null)
                {
                    $code = 110;
                    $this->apiclass->response($code);
                }
                else
                {
                    if (!$this->apiclass->isTelecom($phone)){
                        $state = "1103";
                        $result = array(
                            "result"=>"参数错误",
                            "state"=>$state
                        );
                        $ischarge = 0;
                        $code = "100";
                        $orderno = $this->apiclass->createorderno();
                        $this->apiclass->updatedb($validitycode["userproid"],$validitycode["userid"],$validitycode["proid"],$datajson,$state,$ischarge,$orderno,"zhongchengxingettelecom");
                        $this->apiclass->response($code,$result,$orderno);
                        return;
                    }
                    $this->benchmark->mark('curl_start');
                    $time2 = $this->benchmark->elapsed_time('function_start', 'curl_start');
                    log_message('info',$time2);
                    $this->load->library('zhongchengxin');
                    $out = $this->zhongchengxin->getmobile($name,$idNo,$phone);
                    $this->benchmark->mark('curl_end');
                    $time3 = $this->benchmark->elapsed_time('curl_start', 'curl_end');
                    log_message('info',$time3);
                    //判断返回值
                    if($out == "500")
                    {
                        $this->apiclass->response($out);
                    }
                    else
                    {
                        $arr = json_decode($out,true);
                        $code = !empty($arr["status_code"])?$arr["status_code"]:null;
                        //判断返回json
                        if ($code == "200")
                        {
                            $result = $arr["data"];
                            $state = $result["verify_3d_real_name"];
                            //var_dump($result);
                            $ischarge = 0;
                            switch ($state)
                            {
                                case  "Y":
                                    $state = "1100";
                                    $result = array(
                                        "result"=>"一致",
                                        "state"=>$state
                                    );
                                    $ischarge = 1;
                                    break;
                                case  "N":
                                case  "F":
                                    $state = "1101";
                                    $result = array(
                                        "result"=>"不一致",
                                        "state"=>$state
                                    );
                                    $ischarge = 1;
                                    break;
                                case  "X":
                                    $state = "1102";
                                    $result = array(
                                        "result"=>"库中无此号",
                                        "state"=>$state
                                    );
                                    $ischarge = 0;
                                    break;
                                default:
                                    $this->apiclass->response(500);
                                    return;
                            }
                            $code = "100";
                            $orderno = $this->apiclass->createorderno();
                            $this->apiclass->updatedb($validitycode["userproid"],$validitycode["userid"],$validitycode["proid"],$datajson,$state,$ischarge,$orderno,"zhongchengxingettelecom");
                            $this->apiclass->response($code,$result,$orderno);
                        }
                        elseif ($code == "101" || $code == "101001" || $code == "101002" || $code == "101003" || $code == "101005")
                        {
                            $state = "1103";
                            $result = array(
                                "result"=>"参数错误",
                                "state"=>$state
                            );
                            $ischarge = 0;
                            $code = "100";
                            $orderno = $this->apiclass->createorderno();
                            $this->apiclass->updatedb($validitycode["userproid"],$validitycode["userid"],$validitycode["proid"],$datajson,$state,$ischarge,$orderno,"zhongchengxingettelecom");
                            $this->apiclass->response($code,$result,$orderno);
                        }
                        elseif ($code == "102")
                        {
                            $state = "1104";
                            $result = array(
                                "result"=>"查询错误",
                                "state"=>$state
                            );
                            $ischarge = 0;
                            $code = "100";
                            $orderno = $this->apiclass->createorderno();
                            $this->apiclass->updatedb($validitycode["userproid"],$validitycode["userid"],$validitycode["proid"],$datajson,$state,$ischarge,$orderno,"zhongchengxingettelecom");
                            $this->apiclass->response($code,$result,$orderno);
                        }
                        else
                        {
                            $this->apiclass->response(500);
                        }
                        $this->benchmark->mark('function_end');
                        $time4 = $this->benchmark->elapsed_time('curl_end', 'function_end');
                        log_message('info',$time4);
                    }
                }
            }
            else
            {
                $this->apiclass->response($code);
            }
        }
        catch (Exception $e)
        {
            log_message('error',$e->getMessage());
            $this->apiclass->response(500);
        }
    }

    public function unicombak()
    {
        try{
            //判断用户接口权限
            $this->benchmark->mark('function_start');
            $time1 = $this->benchmark->elapsed_time('total_execution_time_start', 'function_start');
            log_message('info',$time1);
            $validitycode = $this->apiclass->validate();
            $code = is_numeric($validitycode)?$validitycode:1;
            if($code == 1)
            {
                $datajson = file_get_contents('php://input');
                log_message('info',$datajson."---time:".date("Y-m-d H:i:s"));
                $datajson = $this->apiclass->decrypt($datajson);
                log_message('info',$datajson."---time:".date("Y-m-d H:i:s"));
                $data = json_decode($datajson,true);
                $name = !empty($data["name"])?$data["name"]:null;
                $idNo = !empty($data["idNo"])?$data["idNo"]:null;
                $phone = !empty($data["phone"])?$data["phone"]:null;
                //判断参数
                if($name == null || $idNo == null || $phone == null)
                {
                    $code = 110;
                    $this->apiclass->response($code);
                }
                else
                {
                    if (!$this->apiclass->isUnicom($phone)){
                        $state = "1103";
                        $result = array(
                            "result"=>"参数错误",
                            "state"=>$state
                        );
                        $ischarge = 0;
                        $code = "100";
                        $orderno = $this->apiclass->createorderno();
                        $this->apiclass->updatedb($validitycode["userproid"],$validitycode["userid"],$validitycode["proid"],$datajson,$state,$ischarge,$orderno,"zhongchengxingetunicom");
                        $this->apiclass->response($code,$result,$orderno);
                        return;
                    }
                    $this->benchmark->mark('curl_start');
                    $time2 = $this->benchmark->elapsed_time('function_start', 'curl_start');
                    log_message('info',$time2);
                    $this->load->library('zhongchengxin');
                    $out = $this->zhongchengxin->getmobile($name,$idNo,$phone);
                    $this->benchmark->mark('curl_end');
                    $time3 = $this->benchmark->elapsed_time('curl_start', 'curl_end');
                    log_message('info',$time3);
                    //判断返回值
                    if($out == "500")
                    {
                        $this->apiclass->response($out);
                    }
                    else
                    {
                        $arr = json_decode($out,true);
                        $code = !empty($arr["status_code"])?$arr["status_code"]:null;
                        //判断返回json
                        if ($code == "200")
                        {
                            $result = $arr["data"];
                            $state = $result["verify_3d_real_name"];
                            //var_dump($result);
                            $ischarge = 0;
                            switch ($state)
                            {
                                case  "Y":
                                    $state = "1100";
                                    $result = array(
                                        "result"=>"一致",
                                        "state"=>$state
                                    );
                                    $ischarge = 1;
                                    break;
                                case  "N":
                                case  "F":
                                    $state = "1101";
                                    $result = array(
                                        "result"=>"不一致",
                                        "state"=>$state
                                    );
                                    $ischarge = 1;
                                    break;
                                case  "X":
                                    $state = "1102";
                                    $result = array(
                                        "result"=>"库中无此号",
                                        "state"=>$state
                                    );
                                    $ischarge = 0;
                                    break;
                                default:
                                    $this->apiclass->response(500);
                                    return;
                            }
                            $code = "100";
                            $orderno = $this->apiclass->createorderno();
                            $this->apiclass->updatedb($validitycode["userproid"],$validitycode["userid"],$validitycode["proid"],$datajson,$state,$ischarge,$orderno,"zhongchengxingetunicom");
                            $this->apiclass->response($code,$result,$orderno);
                        }
                        elseif ($code == "101" || $code == "101001" || $code == "101002" || $code == "101003" || $code == "101005")
                        {
                            $state = "1103";
                            $result = array(
                                "result"=>"参数错误",
                                "state"=>$state
                            );
                            $ischarge = 0;
                            $code = "100";
                            $orderno = $this->apiclass->createorderno();
                            $this->apiclass->updatedb($validitycode["userproid"],$validitycode["userid"],$validitycode["proid"],$datajson,$state,$ischarge,$orderno,"zhongchengxingetunicom");
                            $this->apiclass->response($code,$result,$orderno);
                        }
                        elseif ($code == "102")
                        {
                            $state = "1104";
                            $result = array(
                                "result"=>"查询错误",
                                "state"=>$state
                            );
                            $ischarge = 0;
                            $code = "100";
                            $orderno = $this->apiclass->createorderno();
                            $this->apiclass->updatedb($validitycode["userproid"],$validitycode["userid"],$validitycode["proid"],$datajson,$state,$ischarge,$orderno,"zhongchengxingetunicom");
                            $this->apiclass->response($code,$result,$orderno);
                        }
                        else
                        {
                            $this->apiclass->response(500);
                        }
                        $this->benchmark->mark('function_end');
                        $time4 = $this->benchmark->elapsed_time('curl_end', 'function_end');
                        log_message('info',$time4);
                    }
                }
            }
            else
            {
                $this->apiclass->response($code);
            }
        }
        catch (Exception $e)
        {
            log_message('error',$e->getMessage());
            $this->apiclass->response(500);
        }
    }

    public function businessthree(){
        try{
            //判断用户接口权限
            $validitycode = $this->apiclass->validate();
            $code = is_numeric($validitycode)?$validitycode:1;
            if($code == 1)
            {
                $datajson = file_get_contents('php://input');
                log_message('info',$datajson."---time:".date("Y-m-d H:i:s"));
                $datajson = $this->apiclass->decrypt($datajson);
                log_message('info',$datajson."---time:".date("Y-m-d H:i:s"));
                $data = json_decode($datajson,true);
                $name = !empty($data["name"])?$data["name"]:null;
                $companyname = !empty($data["companyname"])?$data["companyname"]:null;
                $usccode = !empty($data["usccode"])?$data["usccode"]:null;

                //判断参数
                if($name == null || $companyname == null || $usccode == null)
                {
                    $code = 110;
                    $this->apiclass->response($code);
                }
                else
                {
                    $data = array(
                        "company_name"=>$companyname,
                        "legal_person_name"=>$name,
                        "usc_code"=>$usccode
                    );

                    $this->load->library('zhongsheng');
                    $out = $this->zhongsheng->getdata("gongshangthree",$data);
                    //判断返回值
                    if($out == "500")
                    {
                        $this->apiclass->response($out);
                    }
                    else
                    {
                        $arr = json_decode($out,true);

                        $resultinfo = !empty($arr["resultInfo"])?$arr["resultInfo"]:null;

                        //$code = !empty($arr["code"])?$arr["code"]:null;
                        //var_dump($arr);
                        //判断返回json
                        if ($resultinfo)
                        {

                            $resultinfoarr =  json_decode($resultinfo,true);

                            switch ($resultinfoarr["statcode"])
                            {
                                case  "1600":
                                    $state = "1100";
                                    $result = array(
                                        "result"=>"一致",
                                        "state"=>$state
                                    );
                                    $ischarge = 1;
                                    break;
                                case  "1602":
                                    $state = "1101";
                                    $result = array(
                                        "result"=>"不一致",
                                        "state"=>$state
                                    );
                                    $ischarge = 1;
                                    break;
                                case  "1690":
                                    $state = "1102";
                                    $result = array(
                                        "result"=>"查询错误",
                                        "state"=>$state
                                    );
                                    $ischarge = 0;
                                    break;
                                case  "2203":
                                    $code = 110;
                                    $this->apiclass->response($code);
                                    break;
                                default:
                                    $this->apiclass->response(500);
                                    return;
                            }
                            $code = "100";
                            $orderno = $this->apiclass->createorderno();
                            $this->apiclass->updatedb($validitycode["userproid"],$validitycode["userid"],$validitycode["proid"],$datajson,$state,$ischarge,$orderno,"zhongshengbankthree");
                            $this->apiclass->response($code,$result,$orderno);
                        }
                        else
                        {
                            $this->apiclass->response(500);
                        }
                    }
                }
            }
            else
            {
                $this->apiclass->response($code);
            }
        }
        catch (Exception $e)
        {
            log_message('error',$e->getMessage());
            $this->apiclass->response(500);
        }
    }

    public function companybasic(){
        try{
            //判断用户接口权限
            $validitycode = $this->apiclass->validate();
            $code = is_numeric($validitycode)?$validitycode:1;
            if($code == 1)
            {
                $datajson = file_get_contents('php://input');
                log_message('info',$datajson."---time:".date("Y-m-d H:i:s"));
                $datajson = $this->apiclass->decrypt($datajson);
                log_message('info',$datajson."---time:".date("Y-m-d H:i:s"));
                $data = json_decode($datajson,true);
                $companyname = !empty($data["companyname"])?$data["companyname"]:null;


                //判断参数
                if($companyname == null)
                {
                    $code = 110;
                    $this->apiclass->response($code);
                }
                else
                {
                    $data = array(
                        "key"=>$companyname,
                    );

                    $this->load->library('zhongsheng');
                    $out = $this->zhongsheng->getdata("companybasic",$data);
                    //判断返回值
                    if($out == "500")
                    {
                        $this->apiclass->response($out);
                    }
                    else
                    {
                        $arr = json_decode($out,true);

                        $resultinfo = !empty($arr["resultInfo"])?$arr["resultInfo"]:null;

                        //$code = !empty($arr["code"])?$arr["code"]:null;
                        //var_dump($arr);
                        //判断返回json
                        if ($resultinfo)
                        {
                            $resultinfoarr =  json_decode($resultinfo,true);

                            switch ($resultinfoarr["statcode"])
                            {
                                case  "1600":
                                    $state = "1100";
                                    $result = array(
                                        "result"=>json_decode($resultinfoarr["state"],true),
                                        "state"=>$state
                                    );
                                    $ischarge = 1;
                                    break;
                                case  "1601":
                                    $state = "1101";
                                    $result = array(
                                        "result"=>"查无数据",
                                        "state"=>$state
                                    );
                                    $ischarge = 0;
                                    break;
                                default:
                                    $this->apiclass->response(500);
                                    return;
                            }
                            $code = "100";
                            $orderno = $this->apiclass->createorderno();
                            $this->apiclass->updatedb($validitycode["userproid"],$validitycode["userid"],$validitycode["proid"],$datajson,$state,$ischarge,$orderno,"zhongshengcompanybasic");
                            $this->apiclass->response($code,$result,$orderno);
                        }
                        else
                        {
                            $this->apiclass->response(500);
                        }
                    }
                }
            }
            else
            {
                $this->apiclass->response($code);
            }
        }
        catch (Exception $e)
        {
            log_message('error',$e->getMessage());
            $this->apiclass->response(500);
        }
    }

    public function businessfour(){
        try{
            //判断用户接口权限
            $validitycode = $this->apiclass->validate();
            $code = is_numeric($validitycode)?$validitycode:1;
            if($code == 1)
            {
                $datajson = file_get_contents('php://input');
                log_message('info',$datajson."---time:".date("Y-m-d H:i:s"));
                $datajson = $this->apiclass->decrypt($datajson);
                log_message('info',$datajson."---time:".date("Y-m-d H:i:s"));
                $data = json_decode($datajson,true);
                $name = !empty($data["name"])?$data["name"]:null;
                $idNo = !empty($data["idCard"])?$data["idCard"]:null;
                $companyname = !empty($data["companyName"])?$data["companyName"]:null;
                $usccode = !empty($data["regNo"])?$data["regNo"]:null;

                //判断参数
                if($name == null || $idNo == null || $companyname == null || $usccode == null)
                {
                    $code = 110;
                    $this->apiclass->response($code);
                }
                else
                {
                    $data = array(
                        "companyName"=>$companyname,
                        "name"=>$name,
                        "regNo"=>$usccode,
                        "idCard"=>$idNo
                    );

                    $this->load->library('zhongsheng');
                    $out = $this->zhongsheng->getdata("gongshangfour",$data);
                    //判断返回值
                    if($out == "500")
                    {
                        $this->apiclass->response($out);
                    }
                    else
                    {
                        $arr = json_decode($out,true);

                        $resultinfo = !empty($arr["resultInfo"])?$arr["resultInfo"]:null;

                        //$code = !empty($arr["code"])?$arr["code"]:null;
                        //var_dump($arr);
                        //判断返回json
                        if ($resultinfo)
                        {

                            $resultinfoarr =  json_decode($resultinfo,true);

                            switch ($resultinfoarr["statcode"])
                            {
                                case  "1600":
                                    $state = "1100";
                                    $result = array(
                                        "result"=>json_decode($resultinfoarr["state"],true),
                                        "state"=>$state
                                    );
                                    $ischarge = 1;
                                    break;
                                case  "1601":
                                    $state = "1101";
                                    $result = array(
                                        "result"=>"查无数据",
                                        "state"=>$state
                                    );
                                    $ischarge = 0;
                                    break;
                                case  "1910":
                                    $state = "1102";
                                    $result = array(
                                        "result"=>"无效的公司名称或注册号",
                                        "state"=>$state
                                    );
                                    $ischarge = 0;
                                    break;
                                case  "2202":
                                case  "2203":
                                    $code = 110;
                                    $this->apiclass->response($code);
                                    break;
                                default:
                                    $this->apiclass->response(500);
                                    return;
                            }
                            $code = "100";
                            $orderno = $this->apiclass->createorderno();
                            $this->apiclass->updatedb($validitycode["userproid"],$validitycode["userid"],$validitycode["proid"],$datajson,$state,$ischarge,$orderno,"zhongshengbankfour");
                            $this->apiclass->response($code,$result,$orderno);
                        }
                        else
                        {
                            $this->apiclass->response(500);
                        }
                    }
                }
            }
            else
            {
                $this->apiclass->response($code);
            }
        }
        catch (Exception $e)
        {
            log_message('error',$e->getMessage());
            $this->apiclass->response(500);
        }
    }

    public function vincheck(){
        try{
            //判断用户接口权限
            $validitycode = $this->apiclass->validate();
            $code = is_numeric($validitycode)?$validitycode:1;
            if($code == 1)
            {
                $datajson = file_get_contents('php://input');
                log_message('info',$datajson."---time:".date("Y-m-d H:i:s"));
                $datajson = $this->apiclass->decrypt($datajson);
                log_message('info',$datajson."---time:".date("Y-m-d H:i:s"));
                $data = json_decode($datajson,true);
                $vin = !empty($data["vin"])?$data["vin"]:null;


                //判断参数
                if($vin == null)
                {
                    $code = 110;
                    $this->apiclass->response($code);
                }
                else
                {
                    $data = array(
                        "vin"=>$vin,
                    );

                    $this->load->library('zhongsheng');
                    $out = $this->zhongsheng->getdata("vin",$data);
                    //判断返回值
                    if($out == "500")
                    {
                        $this->apiclass->response($out);
                    }
                    else
                    {
                        $arr = json_decode($out,true);

                        $resultinfo = !empty($arr["resultInfo"])?$arr["resultInfo"]:null;

                        //$code = !empty($arr["code"])?$arr["code"]:null;
                        //var_dump($arr);
                        //判断返回json
                        if ($resultinfo)
                        {

                            $resultinfoarr =  json_decode($resultinfo,true);

                            switch ($resultinfoarr["statcode"])
                            {
                                case  "1800":
                                    $state = "1100";
                                    $result = array(
                                        "result"=>json_decode($resultinfoarr["state"],true),
                                        "state"=>$state
                                    );
                                    $ischarge = 1;
                                    break;
                                case  "1801":
                                    $state = "1101";
                                    $result = array(
                                        "result"=>"VIN码错误",
                                        "state"=>$state
                                    );
                                    $ischarge = 1;
                                    break;
                                case  "1890":
                                    $state = "1102";
                                    $result = array(
                                        "result"=>"查询错误",
                                        "state"=>$state
                                    );
                                    $ischarge = 0;
                                    break;
                                case  "2018":
                                    $code = 110;
                                    $this->apiclass->response($code);
                                    break;
                                default:
                                    $this->apiclass->response(500);
                                    return;
                            }
                            $code = "100";
                            $orderno = $this->apiclass->createorderno();
                            $this->apiclass->updatedb($validitycode["userproid"],$validitycode["userid"],$validitycode["proid"],$datajson,$state,$ischarge,$orderno,"zhongshengvin");
                            $this->apiclass->response($code,$result,$orderno);
                        }
                        else
                        {
                            $this->apiclass->response(500);
                        }
                    }
                }
            }
            else
            {
                $this->apiclass->response($code);
            }
        }
        catch (Exception $e)
        {
            log_message('error',$e->getMessage());
            $this->apiclass->response(500);
        }
    }

    public function houseprice(){
        try{
            //判断用户接口权限
            $validitycode = $this->apiclass->validate();
            $code = is_numeric($validitycode)?$validitycode:1;
            if($code == 1)
            {
                $datajson = file_get_contents('php://input');
                log_message('info',$datajson."---time:".date("Y-m-d H:i:s"));
                $datajson = $this->apiclass->decrypt($datajson);
                log_message('info',$datajson."---time:".date("Y-m-d H:i:s"));
                $data = json_decode($datajson,true);
                $city = !empty($data["city"])?$data["city"]:null;
                $address = !empty($data["address"])?$data["address"]:null;
                $square = !empty($data["square"])?$data["square"]:null;


                //判断参数
                if($city == null || $address == null)
                {
                    $code = 110;
                    $this->apiclass->response($code);
                }
                else
                {
                    if ($square != null && $square != "" && is_numeric($square)){
                        $data = array(
                            "city"=>$city,
                            "address"=>$address,
                            "square"=>$square
                        );
                    }
                    else{
                        $data = array(
                            "city"=>$city,
                            "address"=>$address
                        );
                    }
                    $this->load->library('zhongsheng');
                    $out = $this->zhongsheng->getdata("fangjia",$data);
                    //判断返回值
                    if($out == "500")
                    {
                        $this->apiclass->response($out);
                    }
                    else
                    {
                        $arr = json_decode($out,true);

                        $resultinfo = !empty($arr["resultInfo"])?$arr["resultInfo"]:null;

                        //$code = !empty($arr["code"])?$arr["code"]:null;
                        //var_dump($arr);
                        //判断返回json
                        if ($resultinfo)
                        {

                            $resultinfoarr =  json_decode($resultinfo,true);

                            switch ($resultinfoarr["statcode"])
                            {
                                case  "1600":
                                    $state = "1100";
                                    $result = array(
                                        "result"=>json_decode($resultinfoarr["state"],true),
                                        "state"=>$state
                                    );
                                    $ischarge = 1;
                                    break;
                                case  "1690":
                                    $state = "1101";
                                    $result = array(
                                        "result"=>"查询错误",
                                        "state"=>$state
                                    );
                                    $ischarge = 0;
                                    break;
                                case  "2018":
                                    $code = 110;
                                    $this->apiclass->response($code);
                                    break;
                                default:
                                    $this->apiclass->response(500);
                                    return;
                            }
                            $code = "100";
                            $orderno = $this->apiclass->createorderno();
                            $this->apiclass->updatedb($validitycode["userproid"],$validitycode["userid"],$validitycode["proid"],$datajson,$state,$ischarge,$orderno,"zhongshenghouseprice");
                            $this->apiclass->response($code,$result,$orderno);
                        }
                        else
                        {
                            $this->apiclass->response(500);
                        }
                    }
                }
            }
            else
            {
                $this->apiclass->response($code);
            }
        }
        catch (Exception $e)
        {
            log_message('error',$e->getMessage());
            $this->apiclass->response(500);
        }
    }

    public function invoices(){
        try{
            //判断用户接口权限
            $validitycode = $this->apiclass->validate();
            $code = is_numeric($validitycode)?$validitycode:1;
            if($code == 1)
            {
                $datajson = file_get_contents('php://input');
                log_message('info',$datajson."---time:".date("Y-m-d H:i:s"));
                $datajson = $this->apiclass->decrypt($datajson);
                log_message('info',$datajson."---time:".date("Y-m-d H:i:s"));
                $data = json_decode($datajson,true);
                $fplx = !empty($data["fplx"])?$data["fplx"]:null;
                $fphm = !empty($data["fphm"])?$data["fphm"]:null;
                $fpdm = !empty($data["fpdm"])?$data["fpdm"]:null;
                $jym = !empty($data["jym"])?$data["jym"]:null;
                $fpje = !empty($data["fpje"])?$data["fpje"]:null;
                $kprq = !empty($data["kprq"])?$data["kprq"]:null;


                //判断参数
                if($fplx == null || $fphm == null  || $fpdm == null)
                {
                    $code = 110;
                    $this->apiclass->response($code);
                }
                else
                {

                    $data = array(
                        "fplx"=>$fplx,
                        "fphm"=>$fphm,
                        "fpdm"=>$fpdm,
                        "jym"=>$jym,
                        "fpje"=>$fpje,
                        "kprq"=>$kprq
                    );

                    $this->load->library('zhongsheng');
                    $out = $this->zhongsheng->getdata("fapiao",$data);
                    //判断返回值
                    if($out == "500")
                    {
                        $this->apiclass->response($out);
                    }
                    else
                    {
                        $arr = json_decode($out,true);

                        $resultinfo = !empty($arr["resultInfo"])?$arr["resultInfo"]:null;

                        //$code = !empty($arr["code"])?$arr["code"]:null;
                        //var_dump($arr);
                        //判断返回json
                        if ($resultinfo)
                        {

                            $resultinfoarr =  json_decode($resultinfo,true);

                            switch ($resultinfoarr["statcode"])
                            {
                                case  "1600":
                                    $state = "1100";
                                    $result = array(
                                        "result"=>json_decode($resultinfoarr["state"],true),
                                        "state"=>$state
                                    );
                                    $ischarge = 1;
                                    break;
                                case  "1601":
                                    $state = "1101";
                                    $result = array(
                                        "result"=>"查无数据",
                                        "state"=>$state
                                    );
                                    $ischarge = 0;
                                    break;
                                case  "998":
                                    $code = 110;
                                    $this->apiclass->response($code);
                                    break;
                                default:
                                    $this->apiclass->response(500);
                                    return;
                            }
                            $code = "100";
                            $orderno = $this->apiclass->createorderno();
                            $this->apiclass->updatedb($validitycode["userproid"],$validitycode["userid"],$validitycode["proid"],$datajson,$state,$ischarge,$orderno,"zhongshenginvoices");
                            $this->apiclass->response($code,$result,$orderno);
                        }
                        else
                        {
                            $this->apiclass->response(500);
                        }
                    }
                }
            }
            else
            {
                $this->apiclass->response($code);
            }
        }
        catch (Exception $e)
        {
            log_message('error',$e->getMessage());
            $this->apiclass->response(500);
        }
    }

    public function sxperson(){
        try{
            //判断用户接口权限
            $validitycode = $this->apiclass->validate();
            $code = is_numeric($validitycode)?$validitycode:1;
            if($code == 1)
            {
                $datajson = file_get_contents('php://input');
                log_message('info',$datajson."---time:".date("Y-m-d H:i:s"));
                $datajson = $this->apiclass->decrypt($datajson);
                log_message('info',$datajson."---time:".date("Y-m-d H:i:s"));
                $data = json_decode($datajson,true);
                $idNo = !empty($data["idNo"])?$data["idNo"]:null;


                //判断参数
                if($idNo == null)
                {
                    $code = 110;
                    $this->apiclass->response($code);
                }
                else
                {

                    $data = array(
                        "idCard"=>$idNo,
                    );

                    $this->load->library('zhongsheng');
                    $out = $this->zhongsheng->getdata("sxperson",$data);
                    //判断返回值
                    if($out == "500")
                    {
                        $this->apiclass->response($out);
                    }
                    else
                    {
                        $arr = json_decode($out,true);

                        $resultinfo = !empty($arr["resultInfo"])?$arr["resultInfo"]:null;

                        //$code = !empty($arr["code"])?$arr["code"]:null;
                        //var_dump($arr);
                        //判断返回json
                        if ($resultinfo)
                        {

                            $resultinfoarr =  json_decode($resultinfo,true);

                            switch ($resultinfoarr["statcode"])
                            {
                                case  "1800":
                                    $state = "1100";
                                    $result = array(
                                        "result"=>json_decode($resultinfoarr["state"],true),
                                        "state"=>$state
                                    );
                                    $ischarge = 1;
                                    break;
                                case  "1801":
                                    $state = "1101";
                                    $result = array(
                                        "result"=>"查无数据",
                                        "state"=>$state
                                    );
                                    $ischarge = 0;
                                    break;
                                case  "2203":
                                case  "2018":
                                    $code = 110;
                                    $this->apiclass->response($code);
                                    break;
                                default:
                                    $this->apiclass->response(500);
                                    return;
                            }
                            $code = "100";
                            $orderno = $this->apiclass->createorderno();
                            $this->apiclass->updatedb($validitycode["userproid"],$validitycode["userid"],$validitycode["proid"],$datajson,$state,$ischarge,$orderno,"zhongshengsxperson");
                            $this->apiclass->response($code,$result,$orderno);
                        }
                        else
                        {
                            $this->apiclass->response(500);
                        }
                    }
                }
            }
            else
            {
                $this->apiclass->response($code);
            }
        }
        catch (Exception $e)
        {
            log_message('error',$e->getMessage());
            $this->apiclass->response(500);
        }
    }

    public function sxcompany(){
        try{
            //判断用户接口权限
            $validitycode = $this->apiclass->validate();
            $code = is_numeric($validitycode)?$validitycode:1;
            if($code == 1)
            {
                $datajson = file_get_contents('php://input');
                log_message('info',$datajson."---time:".date("Y-m-d H:i:s"));
                $datajson = $this->apiclass->decrypt($datajson);
                log_message('info',$datajson."---time:".date("Y-m-d H:i:s"));
                $data = json_decode($datajson,true);
                $key = !empty($data["key"])?$data["key"]:null;
                $keyType = !empty($data["keytype"])?$data["keytype"]:null;



                //判断参数
                if($key == null || $keyType == null)
                {
                    $code = 110;
                    $this->apiclass->response($code);
                }
                else
                {
                    $data = array(
                        "key"=>$key,
                        "keyType"=>$keyType
                    );
                    $this->load->library('zhongsheng');
                    $out = $this->zhongsheng->getdata("sxcompany",$data);
                    //判断返回值
                    if($out == "500")
                    {
                        $this->apiclass->response($out);
                    }
                    else
                    {
                        $arr = json_decode($out,true);

                        $resultinfo = !empty($arr["resultInfo"])?$arr["resultInfo"]:null;

                        //$code = !empty($arr["code"])?$arr["code"]:null;
                        //var_dump($arr);
                        //判断返回json
                        if ($resultinfo)
                        {

                            $resultinfoarr =  json_decode($resultinfo,true);

                            switch ($resultinfoarr["statcode"])
                            {
                                case  "1800":
                                    $state = "1100";
                                    $result = array(
                                        "result"=>json_decode($resultinfoarr["state"],true),
                                        "state"=>$state
                                    );
                                    $ischarge = 1;
                                    break;
                                case  "1801":
                                    $state = "1101";
                                    $result = array(
                                        "result"=>"查无数据",
                                        "state"=>$state
                                    );
                                    $ischarge = 0;
                                    break;
                                case  "2202":
                                case  "2203":
                                case  "2018":
                                    $code = 110;
                                    $this->apiclass->response($code);
                                    break;
                                default:
                                    $this->apiclass->response(500);
                                    return;
                            }
                            $code = "100";
                            $orderno = $this->apiclass->createorderno();
                            $this->apiclass->updatedb($validitycode["userproid"],$validitycode["userid"],$validitycode["proid"],$datajson,$state,$ischarge,$orderno,"zhongshengsxcompany");
                            $this->apiclass->response($code,$result,$orderno);
                        }
                        else
                        {
                            $this->apiclass->response(500);
                        }
                    }
                }
            }
            else
            {
                $this->apiclass->response($code);
            }
        }
        catch (Exception $e)
        {
            log_message('error',$e->getMessage());
            $this->apiclass->response(500);
        }
    }

    public function ocridcard(){
        try{
            //判断用户接口权限
            $validitycode = $this->apiclass->validate();
            $code = is_numeric($validitycode)?$validitycode:1;
            if($code == 1)
            {
                $datajson = file_get_contents('php://input');
                log_message('info',$datajson."---time:".date("Y-m-d H:i:s"));
                $datajson = $this->apiclass->decrypt($datajson);
                log_message('info',$datajson."---time:".date("Y-m-d H:i:s"));
                $data = json_decode($datajson,true);
                $photo = !empty($data["photo"])?$data["photo"]:null;
                $imgType = !empty($data["imgtype"])?$data["imgtype"]:null;
                $side = !empty($data["side"])?$data["side"]:null;

                //判断参数
                if($photo == null || $imgType == null || $side == null)
                {
                    $code = 110;
                    $this->apiclass->response($code);
                }
                else
                {
                    $data = array(
                        "imgB64A"=>$photo,
                        "imgType"=>$imgType,
                        "idCardSide"=>$side,
                    );
                    $this->load->library('zhongsheng');
                    $out = $this->zhongsheng->getdata("ocridcard",$data);
                    //判断返回值
                    if($out == "500")
                    {
                        $this->apiclass->response($out);
                    }
                    else
                    {
                        $arr = json_decode($out,true);

                        $resultinfo = !empty($arr["resultInfo"])?$arr["resultInfo"]:null;

                        //$code = !empty($arr["code"])?$arr["code"]:null;
                        //var_dump($arr);
                        //判断返回json
                        if ($resultinfo)
                        {

                            $resultinfoarr =  json_decode($resultinfo,true);

                            switch ($resultinfoarr["statcode"])
                            {
                                case  "1700":
                                    $state = "1100";
                                    $result = array(
                                        "result"=>json_decode($resultinfoarr["state"],true),
                                        "state"=>$state
                                    );
                                    $ischarge = 1;
                                    break;
                                case  "1790":
                                    $state = "1101";
                                    $result = array(
                                        "result"=>"识别错误",
                                        "state"=>$state
                                    );
                                    $ischarge = 0;
                                    break;
                                case  "1903":
                                case  "1904":
                                case  "1905":
                                case  "1910":
                                case  "2018":
                                    $code = 110;
                                    $this->apiclass->response($code);
                                    break;
                                default:
                                    $this->apiclass->response(500);
                                    return;
                            }
                            $code = "100";
                            $orderno = $this->apiclass->createorderno();
                            $this->apiclass->updatedb($validitycode["userproid"],$validitycode["userid"],$validitycode["proid"],$datajson,$state,$ischarge,$orderno,"zhongshengocridcard");
                            $this->apiclass->response($code,$result,$orderno);
                        }
                        else
                        {
                            $this->apiclass->response(500);
                        }
                    }
                }
            }
            else
            {
                $this->apiclass->response($code);
            }
        }
        catch (Exception $e)
        {
            log_message('error',$e->getMessage());
            $this->apiclass->response(500);
        }
    }

    public function ocrbank(){
        try{
            //判断用户接口权限
            $validitycode = $this->apiclass->validate();
            $code = is_numeric($validitycode)?$validitycode:1;
            if($code == 1)
            {
                $datajson = file_get_contents('php://input');
                log_message('info',$datajson."---time:".date("Y-m-d H:i:s"));
                $datajson = $this->apiclass->decrypt($datajson);
                log_message('info',$datajson."---time:".date("Y-m-d H:i:s"));
                $data = json_decode($datajson,true);
                $photo = !empty($data["photo"])?$data["photo"]:null;
                $imgType = !empty($data["imgtype"])?$data["imgtype"]:null;

                //判断参数
                if($photo == null || $imgType == null)
                {
                    $code = 110;
                    $this->apiclass->response($code);
                }
                else
                {
                    $data = array(
                        "imgB64"=>$photo,
                        "imgType"=>$imgType
                    );
                    $this->load->library('zhongsheng');
                    $out = $this->zhongsheng->getdata("ocrbank",$data);
                    //判断返回值
                    if($out == "500")
                    {
                        $this->apiclass->response($out);
                    }
                    else
                    {
                        $arr = json_decode($out,true);

                        $resultinfo = !empty($arr["resultInfo"])?$arr["resultInfo"]:null;

                        //$code = !empty($arr["code"])?$arr["code"]:null;
                        //var_dump($arr);
                        //判断返回json
                        if ($resultinfo)
                        {

                            $resultinfoarr =  json_decode($resultinfo,true);

                            switch ($resultinfoarr["statcode"])
                            {
                                case  "1600":
                                    $state = "1100";
                                    $result = array(
                                        "result"=>json_decode($resultinfoarr["state"],true),
                                        "state"=>$state
                                    );
                                    $ischarge = 1;
                                    break;
                                case  "1690":
                                    $state = "1101";
                                    $result = array(
                                        "result"=>"识别错误",
                                        "state"=>$state
                                    );
                                    $ischarge = 0;
                                    break;
                                case  "1903":
                                case  "1904":
                                case  "1905":
                                case  "1910":
                                case  "2018":
                                    $code = 110;
                                    $this->apiclass->response($code);
                                    break;
                                default:
                                    $this->apiclass->response(500);
                                    return;
                            }
                            $code = "100";
                            $orderno = $this->apiclass->createorderno();
                            $this->apiclass->updatedb($validitycode["userproid"],$validitycode["userid"],$validitycode["proid"],$datajson,$state,$ischarge,$orderno,"zhongshengocrbank");
                            $this->apiclass->response($code,$result,$orderno);
                        }
                        else
                        {
                            $this->apiclass->response(500);
                        }
                    }
                }
            }
            else
            {
                $this->apiclass->response($code);
            }
        }
        catch (Exception $e)
        {
            log_message('error',$e->getMessage());
            $this->apiclass->response(500);
        }
    }

    public function ocrvehicle(){
        try{
            //判断用户接口权限
            $validitycode = $this->apiclass->validate();
            $code = is_numeric($validitycode)?$validitycode:1;
            if($code == 1)
            {
                $datajson = file_get_contents('php://input');
                log_message('info',$datajson."---time:".date("Y-m-d H:i:s"));
                $datajson = $this->apiclass->decrypt($datajson);
                log_message('info',$datajson."---time:".date("Y-m-d H:i:s"));
                $data = json_decode($datajson,true);
                $photo = !empty($data["photo"])?$data["photo"]:null;

                //判断参数
                if($photo == null)
                {
                    $code = 110;
                    $this->apiclass->response($code);
                }
                else
                {
                    $data = array(
                        "imgB64A"=>$photo
                    );
                    $this->load->library('zhongsheng');
                    $out = $this->zhongsheng->getdata("ocrvehicle",$data);
                    //判断返回值
                    if($out == "500")
                    {
                        $this->apiclass->response($out);
                    }
                    else
                    {
                        $arr = json_decode($out,true);

                        $resultinfo = !empty($arr["resultInfo"])?$arr["resultInfo"]:null;

                        //$code = !empty($arr["code"])?$arr["code"]:null;
                        //var_dump($arr);
                        //判断返回json
                        if ($resultinfo)
                        {

                            $resultinfoarr =  json_decode($resultinfo,true);

                            switch ($resultinfoarr["statcode"])
                            {
                                case  "1600":
                                    $state = "1100";
                                    $result = array(
                                        "result"=>json_decode($resultinfoarr["state"],true),
                                        "state"=>$state
                                    );
                                    $ischarge = 1;
                                    break;
                                case  "1690":
                                    $state = "1101";
                                    $result = array(
                                        "result"=>"识别错误",
                                        "state"=>$state
                                    );
                                    $ischarge = 0;
                                    break;
                                case  "1903":
                                case  "1904":
                                case  "1905":
                                case  "1910":
                                case  "2018":
                                    $code = 110;
                                    $this->apiclass->response($code);
                                    break;
                                default:
                                    $this->apiclass->response(500);
                                    return;
                            }
                            $code = "100";
                            $orderno = $this->apiclass->createorderno();
                            $this->apiclass->updatedb($validitycode["userproid"],$validitycode["userid"],$validitycode["proid"],$datajson,$state,$ischarge,$orderno,"zhongshengocrvehicle");
                            $this->apiclass->response($code,$result,$orderno);
                        }
                        else
                        {
                            $this->apiclass->response(500);
                        }
                    }
                }
            }
            else
            {
                $this->apiclass->response($code);
            }
        }
        catch (Exception $e)
        {
            log_message('error',$e->getMessage());
            $this->apiclass->response(500);
        }
    }

    public function ocrbusiness(){
        try{
            //判断用户接口权限
            $validitycode = $this->apiclass->validate();
            $code = is_numeric($validitycode)?$validitycode:1;
            if($code == 1)
            {
                $datajson = file_get_contents('php://input');
                log_message('info',$datajson."---time:".date("Y-m-d H:i:s"));
                $datajson = $this->apiclass->decrypt($datajson);
                log_message('info',$datajson."---time:".date("Y-m-d H:i:s"));
                $data = json_decode($datajson,true);
                $photo = !empty($data["photo"])?$data["photo"]:null;
                $imgType = !empty($data["imgtype"])?$data["imgtype"]:null;

                //判断参数
                if($photo == null || $imgType == null)
                {
                    $code = 110;
                    $this->apiclass->response($code);
                }
                else
                {
                    $data = array(
                        "imgString"=>$photo,
                        "filename"=>"somefile".$imgType
                    );
                    $this->load->library('zhongsheng');
                    $out = $this->zhongsheng->getdata("ocrbusiness",$data);
                    //判断返回值
                    if($out == "500")
                    {
                        $this->apiclass->response($out);
                    }
                    else
                    {
                        $arr = json_decode($out,true);

                        $resultinfo = !empty($arr["resultInfo"])?$arr["resultInfo"]:null;

                        //$code = !empty($arr["code"])?$arr["code"]:null;
                        //var_dump($arr);
                        //判断返回json
                        if ($resultinfo)
                        {

                            $resultinfoarr =  json_decode($resultinfo,true);

                            switch ($resultinfoarr["statcode"])
                            {
                                case  "1600":
                                    $state = "1100";
                                    $result = array(
                                        "result"=>json_decode($resultinfoarr["state"],true),
                                        "state"=>$state
                                    );
                                    $ischarge = 1;
                                    break;
                                case  "1690":
                                    $state = "1101";
                                    $result = array(
                                        "result"=>"识别错误",
                                        "state"=>$state
                                    );
                                    $ischarge = 0;
                                    break;
                                case  "1903":
                                case  "1904":
                                case  "1905":
                                case  "1910":
                                case  "2018":
                                    $code = 110;
                                    $this->apiclass->response($code);
                                    break;
                                default:
                                    $this->apiclass->response(500);
                                    return;
                            }
                            $code = "100";
                            $orderno = $this->apiclass->createorderno();
                            $this->apiclass->updatedb($validitycode["userproid"],$validitycode["userid"],$validitycode["proid"],$datajson,$state,$ischarge,$orderno,"zhongshengocrbusiness");
                            $this->apiclass->response($code,$result,$orderno);
                        }
                        else
                        {
                            $this->apiclass->response(500);
                        }
                    }
                }
            }
            else
            {
                $this->apiclass->response($code);
            }
        }
        catch (Exception $e)
        {
            log_message('error',$e->getMessage());
            $this->apiclass->response(500);
        }
    }

    public function telecomonlinebak()
    {
        try{
            //判断用户接口权限
            $validitycode = $this->apiclass->validate();
            $code = is_numeric($validitycode)?$validitycode:1;
            if($code == 1)
            {
                $datajson = file_get_contents('php://input');
                log_message('info',$datajson."---time:".date("Y-m-d H:i:s"));
                $datajson = $this->apiclass->decrypt($datajson);
                log_message('info',$datajson."---time:".date("Y-m-d H:i:s"));
                $data = json_decode($datajson,true);
                $phone = !empty($data["phone"])?$data["phone"]:null;
                //判断参数
                if($phone == null)
                {
                    $code = 110;
                    $this->apiclass->response($code);
                }
                else
                {
                    if (!$this->apiclass->isTelecom($phone)){
                        $state = "1101";
                        $result = array(
                            "result"=>"未查到",
                            "state"=>$state
                        );
                        $ischarge = 0;
                        $code = "100";
                        $orderno = $this->apiclass->createorderno();
                        $this->apiclass->updatedb($validitycode["userproid"],$validitycode["userid"],$validitycode["proid"],$datajson,$state,$ischarge,$orderno,"tanzhentelecomonline");
                        $this->apiclass->response($code,$result,$orderno);
                        return;
                    }
                    $this->benchmark->mark('curl_start');
                    $data = array(
                        "mobile"=>$phone
                    );
                    $this->load->library('tanzhen');
                    $out = $this->tanzhen->getdata("telecomonline",$data);

                    $this->benchmark->mark('curl_end');
                    $time1 = $this->benchmark->elapsed_time('curl_start', 'curl_end');
                    log_message('info',$time1);

                    //判断返回值
                    if($out == "500")
                    {
                        $this->apiclass->response($out);
                    }
                    else
                    {
                        $arr = json_decode($out,true);
                        $success = !empty($arr["success"])?$arr["success"]:null;

                        //判断返回json
                        if ($success == true)
                        {
                            $code = $arr["code"];
                            switch ($code)
                            {
                                case 0:
                                    $value= $arr["data"]["value"];
                                    switch ($value)
                                    {
                                        case "[0,3)":
                                            $state = "1100";
                                            $result = array(
                                                "result" => array(
                                                    "max"=>"0",
                                                    "min"=>"3"
                                                ),
                                                "state"=>$state
                                            );
                                            $ischarge = 1;
                                            break;
                                        case "[3,6)":
                                            $state = "1100";
                                            $result = array(
                                                "result" => array(
                                                    "max"=>"3",
                                                    "min"=>"6"
                                                ),
                                                "state"=>$state
                                            );
                                            $ischarge = 1;
                                            break;
                                        case "[6,12)":
                                            $state = "1100";
                                            $result = array(
                                                "result" => array(
                                                    "max"=>"6",
                                                    "min"=>"12"
                                                ),
                                                "state"=>$state
                                            );
                                            $ischarge = 1;
                                            break;
                                        case "[12,24)":
                                            $state = "1100";
                                            $result = array(
                                                "result" => array(
                                                    "max"=>"12",
                                                    "min"=>"24"
                                                ),
                                                "state"=>$state
                                            );
                                            $ischarge = 1;
                                            break;
                                        case "[24,-1)":
                                            $state = "1100";
                                            $result = array(
                                                "result" => array(
                                                    "max"=>"12",
                                                    "min"=>"24"
                                                ),
                                                "state"=>$state
                                            );
                                            $ischarge = 1;
                                            break;
                                        default:
                                            $state = "1100";
                                            $result = array(
                                                "result" => array(
                                                    "max"=>"12",
                                                    "min"=>"24"
                                                ),
                                                "state"=>$state
                                            );
                                            $ischarge = 1;
                                            break;
                                    }
                                    break;
                                case 3:
                                    $state = "1101";
                                    $result = array(
                                        "result"=>"未查到",
                                        "state"=>$state
                                    );
                                    $ischarge = 0;
                                    break;
                                case 4:
                                    $code = 110;
                                    $this->apiclass->response($code);
                                    return;
                                default:
                                    $this->apiclass->response(500);
                                    return;
                            }
                            $code = "100";
                            $orderno = $this->apiclass->createorderno();
                            $this->apiclass->updatedb($validitycode["userproid"],$validitycode["userid"],$validitycode["proid"],$datajson,$state,$ischarge,$orderno,"tanzhentelecomonline");
                            $this->apiclass->response($code,$result,$orderno);
                        }
                        else
                        {
                            $this->apiclass->response(500);
                        }
                    }
                }
            }
            else
            {
                $this->apiclass->response($code);
            }
        }
        catch (Exception $e)
        {
            log_message('error',$e->getMessage());
            $this->apiclass->response(500);
        }
    }

    public function unicomonline()
    {
        try{
            //判断用户接口权限
            $validitycode = $this->apiclass->validate();
            $code = is_numeric($validitycode)?$validitycode:1;
            if($code == 1)
            {
                $datajson = file_get_contents('php://input');
                log_message('info',$datajson."---time:".date("Y-m-d H:i:s"));
                $datajson = $this->apiclass->decrypt($datajson);
                log_message('info',$datajson."---time:".date("Y-m-d H:i:s"));
                $data = json_decode($datajson,true);
                $phone = !empty($data["phone"])?$data["phone"]:null;
                //判断参数
                if($phone == null)
                {
                    $code = 110;
                    $this->apiclass->response($code);
                }
                else
                {
                    if (!$this->apiclass->isUnicom($phone)){
                        $state = "1101";
                        $result = array(
                            "result"=>"未查到",
                            "state"=>$state
                        );
                        $ischarge = 0;
                        $code = "100";
                        $orderno = $this->apiclass->createorderno();
                        $this->apiclass->updatedb($validitycode["userproid"],$validitycode["userid"],$validitycode["proid"],$datajson,$state,$ischarge,$orderno,"tanzhenunionline");
                        $this->apiclass->response($code,$result,$orderno);
                        return;
                    }
                    $this->benchmark->mark('curl_start');
                    $data = array(
                        "mobile"=>$phone
                    );
                    $this->load->library('tanzhen');
                    $out = $this->tanzhen->getdata("unicomonline",$data);

                    $this->benchmark->mark('curl_end');
                    $time1 = $this->benchmark->elapsed_time('curl_start', 'curl_end');
                    log_message('info',$time1);

                    //判断返回值
                    if($out == "500")
                    {
                        $this->apiclass->response($out);
                    }
                    else
                    {
                        $arr = json_decode($out,true);
                        $success = !empty($arr["success"])?$arr["success"]:null;

                        //判断返回json
                        if ($success == true)
                        {
                            $code = $arr["code"];
                            switch ($code)
                            {
                                case 0:
                                    $value= $arr["data"]["value"];
                                    switch ($value)
                                    {
                                        case "[0,3)":
                                            $state = "1100";
                                            $result = array(
                                                "result" => array(
                                                    "max"=>"0",
                                                    "min"=>"3"
                                                ),
                                                "state"=>$state
                                            );
                                            $ischarge = 1;
                                            break;
                                        case "[3,6)":
                                            $state = "1100";
                                            $result = array(
                                                "result" => array(
                                                    "max"=>"3",
                                                    "min"=>"6"
                                                ),
                                                "state"=>$state
                                            );
                                            $ischarge = 1;
                                            break;
                                        case "[6,12)":
                                            $state = "1100";
                                            $result = array(
                                                "result" => array(
                                                    "max"=>"6",
                                                    "min"=>"12"
                                                ),
                                                "state"=>$state
                                            );
                                            $ischarge = 1;
                                            break;
                                        case "[12,24)":
                                            $state = "1100";
                                            $result = array(
                                                "result" => array(
                                                    "max"=>"12",
                                                    "min"=>"24"
                                                ),
                                                "state"=>$state
                                            );
                                            $ischarge = 1;
                                            break;
                                        case "[24,-1)":
                                            $state = "1100";
                                            $result = array(
                                                "result" => array(
                                                    "max"=>"24",
                                                    "min"=>"-1"
                                                ),
                                                "state"=>$state
                                            );
                                            $ischarge = 1;
                                            break;
                                        default:
                                            $state = "1100";
                                            $result = array(
                                                "result" => array(
                                                    "max"=>"24",
                                                    "min"=>"-1"
                                                ),
                                                "state"=>$state
                                            );
                                            $ischarge = 1;
                                            break;
                                    }
                                    break;
                                case 3:
                                    $state = "1101";
                                    $result = array(
                                        "result"=>"未查到",
                                        "state"=>$state
                                    );
                                    $ischarge = 0;
                                    break;
                                case 4:
                                    $code = 110;
                                    $this->apiclass->response($code);
                                    return;
                                default:
                                    $this->apiclass->response(500);
                                    return;
                            }
                            $code = "100";
                            $orderno = $this->apiclass->createorderno();
                            $this->apiclass->updatedb($validitycode["userproid"],$validitycode["userid"],$validitycode["proid"],$datajson,$state,$ischarge,$orderno,"tanzhenunionline");
                            $this->apiclass->response($code,$result,$orderno);
                        }
                        else
                        {
                            $this->apiclass->response(500);
                        }
                    }
                }
            }
            else
            {
                $this->apiclass->response($code);
            }
        }
        catch (Exception $e)
        {
            log_message('error',$e->getMessage());
            $this->apiclass->response(500);
        }
    }

    public function telecomstatus()
    {
        try{
            //判断用户接口权限
            $validitycode = $this->apiclass->validate();
            $code = is_numeric($validitycode)?$validitycode:1;
            if($code == 1)
            {
                $datajson = file_get_contents('php://input');
                log_message('info',$datajson."---time:".date("Y-m-d H:i:s"));
                $datajson = $this->apiclass->decrypt($datajson);
                log_message('info',$datajson."---time:".date("Y-m-d H:i:s"));
                $data = json_decode($datajson,true);
                $phone = !empty($data["phone"])?$data["phone"]:null;
                //判断参数
                if($phone == null)
                {
                    $code = 110;
                    $this->apiclass->response($code);
                }
                else
                {
                    if (!$this->apiclass->isTelecom($phone)){
                        $state = "1101";
                        $result = array(
                            "result"=>"未查到",
                            "state"=>$state
                        );
                        $ischarge = 0;
                        $code = "100";
                        $orderno = $this->apiclass->createorderno();
                        $this->apiclass->updatedb($validitycode["userproid"],$validitycode["userid"],$validitycode["proid"],$datajson,$state,$ischarge,$orderno,"tanzhenunionline");
                        $this->apiclass->response($code,$result,$orderno);
                        return;
                    }
                    $this->benchmark->mark('curl_start');
                    $data = array(
                        "mobile"=>$phone
                    );
                    $this->load->library('tanzhen');
                    $out = $this->tanzhen->getdata("status",$data);

                    $this->benchmark->mark('curl_end');
                    $time1 = $this->benchmark->elapsed_time('curl_start', 'curl_end');
                    log_message('info',$time1);


                    //判断返回值
                    if($out == "500")
                    {
                        $this->apiclass->response($out);
                    }
                    else
                    {
                        $arr = json_decode($out,true);
                        $success = !empty($arr["success"])?$arr["success"]:null;

                        //判断返回json
                        if ($success == true)
                        {
                            $code = $arr["code"];
                            switch ($code)
                            {
                                case 0:
                                    $value= $arr["data"]["value"];
                                    switch ($value)
                                    {
                                        case "1":
                                            $state = "1100";
                                            $result = array(
                                                "result" => "正常",
                                                "state"=>$state
                                            );
                                            $ischarge = 1;
                                            break;
                                        case "2":
                                            $state = "1100";
                                            $result = array(
                                                "result" => "单停/停机/预销号",
                                                "state"=>$state
                                            );
                                            $ischarge = 1;
                                            break;
                                        case "3":
                                            $state = "1100";
                                            $result = array(
                                                "result" => "在网不可用/未激活",
                                                "state"=>$state
                                            );
                                            $ischarge = 1;
                                            break;
                                        case "4":
                                            $state = "1100";
                                            $result = array(
                                                "result" => "销号/未启用/不在网",
                                                "state"=>$state
                                            );
                                            $ischarge = 1;
                                            break;
                                        default:
                                            $this->apiclass->response(500);
                                            break;
                                    }
                                    break;
                                case 3:
                                    $state = "1101";
                                    $result = array(
                                        "result"=>"未查到",
                                        "state"=>$state
                                    );
                                    $ischarge = 0;
                                    break;
                                case 4:
                                    $code = 110;
                                    $this->apiclass->response($code);
                                    return;
                                default:
                                    $this->apiclass->response(500);
                                    return;
                            }
                            $code = "100";
                            $orderno = $this->apiclass->createorderno();
                            $this->apiclass->updatedb($validitycode["userproid"],$validitycode["userid"],$validitycode["proid"],$datajson,$state,$ischarge,$orderno,"tanzhetelecomstatus");
                            $this->apiclass->response($code,$result,$orderno);
                        }
                        else
                        {
                            $this->apiclass->response(500);
                        }
                    }
                }
            }
            else
            {
                $this->apiclass->response($code);
            }
        }
        catch (Exception $e)
        {
            log_message('error',$e->getMessage());
            $this->apiclass->response(500);
        }
    }

    public function telecomtmpclose()
    {
        try{
            //判断用户接口权限
            $this->benchmark->mark('function_start');
            $time1 = $this->benchmark->elapsed_time('total_execution_time_start', 'function_start');
            log_message('info',$time1);
            $validitycode = $this->apiclass->validate();
            $code = is_numeric($validitycode)?$validitycode:1;
            if($code == 1)
            {
                $datajson = file_get_contents('php://input');
                log_message('info',$datajson."---time:".date("Y-m-d H:i:s"));
                $datajson = $this->apiclass->decrypt($datajson);
                log_message('info',$datajson."---time:".date("Y-m-d H:i:s"));
                $data = json_decode($datajson,true);
                $name = !empty($data["name"])?$data["name"]:null;
                $idNo = !empty($data["idNo"])?$data["idNo"]:null;
                $phone = !empty($data["phone"])?$data["phone"]:null;
                //判断参数
                if($name == null || $idNo == null || $phone == null)
                {
                    $code = 110;
                    $this->apiclass->response($code);
                }
                else
                {
                    if (!$this->apiclass->isTelecom($phone)){
                        $state = "1103";
                        $result = array(
                            "result"=>"参数错误",
                            "state"=>$state
                        );
                        $ischarge = 0;
                        $code = "100";
                        $orderno = $this->apiclass->createorderno();
                        $this->apiclass->updatedb($validitycode["userproid"],$validitycode["userid"],$validitycode["proid"],$datajson,$state,$ischarge,$orderno,"tanzhentelecom");
                        $this->apiclass->response($code,$result,$orderno);
                        return;
                    }
                    $this->benchmark->mark('curl_start');
                    $time2 = $this->benchmark->elapsed_time('function_start', 'curl_start');
                    log_message('info',$time2);
                    $data = array(
                        "id"=>$idNo,
                        "name"=>$name,
                        "mobile"=>$phone
                    );

                    $this->load->library('tanzhen');
                    $out = $this->tanzhen->getdata("three",$data);

                    $this->benchmark->mark('curl_end');
                    $time3 = $this->benchmark->elapsed_time('curl_start', 'curl_end');
                    log_message('info',$time3);
                    //判断返回值
                    if($out == "500")
                    {
                        $this->apiclass->response($out);
                    }
                    else
                    {
                        $arr = json_decode($out,true);
                        $success = !empty($arr["success"])?$arr["success"]:null;

                        //判断返回json
                        if ($success == true)
                        {
                            $code = $arr["code"];
                            switch ($code)
                            {
                                case 0:
                                    $value= $arr["data"]["value"];
                                    switch ($value)
                                    {
                                        case "0":
                                            $state = "1100";
                                            $result = array(
                                                "result" => "一致",
                                                "state"=>$state
                                            );
                                            $ischarge = 1;
                                            break;
                                        case "1":
                                            $state = "1101";
                                            $result = array(
                                                "result" => "不一致",
                                                "state"=>$state
                                            );
                                            $ischarge = 1;
                                            break;
                                        default:
                                            $this->apiclass->response(500);
                                            break;
                                    }
                                    break;
                                case 3:
                                    $state = "1102";
                                    $result = array(
                                        "result"=>"库中无此号",
                                        "state"=>$state
                                    );
                                    $ischarge = 0;
                                    break;
                                case 4:
                                    $code = 110;
                                    $this->apiclass->response($code);
                                    return;
                                default:
                                    $this->apiclass->response(500);
                                    return;
                            }
                            $code = "100";
                            $orderno = $this->apiclass->createorderno();
                            $this->apiclass->updatedb($validitycode["userproid"],$validitycode["userid"],$validitycode["proid"],$datajson,$state,$ischarge,$orderno,"tanzhentelecom");
                            $this->apiclass->response($code,$result,$orderno);
                        }
                        else
                        {
                            $this->apiclass->response(500);
                        }
                    }
                }
            }
            else
            {
                $this->apiclass->response($code);
            }
        }
        catch (Exception $e)
        {
            log_message('error',$e->getMessage());
            $this->apiclass->response(500);
        }
    }

    public function unicom()
    {
        try{
            //判断用户接口权限
            $this->benchmark->mark('function_start');
            $time1 = $this->benchmark->elapsed_time('total_execution_time_start', 'function_start');
            log_message('info',$time1);
            $validitycode = $this->apiclass->validate();
            $code = is_numeric($validitycode)?$validitycode:1;
            if($code == 1)
            {
                $datajson = file_get_contents('php://input');
                log_message('info',$datajson."---time:".date("Y-m-d H:i:s"));
                $datajson = $this->apiclass->decrypt($datajson);
                log_message('info',$datajson."---time:".date("Y-m-d H:i:s"));
                $data = json_decode($datajson,true);
                $name = !empty($data["name"])?$data["name"]:null;
                $idNo = !empty($data["idNo"])?$data["idNo"]:null;
                $phone = !empty($data["phone"])?$data["phone"]:null;
                //判断参数
                if($name == null || $idNo == null || $phone == null)
                {
                    $code = 110;
                    $this->apiclass->response($code);
                }
                else
                {
                    if (!$this->apiclass->isUnicom($phone)){
                        $state = "1103";
                        $result = array(
                            "result"=>"参数错误",
                            "state"=>$state
                        );
                        $ischarge = 0;
                        $code = "100";
                        $orderno = $this->apiclass->createorderno();
                        $this->apiclass->updatedb($validitycode["userproid"],$validitycode["userid"],$validitycode["proid"],$datajson,$state,$ischarge,$orderno,"tanzhenunicom");
                        $this->apiclass->response($code,$result,$orderno);
                        return;
                    }
                    $this->benchmark->mark('curl_start');
                    $time2 = $this->benchmark->elapsed_time('function_start', 'curl_start');
                    log_message('info',$time2);
                    $data = array(
                        "id"=>$idNo,
                        "name"=>$name,
                        "mobile"=>$phone
                    );
                    $this->load->library('tanzhen');
                    $out = $this->tanzhen->getdata("three",$data);

                    $this->benchmark->mark('curl_end');
                    $time3 = $this->benchmark->elapsed_time('curl_start', 'curl_end');
                    log_message('info',$time3);
                    //判断返回值
                    if($out == "500")
                    {
                        $this->apiclass->response($out);
                    }
                    else
                    {
                        $arr = json_decode($out,true);
                        $success = !empty($arr["success"])?$arr["success"]:null;

                        //判断返回json
                        if ($success == true)
                        {
                            $code = $arr["code"];
                            switch ($code)
                            {
                                case 0:
                                    $value= $arr["data"]["value"];
                                    switch ($value)
                                    {
                                        case "0":
                                            $state = "1100";
                                            $result = array(
                                                "result" => "一致",
                                                "state"=>$state
                                            );
                                            $ischarge = 1;
                                            break;
                                        case "1":
                                            $state = "1101";
                                            $result = array(
                                                "result" => "不一致",
                                                "state"=>$state
                                            );
                                            $ischarge = 1;
                                            break;
                                        default:
                                            $this->apiclass->response(500);
                                            break;
                                    }
                                    break;
                                case 3:
                                    $state = "1102";
                                    $result = array(
                                        "result"=>"库中无此号",
                                        "state"=>$state
                                    );
                                    $ischarge = 0;
                                    break;
                                case 4:
                                    $code = 110;
                                    $this->apiclass->response($code);
                                    return;
                                default:
                                    $this->apiclass->response(500);
                                    return;
                            }
                            $code = "100";
                            $orderno = $this->apiclass->createorderno();
                            $this->apiclass->updatedb($validitycode["userproid"],$validitycode["userid"],$validitycode["proid"],$datajson,$state,$ischarge,$orderno,"tanzhenunicom");
                            $this->apiclass->response($code,$result,$orderno);
                        }
                        else
                        {
                            $this->apiclass->response(500);
                        }
                    }
                }
            }
            else
            {
                $this->apiclass->response($code);
            }
        }
        catch (Exception $e)
        {
            log_message('error',$e->getMessage());
            $this->apiclass->response(500);
        }
    }

    public function telecom()
    {
        try{
            //判断用户接口权限
            $this->benchmark->mark('function_start');
            $time1 = $this->benchmark->elapsed_time('total_execution_time_start', 'function_start');
            log_message('info',$time1);
            $validitycode = $this->apiclass->validate();
            $code = is_numeric($validitycode)?$validitycode:1;
            if($code == 1)
            {
                $datajson = file_get_contents('php://input');
                log_message('info',$datajson."---time:".date("Y-m-d H:i:s"));
                $datajson = $this->apiclass->decrypt($datajson);
                log_message('info',$datajson."---time:".date("Y-m-d H:i:s"));
                $data = json_decode($datajson,true);
                $name = !empty($data["name"])?$data["name"]:null;
                $idNo = !empty($data["idNo"])?$data["idNo"]:null;
                $phone = !empty($data["phone"])?$data["phone"]:null;
                //判断参数
                if($name == null || $idNo == null || $phone == null)
                {
                    $code = 110;
                    $this->apiclass->response($code);
                }
                else
                {
                    if (!$this->apiclass->isTelecom($phone)){
                        $state = "1103";
                        $result = array(
                            "result"=>"参数错误",
                            "state"=>$state
                        );
                        $ischarge = 0;
                        $code = "100";
                        $orderno = $this->apiclass->createorderno();
                        $this->apiclass->updatedb($validitycode["userproid"],$validitycode["userid"],$validitycode["proid"],$datajson,$state,$ischarge,$orderno,"tanzhentelecommd5");
                        $this->apiclass->response($code,$result,$orderno);
                        return;
                    }
                    $this->benchmark->mark('curl_start');
                    $time2 = $this->benchmark->elapsed_time('function_start', 'curl_start');
                    log_message('info',$time2);
                    $data = array(
                        "id"=>md5($idNo),
                        "name"=>$name,
                        "mobile"=>md5($phone)
                    );

                    $this->load->library('tanzhen');
                    $out = $this->tanzhen->getdata("threemd5",$data);

                    $this->benchmark->mark('curl_end');
                    $time3 = $this->benchmark->elapsed_time('curl_start', 'curl_end');
                    log_message('info',$time3);
                    //判断返回值
                    if($out == "500")
                    {
                        $this->apiclass->response($out);
                    }
                    else
                    {
                        $arr = json_decode($out,true);
                        $success = !empty($arr["success"])?$arr["success"]:null;

                        //判断返回json
                        if ($success == true)
                        {
                            $code = $arr["code"];
                            switch ($code)
                            {
                                case 0:
                                    $value= $arr["data"]["value"];
                                    switch ($value)
                                    {
                                        case "0":
                                            $state = "1100";
                                            $result = array(
                                                "result" => "一致",
                                                "state"=>$state
                                            );
                                            $ischarge = 1;
                                            break;
                                        case "1":
                                            $state = "1101";
                                            $result = array(
                                                "result" => "不一致",
                                                "state"=>$state
                                            );
                                            $ischarge = 1;
                                            break;
                                        default:
                                            $this->apiclass->response(500);
                                            break;
                                    }
                                    break;
                                case 3:
                                    $state = "1102";
                                    $result = array(
                                        "result"=>"库中无此号",
                                        "state"=>$state
                                    );
                                    $ischarge = 0;
                                    break;
                                case 4:
                                    $code = 110;
                                    $this->apiclass->response($code);
                                    return;
                                default:
                                    $this->apiclass->response(500);
                                    return;
                            }
                            $code = "100";
                            $orderno = $this->apiclass->createorderno();
                            $this->apiclass->updatedb($validitycode["userproid"],$validitycode["userid"],$validitycode["proid"],$datajson,$state,$ischarge,$orderno,"tanzhentelecommd5");
                            $this->apiclass->response($code,$result,$orderno);
                        }
                        else
                        {
                            $this->apiclass->response(500);
                        }
                    }
                }
            }
            else
            {
                $this->apiclass->response($code);
            }
        }
        catch (Exception $e)
        {
            log_message('error',$e->getMessage());
            $this->apiclass->response(500);
        }
    }

}