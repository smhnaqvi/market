<?php

class Product_Price_model extends CI_Model
{
    public $mainTable = "products";
    public $table = "product_price";

    function __construct()
    {
        parent::__construct();
    }


    function getProductPrices($productId)
    {
        $this->db->where("product_id", $productId);
        return $this->db->get($this->table)->result();
    }

    function getProductStablePrice($productId)
    {
        $this->db->where("product_id", $productId);
        $this->db->order_by("updated_at", "DESC");
        return $this->db->get($this->table)->result();
    }

    function getMarketProducts($marketId)
    {
        $this->db->select()
            ->from($this->mainTable)
            ->join($this->table, "$this->table.product_id = $this->mainTable.id");
        $this->db->where("$this->table.market_id", $marketId);
        $this->db->where("$this->mainTable.is_active", 1);
        $this->db->where("$this->mainTable.is_deleted", 0);
        $this->db->order_by("$this->table.updated_at", "DESC");
        $data = [];
        foreach ($this->db->get()->result() as $market_product) {
            if (!isset($data[$market_product->product_id])) {
                $data[$market_product->product_id] = $market_product;
            }
        }
        return $data;
    }

    function setNewPrice($productId, $marketId, $price, $sell_price)
    {
        $this->db->insert($this->table, array(
            "product_id" => $productId,
            "market_id" => $marketId,
            "price" => $price,
            "sell_price" => $sell_price,
            "updated_at" => date("Y-m-d H:i:s"),
        ));
    }

    function getLastPrice($productId)
    {
        $this->db->select("sell_price");
        $this->db->where("product_id", $productId);
        $result = $this->db->order_by("updated_at", "DESC")->get($this->table, 1);
        return ($result->num_rows() === 1) ? $result->result()[0]->sell_price : 0;
    }
}