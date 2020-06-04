<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Order_model extends CI_Model
{
    public $table = "orders";

    function __construct()
    {
        parent::__construct();
    }

    function new(array $data)
    {
        $data["created_at"] = date("Y-m-d H:i:s");
        $this->db->set($data);
        $isCreated = $this->db->insert($this->table);
        return ($isCreated) ? $this->db->insert_id() : 0;
    }

}