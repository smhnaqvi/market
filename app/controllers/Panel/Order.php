<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once "Main.php";

class Order extends Main
{
    function __construct()
    {
        parent::__construct();
    }

    function index()
    {
        $markets = [];
        $data = new ViewResponse("panel", "manage_orders", 'مدیریت سفارشات', $markets);
        $this->template($data);
    }

}