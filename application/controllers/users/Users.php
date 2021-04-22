<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        if(($this->session->userdata('role_id')==5 )) {
            if(!$this->session->userdata('name')) {
                redirect(redirect('login/login'));
            }

        $this->load->model('UsersModel');
        $this->load->model('WardModel');
        $this->load->model('DistrictModel');
        $this->load->model('ProvinceModel');
        $this->load->model('CitiesModel');
        $this->load->model('RoleNames');

        } else{
            $this->session->set_flashdata('access_alert', array('access_alert' => false));
            redirect('login/Login');
        }
    }

    public function index()
    {
        $data = array(
            'users'    => $this->UsersModel->select(),
            'wards'    => $this->WardModel->select(),
            'districts'=> $this->DistrictModel->select(),
            'provinces'=> $this->ProvinceModel->select(),
            'cities'   => $this->CitiesModel->select(),
            'roles'   => $this->RoleNames->select(),
        );

        $this->load->view('header');
        $this->load->view('users/users', $data);
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

    public function create_user()
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';

        for ($i = 0; $i < 10; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }

        $new_user = array(
            'first_name'=> $this->input->post('first_name'),
            'last_name' => $this->input->post('last_name'),
            'nic'       => $this->input->post('nic'),
            'phone'     => $this->input->post('phone'),
            'email'     => $this->input->post('email'),
            'birthday'  => $this->input->post('birthday'),
            'street'    => $this->input->post('street'),
            'street_two'=> $this->input->post('street_two'),
            'city_id'    => $this->input->post('city'),
            'district_id'=> $this->input->post('district'),
            'province_id'=> $this->input->post('province'),
            'gender'    => $this->input->post('gender'),
            'role_id'      => $this->input->post('role'),
            'ward_id'   => $this->input->post('ward'),
            'create_date' => date('Y-m-d'),
            'password'  => sha1($randomString)
        );

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

        $mail_settings = Array(
            'protocol'    => 'smtp',
            'smtp_host'   => 'smtp.googlemail.com',
            'smtp_port'   => '587',
            'smtp_user'   => 'rashmibit1234@gmail.com',
            'smtp_pass'   => 'rashmi1234',
            'mailtype'    => 'html',
            'smtp_crypto' => 'tls',
            'charset'     => 'utf-8',
            'newline'     => "\r\n"
        );

        $result = $this->UsersModel->create($new_user);
        if ($result){

            $this->load->library('email', $mail_settings);
            $this->email->from('admin@pdos.lk', 'pdos');
            $this->email->to($new_user['email']);
            $this->email->set_mailtype("html");
            $this->email->subject('Invitation for pdos (Pvt) Ltd');
            $this->email->message('
            <p>Dear Sir/ Madam,</p>
            <p>Please use the following details to complete your login request.<br>
            This email is automatically generated by Patient Diet Ordering System.</p>
            <p>Your Name : '.$new_user['first_name'].' '.$new_user['last_name'].'</p>
            <p>Your email : '.$new_user['email'].'</p>
            <p>Password : '.$randomString.'</p>
            <p>Thank You!</p>
            ');
            $this->email->send();

            $alert = array(
                'type'   => "success",
                'message'=> "User successfully added",
            );

            $this->session->set_flashdata('alert',$alert);
            redirect("users/Users");
        }
    }

    public function get_user(){
        $id = $this->input->post('id');
        $result = $this->UsersModel->get_user($id);
        echo json_encode($result);
    }

    public function update_user(){
        $update = array(
            'first_name'=> $this->input->post('first_name'),
            'last_name' => $this->input->post('last_name'),
            'nic'       => $this->input->post('nic'),
            'phone'     => $this->input->post('phone'),
            'email'     => $this->input->post('email'),
            'birthday'  => $this->input->post('birthday'),
            'street'    => $this->input->post('street'),
            'street_two'=> $this->input->post('street_two'),
            'city_id'    => $this->input->post('city'),
            'district_id'=> $this->input->post('district'),
            'province_id'=> $this->input->post('province'),
            'gender'    => $this->input->post('gender'),
            'role_id'    => $this->input->post('role'),
            'ward_id'   => $this->input->post('ward'),
        );


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

        $id = $this->input->post('update_id');


        $result = $this->UsersModel->update_user($update, $id);


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

    public function activate(){
        $id = $this->input->post('id');
        $result = $this->UsersModel->activate($id);
        if ($result){
            $alert = array(
                'type' =>"success",
                'message' =>"User Activated",
            );
            $this->session->set_flashdata('alert',$alert);
            redirect("users/Users");
        }
    }

    public function delete_user(){
        $id = $this->input->post('id');
        $result = $this->UsersModel->delete_user($id);
        if($result){
            $alert = array(
                'type' =>"danger",
                'message'=>"Deleted Successfully",
            );
            $this->session->set_flashdata('alert',$alert);
            redirect('users/Users');
        }

    }

    public function get_city(){
        $id = $this->input->post('city');
        $result =$this->UsersModel->get_district_province_postalcode($id);

        echo json_encode($result);
    }

    public function check_nic() {
        $nic = $this->input->post('nic');
        $result = $this->UsersModel->check_nic($nic);
        echo json_encode($result);
    }

    public function check_phone() {
        $phone = $this->input->post('phone');
        $result = $this->UsersModel->check_phone($phone);
        echo json_encode($result);
    }

    public function check_email() {
        $email = $this->input->post('email');
        $result = $this->UsersModel->check_email($email);
        echo json_encode($result);
    }
}