<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Company extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if(($this->session->userdata('role_id')==5 ) OR ($this->session->userdata('role_id')==3 ) OR ($this->session->userdata('role_id')==4 ) OR ($this->session->userdata('role_id')==1 ) OR ($this->session->userdata('role_id')==2 )) {
            if(!$this->session->userdata('name')) {
                redirect(redirect('login/login'));
            }

        $this->load->model('CompanyModel');

        } else{
            $this->session->set_flashdata('access_alert', array('access_alert' => false));
            redirect('login/Login');
        }
    }

    public function index()
    {
        $data = array(
            'companies' => $this->CompanyModel->select(),
        );

        $this->load->view('header');
        $this->load->view('company/company', $data);
        $this->load->view('footer');
    }

    public function update_company()
    {
        $update = array(
            'name' =>$this->input->post('name'),
            'phone' =>$this->input->post('phone'),
            'email' =>$this->input->post('email'),
            'address' =>$this->input->post('address'),
            'number_beds' =>$this->input->post('beds'),
            'number_wards' =>$this->input->post('wards'),
        );



        $id = $this->input->post('update_id');

        $result = $this->CompanyModel->update_company($update, $id);

        if ($result){
            $alert = array(
                'type' =>"warning",
                'message' =>"updated successfully",
            );
            $this->session->set_flashdata('alert',$alert);
            redirect("company/Company");
        }
    }
}