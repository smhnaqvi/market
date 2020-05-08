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
}