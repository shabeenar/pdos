<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Unit extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if(!$this->session->userdata('name')) {
            redirect(redirect('login/login'));
        }
        $this->load->model('UnitModel');
    }


    public function index()
    {
        $data = array(
            'units' => $this->UnitModel->select(),
        );

        $this->load->view('header');
        $this->load->view('item/unit', $data);
        $this->load->view('footer');
    }

    public function create_unit()
    {
        $new_unit = array(
            'name' => $this->input->post('name'),
            'unit' => $this->input->post('unit'),
        );

        $result = $this->UnitModel->create($new_unit);
        if ($result){
            $alert = array(
                'type' => "success",
                'message' => "Unit of measure successfully added",
            );

            $this->session->set_flashdata('alert',$alert);
            redirect("item/Unit");
        }

    }

    public function get_unit(){
        $id = $this->input->post('id');
        $result = $this->UnitModel->get_unit($id);
        echo json_encode($result);
    }

    public function update_unit(){
        $update = array(
            'name' =>$this->input->post('name'),
            'unit' =>$this->input->post('unit'),
        );
        $id = $this->input->post('update_id');

        $result = $this->UnitModel->update_unit($update, $id);
        if ($result){
            $alert = array(
                'type' =>"warning",
                'message' =>"updated successfully",
            );
            $this->session->set_flashdata('alert',$alert);
            redirect("item/Unit");
        }
    }

    public function delete_unit(){
        $id = $this->input->post('id');
        $result = $this->UnitModel->delete_unit($id);
        if($result){
            $alert = array(
                'type' =>"danger",
                'message'=>"Deleted Successfully",
            );
            $this->session->set_flashdata('alert',$alert);
            redirect('item/Unit');
        }

    }
}