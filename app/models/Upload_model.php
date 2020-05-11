<?php

class Upload_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->library("upload");
    }

    public function uploading($fileInput, $folder)
    {
        $dir = "upload/$folder";

        if (!is_dir("$dir")) {
            mkdir("$dir");
        }

        if (!isset($_FILES[$fileInput])) {
            return false;
        }

        $config['upload_path'] = "$dir";
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['max_size'] = '3000';
        $config['encrypt_name'] = true;
        $this->upload->initialize($config);
        if ($this->upload->do_upload($fileInput) === true) {
            /** upload success */
            return $this->upload->data();
        }
        /** Check error upload */
        return false;
    }

    public function removeCover($fileName, $from)
    {
        return unlink("upload/$from/$fileName");
    }
}