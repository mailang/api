<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class MY_Controller extends CI_Controller{


//通用检测登录
    function check_login(){
        $userid = $this->session->userid;
        if(!$userid){
            redirect('welcome');
        }
    }


}
?>