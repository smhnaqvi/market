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
        $this->template(new ViewResponse("enduser", "Pages/markets", "", ""));
    }

    public function categories()
    {
        $this->template(new ViewResponse("enduser", "Pages/categories", "", ""));
    }

    public function basket()
    {
        $this->template(new ViewResponse("enduser", "Pages/basket", "", ""));
    }
}
