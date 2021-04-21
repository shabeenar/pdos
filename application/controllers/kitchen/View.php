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

    public function confirm_order(){
        $order_id = $this->input->post('id');


        $data = $this->input->post('confirm_order_date');


        $confirm = $this->OrderModel->confirm_order($order_id,$data);



        if ($confirm){
            $alert = array(
                'type' =>"warning",
                'message' =>"Order Confirmed",
            );
            $this->session->set_flashdata('alert',$alert);
            redirect('kitchen/View?id='.$order_id);

        }
    }

    public function cancel_order(){
        $order_id = $this->input->post('id');
        $result = $this->OrderModel->cancel_order($order_id);
        if($result){
            redirect('kitchen/View?id='.$order_id);
        }
    }

}