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
        $search = $this->input->get("search");
        $products = $this->Product_model->getProducts($search);
        $data = new ViewResponse("panel", "manage_products", 'مدیریت محصولات ها', ["products" => $products, "categories" => $categories]);
        $this->template($data);
    }

    public function editProduct($id = null)
    {
        if (!isset($id)) $this->redirectBackward();
        $product = $this->Product_model->getProduct($id);
        if (empty($product)) $this->redirectBackward();
        $product = $product[0];

        $this->load->model("Category_model");
        $categories = $this->Category_model->getCategories();

        $this->template(new ViewResponse("panel", "edit_products", "ویرایش محصول ($product->name)", ["product" => $product, "categories" => $categories]));
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
            $this->session->set_flashdata("error", "خطایی در اینجاد محصول بوجود آمده است");
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


        $this->form_validation->set_rules("id", '', "required|integer");
        $this->form_validation->set_rules("name", '', "required");
        $this->form_validation->set_rules("category_id", '', "required|integer");
        $this->form_validation->set_rules("subcategory_id", '', "required|integer");
        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata("form_error", validation_errors());
            $this->redirectBackward();
        }

        $fileInput = "cover";
        $productCover = null;
        /** if product new cover is exist we should upload that cover */
        if (isset($_FILES["$fileInput"]) and !empty($_FILES["$fileInput"]["name"]) and $_FILES["$fileInput"]["error"] === 0) {
            $productCover = $this->uploadImage($fileInput, "products");
            if ($productCover === false) {
                $this->session->set_flashdata("form_error", "خطایی در آپلود عکس بوجود آمده است");
                $this->redirectBackward();
            }
        }

        $id = $this->input->post("id", true);
        $data = array(
            "name" => $this->input->post("name", true),
            "description" => $this->input->post("description", true),
        );

        /** if product cove is changed update cover name on the database */
        if (isset($productCover)) {
            $data["cover"] = $productCover;
            $fileName = $this->Product_model->getProductCover($id);
            $removing = $this->Upload_model->removeCover($fileName, "products");
            if (!$removing) {
                $this->session->set_flashdata("error", "خطایی در حذف عکس بوجود آمده است");
                return $this->redirectBackward();
            }

        }

        $updatingResult = $this->Product_model->updateProduct($id, $data);
        if ($updatingResult === false) {
            $this->session->set_flashdata("error", "خطایی در ویرایش محصول بوجود آمده است");
        } else {
            $this->load->model("Product_Category_model");
            $category_id = $this->input->post("category_id", true);
            $subcategory_id = $this->input->post("subcategory_id", true);

            $this->Product_Category_model->replace(array(
                "product_id" => $id,
                "category_id" => $category_id,
                "subcategory_id" => $subcategory_id,
            ));
            $this->session->set_flashdata("success", "محصول با موفقیت بروزرسانی شد.");
        }
        return $this->redirectBackward();
    }

    public function delete($id = null)
    {
        if (!isset($id)) {
            $this->redirectBackward();
        }
        $this->Product_model->delete($id);
        $this->redirectBackward();
    }

}
