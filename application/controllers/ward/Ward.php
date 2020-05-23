<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ward extends CI_Controller {

    public function index()
    {
        $this->load->view('header');
        $this->load->view('ward/ward');
        $this->load->view('footer');
    }
}