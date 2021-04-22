<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ViewPurchase extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if(($this->session->userdata('role_id')==5 ) OR ($this->session->userdata('role_id')==4 )) {
            if(!$this->session->userdata('name')) {
                redirect(redirect('login/login'));
            }

        $this->load->model('PurchaseModel');

        } else{
            $this->session->set_flashdata('access_alert', array('access_alert' => false));
            redirect('login/Login');
        }
    }

    public function index()
    {
        $data = array(
            'purchases' => $this->PurchaseModel->select(),
        );

        $this->load->view('header');
        $this->load->view('purchase/viewpurchase', $data);
        $this->load->view('footer');
    }

}