<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Unit extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
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
            'name'=> $this->input->post('name'),
            'unit'=> $this->input->post('unit'),
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
}