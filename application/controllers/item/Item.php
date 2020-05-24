<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Item extends CI_Controller {

    public function index()
    {
        $this->load->view('header');
        $this->load->view('item/item');
        $this->load->view('footer');
    }
    public function create_item()
    {
        $new_item = array(
            'category'=> $this->input->post('category'),
            'brand'   => $this->input->post('brand'),
            'name'    => $this->input->post('name'),
            'price'   => $this->input->post('price'),
            'exp_date'=> $this->input->post('exp_date'),
            'quantity'=> $this->input->post('quantity'),
        );
        var_dump($new_item);
    }
}