<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PatientCategory extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('PatientCategoryModel');
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

    public function create_patientcategory()
    {
        $new_patientcategory = array(
            'category_code'=> $this->input->post('category_code'),
            'category_name'=> $this->input->post('category_name'),
        );

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
}