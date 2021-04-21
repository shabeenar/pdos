<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MealIngredients extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if(!$this->session->userdata('name')) {
            redirect(redirect('login/login'));
        }
        $this->load->model('MealIngredientsModel');

    }

    public function index()
    {
        $id = $this->input->get('id');

        $data = array(
            'ingredients' => $this->MealIngredientsModel->select($id),
            'meals' => $this->MealIngredientsModel->select_meal($id),
        );


        $this->load->view('header');
        $this->load->view('kitchen/mealingredients',$data);
        $this->load->view('footer');
    }


}