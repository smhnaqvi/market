<?php

class Product_Category_model extends CI_Model
{
    protected $table = "product_category";

    function __construct()
    {
        parent::__construct();
    }

    function getByCategory($id)
    {
        $this->db->where("category_id", $id);
        $this->db->get($this->table)->result();
    }

    function store($data)
    {
        return $this->db->insert($this->table, $data);
    }
}