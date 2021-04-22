<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AddIngredient extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if(($this->session->userdata('role_id')==5 ) OR ($this->session->userdata('role_id')==3 )) {
            if(!$this->session->userdata('name')) {
                redirect(redirect('login/login'));
            }

        $this->load->model('MealIngredientsModel');
        $this->load->model('ItemModel');
        $this->load->model('MealsModel');
        $this->load->model('ItemCategoryModel');

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
            'meals' => $this->MealIngredientsModel->select_meal($id),
        );


        $this->load->view('header');
        $this->load->view('kitchen/addingredient', $data);
        $this->load->view('footer');
    }

    public function generate_ingredient_line(){
        $categories = $this->ItemCategoryModel->select();

        $row = '<option selected disabled>Select Category</option>';
        foreach($categories as $category) {
            $row .= '<option value="'.$category->id.'">'.$category->name.'</option>';
        }
        echo $row;
    }

    public function get_item_names(){
        $id = $this->input->post('id');
        $result = $this->MealIngredientsModel->get_item_names($id);
        echo json_encode($result);
    }

    public function add_ingredient(){

        $ingredient = array(
            'meals_id' => $this->input->post('meal_id'),
            'date' => $this->input->post('date'),
        );

        $ingredient_id = $this->MealIngredientsModel->create($ingredient);


        $ingredient_lines = array();
        $lines = array();

        for ($i = 0; $i < count($this->input->post('ingredient_product_category')); $i++) {
            $lines['meal_ingredient_id'] = $ingredient_id;
            $lines['item_category_id'] = $this->input->post('ingredient_product_category')[$i];
            $lines['item_id'] = $this->input->post('ingredient_product')[$i];
            $lines['quantity'] = $this->input->post('ingredient_qty')[$i];
            array_push($ingredient_lines, $lines);
        }

        $result = $this->MealIngredientsModel->add_ingredient($ingredient_lines, $ingredient_id);

        if ($result == true) {
            redirect('kitchen/mealingredients?id='. $ingredient_id);
        }else if ($result == false) {
            redirect('kitchen/AddIngredient');
        }

    }

    public function check_quantity(){
        $id= $this->input->post('ingredient_product');
        $result = $this->MealIngredientsModel->check_quantity($id);

        echo json_encode($result);


    }


}