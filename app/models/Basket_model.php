<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Basket_model extends CI_Model
{
    public $table = "basket";

    function __construct()
    {
        parent::__construct();
    }

    function registerOrder(array $data)
    {
        $isCreated = $this->db->insert_batch($this->table, $data);
        return ($isCreated > 0) ? true : false;
    }

}