<?php
Class ReportModel extends CI_Model {

    public function select(){
        $this->db->from('');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_total_users($from, $to){
        $this->db->select('users.*, role_names.role as role_name');
        $this->db->from('users');
        $this->db->join('role_names', 'role_names.id = users.role_id');
        $this->db->where('create_date >=', $from);
        $this->db->where('create_date <=', $to);

        $query = $this->db->get();
        return $query->result();
    }

    public function get_total_orders($from, $to){
        $this->db->select('order_lines.*, ward.name as ward_name, patient_category.category_name as patient_category_name, order.order_date as order_date');
        $this->db->from('order_lines');
        $this->db->join('ward','ward.id = order_lines.ward_id');
        $this->db->join('patient_category','patient_category.id = order_lines.patient_category_id');
        $this->db->join('order','order.id = order_lines.order_id');
        $this->db->where('order_date >=', $from);
        $this->db->where('order_date <=', $to);

        $query = $this->db->get();
        return $query->result();
    }

    // to get the monthly production
//    public function total_monthly_production()
//    {
//        $this->db->select_sum('manufacturing_order_lines.quantity');
//        $this->db->select('manufacturing_order_lines.*,MONTHNAME(manufacturing.complete_date) as createDate');
//        $this->db->from('manufacturing_order_lines');
//        $this->db->join('products', 'products.id=manufacturing_order_lines.product_id');
//        $this->db->join('manufacturing', 'manufacturing.id=manufacturing_order_lines.manufacturing_id');
//        $this->db->where('manufacturing.status', 'Complete');
//        $this->db->group_by('MONTHNAME(manufacturing.complete_date)');
//        $this->db->order_by('manufacturing_order_lines.manufacturing_id','asd');
//        $query = $this->db->get();
//        return $query->result();
//    }

    public function get_total_expenses($from, $to){
        $this->db->select('purchase.*, supplier.name as supplier_name');
        $this->db->from('purchase');
        $this->db->join('supplier', 'supplier.id = purchase.supplier_id');

        $this->db->where('date >=', $from);
        $this->db->where('date <=', $to);
        $this->db->where('total_price>25000');
        $this->db->order_by('purchase.total_price','asd');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_total_patients($from,$to,$ward,$patient_category,$diet_category){
        $this->db->select('patient.*,patient_category.category_name as patient_category, ward.name as ward_name, diet_category.category_name as diet_category');
        $this->db->from('patient');
        $this->db->join('patient_category','patient_category.id = patient.patient_category_id');
        $this->db->join('ward','ward.id = patient.ward_id');
        $this->db->join('diet_category','diet_category.id = patient.diet_category_id');
        $this->db->where('in_date >=', $from);
        $this->db->where('in_date <=', $to);
        $this->db->where('ward_id', $ward);
        $this->db->where('patient_category_id', $patient_category);
        $this->db->where('diet_category_id', $diet_category);

        $query = $this->db->get();
        return $query->result();
    }
}

?>
