<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends MY_Controller
{
    protected $user_id = null;

    function __construct()
    {
        parent::__construct();
        $userData = $this->session->get_userdata();
        if (!isset($userData["admin_info"])) {
            redirect(base_url("panel/login"));
        }
        $userData = $userData["admin_info"];
        $this->user_id = $userData->id;
    }

    function index()
    {
        $this->load->model('Product_model');
        $total_products = $this->Product_model->totalCount();
        $response["total_active_products"] = $total_products;
        $data = new ViewResponse("panel", "home", 'داشبورد', $response);
        $this->template($data);
    }

    function response($status, $error_code = null, $data = null)
    {
        $response = new stdClass();
        $response->success = $status;
        $response->error_code = $error_code;
        $response->data = $data;
        exit(json_encode($response));
    }

}