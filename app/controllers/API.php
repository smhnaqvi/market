<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class API extends My_Controller
{
    public function __construct()
    {
        parent::__construct();
        header('Access-Control-Allow-Origin: *');
    }

    function response(bool $success, array $error = null, array $data = null)
    {
        $response = new stdClass;
        $response->success = $success;
        $response->errors = $error;
        $response->data = $data;
        exit(json_encode($response));
    }

    function getBasket()
    {
        $this->load->library("cart");
        $data = [
            "items" => $this->cart->contents(),
            "total_price" => $this->cart->total(),
            "total_items" => count($this->cart->contents())
        ];
        $this->response(true, null, $data);
    }

    function addItemBasket()
    {
        $this->load->library("cart");
        $this->form_validation->set_rules("id", 'id', "required|integer");
        $this->form_validation->set_rules("qty", 'qty', "required|integer");
        $this->form_validation->set_rules("price", 'price', "required|integer");
        $this->form_validation->set_rules("title", 'title', "required");
        $this->form_validation->set_rules("cover", 'title', "required");
        $data = array(
            'id' => $this->input->post("id"),
            'qty' => $this->input->post("qty"),
            'price' => $this->input->post("price"),
            'name' => $this->input->post("title"),
            'cover' => $this->input->post("cover"),
        );
        $this->load->library("cart");
        foreach ($this->cart->contents() as $item) {
            if ((int)$item["id"] === (int)$data["id"]) {
                $data["rowid"] = $item["rowid"];
                if ($this->cart->update($data)) {
                    $this->response(true);
                }
                $this->response(false);
            }
        }
        if ($this->cart->insert($data)) {
            $this->response(true);
        }
        $this->response(false);
    }

    function removeItemBasket()
    {
        $this->load->library("cart");
        $rowId = $this->input->get("rowId");
        if (!isset($rowId)) {
            $this->response(false, [["code" => 14004, "message" => "برای حذف باید شناسه محصول را ارسال کنید"]]);
        }
        if ($this->cart->remove($rowId)) {
            $this->response(true);
        }
        $this->response(false, [["code" => 14005, "message" => "خطایی در حذف بوجود آمده است. دوباره تلاش کنید"]]);
    }

}