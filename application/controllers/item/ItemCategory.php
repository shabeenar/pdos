<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ItemCategory extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('ItemCategoryModel');
    }


    public function index()
    {
        $data = array(
            'itemcategories' => $this->ItemCategoryModel->select(),
        );

        $this->load->view('header');
        $this->load->view('item/itemcategory', $data);
        $this->load->view('footer');
    }

    public function create_itemcategory()
    {
        $new_itemcategory = array(
            'code'=> $this->input->post('code'),
            'name'=> $this->input->post('name'),
        );

        $result = $this->ItemCategoryModel->create($new_itemcategory);
        if ($result){
            $alert = array(
                'type' => "success",
                'message' => "Item Category successfully added",
            );

            $this->session->set_flashdata('alert',$alert);
            redirect("item/ItemCategory");
        }

    }
}