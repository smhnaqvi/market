<?php

class Product_Category_model extends CI_Model
{
    public $table = "product_category";

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

    public function replace(array $data)
    {
        $this->db->where("product_id", $data["product_id"]);
        $id = $this->db->select("id")->get($this->table, 1);
        $id = ($id->num_rows() > 0) ? $id->result()[0]->id : null;

        if (!empty($id)) {
            $this->db->where("id", $id);
            return $this->db->update($this->table, $data);
        } else {
            return $this->store($data);
        }
    }
}