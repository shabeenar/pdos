<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('LoginModel');
    }

    public function index(){

        $this->load->view('login/login');
    }

    public function signup(){
        $create = array(
            'email' => $this->input->post('email'),
            'password' =>$this->input->post('password'),
        );
        $result = $this->LoginModel->login_user($create);
        if ($result){
            redirect('welcome');
        }else{
            redirect('login/Login');
        }
    }








}




?>