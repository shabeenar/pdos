<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PatientCategory extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if(!$this->session->userdata('name')) {
            redirect(redirect('login/login'));
        }
        $this->load->model('PatientCategoryModel');
        $this->load->model('PatientModel');
    }


    public function index()
    {
        $data = array(
            'patientcategories' => $this->PatientCategoryModel->select(),
        );

        $this->load->view('header');
        $this->load->view('patient/patientcategory', $data);
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

    public function create_patientcategory()
    {
        $new_patientcategory = array(
            'category_code'=> $this->input->post('category_code'),
            'category_name'=> $this->input->post('category_name'),
        );

        $this->form_validation->set_rules('category_code', 'Code', 'required|numeric');
        $this->form_validation->set_rules('category_name', 'Category Name', 'trim|required|alpha|max_length[50]');

        $result = $this->PatientCategoryModel->create($new_patientcategory);
        if ($result){
            $alert = array(
                'type' => "success",
                'message' => "Patient category successfully added",
            );

            $this->session->set_flashdata('alert',$alert);
            redirect("patient/PatientCategory");
        }

    }

    public function get_patientcategory(){
        $id = $this->input->post('id');
        $result = $this->PatientCategoryModel->get_patientcategory($id);
        echo json_encode($result);
    }

    public function update_patientcategory(){
        $update = array(
            'category_code'=> $this->input->post('category_code'),
            'category_name'=> $this->input->post('category_name'),
        );

        $this->form_validation->set_rules('category_code', 'Code', 'required|numeric');
        $this->form_validation->set_rules('category_name', 'Category Name', 'trim|required|alpha|max_length[50]');

        $id = $this->input->post('update_id');

        $result = $this->PatientCategoryModel->update_patientcategory($update, $id);
        if ($result){
            $alert = array(
                'type' =>"warning",
                'message' =>"updated successfully",
            );
            $this->session->set_flashdata('alert',$alert);
            redirect("patient/PatientCategory");
        }
    }

    public function delete_patientcategory(){
        $id = $this->input->post('id');
        $result = $this->PatientCategoryModel->delete_patientcategory($id);
        if($result){
            $alert = array(
                'type' =>"danger",
                'message'=>"Deleted Successfully",
            );
            $this->session->set_flashdata('alert',$alert);
            redirect('patient/PatientCategory');
        }

    }

    public function check_category_name(){
        $category_name = $this->input->post('category_name');
        $result = $this->PatientModel->check_category_name($category_name);

        echo json_encode($result);


    }

}