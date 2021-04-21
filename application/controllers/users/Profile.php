<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if(!$this->session->userdata('name')) {
            redirect(redirect('login/login'));
        }
        $this->load->model('LoginModel');
        $this->load->model('WardModel');
        $this->load->model('DistrictModel');
        $this->load->model('ProvinceModel');
        $this->load->model('CitiesModel');
        $this->load->model('RoleNames');
        $this->load->model('ProfileModel');
    }

    public function index()
    {
        $data = array(
            'wards'    => $this->WardModel->select(),
            'districts'=> $this->DistrictModel->select(),
            'provinces'=> $this->ProvinceModel->select(),
            'cities'   => $this->CitiesModel->select(),
            'roles'   => $this->RoleNames->select(),
        );

        $this->load->view('header');
        $this->load->view('users/profile', $data);
        $this->load->view('footer');
    }

    public function form_validations(){

        $this->form_validation->set_rules('first_name', 'First Name', 'trim|required|alpha|max_length[30]');
        $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|alpha|max_length[30]');
        $this->form_validation->set_rules('nic', 'NIC', 'trim|required|max_length[10]');
        $this->form_validation->set_rules('phone', 'Phone', 'trim|required|max_length[10]');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('birthday', 'Birthday', 'required');
        $this->form_validation->set_rules('street', 'Street', 'required');
        $this->form_validation->set_rules('city', 'City', 'required');
        $this->form_validation->set_rules('gender', 'Gender', 'required');
        $this->form_validation->set_rules('role', 'Role', 'required');
        $this->form_validation->set_rules('ward', 'Ward Name', 'required');

        if ($this->form_validation->run() == FALSE)
        {
            $result = array(
                'error' => true,
                'messages' => validation_errors(),
            );
            echo json_encode($result);
        }
        else
        {
            $result = array(
                'error' => false,
                'messages' => "",
            );
            echo json_encode($result);
        }
    }

    public function update_user(){
        $update = array(
            'first_name'=> $this->input->post('name'),
            'last_name' => $this->input->post('name'),
            'nic'       => $this->input->post('nic'),
            'phone'     => $this->input->post('phone'),
            'email'     => $this->input->post('email'),
            'birthday'  => $this->input->post('birthday'),
            'street'    => $this->input->post('street'),
            'street_two'=> $this->input->post('street_two'),
            'city_id'    => $this->input->post('city_id'),
            'district_id'=> $this->input->post('district'),
            'province_id'=> $this->input->post('province'),
            'gender'    => $this->input->post('gender'),
            'role_id'    => $this->input->post('role'),
            'ward_id'   => $this->input->post('ward'),
        );



        $id = $this->input->post('update_id');


        $result = $this->UsersModel->update_user($update, $id);

var_dump($result);
die();
        if ($result){
            $alert = array(
                'type' =>"warning",
                'message' =>"updated successfully",
            );
            $this->session->set_flashdata('alert',$alert);
            redirect("users/Users");
        }
    }

    public function inactivate(){
        $id = $this->input->post('id');
        $result = $this->UsersModel->inactivate($id);
        if ($result){
            $alert = array(
                'type' =>"success",
                'message' =>"User Deactivated",
            );
            $this->session->set_flashdata('alert',$alert);
            redirect("users/Users");
        }
    }

}