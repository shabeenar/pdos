<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('UsersModel');
        $this->load->model('WardModel');
    }

    public function index()
    {
        $data = array(
            'users' => $this->UsersModel->select(),
            'wards' => $this->WardModel->select(),
        );

        $this->load->view('header');
        $this->load->view('users/users', $data);
        $this->load->view('footer');
    }

    public function create_user()
    {
        $new_user = array(
            'first_name'=> $this->input->post('first_name'),
            'last_name' => $this->input->post('last_name'),
            'nic'       => $this->input->post('nic'),
            'phone'     => $this->input->post('phone'),
            'email'     => $this->input->post('email'),
            'birthday'  => $this->input->post('birthday'),
            'street'    => $this->input->post('street'),
            'street_two'=> $this->input->post('street_two'),
            'city'      => $this->input->post('city'),
            'district'  => $this->input->post('district'),
            'province'  => $this->input->post('province'),
            'gender'    => $this->input->post('gender'),
            'role'      => $this->input->post('role'),
            'ward_id'   => $this->input->post('ward'),
        );

        $result = $this->UsersModel->create($new_user);
        if ($result){
            $alert = array(
                'type' => "success",
                'message' => "User successfully added",
            );

            $this->session->set_flashdata('alert',$alert);
            redirect("users/Users");
        }
    }
}