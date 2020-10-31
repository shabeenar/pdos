<?php
Class OrderModel extends CI_Model
{

    public function select()
    {
        $this->db->from('order');
        $query = $this->db->get();
        return $query->result();
    }

    public function mainlines($data)
    {
        $this->db->from('order');
        $this->db->where('order.id', $data);
        $query = $this->db->get();
        return $query->result();
    }

    public function lines($data){
        $this->db->select('order_lines.*, ward.name as ward_name, patient_category.category_name as patient_category_name, bf.meal_name as breakfast, ln.meal_name as lunch, dn.meal_name as dinner');
        $this->db->from('order_lines');
        $this->db->join('ward','ward.id = order_lines.ward_id');
        $this->db->join('patient_category','patient_category.id = order_lines.patient_category_id');
        $this->db->join('meals bf','bf.id = order_lines.breakfast_meal_id');
        $this->db->join('meals ln','ln.id = order_lines.lunch_meal_id');
        $this->db->join('meals dn','dn.id = order_lines.dinner_meal_id');
        $this->db->where('order_id', $data);
        $query = $this->db->get();
        return $query->result();
    }

}
?>