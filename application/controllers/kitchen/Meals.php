<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Meals extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if(!$this->session->userdata('name')) {
            redirect(redirect('login/login'));
        }
        $this->load->model('MealsModel');
    }


    public function index()
    {
        $data = array(
            'meals' => $this->MealsModel->select(),
        );

        $this->load->view('header');
        $this->load->view('kitchen/meals', $data);
        $this->load->view('footer');
    }

    public function create_meal()
    {
        $new_meal = array(
            'code' => $this->input->post('code'),
            'meal_name' => $this->input->post('meal_name'),
            'breakfast' => $this->input->post('breakfast'),
            'lunch' => $this->input->post('lunch'),
            'dinner' => $this->input->post('dinner'),
        );

        $result = $this->MealsModel->create($new_meal);
        if ($result){
            $alert = array(
                'type' => "success",
                'message' => "Meal successfully added",
            );

            $this->session->set_flashdata('alert',$alert);
            redirect("kitchen/Meals");
        }

    }

    public function get_meal(){
        $id = $this->input->post('id');
        $result = $this->MealsModel->get_meal($id);
        echo json_encode($result);
    }

    public function update_meal(){
        $update = array(
            'code' => $this->input->post('code'),
            'meal_name' => $this->input->post('meal_name'),
        );
        $id = $this->input->post('update_id');

        $result = $this->MealsModel->update_meal($update, $id);
        if ($result){
            $alert = array(
                'type' =>"warning",
                'message' =>"updated successfully",
            );
            $this->session->set_flashdata('alert',$alert);
            redirect("kitchen/Meals");
        }
    }

    public function delete_meal(){
        $id = $this->input->post('id');
        $result = $this->MealsModel->delete_meal($id);
        if($result){
            $alert = array(
                'type' =>"danger",
                'message'=>"Deleted Successfully",
            );
            $this->session->set_flashdata('alert',$alert);
            redirect('kitchen/Meals');
        }

    }


}