<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ItemCategory extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if(($this->session->userdata('role_id')==5 ) OR ($this->session->userdata('role_id')==3 ) OR ($this->session->userdata('role_id')==4 )) {
            if(!$this->session->userdata('name')) {
                redirect(redirect('login/login'));
            }

        $this->load->model('ItemCategoryModel');

        } else{
            $this->session->set_flashdata('access_alert', array('access_alert' => false));
            redirect('login/Login');
        }
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

    public function form_validations(){

        $this->form_validation->set_rules('code', 'Code', 'required|numeric');
        $this->form_validation->set_rules('name', 'Item Category Name', 'trim|required|alpha|max_length[50]');

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

    public function create_itemcategory()
    {
        $new_itemcategory = array(
            'code'=> $this->input->post('code'),
            'name'=> $this->input->post('name'),
        );

        $this->form_validation->set_rules('code', 'Code', 'required|numeric');
        $this->form_validation->set_rules('name', 'Item Category Name', 'trim|required|alpha|max_length[50]');

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

        $this->form_validation->set_rules('code', 'Code', 'required|numeric');
        $this->form_validation->set_rules('name', 'Item Category Name', 'trim|required|alpha|max_length[50]');

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

    public function check_name() {
        $name = $this->input->post('name');
        $result = $this->ItemCategoryModel->check_name($name);
        echo json_encode($result);
    }

}