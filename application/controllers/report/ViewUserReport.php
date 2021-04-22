<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ViewUserReport extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if(($this->session->userdata('role_id')==5 )) {
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
        $this->load->view('report/viewuserreport');
        $this->load->view('footer');
    }

    public function add_report(){
    $from = $this->input->post('from');
    $to = $this->input->post('to');

        $data = array(
            'users' => $this->ReportModel->get_total_users($from,$to),
        );

        $this->load->view('header');
        $this->load->view('report/viewuserreport',$data);
        $this->load->view('footer');

    }


}