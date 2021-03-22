<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Item extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if(!$this->session->userdata('name')) {
            redirect(redirect('login/login'));
        }
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

    public function form_validations(){

        $this->form_validation->set_rules('category', 'Category Name', 'required');
        $this->form_validation->set_rules('name', 'Item name', 'trim|required|alpha|max_length[20]');
        $this->form_validation->set_rules('unit', 'Unit name', 'required');
        $this->form_validation->set_rules('quantity', 'Quantity', 'required|numeric');
        $this->form_validation->set_rules('price', 'Price', 'required|decimal|numeric');


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

    public function create_item()
    {
        $this->form_validation->set_rules('category', 'Category Name', 'required');
        $this->form_validation->set_rules('name', 'Item name', 'trim|required|alpha|max_length[20]');
        $this->form_validation->set_rules('unit', 'Unit name', 'required');
        $this->form_validation->set_rules('quantity', 'Quantity', 'required|numeric');
        $this->form_validation->set_rules('price', 'Price', 'required|decimal|numeric');


        $new_item = array(
            'item_category_id'=> $this->input->post('category'),
            'name'            => $this->input->post('name'),
            'unit_id'         => $this->input->post('unit'),
            'quantity'        => $this->input->post('quantity'),
            'price'           => $this->input->post('price'),
            'exp_date'        => $this->input->post('exp_date'),
        );



        $result = $this->ItemModel->create($new_item);
        if ($result) {
            $alert = array(
                'type'   => "success",
                'message'=> "Item successfully added",
            );

            $this->session->set_flashdata('alert', $alert);
            redirect("item/Item");
        }
    }

    public function get_item(){
        $id = $this->input->post('id');
        $result = $this->ItemModel->get_item($id);
        echo json_encode($result);
    }

    public function update_item(){
        $update = array(
            'item_category_id'=> $this->input->post('category'),
            'name'            => $this->input->post('name'),
            'unit_id'         => $this->input->post('unit'),
            'quantity'        => $this->input->post('quantity'),
            'price'           => $this->input->post('price'),
            'exp_date'        => $this->input->post('exp_date'),
        );

        $this->form_validation->set_rules('category', 'Category Name', 'required');
        $this->form_validation->set_rules('name', 'Item name', 'trim|required|alpha|max_length[20]');
        $this->form_validation->set_rules('unit', 'Unit name', 'required');
        $this->form_validation->set_rules('quantity', 'Quantity', 'required|numeric');
        $this->form_validation->set_rules('price', 'Price', 'required|decimal|numeric');

        $id = $this->input->post('update_id');

        $result = $this->ItemModel->update_item($update, $id);
        if ($result){
            $alert = array(
                'type' =>"warning",
                'message' =>"updated successfully",
            );
            $this->session->set_flashdata('alert',$alert);
            redirect("item/Item");
        }
    }

    public function delete_item(){
        $id = $this->input->post('id');
        $result = $this->ItemModel->delete_item($id);
        if($result){
            $alert = array(
                'type' =>"danger",
                'message'=>"Deleted Successfully",
            );
            $this->session->set_flashdata('alert',$alert);
            redirect('item/Item');
        }
    }

    public function get_quantity(){
        $uom = $this->input->post('uom');
        $result = $this->ItemModel->get_quantity($uom);
        echo json_encode($result);
    }
}