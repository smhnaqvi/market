<?php


/**
 * @property Product_Price_model $Product_Price_model
 * @property Product_Category_model $Product_Category_model
 */

class Category_model extends CI_Model
{
    public $table = "category";
    public $tableSub = "subCategories";

    function __construct()
    {
        parent::__construct();
    }

    function getCategories($where = null)
    {
        if (isset($where)) $this->db->where($where);
        return $this->db->get($this->table)->result();
    }

    function getCategoryById($id)
    {
        $result = $this->db->where("id", $id)->get($this->table);
        if ($result->num_rows() === 1) {
            return $result->result()[0];
        }
        return [];
    }

    function newCategory(array $data)
    {
        $data["created_at"] = date("Y-m-d H:i:s");
        return $this->db->insert($this->table, $data);
    }

    function updateCategory($id, array $data)
    {
        $this->db->where("id", $id);
        $this->db->set($data);
        $this->db->update($this->table);
    }

    function removeCategory($id)
    {
        $this->db->where("id", $id);
        return $this->db->delete($this->table);
    }


    /***** section manage sub categories ******/

    function newSubCategory(array $data)
    {
        $data["created_at"] = date("Y-m-d H:i:s");
        return $this->db->insert($this->tableSub, $data);
    }

    public function getSubCategories($catId)
    {
        $this->db->where("category_id", $catId);
        return $this->db->get($this->tableSub)->result();
    }

    public function removeSubCategory($id)
    {
        $this->db->where("id", $id);
        return $this->db->delete($this->tableSub);
    }

    function updateSubCategory($id, array $data)
    {
        $this->db->where("id", $id);
        $this->db->set($data);
        $this->db->update($this->tableSub);
    }

    public function getMarketCategories($market_id)
    {
        $this->load->model("Product_Category_model");
        $this->load->model("Product_Price_model");
        $product_price_table = $this->Product_Price_model->table;
        $product_category_table = $this->Product_Category_model->table;
        return $this->db->select("$this->table.*")->distinct()
            ->from($product_price_table)
            ->join($product_category_table, "$product_category_table.product_id = $product_price_table.product_id")
            ->join($this->table, "$this->table.id = $product_category_table.category_id")
            ->where("market_id", $market_id)
            ->get()->result();
    }
}