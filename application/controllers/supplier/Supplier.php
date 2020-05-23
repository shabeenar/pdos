<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Supplier extends CI_Controller {

    public function index()
    {
        $this->load->view('header');
        $this->load->view('supplier/supplier');
        $this->load->view('footer');
    }
    public function create_supplier()
    {
        $new_supplier = array(
            'name'   => $this->input->post('name'),
            'phone'  => $this->input->post('phone'),
            'email'  => $this->input->post('email'),
            'address'=> $this->input->post('address'),
        );
        var_dump($new_supplier);
    }
}