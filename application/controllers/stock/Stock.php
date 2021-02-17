<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stock extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if(!$this->session->userdata('name')) {
            redirect(redirect('login/login'));
        }
        $this->load->model('StockModel');
        $this->load->model('ItemModel');
    }

    public function index()
    {
        $data = array(
            'stocks' => $this->StockModel->select(),
            'items' => $this->ItemModel->select(),
        );

        $this->load->view('header');
        $this->load->view('stock/stock', $data);
        $this->load->view('footer');
    }
}