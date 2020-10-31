<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if(!$this->session->userdata('name')) {
            redirect(redirect('login/login'));
        }
        $this->load->model('OrderModel');
        $this->load->model('CreateOrderModel');
    }

    public function index()
    {
        $data = array(
            'orders'   => $this->CreateOrderModel->select(),
        );

        $this->load->view('header');
        $this->load->view('kitchen/order', $data);
        $this->load->view('footer');
    }


}