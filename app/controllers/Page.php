<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once "Main.php";

class Page extends Main
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

    public function markets()
    {
        $this->load->model("Market_model");
        $markets = $this->Market_model->getMarkets(["is_active" => 1]);
        $this->template(new ViewResponse("enduser", "Pages/markets", "فروشگاه ها", ["markets" => $markets]));
    }

    public function categories()
    {
    }

}
