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
        $categoryID = intval($this->input->get("c", true));
        $categoryID = ($categoryID === 0) ? null : $categoryID;
        $SubCategoryID = intval($this->input->get("sc", true));
        $SubCategoryID = ($SubCategoryID === 0) ? null : $SubCategoryID;
        $sort = $this->input->get("sort", true);
        $search = $this->input->get("search", true);

        $this->load->model("Product_model");
        $this->load->model("Product_Price_model");
        $products = $this->Product_model->getProducts(true, addslashes($search), addslashes($sort), $categoryID, $SubCategoryID);
        if (!empty($products)) {
            foreach ($products["products"] as &$product) {
                $product->sell_price = $this->Product_Price_model->getLastPrice($product->product_id);
            }
        }

        $this->template(new ViewResponse("enduser", "Pages/products", "محصولات", ["products" => $products]));
    }

    public function categories()
    {
        $this->load->model("Category_model");
        $categories = $this->Category_model->getCategories();
        $this->template(new ViewResponse("enduser", "Pages/categories", "دسته بندی ها", ["categories" => $categories]));
    }

    public function category($catID = null)
    {
        if (!isset($catID)) show_404();
        $this->load->model("Category_model");
        $subCategories = $this->Category_model->getSubCategories($catID);
        if (empty($subCategories)) show_404();
        $this->template(new ViewResponse("enduser", "Pages/subCategory", "ریز دسته ها", ["subCategories" => $subCategories]));
    }

    public function panelLogin()
    {
        if (isset($_SESSION["admin_info"])) {
            redirect(base_url("panel"));
        } else {
            $this->load->view("login");
        }
    }
}
