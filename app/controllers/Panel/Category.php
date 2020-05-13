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

    public function index()
    {
        $categories = $this->Category_model->getCategories();
        $data = new ViewResponse("panel", "manage_category", 'مدیریت دسته بندی ها', $categories);
        $this->template($data);
    }

    public function store()
    {
        $this->form_validation->set_rules("title", '', "required");
        if ($this->form_validation->run() === false) {
            $this->redirectBackward();
        }

        $this->Category_model->newCategory(array(
            "title" => $this->input->post("title", true),
            "description" => $this->input->post("description", true),
        ));
        return $this->redirectBackward();
    }

    public function update()
    {
        $this->form_validation->set_rules("id", '', "required");
        $this->form_validation->set_rules("title", '', "required");
        $this->form_validation->set_rules("description", '', "required");
        if ($this->form_validation->run() === false) {
            $this->redirectBackward();
        }

        $id = $this->input->post("id", true);
        $this->Category_model->updateCategory($id, array(
            "title" => $this->input->post("title", true),
            "description" => $this->input->post("description", true),
        ));
        return $this->redirectBackward();
    }

    public function delete($id = null)
    {
        if (!isset($id)) {
            $this->redirectBackward();
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
        $this->load->model("Product_model");

        $products = $this->Product_model->getSubCategoryProducts($id, $search);
        $this->template(new ViewResponse("panel", 'sub_category_products', 'محصولات', ["products" => $products]));
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
