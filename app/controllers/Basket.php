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
        $basket = $this->cart->contents();
        $count = $this->cart->total();
        $this->template(new ViewResponse("enduser", "Pages/basket", "سبد خرید", ["basket" => $basket]));
    }
}