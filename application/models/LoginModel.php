<?php
Class LoginModel extends CI_Model {

    public function login_user($create){
        $this->db->from('users');
        $this->db->where($create);
        $query = $this->db->get();
        return $query->result();
    }

    public function forgotpassword($email){
        $this->db->from('users');
        $this->db->where('email',$email);
        $query = $this->db->get();
        return $query->result();

    }

    public function updatepassword($email,$randomString){
        $this->db->where('email', $email);
        $this->db->update('users', array('password'=>sha1($randomString)));
    }





}