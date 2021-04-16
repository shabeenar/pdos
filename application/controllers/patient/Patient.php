<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Patient extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if(!$this->session->userdata('name')) {
            redirect(redirect('login/login'));
        }
        $this->load->model('PatientModel');
        $this->load->model('PatientCategoryModel');
        $this->load->model('DietCategoryModel');
        $this->load->model('WardModel');
        $this->load->model('DistrictModel');
        $this->load->model('ProvinceModel');
        $this->load->model('CitiesModel');
    }

    public function index()
    {
        $data = array(
            'patients'          => $this->PatientModel->select(),
            'patient_categories'=> $this->PatientCategoryModel->select(),
            'diet_categories'   => $this->DietCategoryModel->select(),
            'wards'             => $this->WardModel->select(),
            'districts'         => $this->DistrictModel->select(),
            'provinces'         => $this->ProvinceModel->select(),
            'cities'            => $this->CitiesModel->select(),
        );

        $this->load->view('header');
        $this->load->view('patient/patient', $data);
        $this->load->view('footer');
    }

    public function form_validations(){

        $this->form_validation->set_rules('patient_category', 'Patient Category', 'required');
        $this->form_validation->set_rules('name', 'Name', 'trim|required|alpha_numeric_spaces|max_length[50]');
        $this->form_validation->set_rules('age', 'Age', 'required|numeric|max_length[3]');
        $this->form_validation->set_rules('birthday', 'Birthday', 'required');
        $this->form_validation->set_rules('nic', 'NIC', 'trim|required|max_length[10]');
        $this->form_validation->set_rules('phone', 'Phone', 'trim|required|max_length[10]');
        $this->form_validation->set_rules('gender', 'Gender', 'required');
        $this->form_validation->set_rules('street', 'Street', 'required');
        $this->form_validation->set_rules('city', 'City', 'required');
        $this->form_validation->set_rules('in_date', 'In Date', 'required');
        $this->form_validation->set_rules('ward', 'Ward Name', 'required');
        $this->form_validation->set_rules('bed', 'Bed Number', 'required|numeric');
        $this->form_validation->set_rules('diet_category', 'Diet Category', 'required');

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


    public function create_patient()
    {
        $new_patient = array(
            'patient_category_id'=> $this->input->post('patient_category'),
            'name'               => $this->input->post('name'),
            'age'                => $this->input->post('age'),
            'birthday'           => $this->input->post('birthday'),
            'nic'                => $this->input->post('nic'),
            'phone'              => $this->input->post('phone'),
            'gender'             => $this->input->post('gender'),
            'street'             => $this->input->post('street'),
            'street_two'         => $this->input->post('street_two'),
            'city_id'            => $this->input->post('city'),
            'district_id'        => $this->input->post('district'),
            'province_id'        => $this->input->post('province'),
            'in_date'            => $this->input->post('in_date'),
            'ward_id'            => $this->input->post('ward'),
            'bed'                => $this->input->post('bed'),
            'diet_category_id'   => $this->input->post('diet_category'),
        );

        $this->form_validation->set_rules('patient_category', 'Patient Category', 'required');
        $this->form_validation->set_rules('name', 'Name', 'trim|required|alpha_numeric_spaces|max_length[50]');
        $this->form_validation->set_rules('age', 'Age', 'required|numeric|max_length[3]');
        $this->form_validation->set_rules('birthday', 'Birthday', 'required');
        $this->form_validation->set_rules('nic', 'NIC', 'trim|required|max_length[10]');
        $this->form_validation->set_rules('phone', 'Phone', 'trim|required|max_length[10]');
        $this->form_validation->set_rules('gender', 'Gender', 'required');
        $this->form_validation->set_rules('street', 'Street', 'required');
        $this->form_validation->set_rules('city', 'City', 'required');
        $this->form_validation->set_rules('in_date', 'In Date', 'required');
        $this->form_validation->set_rules('ward', 'Ward Name', 'required');
        $this->form_validation->set_rules('bed', 'Bed Number', 'required|numeric');
        $this->form_validation->set_rules('diet_category', 'Diet Category', 'required');

        $result = $this->PatientModel->create($new_patient);
        if ($result){
            $alert = array(
                'type'   => "success",
                'message'=> "Patient successfully added",
            );

            $this->session->set_flashdata('alert',$alert);
            redirect("patient/Patient");
        }
    }

    public function get_patient(){
        $id = $this->input->post('id');
        $result = $this->PatientModel->get_patient($id);
        echo json_encode($result);
    }

    public function update_patient(){
        $update = array(
            'patient_category_id'=> $this->input->post('patient_category'),
            'name'               => $this->input->post('name'),
            'age'                => $this->input->post('age'),
            'birthday'           => $this->input->post('birthday'),
            'nic'                => $this->input->post('nic'),
            'phone'              => $this->input->post('phone'),
            'gender'             => $this->input->post('gender'),
            'street'             => $this->input->post('street'),
            'street_two'         => $this->input->post('street_two'),
            'city_id'            => $this->input->post('city'),
            'district_id'        => $this->input->post('district'),
            'province_id'        => $this->input->post('province'),
            'in_date'            => $this->input->post('in_date'),
            'ward_id'            => $this->input->post('ward'),
            'bed'                => $this->input->post('bed'),
            'diet_category_id'   => $this->input->post('diet_category'),
        );

        $this->form_validation->set_rules('patient_category', 'Patient Category', 'required');
        $this->form_validation->set_rules('name', 'Name', 'trim|required|alpha_numeric_spaces|max_length[50]');
        $this->form_validation->set_rules('age', 'Age', 'required|numeric|max_length[3]');
        $this->form_validation->set_rules('birthday', 'Birthday', 'required');
        $this->form_validation->set_rules('nic', 'NIC', 'trim|required|max_length[10]');
        $this->form_validation->set_rules('phone', 'Phone', 'trim|required|max_length[10]');
        $this->form_validation->set_rules('gender', 'Gender', 'required');
        $this->form_validation->set_rules('street', 'Street', 'required');
        $this->form_validation->set_rules('city', 'City', 'required');
        $this->form_validation->set_rules('in_date', 'In Date', 'required');
        $this->form_validation->set_rules('ward', 'Ward Name', 'required');
        $this->form_validation->set_rules('bed', 'Bed Number', 'required|numeric');
        $this->form_validation->set_rules('diet_category', 'Diet Category', 'required');

        $id = $this->input->post('update_id');

        $result = $this->PatientModel->update_patient($update, $id);
        if ($result){
            $alert = array(
                'type' =>"warning",
                'message' =>"updated successfully",
            );
            $this->session->set_flashdata('alert',$alert);
            redirect("patient/Patient");
        }
    }

    public function inactivate(){
        $id = $this->input->post('id');
        $result = $this->PatientModel->inactivate($id);
        if ($result){
            $alert = array(
                'type' =>"success",
                'message' =>"Patient Deactivated",
            );
            $this->session->set_flashdata('alert',$alert);
            redirect("patient/Patient");
        }
    }

    public function activate(){
        $id = $this->input->post('id');
        $result = $this->PatientModel->activate($id);
        if ($result){
            $alert = array(
                'type' =>"success",
                'message' =>"Patient Activated",
            );
            $this->session->set_flashdata('alert',$alert);
            redirect("patient/Patient");
        }
    }

    public function delete_patient(){
        $id = $this->input->post('id');
        $result = $this->PatientModel->delete_patient($id);
        if($result){
            $alert = array(
                'type' =>"danger",
                'message'=>"Deleted Successfully",
            );
            $this->session->set_flashdata('alert',$alert);
            redirect('patient/Patient');
        }
    }

    public function get_city(){
        $id = $this->input->post('city');
        $result =$this->PatientModel->get_district_province_postalcode($id);

        echo json_encode($result);
    }

    public function check_phone(){
        $phone = $this->input->post('phone');
        $result = $this->PatientModel->check_phone($phone);

        echo json_encode($result);


    }

    public function check_nic(){
        $nic = $this->input->post('nic');
        $result = $this->PatientModel->check_nic($nic);

        echo json_encode($result);


    }



}