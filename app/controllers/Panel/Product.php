<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require_once "Main.php";

class Product extends Main
{

    function __construct()
    {
        parent::__construct();
        $this->load->model("Product_model");
    }

    public function index()
    {
        $this->load->model("Category_model");
        $categories = $this->Category_model->getCategories();
        $products = $this->Product_model->getProducts();
        $data = new ViewResponse("panel", "manage_products", 'مدیریت محصولات ها', ["products" => $products, "categories" => $categories]);
        $this->template($data);
    }

    public function store()
    {


        $fileInput = "cover";
        if (isset($_FILES["$fileInput"])) {
            $_POST["$fileInput"] = true;
        }

        $this->form_validation->set_rules("name", '', "required");
        $this->form_validation->set_rules("category_id", '', "required|integer");
        $this->form_validation->set_rules("subcategory_id", '', "required|integer");
        $this->form_validation->set_rules("$fileInput", '', "required");
        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata("form_error", validation_errors());
            $this->redirectBackward();
        }

        $productCover = $this->uploadImage($fileInput, "products");
        if ($productCover === false) {
            $this->session->set_flashdata("form_error", "حطایی در آپلود عکس بوجود آمده است");
            $this->redirectBackward();
        }

        $description = $this->input->post("description", true);
        $data = array(
            "name" => $this->input->post("name", true),
            "description" => (isset($description)) ? $description : 'null',
            "user_id" => $this->user_id,
            "cover" => $productCover,
        );
        $insertingResult = $this->Product_model->newProduct($data);
        if ($insertingResult === false) {
            $this->session->set_flashdata("error", "حطایی در اینجاد محصول بوجود آمده است");
        } else {
            $this->load->model("Product_Category_model");
            $category_id = $this->input->post("category_id", true);
            $subcategory_id = $this->input->post("subcategory_id", true);

            $this->Product_Category_model->store(array(
                "product_id" => $insertingResult,
                "category_id" => $category_id,
                "subcategory_id" => $subcategory_id,
            ));
            $this->session->set_flashdata("success", "محصول با موفقیت اضافه شد.");
        }
        return $this->redirectBackward();
    }

    public function update()
    {
        /** TODO update product */
        $this->form_validation->set_rules("id", '', "required");
        $this->form_validation->set_rules("name", '', "required");
        $this->form_validation->set_rules("sell_type", '', "required");
        $this->form_validation->set_rules("price", '', "required");
        $this->form_validation->set_rules("cover", '', "required");
        if ($this->form_validation->run() === false) {
            return $this->redirectBackward();
        }

        $id = $this->input->post("id", true);
        $data["name"] = $this->input->post("name", true);
        $data["sell_type"] = $this->input->post("sell_type", true);
        $data["cover"] = $this->input->post("cover", true);

        $this->Product_model->updateProduct($id, $data);

        $price = $this->input->post("price", true);
        $this->Product_Price_model->updatePrice($id, $price);

        return $this->redirectBackward();
    }

    public function delete()
    {
        $id = $this->input->get("id", true);
        if (!isset($id)) {
            $this->redirectBackward();
        }

        $this->Category_model->removeCategory($id);
        $this->redirectBackward();
    }

}
