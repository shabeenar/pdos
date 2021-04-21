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

    public function dashboard_patients(){
        $this->db->select('count(patient.id) as total_patient');
        $this->db->from('patient');
        $query = $this->db->get();
        return $query->result();

    }

    public function dashboard_meal_orders(){
        $this->db->select('count(order.id) as total_order');
        $this->db->from('order');
        $query = $this->db->get();
        return $query->result();

    }

    public function dashboard_purchases(){
        $this->db->select('count(purchase.id) as total_purchase');
        $this->db->from('purchase');
        $query = $this->db->get();
        return $query->result();

    }

    public function dashboard_items(){
        $this->db->select('count(item.id) as total_item');
        $this->db->from('item');
        $query = $this->db->get();
        return $query->result();

    }

    public function dashboard_users(){
        $this->db->select('users.*,ward.name as ward_name, role_names.role as role_name');
        $this->db->from('users');
        $this->db->join('ward','ward.number = users.ward_id');
        $this->db->join('role_names','role_names.id = users.role_id');
        $query = $this->db->get();
        return $query->result();

    }

}

?>
