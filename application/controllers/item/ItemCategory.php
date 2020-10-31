<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ItemCategory extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if(!$this->session->userdata('name')) {
            redirect(redirect('login/login'));
        }
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

    public function get_itemcategory(){
        $id = $this->input->post('id');
        $result = $this->ItemCategoryModel->get_itemcategory($id);
        echo json_encode($result);
    }

    public function update_itemcategory(){
        $update = array(
            'code'=> $this->input->post('code'),
            'name'=> $this->input->post('name'),
        );
        $id = $this->input->post('update_id');

        $result = $this->ItemCategoryModel->update_itemcategory($update, $id);
        if ($result){
            $alert = array(
                'type' =>"warning",
                'message' =>"updated successfully",
            );
            $this->session->set_flashdata('alert',$alert);
            redirect("item/ItemCategory");
        }

    }

    public function delete_itemcategory(){
        $id = $this->input->post('id');
        $result = $this->ItemCategoryModel->delete_itemcategory($id);
        if($result){
            $alert = array(
                'type' =>"danger",
                'message'=>"Deleted Successfully",
            );
            $this->session->set_flashdata('alert',$alert);
            redirect('item/ItemCategory');
        }
    }
}