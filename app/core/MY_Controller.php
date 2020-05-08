<?php
require_once "app/libraries/ViewResponse.php";

class MY_Controller extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
    }

    public function uploadImage($input, $folder)
    {
        $fileInputName = $input;
        if (!isset($_FILES["$fileInputName"]) or $_FILES["$fileInputName"]["error"] !== 0) {
            return false;
        }

        /** get uploading image file */
        $this->load->model("Upload_model");
        $imageData = $this->Upload_model->uploading($fileInputName, $folder);
        return ($imageData === false) ? false : $imageData["file_name"];
    }

    protected function redirectBackward()
    {
        redirect($this->input->server("HTTP_REFERER"));
    }


    protected function template(ViewResponse $data)
    {
        $data = $data->getObject();
        $this->load->view("$data->dir/includes/header", $data);
        $this->load->view("$data->dir/includes/menu");
        $this->load->view("$data->dir/$data->page");
        $this->load->view("$data->dir/includes/footer");
    }

}