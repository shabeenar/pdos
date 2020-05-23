<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notification extends CI_Controller {

    public function index()
    {
        $this->load->view('header');
        $this->load->view('notification/notification');
        $this->load->view('footer');
    }
}