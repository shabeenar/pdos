<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ViewExpenditureReport extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if(($this->session->userdata('role_id')==5 ) OR ($this->session->userdata('role_id')==4 )) {
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
        $this->load->view('report/viewexpenditurereport');
        $this->load->view('footer');
    }

    public function add_report(){
        $from = $this->input->post('from');
        $to = $this->input->post('to');

        $data = array(
            'expenses' => $this->ReportModel->get_total_expenses($from,$to),
        );

        $this->load->view('header');
        $this->load->view('report/viewexpenditurereport',$data);
        $this->load->view('footer');

    }
}