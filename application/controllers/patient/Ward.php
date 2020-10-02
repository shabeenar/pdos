<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ward extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('WardModel');
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

    public function create_ward()
    {
        $new_ward = array(
            'number'=> $this->input->post('number'),
            'name'  => $this->input->post('name'),
            'gender'=> $this->input->post('gender'),
        );

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