<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DietCategory extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if(($this->session->userdata('role_id')==5 ) OR ($this->session->userdata('role_id')==1 )) {
            if(!$this->session->userdata('name')) {
                redirect(redirect('login/login'));
            }

        $this->load->model('DietCategoryModel');
        $this->load->model('PatientModel');

        } else{
            $this->session->set_flashdata('access_alert', array('access_alert' => false));
            redirect('login/Login');
        }
    }


    public function index()
    {
        $data = array(
            'dietcategories' => $this->DietCategoryModel->select(),
        );

        $this->load->view('header');
        $this->load->view('patient/dietcategory', $data);
        $this->load->view('footer');
    }

    public function form_validations(){

        $this->form_validation->set_rules('category_code', 'Code', 'required|numeric');
        $this->form_validation->set_rules('category_name', 'Category Name', 'trim|required|alpha|max_length[50]');

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

    public function create_dietcategory()
    {
        $new_dietcategory = array(
            'category_code'=> $this->input->post('category_code'),
            'category_name'=> $this->input->post('category_name'),
        );

        $this->form_validation->set_rules('category_code', 'Code', 'required|numeric');
        $this->form_validation->set_rules('category_name', 'Category Name', 'trim|required|alpha|max_length[50]');

        $result = $this->DietCategoryModel->create($new_dietcategory);
        if ($result){
            $alert = array(
                'type' => "success",
                'message' => "Diet category successfully added",
            );

            $this->session->set_flashdata('alert',$alert);
            redirect("patient/DietCategory");
        }

    }

    public function get_dietcategory(){
        $id = $this->input->post('id');
        $result = $this->DietCategoryModel->get_dietcategory($id);
        echo json_encode($result);
    }

    public function update_dietcategory(){
        $update = array(
            'category_code' =>$this->input->post('category_code'),
            'category_name' =>$this->input->post('category_name'),
        );

        $this->form_validation->set_rules('category_code', 'Code', 'required|numeric');
        $this->form_validation->set_rules('category_name', 'Category Name', 'trim|required|alpha|max_length[50]');

        $id = $this->input->post('update_id');

        $result = $this->DietCategoryModel->update_dietcategory($update, $id);
        if ($result){
            $alert = array(
                'type' =>"warning",
                'message' =>"updated successfully",
            );
            $this->session->set_flashdata('alert',$alert);
            redirect("patient/DietCategory");
        }
    }

    public function delete_dietcategory(){
        $id = $this->input->post('id');
        $result = $this->DietCategoryModel->delete_dietcategory($id);
        if($result){
            $alert = array(
                'type' =>"danger",
                'message'=>"Deleted Successfully",
            );
            $this->session->set_flashdata('alert',$alert);
            redirect('patient/DietCategory');
        }

    }

    public function check_diet_name(){
        $category_name = $this->input->post('category_name');
        $result = $this->PatientModel->check_diet_name($category_name);

        echo json_encode($result);


    }


}