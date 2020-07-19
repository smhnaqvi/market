<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends My_Controller
{
    public function index()
    {
        $this->load->model("Setting_model");
        $response["slider"] = $this->Setting_model->getSetting("image", "slider", "home");
        $this->template(new ViewResponse("enduser", "Pages/home", "", $response));
    }

    public function about()
    {
        $this->template(new ViewResponse("enduser", "Pages/about", "", ""));
    }

    public function contact()
    {
        $this->template(new ViewResponse("enduser", "Pages/contact", "", ""));
    }

    public function product($productId = null)
    {
        if (!isset($productId)) show_404();
        $this->load->model(["Product_model", "Product_Price_model"]);
        $product = $this->Product_model->getProduct($productId);

        if (empty($product)) show_404();
        $product->sell_price = $this->Product_Price_model->getLastPrice($product->id);

        $similar_products = $this->Product_model->getSubCategoryProducts($product->subcategory_id);

        if (!empty($similar_products)) {
            foreach ($similar_products as &$product_item) {
                $product_item->sell_price = (int)$this->Product_Price_model->getLastPrice($product_item->id);
            }
        }

        $this->template(new ViewResponse("enduser", "Pages/product", "محصول", ["product" => $product, "similar_products" => $similar_products]));
    }

    function search()
    {
        $this->load->model(["Product_model", "Category_model", "Product_Price_model"]);
        $search = $this->input->get("q", true);
        $products = $this->Product_model->getProducts(false, addslashes($search));
        if (!empty($products)) {
            foreach ($products["products"] as $index => &$product) {
                $product->sell_price = $this->Product_Price_model->getLastPrice($product->product_id);
                //TODO remove products if sell_price is zero
//                if ($product->sell_price === 0) {
//                    unset($products['products'][$index]);
//                }
            }
        }
        $this->template(new ViewResponse("enduser", "Pages/products", "محصولات", ["products" => $products]));
    }

    public function products()
    {
        $categoryID = intval($this->input->get("c", true));
        $categoryID = ($categoryID === 0) ? null : $categoryID;
        $SubCategoryID = intval($this->input->get("sc", true));
        $SubCategoryID = ($SubCategoryID === 0) ? null : $SubCategoryID;
        $sort = $this->input->get("sort", true);
        $search = $this->input->get("search", true);

        $this->load->model(["Product_model", "Category_model", "Product_Price_model"]);
        $category = $this->Category_model->getCategoryById($categoryID);
        $products = $this->Product_model->getProducts(false, addslashes($search), addslashes($sort), $categoryID, $SubCategoryID);
        if (!empty($products)) {
            foreach ($products["products"] as $index => &$product) {
                $product->sell_price = $this->Product_Price_model->getLastPrice($product->product_id);
                //TODO remove products if sell_price is zero
//                if ($product->sell_price === 0) {
//                    unset($products['products'][$index]);
//                }
            }
        }

        $this->template(new ViewResponse("enduser", "Pages/products", "محصولات", ["products" => $products, "category" => $category]));
    }

    public function categories()
    {
        $category_id = $this->input->get("c", true);
        $this->load->model("Category_model");
        if (isset($category_id)) {
            $categories = $this->Category_model->getSubCategories($category_id);
        } else {
            $categories = $this->Category_model->getCategories();
        }
        $this->template(new ViewResponse("enduser", "Pages/categories", "دسته بندی ها", ["categories" => $categories]));
    }

    function subCategories($c_id = null)
    {
        if (!isset($c_id)) {
            show_404();
        }

        $this->load->model("Category_model");
        $category = $this->Category_model->getCategoryById($c_id);

        $subCategories = $this->Category_model->getSubCategories($c_id);
        if (empty($subCategories)) {
            show_404();
        }

        $this->template(new ViewResponse("enduser", "Pages/subCategory", $category->title, ["subCategories" => $subCategories]));
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
