<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Item extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('ItemModel');
        $this->load->model('ItemCategoryModel');
        $this->load->model('UnitModel');
    }

    public function index()
    {
        $data = array(
            'items'     => $this->ItemModel->select(),
            'categories'=> $this->ItemCategoryModel->select(),
            'units'     => $this->UnitModel->select(),
        );

        $this->load->view('header');
        $this->load->view('item/item', $data);
        $this->load->view('footer');
    }

    public function create_item()
    {
        $new_item = array(
            'item_category_id' => $this->input->post('category'),
            'name' => $this->input->post('name'),
            'unit_id' => $this->input->post('unit'),
            'quantity' => $this->input->post('quantity'),
            'price' => $this->input->post('price'),
            'exp_date' => $this->input->post('exp_date'),
        );

        $result = $this->ItemModel->create($new_item);
        if ($result) {
            $alert = array(
                'type' => "success",
                'message' => "Item successfully added",
            );

            $this->session->set_flashdata('alert', $alert);
            redirect("item/Item");
        }



    }
}