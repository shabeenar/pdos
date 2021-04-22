<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Purchase extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if(($this->session->userdata('role_id')==5 ) OR ($this->session->userdata('role_id')==4 )) {
            if(!$this->session->userdata('name')) {
                redirect(redirect('login/login'));
            }

        $this->load->model('PurchaseModel');
        $this->load->model('SupplierModel');
        $this->load->model('ItemModel');

        } else{
            $this->session->set_flashdata('access_alert', array('access_alert' => false));
            redirect('login/Login');
        }
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

    public function form_validations(){

        $this->form_validation->set_rules('supplier', 'Supplier Name', 'required');
        $this->form_validation->set_rules('date', 'Date', 'required');
        $this->form_validation->set_rules('total_amount', 'Total Amount', 'required|decimal|numeric');

        if ($this->form_validation->run() == FALSE)
        {
            $result = array(
                'error' => true,
                'messages' => validation_errors(),
            );
            echo json_encode($result);
        }
        else
        {
            $result = array(
                'error' => false,
                'messages' => "",
            );
            echo json_encode($result);
        }
    }

    public function create_purchase(){
        $purchase = array(
            'supplier_id' => $this->input->post('supplier'),
            'date' => $this->input->post('date'),
            'total_price' => $this->input->post('total_amount'),
        );

        $this->form_validation->set_rules('supplier', 'Supplier Name', 'required');
        $this->form_validation->set_rules('date', 'Date', 'required');
        $this->form_validation->set_rules('total_amount', 'Total Amount', 'required|decimal|numeric');

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

        if ($result == true) {
            redirect('purchase/viewpurchase');
        }else if ($result == false) {
            redirect('purchase/purchase');
        }


//        redirect('purchase/View?id='.$purchase_id);
    }


}