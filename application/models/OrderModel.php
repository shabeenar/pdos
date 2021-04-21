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
        $this->db->where('id', $data);
        $query = $this->db->get();
        return $query->result();
    }

    public function lines($data){
        $this->db->select('order_lines.*, ward.name as ward_name, patient_category.category_name as patient_category_name, 
        diet_category.category_name as diet_category_name, bf.meal_name as breakfast, ln.meal_name as lunch, dn.meal_name as dinner');
        $this->db->from('order_lines');
        $this->db->join('ward','ward.id = order_lines.ward_id');
        $this->db->join('patient_category','patient_category.id = order_lines.patient_category_id');
        $this->db->join('diet_category','diet_category.id = order_lines.diet_category_id');
        $this->db->join('meals bf','bf.id = order_lines.breakfast_meal_id');
        $this->db->join('meals ln','ln.id = order_lines.lunch_meal_id');
        $this->db->join('meals dn','dn.id = order_lines.dinner_meal_id');
        $this->db->where('order_lines.order_id', $data);
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

//    new
    public function get_patient_categories($id){
        $this->db->select('diet_category.id as category_id, diet_category.category_name as category_name');
        $this->db->from('patient');
        $this->db->join('diet_category', 'diet_category.id = patient.diet_category_id');
        $this->db->where('patient.patient_category_id',$id);
        $this->db->group_by('patient.diet_category_id');
        $query = $this->db->get();
        return $query->result();

    }

    public function get_total_patients($id, $ward, $patient_category){
        $this->db->from('patient');
        $this->db->where(array('patient_category_id'=>$patient_category, 'diet_category_id'=>$id, 'ward_id'=>$ward));
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

    public function create_mealorder($order_lines,$order_id){
        $this->db->insert_batch('order_lines',$order_lines);
        $query = $this->db->get_where('order_lines',array('order_id'=>$order_id));
        return $query->result();
    }


    public function confirm_order($order_id,$data){
        $this->db->where('id', $order_id);
        $this->db->update('order', array('status'=>2, 'confirm_date'=>$data));

        if ($this->db->affected_rows()==1){
            return true;
        }
        else {
            return false;
        }

    }

    public function cancel_order($order_id){
        $this->db->where('id',$order_id);
        $this->db->update('order',array('status' => 0));
        if ($this->db->affected_rows() == 1) {
            return true;
        }
        else {
            return false;
        }
    }


}
?>