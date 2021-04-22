<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ViewPatientReport extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if(($this->session->userdata('role_id')==5 ) OR ($this->session->userdata('role_id')==1 )) {
            if(!$this->session->userdata('name')) {
                redirect(redirect('login/login'));
            }

        $this->load->model('ReportModel');

        } else{
            $this->session->set_flashdata('access_alert', array('access_alert' => false));
            redirect('login/Login');
        }

    }

    public function index()
    {
        $this->load->view('header');
        $this->load->view('report/viewpatientreport');
        $this->load->view('footer');
    }

    public function add_report(){
        $from = $this->input->post('from');
        $to = $this->input->post('to');
        $ward = $this->input->post('ward');
        $patient_category = $this->input->post('patient_category');
        $diet_category = $this->input->post('diet_category');

        $data = array(
            'patients' => $this->ReportModel->get_total_patients($from,$to,$ward,$patient_category,$diet_category),
        );

        $this->load->view('header');
        $this->load->view('report/viewpatientreport',$data);
        $this->load->view('footer');

    }
}