<?php
Class WelcomeModel extends CI_Model {

    public function select(){
        $this->db->select('count(patient.id) as total_patient,patient_category.category_name as patient_category_name');
        $this->db->from('patient');
        $this->db->join('patient_category', 'patient_category.id = patient.patient_category_id');
        $this->db->group_by('patient.patient_category_id');
        $query = $this->db->get();
        return $query->result();

    }

}

?>
