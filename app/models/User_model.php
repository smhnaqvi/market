<?php

class User_model extends CI_Model
{
    protected $table = "users";

    function __construct()
    {
        parent::__construct();
    }

    public function getUserDataByMobileNumber($mobileNumber, $where = null)
    {
        if (isset($where)) $this->db->where($where);
        $this->db->where("mobile_number", $mobileNumber);
        $result = $this->db->get($this->table, 1);
        return ($result->num_rows() === 1) ? $result->result()[0] : [];
    }

    function register($first_name, $last_name, $mobile_number)
    {
        $this->db->set(array(
            "name" => $first_name,
            "family" => $last_name,
            "mobile_number" => $mobile_number,
            "created_at" => date("Y-m-d H:i:s"),
        ));
        $isCreated = $this->db->insert($this->table);
        return ($isCreated) ? $this->db->insert_id() : 0;
    }
}