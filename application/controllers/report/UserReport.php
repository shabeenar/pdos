<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserReport extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if(!$this->session->userdata('name')) {
            redirect(redirect('login/login'));
        }
        $this->load->model('ReportModel');

    }

    public function index()
    {
        $this->load->view('header');
        $this->load->view('report/userreport');
        $this->load->view('footer');
    }




}