<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ViewIngredients extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if(($this->session->userdata('role_id')==5 ) OR ($this->session->userdata('role_id')==2 ) OR ($this->session->userdata('role_id')==3 ) ) {
            if(!$this->session->userdata('name')) {
                redirect(redirect('login/login'));
            }

        $this->load->model('MealIngredientsModel');

        } else{
            $this->session->set_flashdata('access_alert', array('access_alert' => false));
            redirect('login/Login');
        }

    }

    public function index()
    {
        $id = $this->input->get('id');

        $data = array(
            'ingredients' => $this->MealIngredientsModel->mainlines($id),
            'ingredient_lines' => $this->MealIngredientsModel->lines($id),
        );

        $this->load->view('header');
        $this->load->view('kitchen/viewingredients', $data);
        $this->load->view('footer');
    }

    public function confirm_ingredients(){
    $id = $this->input->post('id');

    $results = $this->MealIngredientsModel->get_ingredients($id);


        foreach ($results as $result){
            $this->MealIngredientsModel->update_quantity($result->quantity,$result->item_id);
        }

        $data = array(
            'status' => '2',
        );

        $deducted_quantity = $this->MealIngredientsModel->confirm_ingredients($id,$data);

        redirect('kitchen/MealIngredients?id='.$id);

//        if ($deducted_quantity){
//            $alert = array(
//                'type' =>"warning",
//                'message' =>"Meal ingredients proceeded",
//            );
//            $this->session->set_flashdata('alert',$alert);
//            redirect('kitchen/MealIngredients?id='.$id);
//
//        }

    }

}