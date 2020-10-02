<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('OrderModel');
        $this->load->model('PatientModel');
    }

    public function index()
    {
        $data = array(
            'orders'   => $this->OrderModel->select(),
        );

        $this->load->view('header');
        $this->load->view('kitchen/order', $data);
        $this->load->view('footer');
    }


}