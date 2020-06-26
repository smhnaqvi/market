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

    /**
     * @return array
     */
    public function getOrders(): array
    {
        return $this->db->get($this->table)->result();
    }

    public function getOrder($id)
    {
        $this->db->where("id", $id);
        $order = $this->db->get($this->table, 1);
        if ($order->num_rows() === 1) {
            return $order->result()[0];
        }
        return [];
    }

    public function updateDeliverState($id)
    {
        $this->db->where("id", $id);
        $this->db->set("is_delivered", 1);
        return $this->db->update($this->table);
    }

}