<?php
Class UsersModel extends CI_Model {
    public function create($new_user)
    {
        $this->db->insert('users', $new_user);
        if ($this->db->affected_rows() == 1) {
            return true;
        }
        else{
            return false;
        }


    }

//get data from db
    public function select(){
        $this->db->select('users.*,ward.name as ward_name, role_names.role as role_name');
        $this->db->from('users');
        $this->db->join('ward','ward.id = users.ward_id');
        $this->db->join('role_names','role_names.id = users.role_id');
        $this->db->where(array('users.status' => 1));
        $query = $this->db->get();
        return $query->result();
    }

    public function get_user($id){
        $this->db->from('users');
        $this->db->where('users.id',$id);
        $query = $this->db->get();
        return $query->result();

//        $this->db->select('users.*,districts.name_en as district_name,provinces.name_en as province_name');
//        $this->db->from('users');
//        $this->db->join('districts','districts.id = users.district_id');
//        $this->db->join('provinces','provinces.id = users.province_id');
//        $this->db->where('users.id',$id);
//        $query = $this->db->get();
//        return $query->result();
    }

    public function update_user($update, $id){
        $this->db->where('id',$id);
        $this->db->update('users',$update);
        if ($this->db->affected_rows() == 1){
            return true;
        }
        else{
            return $this->db->error();
        }
    }

    public function inactivate($id){
        $this->db->where('id',$id );
        $this->db->update('users',array('active' =>0));
        if ($this->db->affected_rows() == 1){
            return true;
        }
        else{
            return $this->db->error();
        }
    }

    public function activate($id){
        $this->db->where('id',$id );
        $this->db->update('users',array('active' =>1));
        if ($this->db->affected_rows() == 1){
            return true;
        }
        else{
            return $this->db->error();
        }
    }

    public function delete_user($id){
        $this->db->where('id',$id);
        $this->db->update('users', array('status'=>0));
        if ($this->db->affected_rows() == 1){
            return true;
        }
        else{
            return false;
        }

    }

    public function get_district_province_postalcode($id){
        $this->db->select('cities.*,districts.name_en as district_name,provinces.name_en as province_name, provinces.id as province_id');
        $this->db->from('cities');
        $this->db->join('districts','districts.id = cities.district_id');
        $this->db->join('provinces','provinces.id = districts.province_id');
        $this->db->where('cities.id', $id);
        $query = $this->db->get();
        return $query->result();
    }

    public function check_nic($nic) {
        $query = $this->db->select("*")->from('users')->where('nic', $nic);
        if(count($query->get()->result_array()) == 1) {
            return true;
        }
        else {
            return false;
        }
    }

    public function check_phone($phone) {
        $query = $this->db->select("*")->from('users')->where('phone', $phone);
        if(count($query->get()->result_array()) == 1) {
            return true;
        }
        else {
            return false;
        }
    }

    public function check_email($email) {
        $query = $this->db->select("*")->from('users')->where('email', $email);
        if(count($query->get()->result_array()) == 1) {
            return true;
        }
        else {
            return false;
        }
    }
}

?>
