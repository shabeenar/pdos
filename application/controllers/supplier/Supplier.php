<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Supplier extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('SupplierModel');
    }

    public function index()
    {
        $data = array(
            'suppliers' => $this->SupplierModel->select(),
        );

        $this->load->view('header');
        $this->load->view('supplier/supplier', $data);
        $this->load->view('footer');
    }

    public function create_supplier()
    {
        $new_supplier = array(
            'name'      => $this->input->post('name'),
            'phone'     => $this->input->post('phone'),
            'email'     => $this->input->post('email'),
            'street'    => $this->input->post('street'),
            'street_two'=> $this->input->post('street_two'),
            'city'      => $this->input->post('city'),
            'district'  => $this->input->post('district'),
            'province'  => $this->input->post('province'),
        );

        $result = $this->SupplierModel->create($new_supplier);
        if ($result){
            $alert = array(
                'type' => "success",
                'message' => "Supplier successfully added",
            );

            $this->session->set_flashdata('alert',$alert);
            redirect("supplier/Supplier");
        }
    }
}