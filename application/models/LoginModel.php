<?php
Class LoginModel extends CI_Model {

    public function login_user($create){
        $this->db->select('users.*,ward.name as ward_name, role_names.role as role_name, cities.name_en as city_name, districts.name_en as district_name, provinces.name_en as province_name');
        $this->db->from('users');
        $this->db->join('ward','ward.number = users.ward_id');
        $this->db->join('role_names','role_names.id = users.role_id');
        $this->db->join('cities','cities.id = users.city_id');
        $this->db->join('districts','districts.id = users.district_id');
        $this->db->join('provinces','provinces.id = users.province_id');
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