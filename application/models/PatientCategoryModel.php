<?php
Class PatientCategoryModel extends CI_Model {
    public function create($new_category)
    {
        $this->db->insert('patient_category', $new_category);
        if ($this->db->affected_rows() == 1) {
            return true;
        }
        else{
            return false;
        }
    }

    public function select(){
        $this->db->from('patient_category');
        $this->db->where('status', 1);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_patientcategory($id){
        $this->db->from('patient_category');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->result();
    }

    public function update_patientcategory($update, $id){
        $this->db->where('id', $id);
        $this->db->update('patient_category', $update);
        if ($this->db->affected_rows() == 1){
            return true;
        }
        else{
            return $this->db->error();
        }
    }

    public function delete_patientcategory($id){
        $this->db->where('id',$id);
        $this->db->update('patient_category', array('status'=>0));
        if ($this->db->affected_rows() == 1){
            return true;
        }
        else{
            return false;
        }

    }

}

?>
