<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends CI_Controller {

    public function index()
    {
        $this->load->view('header');
        $this->load->view('order/order');
        $this->load->view('footer');
    }
    public function create_order()
    {
        $new_order = array(
            'date'            => $this->input->post('date'),
            'name'            => $this->input->post('patient_name'),
            'ward'            => $this->input->post('ward'),
            'bed'             => $this->input->post('bed'),
            'patient_category'=> $this->input->post('patient_category'),
            'dinner'          => $this->input->post('dinner'),
            'breakfast'       => $this->input->post('breakfast'),
            'lunch'           => $this->input->post('lunch'),
        );
        var_dump($new_order);
    }
}