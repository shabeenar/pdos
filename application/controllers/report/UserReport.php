<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserReport extends CI_Controller {

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
        $this->load->view('report/userreport');
        $this->load->view('footer');
    }




}