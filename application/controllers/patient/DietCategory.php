<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DietCategory extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('DietCategoryModel');
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

    public function create_dietcategory()
    {
        $new_dietcategory = array(
            'category_code'=> $this->input->post('category_code'),
            'category_name'=> $this->input->post('category_name'),
        );

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
}