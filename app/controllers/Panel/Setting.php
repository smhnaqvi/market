<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model("Setting_model");
    }

    public function index()
    {
        $response["home_slider"] = $this->Setting_model->getSetting("image", "slider", "home");
        $data = new ViewResponse("panel", "setting", 'تنظیمات', $response);
        $this->template($data);
    }

    public function uploadNewSlide()
    {
        $fileInput = "slide";
        if (isset($_FILES["$fileInput"])) {
            $_POST["$fileInput"] = true;
        }
        $this->form_validation->set_rules("$fileInput", '', "required");
        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata("form_error", validation_errors());
            $this->redirectBackward();
        }
        $productCover = $this->uploadImage($fileInput);
        if ($productCover === false) {
            $this->session->set_flashdata("form_error", "خطایی در آپلود اسلاید بوجود آمده است");
            $this->redirectBackward();
        }

        $result = $this->Setting_model->store("image", $productCover, "slider", "home");
        if ($result) {
            $this->session->set_flashdata("success", "اسلاید با موفقیت اضافه شد");
            $this->redirectBackward();
        }
        $this->session->set_flashdata("error", "خطایی در افرودن اسلاید بوجود آمده است");
        $this->redirectBackward();
    }

    public function removeSlide($id = null)
    {
        if (!isset($id)) {
            $this->redirectBackward();
        }

        $data = $this->Setting_model->getData($id);
        if (empty($data)) {
            $this->redirectBackward();
        }

        $this->load->model("Upload_model");
        $this->Upload_model->removeCover($data->value, "");
        $this->Setting_model->destroy($id);
        $this->redirectBackward();
    }
}