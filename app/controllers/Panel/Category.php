<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require_once "Main.php";

class Category extends Main
{

    function __construct()
    {
        parent::__construct();
        $this->load->model("Category_model");
    }

    public function index($id = null)
    {
        $category = array();
        if (isset($id)) {
            $category = $this->Category_model->getCategoryById($id);
            if (empty($category)) {
                $this->redirectBackward();
            }
        }

        $categories = $this->Category_model->getCategories();
        $data = new ViewResponse("panel", "manage_category", 'مدیریت دسته بندی ها', ["categories" => $categories, "category" => $category]);
        $this->template($data);
    }

    public function store()
    {
        $fileInput = "cover";
        if (isset($_FILES["$fileInput"])) {
            $_POST["$fileInput"] = true;
        }


        $this->form_validation->set_rules("title", '', "required");
        $this->form_validation->set_rules("$fileInput", '', "required");
        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata("form_error", validation_errors());
            $this->redirectBackward();
        }

        $productCover = $this->uploadImage($fileInput, "category");
        if ($productCover === false) {
            $this->session->set_flashdata("form_error", "خطایی در آپلود عکس بوجود آمده است");
            $this->redirectBackward();
        }

        $this->Category_model->newCategory(array(
            "title" => $this->input->post("title", true),
            "description" => $this->input->post("description", true),
            "cover" => $productCover,
        ));
        return $this->redirectBackward();
    }

    public function update()
    {

        $this->form_validation->set_rules("id", '', "required");
        $this->form_validation->set_rules("title", '', "required");
        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata("form_error", validation_errors());
            $this->redirectBackward();
        }

        $fileInput = "cover";
        $productCover = null;
        /** if product new cover is exist we should upload that cover */
        if (isset($_FILES["$fileInput"]) and !empty($_FILES["$fileInput"]["name"]) and $_FILES["$fileInput"]["error"] === 0) {
            $productCover = $this->uploadImage($fileInput, "category");
            if ($productCover === false) {
                $this->session->set_flashdata("form_error", "خطایی در آپلود عکس بوجود آمده است");
                $this->redirectBackward();
            }
        }

        $id = $this->input->post("id", true);
        $data = array(
            "title" => $this->input->post("title", true),
            "description" => $this->input->post("description", true),
        );
        /** if product cove is changed update cover name on the database */
        if (isset($productCover)) {
            $data["cover"] = $productCover;
            $category = $this->Category_model->getCategoryById($id);
            if (!empty($category->cover)) {
                $removing = $this->Upload_model->removeCover($category->cover, "category");
                if (!$removing) {
                    $this->session->set_flashdata("error", "خطایی در حذف عکس بوجود آمده است");
                    return $this->redirectBackward();
                }
            }
        }

        $this->Category_model->updateCategory($id, $data);
        return $this->redirectBackward();
    }

    public function delete($id = null)
    {
        if (!isset($id)) {
            $this->redirectBackward();
        }
        $category = $this->Category_model->getCategoryById($id);
        if (!empty($category->cover)) {
            $this->load->model("Upload_model");
            $removing = $this->Upload_model->removeCover($category->cover, "category");
            if (!$removing) {
                $this->session->set_flashdata("error", "خطایی در حذف عکس بوجود آمده است");
                $this->redirectBackward();
            }
        }
        $this->Category_model->removeCategory($id);
        $this->redirectBackward();
    }

    /***** section manage sub categories ******/

    public function indexSubCategories($id = null)
    {
        if (!isset($id)) show_404();

        $categories = $this->Category_model->getSubCategories($id);
        $data = new ViewResponse("panel", "manage_sub_categories", 'مدیریت زیر دسته ها', ["category_id" => $id, "categories" => $categories]);
        $this->template($data);
    }

    public function storeSubCategory($id = null)
    {
        echo $id;
        if (!isset($id)) show_404();
        $this->form_validation->set_rules("title", '', "required");
        if ($this->form_validation->run() === false) {
            $this->redirectBackward();
        }

        $this->Category_model->newSubCategory(array(
            "category_id" => $id,
            "title" => $this->input->post("title", true),
        ));
        return $this->redirectBackward();
    }

    public function deleteSubCategory($id = null)
    {
        if (!isset($id)) {
            $this->redirectBackward();
        }

        $this->Category_model->removeSubCategory($id);
        $this->redirectBackward();
    }

    public function productsSubCategory($id = null)
    {
        if (!isset($id)) {
            $this->redirectBackward();
        }
        $search = $this->input->get("search", true);
        $this->load->model(["Product_model", "Market_model", "Product_Price_model"]);

        $markets = $this->Market_model->getMarkets(["is_deleted" => 0]);

        $products = $this->Product_model->getSubCategoryProducts($id, $search);
        if (!empty($products)) {
            foreach ($products as &$product) {
                $product->sell_price = $this->Product_Price_model->getLastPrice($product->product_id);
            }
        }
        $this->template(new ViewResponse("panel", 'sub_category_products', 'محصولات', ["products" => $products, "markets" => $markets]));
    }

    public function apiGetSubCategory()
    {
        $category_id = $this->input->get("category_id");
        if (!isset($category_id))
            $this->response(false, 404);

        $categories = $this->Category_model->getSubCategories($category_id);
        $this->response(true, null, ["subCategories" => $categories]);
    }
}
