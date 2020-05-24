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
        $this->db->from('patient');
        $query = $this->db->get();
        return $query->result();
    }
}

?>
