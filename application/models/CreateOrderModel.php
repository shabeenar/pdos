<?php
Class CreateOrderModel extends CI_Model
{

    public function select()
    {
        $this->db->from('order');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_ward_categories($id){
        $this->db->select('patient_category.id as category_id, patient_category.category_name as category_name');
        $this->db->from('patient');
        $this->db->join('patient_category', 'patient_category.id = patient.patient_category_id');
        $this->db->where('ward_id',$id);
        $this->db->group_by('patient.patient_category_id');
        $query = $this->db->get();
        return $query->result();

    }

    public function get_total_patients($id,$ward){
        $this->db->from('patient');
        $this->db->where(array('patient_category_id'=>$id,'ward_id'=>$ward));
        return $this->db->count_all_results();
    }

    public function get_breakfast(){
        $this->db->where('breakfast',1);
        $this->db->from('meals');
        $query = $this->db->get();
        return $query->result();

    }

    public function get_lunch(){
        $this->db->where('lunch',1);
        $this->db->from('meals');
        $query = $this->db->get();
        return $query->result();

    }

    public function get_dinner(){
        $this->db->where('dinner',1);
        $this->db->from('meals');
        $query = $this->db->get();
        return $query->result();

    }

    public function create($date){
        $this->db->insert('order', array('order_date'=>$date));
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }




}
?>