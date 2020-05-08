<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends My_Controller
{

    function __construct()
    {
        parent::__construct();
    }

    function index(){
        echo "enduser Main";
    }

}