<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once "Main.php";

class Market extends Main
{

    function __construct()
    {
        parent::__construct();
        $this->load->model("Market_model");
    }

    function index()
    {
        $markets = $this->Market_model->getMarkets();
        $data = new ViewResponse("panel", "manage_markets", 'مدیریت مغازه ها', ["markets" => $markets]);
        $this->template($data);
    }

    function marketProducts($id = null)
    {
        if (!isset($id)) $this->redirectBackward();
        $this->load->model("Product_Price_model");
        $market_products = $this->Product_Price_model->getMarketProducts($id);
        $data = [];
        foreach ($market_products as $market_product) {
            if (!isset($data[$market_product->product_id])) {
                $data[$market_product->product_id] = $market_product;
            }
        }
        $market_products = $data;
        $this->load->model("Product_model");
        $products = $this->Product_model->getProducts();
        $market = $this->Market_model->getMarket($id)[0];
        $data = new ViewResponse("panel", "manage_market_products", 'مدیریت محصولات مغازه', ["market" => $market, "market_products" => $market_products, "products" => $products]);
        $this->template($data);
    }

    public function store()
    {
        $this->form_validation->set_rules("name", '', "required");
        $this->form_validation->set_rules("owner_name", '', "required");
        $this->form_validation->set_rules("address", '', "required");
        $this->form_validation->set_rules("phone_number", '', "required|integer");
        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata("form_error", validation_errors());
            $this->redirectBackward();
        }

        $insertingResult = $this->Market_model->newMarket(array(
            "name" => $this->input->post("name", true),
            "owner_name" => $this->input->post("owner_name", true),
            "address" => $this->input->post("address", true),
            "phone_number" => $this->input->post("phone_number", true),
            "user_id" => $this->user_id,
        ));

        if ($insertingResult === false) {
            $this->session->set_flashdata("error", "خطایی در اینجاد مغازه جدید بوجود آمده است");
        } else {
            $this->session->set_flashdata("success", "مغازه جدید با موفقیت اضافه شد.");
        }
        return $this->redirectBackward();
    }

    public function assignProduct()
    {

        $this->form_validation->set_rules("market_id", '', "required|integer");
        $this->form_validation->set_rules("product_id", '', "required|integer");
        $this->form_validation->set_rules("product_price", '', "required|integer");
        $this->form_validation->set_rules("product_sell_price", '', "required|integer");
        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata("form_error", validation_errors());
            $this->redirectBackward();
        }
        $id = $this->input->post("market_id", true);
        $market = $this->Market_model->getMarket($id);
        if (empty($market)) {
            $this->session->set_flashdata("form_error", "چنین مغازه ای وجود ندارد");
            $this->redirectBackward();
        }

        $product_id = $this->input->post("product_id", true);
        $product_price = $this->input->post("product_price", true);
        $product_sell_price = $this->input->post("product_sell_price", true);
        $this->load->model("Product_Price_model");
        $insertingResult = $this->Product_Price_model->setNewPrice($product_id, $id, $product_price, $product_sell_price);
        if ($insertingResult === false) {
            $this->session->set_flashdata("error", "خطایی در ثبت محصول برای مغازه بوجود آمده است");
        } else {
            $this->session->set_flashdata("success", "قیمت محصول با موفقیت ثبت شد.");
        }
        return $this->redirectBackward();
    }


    function activation($id = null)
    {
        if (!isset($id)) $this->redirectBackward();
        $state = $this->input->get("state", true);
        if (!isset($state) or !in_array($state, [1, 0])) $this->redirectBackward();

        $changingResult = $this->Market_model->changeActivationState($id, $state);
        $message = ($state === '1') ? "فعال سازی" : "غیر فعال سازی";
        if ($changingResult === false) {
            $this->session->set_flashdata("error", "خطایی در عملیات $message بوجود آمده است. نجددا تلاش کنید");
        } else {
            $this->session->set_flashdata("success", "$message سوپر مارکت با موفقیت انجام شد");
        }
        return $this->redirectBackward();
    }


}