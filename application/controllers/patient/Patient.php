<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Patient extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('PatientModel');
    }

    public function index()
    {
        $data = array(
            'patients' => $this->PatientModel->select(),
        );

        $this->load->view('header');
        $this->load->view('patient/patient', $data);
        $this->load->view('footer');
    }

    public function create_patient()
    {
        $new_patient = array(
            'category'  => $this->input->post('category'),
            'name'      => $this->input->post('name'),
            'age'       => $this->input->post('age'),
            'birthday'  => $this->input->post('birthday'),
            'nic'       => $this->input->post('nic'),
            'phone'     => $this->input->post('phone'),
            'gender'    => $this->input->post('gender'),
            'street'    => $this->input->post('street'),
            'street_two'=> $this->input->post('street_two'),
            'city'      => $this->input->post('city'),
            'district'  => $this->input->post('district'),
            'province'  => $this->input->post('province'),
            'in_date'   => $this->input->post('in_date'),
            'ward'      => $this->input->post('ward'),
            'bed'       => $this->input->post('bed'),
        );

        $result = $this->PatientModel->create($new_patient);
        if ($result == true){
            redirect("patient/Patient");
        }
    }
}