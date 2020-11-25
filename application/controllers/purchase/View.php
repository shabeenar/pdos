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
        $id = $this->input->post('id');
        $confirm_date = $this->input->post('confirm_order_date');
        $result = $this->ViewModel->addtostock($id, $confirm_date);

        if ($result){
            $alert = array(
                'type' =>"warning",
                'message' =>"added successfully",
            );
            $this->session->set_flashdata('alert',$alert);
            redirect("purchase/View");
        }
    }



}