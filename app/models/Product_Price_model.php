<?php

class Product_Price_model extends CI_Model
{
    protected $mainTable = "products";
    protected $table = "product_price";

    function __construct()
    {
        parent::__construct();
    }

    function getProductPrices($productId)
    {
        $this->db->where("product_id", $productId);
        $this->db->get($this->table)->result();
    }

    function getMarketProducts($marketId)
    {
        $this->db->select()
            ->from($this->mainTable)
            ->join($this->table, "$this->table.product_id = $this->mainTable.id");
        $this->db->where("$this->table.market_id", $marketId);
        $this->db->order_by("$this->table.id", "DESC");
        return $this->db->get()->result();
    }

    function setNewPrice($productId, $marketId, $price)
    {
        $this->db->insert($this->table, array(
            "product_id" => $productId,
            "market_id" => $marketId,
            "price" => $price,
            "updated_at" => date("Y-m-d H:i:s"),
        ));
    }

    function getLastPrice($productId)
    {
        $result = $this->db->order_by("id", "DESC")->get($this->table, 1);
        return ($result->num_rows() === 1) ? $result->result()[0] : [];
    }
}