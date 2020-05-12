<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends My_Controller
{
    public function index()
    {
        $this->template(new ViewResponse("enduser", "Pages/home", "", ""));
    }

    public function about()
    {
        $this->template(new ViewResponse("enduser", "Pages/about", "", ""));
    }

    public function contact()
    {
        $this->template(new ViewResponse("enduser", "Pages/contact", "", ""));
    }

    public function product($productId)
    {
        $this->template(new ViewResponse("enduser", "Pages/product", "", ""));
    }

    public function products()
    {
        $this->load->model("Product_Price_model");
        $products = $this->Product_Price_model->getProductsByPrice();
        $this->template(new ViewResponse("enduser", "Pages/products", "محصولات", ["products" => $products]));
    }

    public function categories()
    {
    }

}
