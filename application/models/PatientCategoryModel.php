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
        $query = $this->db->get();
        return $query->result();
    }
}

?>
