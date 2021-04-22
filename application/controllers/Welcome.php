<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if(!$this->session->userdata('name')) {
            redirect(redirect('login/login'));
        }
        $this->load->model('WelcomeModel');
    }

	
	public function index()
	{

	    $categories = $this->WelcomeModel->select();



	    foreach ($categories as $category){
	        $chart_data[] = array(
                'value' => $category->total_patient,
                'color' => '#' . dechex(mt_rand(0, 16777215)),
                'highlight' => '#' . dechex(mt_rand(0, 16777215)),
                'label' => $category->patient_category_name,
            );


        }


        if ($chart_data) {
            $chart_data = (preg_replace('/"([^"]+)"\s*:\s*/', '$1:', json_encode($chart_data)));
        }

	    $data = array(
	        'piedata' => $chart_data,
            'patients' => $this->WelcomeModel->dashboard_patients(),
            'meal_orders' => $this->WelcomeModel->dashboard_meal_orders(),
            'purchases' => $this->WelcomeModel->dashboard_purchases(),
            'items' => $this->WelcomeModel->dashboard_items(),
            'users' => $this->WelcomeModel->dashboard_users(),
        );



		$this->load->view('header');
		$this->load->view('welcome_message', $data);
		$this->load->view('footer');
	}

}
