<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Basket extends My_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('cart');
    }

    function index()
    {
        $this->load->library("cart");
        $data = [
            "items" => $this->cart->contents(),
            "total_price" => $this->cart->total(),
            "total_items" => count($this->cart->contents())
        ];
        $this->template(new ViewResponse("enduser", "Pages/basket2", "سبد خرید", ["basket" => $data]));
    }

    function basket2()
    {
        $this->load->library("cart");
        $data = [
            "items" => $this->cart->contents(),
            "total_price" => $this->cart->total(),
            "total_items" => count($this->cart->contents())
        ];
        $this->template(new ViewResponse("enduser", "Pages/basket", "", ["basket" => $data]));
    }

    function removeItem()
    {
        $this->load->library("cart");
        $rowId = $this->input->get("rowId");
        if (!isset($rowId)) {
            $this->redirectBackward();
        }

        $this->cart->remove($rowId);
        $this->redirectBackward();
    }
}