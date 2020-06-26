<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once "Main.php";

class Order extends Main
{
    function __construct()
    {
        parent::__construct();
        $this->load->model("Order_model");

    }

    function index()
    {
        $orders = $this->Order_model->getOrders();
        $data = new ViewResponse("panel", "manage_orders", 'مدیریت سفارشات', $orders);
        $this->template($data);
    }

    function delivered($id = null)
    {
        if (!isset($id)) {
            $this->redirectBackward();
        }
        $order = $this->Order_model->getOrder($id);
        if ($order->is_delivered === '0') {
            $this->Order_model->updateDeliverState($id);
        }

        $this->redirectBackward();
    }

}