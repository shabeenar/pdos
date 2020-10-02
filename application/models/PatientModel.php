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
        $this->db->from('patient');
        $this->db->where('id',$id);
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


}

?>
