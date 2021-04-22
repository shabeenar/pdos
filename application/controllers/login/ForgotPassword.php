<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ForgotPassword extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('LoginModel');
    }

    public function index()
    {
        $this->load->view('login/forgotpassword');
    }

    public function forgotpassword(){
        $email = $this->input->post('email');
        $result = $this->LoginModel->forgotpassword($email);

        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

        if($result) {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $randomString = '';

            for ($i = 0; $i < 10; $i++) {
                $index = rand(0, strlen($characters) - 1);
                $randomString .= $characters[$index];
            }

            $this->LoginModel->updatepassword($email,$randomString);

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

            $this->load->library('email', $mail_settings);
            $this->email->from('admin@pdos.lk', 'Patient Diet Ordering System');
            $this->email->to($email);
            $this->email->set_mailtype("html");
            $this->email->subject('Patient Diet Ordering System - Password Reset Request');
            $this->email->message('
            <p>Hi '.$result[0]->first_name.' '.$result[0]->last_name.',</p>
            <p>Please use following new credential to complete your system login.</p>
            <p>Email : '.$result[0]->email.'</p>
            <p>Password : '.$randomString.'</p>
            <p>Thank You!</p>
            <small>This email is automatically generated by Patient Diet Ordering System - Colombo South Teaching Hospital</small>
            ');
            $this->email->send();

            redirect("login/Login");
        }
        else{

            $this->session->set_flashdata('alert', array('alert' => false));
            redirect('login/ForgotPassword');
        }

    }

}