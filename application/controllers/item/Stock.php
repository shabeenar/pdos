<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stock extends CI_Controller {

    public function index()
    {
        $this->load->view('header');
        $this->load->view('item/stock');
        $this->load->view('footer');
    }
}