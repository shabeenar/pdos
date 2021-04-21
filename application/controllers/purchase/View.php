<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class View extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if(!$this->session->userdata('name')) {
            redirect(redirect('login/login'));
        }
        $this->load->model('PurchaseModel');
    }

    public function index()
    {
        $id = $this->input->get('id');
        $data = array(
            'purchases' => $this->PurchaseModel->mainlines($id),
            'purchase_lines' => $this->PurchaseModel->lines($id),
        );


        $this->load->view('header');
        $this->load->view('purchase/view', $data);
        $this->load->view('footer');
    }



    public function addtostock(){
        $po_id = $this->input->post('id');

        $result = $this->PurchaseModel->get_purchases($po_id);

        foreach ($result as $result){
            $this->PurchaseModel->update_quantity($result->quantity,$result->item_id);
        }

        $data = array(
            'confirm_date'   => $this->input->post('confirm_order_date'),
            'status' => '2',
        );

        $recieved_quantity=$this->PurchaseModel->confirm_po($po_id,$data);



        if ($recieved_quantity){
            $alert = array(
                'type' =>"warning",
                'message' =>"Added to stock",
            );
            $this->session->set_flashdata('alert',$alert);
            redirect('purchase/View?id='.$po_id);

        }

    }

    public function cancel_po(){
        $po_id = $this->input->post('id');
        $result = $this->PurchaseModel->cancel_po($po_id);
        if($result){
            redirect('purchase/View?id='.$po_id);
        }
    }




}