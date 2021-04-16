<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AddIngredient extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if(!$this->session->userdata('name')) {
            redirect(redirect('login/login'));
        }
        $this->load->model('MealIngredientsModel');
        $this->load->model('ItemModel');
        $this->load->model('MealsModel');
    }

    public function index()
    {

        $id = $this->input->get('id');

        $data = array(
            'meal_ingredients' => $this->MealIngredientsModel->select($id),
        );

        $this->load->view('header');
        $this->load->view('kitchen/addingredient', $data);
        $this->load->view('footer');
    }

    public function generate_ingredient_line(){
        $products = $this->ItemModel->select();

        $row = '<option selected disabled>Select Product</option>';
        foreach($products as $product) {
            $row .= '<option value="'.$product->id.'">'.$product->name.'</option>';
        }
        echo $row;
    }

    public function add_ingredient(){
        $meal = array(
            'meals_id' => $this->input->post('meal_name'),
        );

        $meal_id = $this->MealIngredientsModel->create_meal($meal);

        $ingredient_lines = array();
        $lines = array();

        for ($i = 0; $i < count($this->input->post('ingredient_product')); $i++) {
            $lines['meal_id'] = $meal_id;
            $lines['item_id'] = $this->input->post('ingredient_product')[$i];
            $lines['quantity'] = $this->input->post('ingredient_qty')[$i];
            array_push($ingredient_lines, $lines);
        }

        $result = $this->MealIngredientsModel->add_ingredient($ingredient_lines, $meal_id);
    }


}