<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class View extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if(!$this->session->userdata('name')) {
            redirect(redirect('login/login'));
        }
        $this->load->model('OrderModel');
    }

    public function index()
    {
        $id = $this->input->get('id');
        $data = array(
            'orders' => $this->OrderModel->mainlines($id),
            'order_lines' => $this->OrderModel->lines($id),
        );

        $this->load->view('header');
        $this->load->view('kitchen/view', $data);
        $this->load->view('footer');
    }

}