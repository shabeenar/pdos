<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ViewMealOrderReport extends CI_Controller {

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
        $this->load->view('report/viewmealorderreport');
        $this->load->view('footer');
    }

    public function add_report(){
        $from = $this->input->post('from');
        $to = $this->input->post('to');

        $data = array(
            'orders' => $this->ReportModel->get_total_orders($from,$to),
        );

        $this->load->view('header');
        $this->load->view('report/viewmealorderreport',$data);
        $this->load->view('footer');

    }
}