<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Supplier extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if(($this->session->userdata('role_id')==5 ) OR ($this->session->userdata('role_id')==4 )) {
            if(!$this->session->userdata('name')) {
                redirect(redirect('login/login'));
            }

        $this->load->model('SupplierModel');
        $this->load->model('DistrictModel');
        $this->load->model('ProvinceModel');
        $this->load->model('CitiesModel');

        } else{
            $this->session->set_flashdata('access_alert', array('access_alert' => false));
            redirect('login/Login');
        }
    }

    public function index()
    {
        $data = array(
            'suppliers' => $this->SupplierModel->select(),
            'districts' => $this->DistrictModel->select(),
            'provinces' => $this->ProvinceModel->select(),
            'cities'    => $this->CitiesModel->select(),
        );

        $this->load->view('header');
        $this->load->view('supplier/supplier', $data);
        $this->load->view('footer');
    }

    public function form_validations(){

        $this->form_validation->set_rules('name', 'Supplier Name', 'trim|required|alpha_numeric_spaces|max_length[50]');
        $this->form_validation->set_rules('phone', 'Phone', 'required');
        $this->form_validation->set_rules('street', 'Street', 'required');
        $this->form_validation->set_rules('city', 'City', 'required');

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

    public function create_supplier()
    {
        $new_supplier = array(
            'name'      => $this->input->post('name'),
            'phone'     => $this->input->post('phone'),
            'email'     => $this->input->post('email'),
            'street'    => $this->input->post('street'),
            'street_two'=> $this->input->post('street_two'),
            'city_id'      => $this->input->post('city'),
            'district_id'  => $this->input->post('district'),
            'province_id'  => $this->input->post('province'),
        );

        $this->form_validation->set_rules('name', 'Supplier Name', 'trim|required|alpha_numeric_spaces|max_length[50]');
        $this->form_validation->set_rules('phone', 'Phone', 'required');
        $this->form_validation->set_rules('street', 'Street', 'required');
        $this->form_validation->set_rules('city', 'City', 'required');

        $result = $this->SupplierModel->create($new_supplier);
        if ($result){
            $alert = array(
                'type' => "success",
                'message' => "Supplier successfully added",
            );

            $this->session->set_flashdata('alert',$alert);
            redirect("supplier/Supplier");
        }
    }

    public function get_supplier(){
        $id = $this->input->post('id');
        $result = $this->SupplierModel->get_supplier($id);
        echo json_encode($result);
    }

    public function update_supplier(){
        $update = array(
            'name'      => $this->input->post('name'),
            'phone'     => $this->input->post('phone'),
            'email'     => $this->input->post('email'),
            'street'    => $this->input->post('street'),
            'street_two'=> $this->input->post('street_two'),
            'city_id'      => $this->input->post('city'),
            'district_id'  => $this->input->post('district'),
            'province_id'  => $this->input->post('province'),
        );

        $this->form_validation->set_rules('name', 'Supplier Name', 'trim|required|alpha_numeric_spaces|max_length[50]');
        $this->form_validation->set_rules('phone', 'Phone', 'required');
        $this->form_validation->set_rules('street', 'Street', 'required');
        $this->form_validation->set_rules('city', 'City', 'required');

        $id = $this->input->post('update_id');

        $result = $this->SupplierModel->update_supplier($update, $id);
        if ($result){
            $alert = array(
                'type' =>"warning",
                'message' =>"updated successfully",
            );
            $this->session->set_flashdata('alert',$alert);
            redirect("supplier/Supplier");
        }
    }

    public function inactivate(){
        $id = $this->input->post('id');
        $result = $this->SupplierModel->inactivate($id);
        if ($result){
            $alert = array(
                'type' =>"success",
                'message' =>"Supplier Deactivated",
            );
            $this->session->set_flashdata('alert',$alert);
            redirect("supplier/Supplier");
        }
    }

    public function activate(){
        $id = $this->input->post('id');
        $result = $this->SupplierModel->activate($id);
        if ($result){
            $alert = array(
                'type' =>"success",
                'message' =>"Supplier Activated",
            );
            $this->session->set_flashdata('alert',$alert);
            redirect("supplier/Supplier");
        }
    }

    public function delete_supplier(){
        $id = $this->input->post('id');
        $result = $this->SupplierModel->delete_supplier($id);
        if($result){
            $alert = array(
                'type' =>"danger",
                'message'=>"Deleted Successfully",
            );
            $this->session->set_flashdata('alert',$alert);
            redirect('supplier/Supplier');
        }

    }

    public function get_city(){
        $id = $this->input->post('city');
        $result =$this->SupplierModel->get_district_province_postalcode($id);

        echo json_encode($result);
    }
}