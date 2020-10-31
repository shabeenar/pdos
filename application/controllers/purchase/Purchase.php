<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Purchase extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if(!$this->session->userdata('name')) {
            redirect(redirect('login/login'));
        }
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

    public function create_purchase(){
        $purchase = array(
            'supplier_id' => $this->input->post('supplier'),
            'date' => $this->input->post('date'),
            'total_price' => $this->input->post('total_amount'),
        );
        $purchase_id = $this->PurchaseModel->create($purchase);

        $purchase_lines = array();
        $lines = array();

        for ($i = 0; $i < count($this->input->post('purchase_product')); $i++) {
            $lines['purchase_id'] = $purchase_id;
            $lines['item_id'] = $this->input->post('purchase_product')[$i];
            $lines['price'] = $this->input->post('purchase_price')[$i];
            $lines['quantity'] = $this->input->post('purchase_qty')[$i];
            $lines['unit_id'] = $this->input->post('purchase_uom_id')[$i];
            $lines['sub_total'] = $this->input->post('purchase_total')[$i];
            array_push($purchase_lines,$lines);
        }

        $result = $this->PurchaseModel->create_purchase($purchase_lines, $purchase_id);
        redirect('purchase/View?id='.$purchase_id);
    }
}