<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CreateOrder extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if(($this->session->userdata('role_id')==5 ) OR ($this->session->userdata('role_id')==2 )) {
            if(!$this->session->userdata('name')) {
                redirect(redirect('login/login'));
            }

        $this->load->model('OrderModel');
        $this->load->model('PatientModel');
        $this->load->model('PatientCategoryModel');
        $this->load->model('WardModel');
        $this->load->model('MealsModel');

        } else{
            $this->session->set_flashdata('access_alert', array('access_alert' => false));
            redirect('login/Login');
        }
    }

    public function index()
    {
        $data = array(
            'orders'   => $this->OrderModel->select(),
        );

        $this->load->view('header');
        $this->load->view('kitchen/createorder', $data);
        $this->load->view('footer');
    }

    public function create_mealorder()
    {
        $date = $this->input->post('date');
        $order_id = $this->OrderModel->create($date);

        $order_lines = array();
        $lines = array();

        for ($i = 0; $i < count($this->input->post('order_patient_ward')); $i++) {
            $lines['order_id'] = $order_id;
            $lines['ward_id'] = $this->input->post('order_patient_ward')[$i];
            $lines['patient_category_id'] = $this->input->post('order_patient_category')[$i];
            $lines['diet_category_id'] = $this->input->post('order_diet_category')[$i];
            $lines['total_patients'] = $this->input->post('order_total_patient')[$i];
            $lines['breakfast_meal_id'] = $this->input->post('order_breakfast')[$i];
            $lines['lunch_meal_id'] = $this->input->post('order_lunch')[$i];
            $lines['dinner_meal_id'] = $this->input->post('order_dinner')[$i];
//            $this->OrderModel->update_order_quantity($this->input->post('product_id')[$i], $this->input->post('sales_qty')[$i]);
            array_push($order_lines,$lines);
        }
        $result = $this->OrderModel->create_mealorder($order_lines,$order_id);
        redirect('kitchen/order');

    }

    public function generate_order_line()
    {
        $wards = $this->WardModel->select();

        $row = '<option selected disabled>Select Category</option>';
        foreach ($wards as $ward) {
            $row .= '<option value="' . $ward->id . '">' . $ward->name . '</option>';
        }
        echo $row;
    }

    public function get_single_ward(){
        $id = $this->input->post('id');
        $result = $this->PatientModel->get_single_ward($id);
        echo json_encode($result);

    }

    public function get_ward_categories(){
        $id = $this->input->post('id');
        $result = $this->OrderModel->get_ward_categories($id);
        echo json_encode($result);
    }

//    new
    public function get_patient_categories(){
        $id = $this->input->post('id');
        $result = $this->OrderModel->get_patient_categories($id);
        echo json_encode($result);
    }

    public function get_total_patients(){
        $id = $this->input->post('id');
        $ward = $this->input->post('ward_id');
        $patient_category = $this->input->post('patient_category_id');
        $result = $this->OrderModel->get_total_patients($id, $ward, $patient_category);
        echo json_encode($result);
    }

    public function get_breakfast(){
        $result = $this->OrderModel->get_breakfast();
        $row = '<option selected disabled>Select Menu</option>';
        foreach ($result as $breakfast){
            $row .= '<option value=" ' . $breakfast->id . '">'. $breakfast->meal_name . '</option>';
        }
        echo $row;
    }

    public function get_lunch(){
        $result = $this->OrderModel->get_lunch();
        $row = '<option selected disabled>Select Menu</option>';
        foreach ($result as $lunch){
            $row .= '<option value=" ' . $lunch->id . '">'. $lunch->meal_name . '</option>';
        }
        echo $row;
    }

    public function get_dinner(){
        $result = $this->OrderModel->get_dinner();
        $row = '<option selected disabled>Select Menu</option>';
        foreach ($result as $dinner){
            $row .= '<option value=" ' . $dinner->id . '">'. $dinner->meal_name . '</option>';
        }
        echo $row;
    }

}