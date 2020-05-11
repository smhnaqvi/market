<?php

/**
 * @property Market_model $Market_model
 * @property Product_Price_model $Product_Price_model
 * @property Product_Category_model $Product_Category_model
 * @property Category_model $Category_model
 */
class Product_model extends CI_Model
{
    protected $table = "products";

    function __construct()
    {
        parent::__construct();
    }

    function getProducts()
    {
        $this->db->where("is_active", 1);
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
        $data["updated_at"] = date("Y-m-d H:i:s");
        return $this->db->update($this->table, $data, ["id" => $id]);
    }

    public function getProduct($id)
    {
        $this->load->model("Product_Category_model");
        $this->load->model("Category_model");
        $productCat_table = $this->Product_Category_model->table;
        $cat_table = $this->Category_model->table;
        return $this->db->select("$this->table.*,$productCat_table.category_id,$cat_table.title as category_title")->from($this->table)
            ->join($productCat_table, "$productCat_table.product_id = $this->table.id", "left")
            ->join($cat_table, "$cat_table.id = $productCat_table.category_id", "left")
            ->where("$this->table.id", $id)
            ->get()->result();
    }

    public function getProductCover($id)
    {
        $this->db->where("id", $id);
        $this->db->select("cover");
        $result = $this->db->get($this->table, 1);
        return $result->num_rows() === 1 ? $result->result()[0]->cover : null;
    }

    public function getMarketProducts($marketId)
    {
//        $marketTable = $this->Market_model->table;
        $this->load->model("Product_Price_model");
        $ProductPriceTable = $this->Product_Price_model->table;
        return $this->db->select()->from($this->table)
            ->join($ProductPriceTable, "$ProductPriceTable.product_id = $this->table.id AND $ProductPriceTable.market_id = $marketId")
            ->get()->result();
    }

    public function delete($id)
    {
        $this->db->where("id", $id);
        return $this->db->update($this->table, array(
            "is_deleted" => 1,
            "is_active" => 0,
        ));
    }
}