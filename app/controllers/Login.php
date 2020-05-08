<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller
{
    public function index()
    {
        if (isset($_SESSION["user_info"])){
            redirect(base_url("panel"));
        }else{
            $this->load->view("login");
        }
    }

    function checkUser()
    {
        $this->form_validation->set_rules("mobileNumber", null, 'required|integer');
        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata("form_error", validation_errors());
            $this->redirectBackward();
        }


        $this->load->model("User_model");
        $mobile_number = $this->input->post("mobileNumber", true);
        $result = $this->User_model->getUserDataByMobileNumber($mobile_number, ["type" => "admin"]);
        if (!empty($result)) {
            $this->session->set_userdata("user_info", $result);
            redirect(base_url("panel"));
        } else {
            $this->session->set_flashdata("error", "خطایی رخ داده است لطفا دوباره تلاش کنید");
            $this->redirectBackward();
        }
    }

    function logout()
    {
        $this->session->unset_userdata("user_info");
        $this->redirectBackward();
    }
}
