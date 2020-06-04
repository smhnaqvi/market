<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends My_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model("Order_model");
    }

    function newRequest()
    {
        $this->form_validation->set_rules("firstName", "firstName", "required|trim");
        $this->form_validation->set_rules("lastName", "lastName", "required|trim");
        $this->form_validation->set_rules("mobileNumber", "mobileNumber", "required|exact_length[11])");
        $this->form_validation->set_rules("address", "address", "required|trim");

        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata("form_error", validation_errors());
            $this->redirectBackward();
        }

        $firstName = $this->input->post("firstName", true);
        $lastName = $this->input->post("lastName", true);
        $mobileNumber = $this->input->post("mobileNumber", true);
        $address = $this->input->post("address", true);


        $this->load->model(array("User_model", "Basket_model"));
        $this->load->library("cart");

        $userData = $this->User_model->getUserDataByMobileNumber($mobileNumber);
        if (!empty($userData)) {
            //user is exist
            $userID = $userData->id;
        } else {
//            //ne/w user
            $userID = $this->User_model->register($firstName, $lastName, $mobileNumber);
        }

        if ($userID === 0) {
            $this->session->set_flashdata("error", "حطایی در ثبت کاربر بوجود آمده است");
            $this->redirectBackward();
        }

        $this->db->trans_start();
        $orderID = $this->Order_model->new(array(
            "user_id" => $userID,
            "address" => $address,
        ));

        if ($orderID === 0) {
            $this->session->set_flashdata("error", "حطایی در ثبت سفارش بوجود آمده است");
            $this->redirectBackward();
        }

        $cartData = $this->cart->contents();
        $basketData = array();
        foreach ($cartData as $item) {
            $basketData[] = array(
                "order_id" => $orderID,
                "product_id" => $item['id'],
                "price_id" => 0,
                "count" => $item["qty"]
            );
        }

        $result = $this->Basket_model->registerOrder($basketData);
        $this->db->trans_complete();
        if ($this->db->trans_status() and $result) {
            $this->db->trans_commit();
            $this->session->set_flashdata("success", "سفارش با موفقیت ثبت شد");
            $this->cart->destroy();
            $this->redirectBackward();
        } else {
            $this->session->set_flashdata("success", "سفارش ثبت نشد");
            $this->db->trans_rollback();
            $this->redirectBackward();
        }

    }
}