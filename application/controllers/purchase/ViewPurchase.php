<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ViewPurchase extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if(!$this->session->userdata('name')) {
            redirect(redirect('login/login'));
        }
        $this->load->model('ViewPurchaseModel');
    }

    public function index()
    {
        $data = array(
            'purchases' => $this->ViewPurchaseModel->select(),
        );

        $this->load->view('header');
        $this->load->view('purchase/viewpurchase', $data);
        $this->load->view('footer');
    }

}