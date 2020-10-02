<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Purchase extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('PurchaseModel');
        $this->load->model('SupplierModel');
        $this->load->model('ItemModel');
    }

    public function index()
    {
        $data = array(
            'purchases' => $this->PurchaseModel->select(),
            'suppliers' => $this->SupplierModel->select(),
        );

        $this->load->view('header');
        $this->load->view('purchase/purchase', $data);
        $this->load->view('footer');
    }

    public function generate_purchase_line(){
        $products = $this->ItemModel->select();

        $row = '<option selected disabled>Select Product</option>';
        foreach($products as $product) {
            $row .= '<option value="'.$product->id.'">'.$product->name.'</option>';
        }
        echo $row;
    }

    public function get_single_product(){
        $id = $this->input->post('id');
        $result = $this->ItemModel->get_single_product($id);
        echo json_encode($result);

    }
}