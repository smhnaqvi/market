<?php

class Product_model extends CI_Model
{
    protected $table = "products";

    function __construct()
    {
        parent::__construct();
    }

    function getProducts()
    {
        return $this->db->get($this->table)->result();
    }

    function getProductsByIds(array $ids)
    {
        $this->db->where_in("id", $ids);
        return $this->db->get($this->table)->result();
    }

    public function newProduct(array $data)
    {
        $data["created_at"] = date("Y-m-d H:i:s");
        $this->db->set($data);
        return ($this->db->insert($this->table)) ? $this->db->insert_id() : false;
    }

    public function updateProduct(int $id, array $data)
    {
        return $this->db->update($this->table, $data, ["id" => $id]);
    }
}