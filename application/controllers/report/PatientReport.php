<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PatientReport extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if(($this->session->userdata('role_id')==5 ) OR ($this->session->userdata('role_id')==1 )) {
            if(!$this->session->userdata('name')) {
                redirect(redirect('login/login'));
            }

        $this->load->model('ReportModel');
        $this->load->model('WardModel');
        $this->load->model('PatientCategoryModel');
        $this->load->model('DietCategoryModel');

        } else{
            $this->session->set_flashdata('access_alert', array('access_alert' => false));
            redirect('login/Login');
        }

    }

    public function index()
    {
        $data = array(
            'wards' => $this->WardModel->select(),
            'patient_categories'=> $this->PatientCategoryModel->select(),
            'diet_categories'   => $this->DietCategoryModel->select(),
        );

        $this->load->view('header');
        $this->load->view('report/patientreport', $data);
        $this->load->view('footer');
    }




}