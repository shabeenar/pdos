<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Purchase extends CI_Controller {

    public function index()
    {
        $this->load->view('header');
        $this->load->view('purchase/purchase');
        $this->load->view('footer');
    }
}