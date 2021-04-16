<?php
Class PatientModel extends CI_Model {
    public function create($new_patient)
    {
        $this->db->insert('patient', $new_patient);
        if ($this->db->affected_rows() == 1) {
            return true;
        }
        else{
            return false;
        }
    }

    public function select(){
        $this->db->select('patient.*,cities.name_en as city_name,districts.name_en as district_name,provinces.name_en as province_name,ward.name as ward_name');
        $this->db->from('patient');
        $this->db->join('cities','cities.id = patient.city_id');
        $this->db->join('districts','districts.id = patient.district_id');
        $this->db->join('provinces','provinces.id = patient.province_id');
        $this->db->join('ward','ward.number = patient.ward_id');
        $this->db->where(array('patient.status' => 1));
        $query = $this->db->get();
        return $query->result();
    }

    public function get_patient($id){
        $this->db->select('patient.*,districts.name_en as district_name,provinces.name_en as province_name');
        $this->db->from('patient');
        $this->db->join('districts','districts.id = patient.district_id');
        $this->db->join('provinces','provinces.id = patient.province_id');
        $this->db->where('patient.id',$id);
        $query = $this->db->get();
        return $query->result();
    }

    public function update_patient($update, $id){
        $this->db->where('id',$id);
        $this->db->update('patient',$update);
        if ($this->db->affected_rows() == 1){
            return true;
        }
        else{
            return $this->db->error();
        }
    }

    public function inactivate($id){
        $this->db->where('id',$id );
        $this->db->update('patient',array('active' =>0));
        if ($this->db->affected_rows() == 1){
            return true;
        }
        else{
            return $this->db->error();
        }
    }

    public function activate($id){
        $this->db->where('id',$id );
        $this->db->update('patient',array('active' =>1));
        if ($this->db->affected_rows() == 1){
            return true;
        }
        else{
            return $this->db->error();
        }
    }

    public function delete_patient($id){
        $this->db->where('id', $id);
        $this->db->update('patient', array('status'=>0));
        if ($this->db->affected_rows() == 1){
            return true;
        }
        else{
            return false;
        }
    }

    public function get_ward(){
        $this->db->from('patient');
        $this->db->select();
        $query = $this->db->get();
        return $query->result();
    }

    public function check_phone($phone){
        $query = $this->db->from('patient')->where('phone', $phone);
        if(count($query->get()->result_array()) >= 1) {
            return true;
        }
        else {
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

    public function check_nic($nic){
        $query = $this->db->from('patient')->where('nic', $nic);
        if(count($query->get()->result_array()) >= 1) {
            return true;
        }
        else {
            return false;
        }
    }

    public function check_category_name($category_name){
        $query = $this->db->from('patient_category')->where('category_name', $category_name);
        if(count($query->get()->result_array()) >= 1) {
            return true;
        }
        else {
            return false;
        }
    }

    public function check_diet_name($category_name){
        $query = $this->db->from('diet_category')->where('category_name', $category_name);
        if(count($query->get()->result_array()) >= 1) {
            return true;
        }
        else {
            return false;
        }
    }

}

?>
