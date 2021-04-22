<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MealIngredients extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if(($this->session->userdata('role_id')==5 ) OR ($this->session->userdata('role_id')==2 ) OR ($this->session->userdata('role_id')==3 )) {
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

            'ingredients' => $this->MealIngredientsModel->select($id),
            'meals' => $this->MealIngredientsModel->lines($id),
            'orders' => $this->MealIngredientsModel->view_per_meal($id),
        );


        $this->load->view('header');
        $this->load->view('kitchen/mealingredients',$data);
        $this->load->view('footer');
    }


}