<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class  Api_model extends CI_Model
{

    public function getuser($appkey)
    {
        $query = $this->db->get_where('api_user', array('appkey' => $appkey));
        return $query->row();
    }

    public function getuserapi($userid,$appkey)
    {
        $query = "SELECT a.`id`,b.`id` as proid,a.`charge_count`,a.`all_count` FROM api_userpro a
                LEFT JOIN api_product b
                ON a.`pro_id` = b.`id`
                WHERE a.`user_id` = ?
                AND b.api_name = ?
                AND a.`isable` = 1
                AND b.`isable` = 1";
        return $this->db->query($query, array($userid,"$appkey"))->row();
    }

    public function insertorder($orderno,$userid,$proid,$detail,$ischarge,$state,$mark,$time,$updatedbtime)
    {
        //$time = date("Y-m-d H:i:s");
        $query = "insert into api_order VALUE (0,?,?,?,?,?,?,?,?,?,?)";
        return $this->db->query($query,array("$orderno","$userid","$proid","$detail","$ischarge","$state","$mark","$updatedbtime","$time","$time"));
    }

    public function updateuserpro($userproid,$ischarge,$time)
    {
        //$time = date("Y-m-d H:i:s");
        $query = "update api_userpro set used_count=used_count+1,charge_count=charge_count+?,update_time=? where id = ?";
        return $this->db->query($query,array("$ischarge","$time","$userproid"));
    }

    public function updatestatis($api_name,$time)
    {
        //$time = date("Y-m-d H:i:s");
        $query = "update api_statis set `count`=`count`+1,update_time=? where api_name=?";
        return $this->db->query($query,array("$time","$api_name"));
    }


}