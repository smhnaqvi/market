<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Market extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function products($marketId = null)
    {
        if (!isset($marketId)) $this->redirectBackward();
        $this->load->model("Product_Price_model");
        $market_products = $this->Product_Price_model->getMarketProducts($marketId);
        $this->load->model("Product_model");
        $this->template(new ViewResponse("enduser", "Pages/products", "محصولات", ["products" => $market_products]));
    }


    function category($marketId = null)
    {
        if (!isset($marketId)) $this->redirectBackward();
        $this->load->model("Category_model");
        $result = $this->Category_model->getMarketCategories($marketId);
        $this->template(new ViewResponse("enduser", "Pages/categories", "دسته بندی ها", ["categories" => $result]));
    }

}