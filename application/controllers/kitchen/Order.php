<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if(($this->session->userdata('role_id')==5 ) OR ($this->session->userdata('role_id')==2 ) OR ($this->session->userdata('role_id')==3 ) ) {
            if(!$this->session->userdata('name')) {
                redirect(redirect('login/login'));
            }

        $this->load->model('OrderModel');

        } else{
            $this->session->set_flashdata('access_alert', array('access_alert' => false));
            redirect('login/Login');
        }
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