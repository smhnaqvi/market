<?php

class Market_model extends CI_Model
{
    public $table = "market";

    function __construct()
    {
        parent::__construct();
    }

    function getMarketProducts($marketId): array
    {
        $result = $this->db->where("id", $marketId)->get($this->table, 1);
        return ($result->num_rows() === 1) ? $result->result() : [];
    }

    function getMarkets(array $where = null)
    {
        if (isset($where)) $this->db->where($where);
        return $this->db->get($this->table)->result();
    }

    function newMarket($data): bool
    {
        $data["created_at"] = date("Y-m-d H:i:s");
        return $this->db->insert($this->table, $data);
    }

    function updateMarket($id, array $data)
    {
        $this->db->where("id", $id);
        return $this->db->update($this->table, $data);
    }

    public function getMarket($marketId)
    {
        return $this->db->where("id", $marketId)->get($this->table)->result();
    }

    public function changeActivationState($id, $state)
    {
        $this->db->where("id", $id);
        return $this->db->update($this->table, ["is_active" => $state]);
    }
}