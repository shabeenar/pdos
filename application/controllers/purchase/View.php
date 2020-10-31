<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class View extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if(!$this->session->userdata('name')) {
            redirect(redirect('login/login'));
        }
        $this->load->model('ViewModel');
    }

    public function index()
    {
        $id = $this->input->get('id');
        $data = array(
            'purchases' => $this->ViewModel->mainlines($id),
            'purchase_lines' => $this->ViewModel->lines($id),
        );


        $this->load->view('header');
        $this->load->view('purchase/view', $data);
        $this->load->view('footer');
    }

    public function addtostock(){
        $id = $this->input->get('id');
        $result = $this->ViewModel->addtostock($id);

    }

}