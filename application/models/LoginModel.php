<?php
Class LoginModel extends CI_Model {

    public function login_user($create){
        $this->db->from('users');
        $this->db->where($create);
        $query = $this->db->get();
        return $query->result();
    }





}