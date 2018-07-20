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

    public function twncard()
    {
        try{
            //判断用户接口权限
            $validitycode = $this->apiclass->validate();
            $code = is_numeric($validitycode)?$validitycode:1;
            if($code == 1)
            {
                $datajson = file_get_contents('php://input');
                log_message('info',$datajson."---time:".date("Y-m-d H:i:s"));
                $data = json_decode($datajson,true);
                $name = !empty($data["name"])?$data["name"]:null;
                $cardNo = !empty($data["cardNo"])?$data["cardNo"]:null;
                $birthDay = !empty($data["birthDay"])?$data["birthDay"]:null;
                $validity = !empty($data["validity"])?$data["validity"]:null;
                //判断参数
                if($name == null || $cardNo == null || $birthDay == null || $validity == null)
                {
                    $code = 110;
                    $this->apiclass->response($code);
                }
                else
                {
                    $this->load->library('identity');
                    $out = $this->identity->gettwncard($name,$cardNo,$birthDay,$validity);
                    //判断返回值
                    if($out == "500")
                    {
                        $this->apiclass->response($out);
                    }
                    else
                    {
                        $arr = json_decode($out,true);
                        $code = !empty($arr["code"])?$arr["code"]:null;
                        //判断返回json
                        if ($code == "100")
                        {
                            $result = $arr["data"];
                            $state = $result["state"];
                            //var_dump($result);
                            $ischarge = 0;
                            switch ($state)
                            {
                                case  "1100":
                                case  "1101":
                                case  "1102":
                                case  "1103":
                                    $ischarge = 1;
                                    break;
                                case  "1104":
                                case  "1105":
                                    $ischarge = 0;
                                    break;
                                default:
                                    $this->apiclass->response(500);
                                    return;
                            }
                            $orderno = $this->apiclass->createorderno();
                            $this->apiclass->updatedb($validitycode["userproid"],$validitycode["userid"],$validitycode["proid"],$datajson,$state,$ischarge,$orderno,"indentitytwn");
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

    public function hkmacard()
    {
        try{
            //判断用户接口权限
            $validitycode = $this->apiclass->validate();
            $code = is_numeric($validitycode)?$validitycode:1;
            if($code == 1)
            {
                $datajson = file_get_contents('php://input');
                log_message('info',$datajson."---time:".date("Y-m-d H:i:s"));
                $data = json_decode($datajson,true);
                $name = !empty($data["name"])?$data["name"]:null;
                $cardNo = !empty($data["cardNo"])?$data["cardNo"]:null;
                $birthDay = !empty($data["birthDay"])?$data["birthDay"]:null;
                $validity = !empty($data["validity"])?$data["validity"]:null;
                //判断参数
                if($name == null || $cardNo == null || $birthDay == null || $validity == null)
                {
                    $code = 110;
                    $this->apiclass->response($code);
                }
                else
                {
                    $this->load->library('identity');
                    $out = $this->identity->gethkmacard($name,$cardNo,$birthDay,$validity);
                    //判断返回值
                    if($out == "500")
                    {
                        $this->apiclass->response($out);
                    }
                    else
                    {
                        $arr = json_decode($out,true);
                        $code = !empty($arr["code"])?$arr["code"]:null;
                        //判断返回json
                        if ($code == "100")
                        {
                            $result = $arr["data"];
                            $state = $result["state"];
                            //var_dump($result);
                            $ischarge = 0;
                            switch ($state)
                            {
                                case  "1100":
                                case  "1101":
                                case  "1102":
                                case  "1103":
                                    $ischarge = 1;
                                    break;
                                case  "1104":
                                case  "1105":
                                    $ischarge = 0;
                                    break;
                                default:
                                    $this->apiclass->response(500);
                                    return;
                            }
                            $orderno = $this->apiclass->createorderno();
                            $this->apiclass->updatedb($validitycode["userproid"],$validitycode["userid"],$validitycode["proid"],$datajson,$state,$ischarge,$orderno,"indentityhkma");
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

    public function greencard()
    {
        try{
            //判断用户接口权限
            $validitycode = $this->apiclass->validate();
            $code = is_numeric($validitycode)?$validitycode:1;
            if($code == 1)
            {
                $datajson = file_get_contents('php://input');
                log_message('info',$datajson."---time:".date("Y-m-d H:i:s"));
                $data = json_decode($datajson,true);
                $enName = !empty($data["enName"])?$data["enName"]:null;
                $cardNo = !empty($data["cardNo"])?$data["cardNo"]:null;
                $birthDay = !empty($data["birthDay"])?$data["birthDay"]:null;
                $validity = !empty($data["validity"])?$data["validity"]:null;
                //判断参数
                if($enName == null || $cardNo == null || $birthDay == null || $validity == null)
                {
                    $code = 110;
                    $this->apiclass->response($code);
                }
                else
                {
                    $this->load->library('identity');
                    $out = $this->identity->getgreencard($enName,$cardNo,$birthDay,$validity);
                    //判断返回值
                    if($out == "500")
                    {
                        $this->apiclass->response($out);
                    }
                    else
                    {
                        $arr = json_decode($out,true);
                        $code = !empty($arr["code"])?$arr["code"]:null;
                        //判断返回json
                        if ($code == "100")
                        {
                            $result = $arr["data"];
                            $state = $result["state"];
                            //var_dump($result);
                            $ischarge = 0;
                            switch ($state)
                            {
                                case  "1100":
                                case  "1101":
                                case  "1102":
                                case  "1103":
                                    $ischarge = 1;
                                    break;
                                case  "1104":
                                case  "1105":
                                    $ischarge = 0;
                                    break;
                                default:
                                    $this->apiclass->response(500);
                                    return;
                            }
                            $orderno = $this->apiclass->createorderno();
                            $this->apiclass->updatedb($validitycode["userproid"],$validitycode["userid"],$validitycode["proid"],$datajson,$state,$ischarge,$orderno,"indentitygreen");
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

    public function idvalidity()
    {
        try{
            //判断用户接口权限
            $validitycode = $this->apiclass->validate();
            $code = is_numeric($validitycode)?$validitycode:1;
            if($code == 1)
            {
                $datajson = file_get_contents('php://input');
                log_message('info',$datajson."---time:".date("Y-m-d H:i:s"));
                $data = json_decode($datajson,true);
                $beginDate = !empty($data["beginDate"])?$data["beginDate"]:null;
                $name = !empty($data["name"])?$data["name"]:null;
                $idNo = !empty($data["idNo"])?$data["idNo"]:null;
                //判断参数
                if($beginDate == null || $name == null || $idNo == null)
                {
                    $code = 110;
                    $this->apiclass->response($code);
                }
                else
                {
                    $this->load->library('identity');
                    $out = $this->identity->getIDvalidity($beginDate,$name,$idNo);
                    //判断返回值
                    if($out == "500")
                    {
                        $this->apiclass->response($out);
                    }
                    else
                    {
                        $arr = json_decode($out,true);
                        $code = !empty($arr["code"])?$arr["code"]:null;
                        //判断返回json
                        if ($code == "100")
                        {
                            $result = $arr["data"];
                            $state = $result["state"];
                            //var_dump($result);
                            $ischarge = 0;
                            switch ($state)
                            {
                                case  "1100":
                                case  "1101":
                                    $ischarge = 1;
                                    break;
                                case  "1102":
                                case  "1103":
                                    $ischarge = 0;
                                    break;
                                default:
                                    $this->apiclass->response(500);
                                    return;
                            }
                            $orderno = $this->apiclass->createorderno();
                            $this->apiclass->updatedb($validitycode["userproid"],$validitycode["userid"],$validitycode["proid"],$datajson,$state,$ischarge,$orderno,"indentityidvilidity");
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

    public function idcheck()
    {
        try{
            //判断用户接口权限
            $validitycode = $this->apiclass->validate();
            $code = is_numeric($validitycode)?$validitycode:1;
            if($code == 1)
            {
                $datajson = file_get_contents('php://input');
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
                    $this->load->library('identity');
                    $out = $this->identity->getIDcheck($name,$idNo);
                    //判断返回值
                    if($out == "500")
                    {
                        $this->apiclass->response($out);
                    }
                    else
                    {
                        $arr = json_decode($out,true);
                        $code = !empty($arr["code"])?$arr["code"]:null;
                        //判断返回json
                        if ($code == "100")
                        {
                            $result = $arr["data"];
                            $state = $result["state"];
                            //var_dump($result);
                            $ischarge = 0;
                            switch ($state)
                            {
                                case  "1100":
                                case  "1101":
                                    $ischarge = 1;
                                    break;
                                case  "1102":
                                case  "1103":
                                    $ischarge = 0;
                                    break;
                                default:
                                    $this->apiclass->response(500);
                                    return;
                            }
                            $orderno = $this->apiclass->createorderno();
                            $this->apiclass->updatedb($validitycode["userproid"],$validitycode["userid"],$validitycode["proid"],$datajson,$state,$ischarge,$orderno,"indentityidcheck");
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

    public function nameidcheck()
    {
        try{
            //判断用户接口权限
            $validitycode = $this->apiclass->validate();
            $code = is_numeric($validitycode)?$validitycode:1;
            if($code == 1)
            {
                $datajson = file_get_contents('php://input');
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
                    $this->load->library('jiaoke');
                    $out = $this->jiaoke->getIDcheck($name,$idNo);
                    //判断返回值
                    if($out == "500")
                    {
                        $this->apiclass->response($out);
                    }
                    else
                    {
                        $arr = json_decode($out,true);
                        $code = !empty($arr["ResultCode"])?$arr["ResultCode"]:null;
                        //var_dump($arr);
                        //判断返回json
                        if ($code)
                        {
                            $result = "";
                            //$state = $result["state"];
                            //var_dump($result);
                            $ischarge = 0;
                            switch ($code)
                            {
                                case  "1000":
                                    $state = "1100";
                                    $result = array(
                                        "result"=>"一致",
                                        "state"=>$state
                                    );
                                    $ischarge = 1;
                                    break;
                                case  "1001":
                                    $state = "1101";
                                    $result = array(
                                        "result"=>"不一致",
                                        "state"=>$state
                                    );
                                    $ischarge = 1;
                                    break;
                                case  "1002":
                                    $state = "1102";
                                    $result = array(
                                        "result"=>"库中无此号",
                                        "state"=>$state
                                    );
                                    $ischarge = 0;
                                    break;
                                case  "2005":
                                    $state = "1103";
                                    $result = array(
                                        "result"=>"姓名或身份证错误",
                                        "state"=>$state
                                    );
                                    $ischarge = 0;
                                    break;
                                case  "9001":
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

    public function mobile()
    {
        try{
            //判断用户接口权限
            $validitycode = $this->apiclass->validate();
            $code = is_numeric($validitycode)?$validitycode:1;
            if($code == 1)
            {
                $datajson = file_get_contents('php://input');
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
                    $this->load->library('jiaoke');
                    $out = $this->jiaoke->mobile($name,$idNo,$phone);
                    //判断返回值
                    if($out == "500")
                    {
                        $this->apiclass->response($out);
                    }
                    else
                    {
                        $arr = json_decode($out,true);
                        $code = !empty($arr["ResultCode"])?$arr["ResultCode"]:null;
                        //var_dump($arr);
                        //判断返回json
                        if ($code)
                        {
                            $result = "";
                            //$state = $result["state"];
                            //var_dump($result);
                            $ischarge = 0;
                            switch ($code)
                            {
                                case  "1000":
                                    $state = "1100";
                                    $result = array(
                                        "result"=>"一致",
                                        "state"=>$state
                                    );
                                    $ischarge = 1;
                                    break;
                                case  "1001":
                                    $state = "1101";
                                    $result = array(
                                        "result"=>"不一致",
                                        "state"=>$state
                                    );
                                    $ischarge = 1;
                                    break;
                                case  "1002":
                                    $state = "1102";
                                    $result = array(
                                        "result"=>"库中无此号",
                                        "state"=>$state
                                    );
                                    $ischarge = 0;
                                    break;
                                case  "2001":
                                    $state = "1103";
                                    $result = array(
                                        "result"=>"号段不支持",
                                        "state"=>$state
                                    );
                                    $ischarge = 0;
                                    break;
                                case  "2005":
                                    $state = "1104";
                                    $result = array(
                                        "result"=>"参数错误",
                                        "state"=>$state
                                    );
                                    $ischarge = 0;
                                    break;
                                case  "9901":
                                    $state = "1105";
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

    public function szmcmcch()
    {
        try{
            //判断用户接口权限
            $validitycode = $this->apiclass->validate();
            $code = is_numeric($validitycode)?$validitycode:1;
            if($code == 1)
            {
                $datajson = file_get_contents('php://input');
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
                    $this->load->library('jiaoke');
                    $out = $this->jiaoke->szmcmcch($name,$idNo,$phone);
                    //判断返回值
                    if($out == "500")
                    {
                        $this->apiclass->response($out);
                    }
                    else
                    {
                        $arr = json_decode($out,true);
                        $code = !empty($arr["ResultCode"])?$arr["ResultCode"]:null;
                        //var_dump($arr);
                        //判断返回json
                        if ($code)
                        {
                            $result = "";
                            //$state = $result["state"];
                            //var_dump($result);
                            $ischarge = 0;
                            switch ($code)
                            {
                                case  "1000":
                                    $state = "1100";
                                    $result = array(
                                        "result"=>"一致",
                                        "state"=>$state
                                    );
                                    $ischarge = 1;
                                    break;
                                case  "1001":
                                    $state = "1101";
                                    $result = array(
                                        "result"=>"不一致",
                                        "state"=>$state
                                    );
                                    $ischarge = 1;
                                    break;
                                case  "1002":
                                    $state = "1102";
                                    $result = array(
                                        "result"=>"库中无此号",
                                        "state"=>$state
                                    );
                                    $ischarge = 0;
                                    break;
//                                case  "2001":
//                                    $state = "1103";
//                                    $result = array(
//                                        "result"=>"号段不支持",
//                                        "state"=>$state
//                                    );
//                                    $ischarge = 0;
//                                    break;
                                case  "2005":
                                    $state = "1104";
                                    $result = array(
                                        "result"=>"参数错误",
                                        "state"=>$state
                                    );
                                    $ischarge = 0;
                                    break;
                                case  "9901":
                                    $state = "1105";
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
                            $this->apiclass->updatedb($validitycode["userproid"],$validitycode["userid"],$validitycode["proid"],$datajson,$state,$ischarge,$orderno,"jiaokeszmcmcch");
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

    public function bankthree()
    {
        try{
            //判断用户接口权限
            $validitycode = $this->apiclass->validate();
            $code = is_numeric($validitycode)?$validitycode:1;
            if($code == 1)
            {
                $datajson = file_get_contents('php://input');
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
                    $this->load->library('jiaoke');
                    $out = $this->jiaoke->bankthree($name,$idNo,$bankcard);
                    //判断返回值
                    if($out == "500")
                    {
                        $this->apiclass->response($out);
                    }
                    else
                    {
                        $arr = json_decode($out,true);
                        $code = !empty($arr["ResultCode"])?$arr["ResultCode"]:null;
                        //var_dump($arr);
                        //判断返回json
                        if ($code)
                        {
                            $result = "";
                            //$state = $result["state"];
                            //var_dump($result);
                            $ischarge = 0;
                            switch ($code)
                            {
                                case  "1000":
                                    $state = "1100";
                                    $result = array(
                                        "result"=>"一致",
                                        "state"=>$state
                                    );
                                    $ischarge = 1;
                                    break;
                                case  "1001":
                                    $state = "1101";
                                    $result = array(
                                        "result"=>"不一致",
                                        "state"=>$state
                                    );
                                    $ischarge = 1;
                                    break;
                                case  "1022":
                                    $state = "1122";
                                    $result = array(
                                        "result"=>"银行卡状态错误",
                                        "state"=>$state
                                    );
                                    $ischarge = 1;
                                    break;
                                case  "1002":
                                    $state = "1102";
                                    $result = array(
                                        "result"=>"库无",
                                        "state"=>$state
                                    );
                                    $ischarge = 0;
                                    break;
                                case  "1003":
                                    $state = "1103";
                                    $result = array(
                                        "result"=>"验证失败",
                                        "state"=>$state
                                    );
                                    $ischarge = 0;
                                    break;
                                case  "1004":
                                    $state = "1104";
                                    $result = array(
                                        "result"=>"卡验证接口错误",
                                        "state"=>$state
                                    );
                                    $ischarge = 0;
                                    break;
                                case  "1005":
                                    $state = "1105";
                                    $result = array(
                                        "result"=>"无效的身份证号码",
                                        "state"=>$state
                                    );
                                    $ischarge = 0;
                                    break;
                                case  "1006":
                                    $state = "1106";
                                    $result = array(
                                        "result"=>"无效的姓名",
                                        "state"=>$state
                                    );
                                    $ischarge = 0;
                                    break;
                                case  "1007":
                                    $state = "1107";
                                    $result = array(
                                        "result"=>"非法参数",
                                        "state"=>$state
                                    );
                                    $ischarge = 0;
                                    break;
                                case  "1008":
                                    $state = "1108";
                                    $result = array(
                                        "result"=>"无效手机号",
                                        "state"=>$state
                                    );
                                    $ischarge = 0;
                                    break;
                                case  "1009":
                                    $state = "1109";
                                    $result = array(
                                        "result"=>"无效银行卡",
                                        "state"=>$state
                                    );
                                    $ischarge = 0;
                                    break;
                                case  "1010":
                                    $state = "1110";
                                    $result = array(
                                        "result"=>"无法验证，无记录（无对应银行卡记录）",
                                        "state"=>$state
                                    );
                                    $ischarge = 0;
                                    break;
                                case  "1011":
                                    $state = "1111";
                                    $result = array(
                                        "result"=>"发卡行不支持此比交易",
                                        "state"=>$state
                                    );
                                    $ischarge = 0;
                                    break;
                                case  "2005":
                                    $state = "1201";
                                    $result = array(
                                        "result"=>"查询参数错误",
                                        "state"=>$state
                                    );
                                    $ischarge = 0;
                                    break;
                                case  "2006":
                                    $state = "1202";
                                    $result = array(
                                        "result"=>"查询结果失败，由于银行卡号格式错误导致的异常",
                                        "state"=>$state
                                    );
                                    $ischarge = 0;
                                    break;
                                case  "2007":
                                    $state = "1203";
                                    $result = array(
                                        "result"=>"手机号码类型不符",
                                        "state"=>$state
                                    );
                                    $ischarge = 0;
                                    break;
                                case  "9901":
                                    $state = "1204";
                                    $result = array(
                                        "result"=>"查询失败",
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
                            $this->apiclass->updatedb($validitycode["userproid"],$validitycode["userid"],$validitycode["proid"],$datajson,$state,$ischarge,$orderno,"jiaokebankthree");
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

    public function bankfour()
    {
        try{
            //判断用户接口权限
            $validitycode = $this->apiclass->validate();
            $code = is_numeric($validitycode)?$validitycode:1;
            if($code == 1)
            {
                $datajson = file_get_contents('php://input');
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
                    $this->load->library('jiaoke');
                    $out = $this->jiaoke->bankfour($name,$idNo,$bankcard,$phone);
                    //判断返回值
                    if($out == "500")
                    {
                        $this->apiclass->response($out);
                    }
                    else
                    {
                        $arr = json_decode($out,true);
                        $code = !empty($arr["ResultCode"])?$arr["ResultCode"]:null;
                        //var_dump($arr);
                        //判断返回json
                        if ($code)
                        {
                            $result = "";
                            //$state = $result["state"];
                            //var_dump($result);
                            $ischarge = 0;
                            switch ($code)
                            {
                                case  "1000":
                                    $state = "1100";
                                    $result = array(
                                        "result"=>"一致",
                                        "state"=>$state
                                    );
                                    $ischarge = 1;
                                    break;
                                case  "1001":
                                    $state = "1101";
                                    $result = array(
                                        "result"=>"不一致",
                                        "state"=>$state
                                    );
                                    $ischarge = 1;
                                    break;
                                case  "1022":
                                    $state = "1122";
                                    $result = array(
                                        "result"=>"银行卡状态错误",
                                        "state"=>$state
                                    );
                                    $ischarge = 1;
                                    break;
                                case  "1002":
                                    $state = "1102";
                                    $result = array(
                                        "result"=>"库无",
                                        "state"=>$state
                                    );
                                    $ischarge = 0;
                                    break;
                                case  "1003":
                                    $state = "1103";
                                    $result = array(
                                        "result"=>"验证失败",
                                        "state"=>$state
                                    );
                                    $ischarge = 0;
                                    break;
                                case  "1004":
                                    $state = "1104";
                                    $result = array(
                                        "result"=>"卡验证接口错误",
                                        "state"=>$state
                                    );
                                    $ischarge = 0;
                                    break;
                                case  "1005":
                                    $state = "1105";
                                    $result = array(
                                        "result"=>"无效的身份证号码",
                                        "state"=>$state
                                    );
                                    $ischarge = 0;
                                    break;
                                case  "1006":
                                    $state = "1106";
                                    $result = array(
                                        "result"=>"无效的姓名",
                                        "state"=>$state
                                    );
                                    $ischarge = 0;
                                    break;
                                case  "1007":
                                    $state = "1107";
                                    $result = array(
                                        "result"=>"非法参数",
                                        "state"=>$state
                                    );
                                    $ischarge = 0;
                                    break;
                                case  "1008":
                                    $state = "1108";
                                    $result = array(
                                        "result"=>"无效手机号",
                                        "state"=>$state
                                    );
                                    $ischarge = 0;
                                    break;
                                case  "1009":
                                    $state = "1109";
                                    $result = array(
                                        "result"=>"无效银行卡",
                                        "state"=>$state
                                    );
                                    $ischarge = 0;
                                    break;
                                case  "1010":
                                    $state = "1110";
                                    $result = array(
                                        "result"=>"无法验证，无记录",
                                        "state"=>$state
                                    );
                                    $ischarge = 0;
                                    break;
                                case  "1011":
                                    $state = "1111";
                                    $result = array(
                                        "result"=>"发卡行不支持此笔交易",
                                        "state"=>$state
                                    );
                                    $ischarge = 0;
                                    break;
                                case  "2005":
                                    $state = "1201";
                                    $result = array(
                                        "result"=>"查询参数错误",
                                        "state"=>$state
                                    );
                                    $ischarge = 0;
                                    break;
                                case  "2006":
                                    $state = "1202";
                                    $result = array(
                                        "result"=>"查询结果失败，由于银行卡号格式错误导致的异常",
                                        "state"=>$state
                                    );
                                    $ischarge = 0;
                                    break;
                                case  "2007":
                                    $state = "1203";
                                    $result = array(
                                        "result"=>"手机号码类型不符",
                                        "state"=>$state
                                    );
                                    $ischarge = 0;
                                    break;
                                case  "9901":
                                    $state = "1204";
                                    $result = array(
                                        "result"=>"查询失败",
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
                            $this->apiclass->updatedb($validitycode["userproid"],$validitycode["userid"],$validitycode["proid"],$datajson,$state,$ischarge,$orderno,"jiaokebankfour");
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