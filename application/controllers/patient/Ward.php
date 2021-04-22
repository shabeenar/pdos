<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ward extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if(($this->session->userdata('role_id')==5 ) OR ($this->session->userdata('role_id')==1 )) {
            if(!$this->session->userdata('name')) {
                redirect(redirect('login/login'));
            }

        $this->load->model('WardModel');

        } else{
            $this->session->set_flashdata('access_alert', array('access_alert' => false));
            redirect('login/Login');
        }
    }

    public function index()
    {
        $data = array(
            'wards' => $this->WardModel->select(),
        );

        $this->load->view('header');
        $this->load->view('patient/ward', $data);
        $this->load->view('footer');
    }

    public function form_validations(){

        $this->form_validation->set_rules('number', 'Ward Number', 'required|alpha_numeric');
        $this->form_validation->set_rules('name', 'Ward Name', 'trim|required|alpha_numeric|max_length[50]');
        $this->form_validation->set_rules('gender', 'Ward Gender', 'required');

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

    public function create_ward()
    {
        $new_ward = array(
            'number'=> $this->input->post('number'),
            'name'  => $this->input->post('name'),
            'gender'=> $this->input->post('gender'),
        );

        $this->form_validation->set_rules('number', 'Ward Number', 'required|alpha_numeric');
        $this->form_validation->set_rules('name', 'Ward Name', 'trim|required|alpha_numeric|max_length[50]');
        $this->form_validation->set_rules('gender', 'Ward Gender', 'required');

        $result = $this->WardModel->create($new_ward);
        if ($result){
            $alert = array(
                'type' => "success",
                'message' => "Ward successfully added",
            );

            $this->session->set_flashdata('alert',$alert);
            redirect("patient/Ward");
        }
    }

    public function get_ward(){
        $id = $this->input->post('id');
        $result = $this->WardModel->get_ward($id);
        echo json_encode($result);
    }

    public function update_ward(){
        $update = array(
            'number'=> $this->input->post('number'),
            'name'  => $this->input->post('name'),
            'gender'=> $this->input->post('gender'),
        );

        $this->form_validation->set_rules('number', 'Ward Number', 'required|alpha_numeric');
        $this->form_validation->set_rules('name', 'Ward Name', 'trim|required|alpha_numeric|max_length[50]');
        $this->form_validation->set_rules('gender', 'Ward Gender', 'required');

        $id = $this->input->post('update_id');

        $result = $this->WardModel->update_ward($update, $id);
        if ($result){
            $alert = array(
                'type' =>"warning",
                'message' =>"updated successfully",
            );
            $this->session->set_flashdata('alert',$alert);
            redirect('patient/Ward');
        }
    }

    public function delete_ward(){
        $id = $this->input->post('id');
        $result = $this->WardModel->delete_ward($id);
        if($result){
            $alert = array(
                'type' =>"danger",
                'message'=>"Deleted Successfully",
            );
            $this->session->set_flashdata('alert',$alert);
            redirect('patient/Ward');
        }

    }
}