<?php
Class SupplierModel extends CI_Model {
    public function create($new_supplier)
    {
        $this->db->insert('supplier', $new_supplier);
        if ($this->db->affected_rows() == 1) {
            return true;
        }
        else{
            return false;
        }
    }

//get data from db
    public function select(){
        $this->db->select('supplier.*,cities.name_en as city_name,districts.name_en as district_name,provinces.name_en as province_name');
        $this->db->from('supplier');
        $this->db->join('cities','cities.id = supplier.city_id');
        $this->db->join('districts','districts.id = supplier.district_id');
        $this->db->join('provinces','provinces.id = supplier.province_id');
        $this->db->where(array('supplier.status' => 1));
        $query = $this->db->get();
        return $query->result();
    }

    public function get_supplier($id){
        $this->db->select('supplier.*,districts.name_en as district_name,provinces.name_en as province_name');
        $this->db->from('supplier');
        $this->db->join('districts','districts.id = supplier.district_id');
        $this->db->join('provinces','provinces.id = supplier.province_id');
        $this->db->where('supplier.id',$id);
        $query = $this->db->get();
        return $query->result();
    }

    public function update_supplier($update, $id){
        $this->db->where('id',$id);
        $this->db->update('supplier',$update);
        if ($this->db->affected_rows() == 1){
            return true;
        }
        else{
            return $this->db->error();
        }
    }

    public function inactivate($id){
        $this->db->where('id',$id );
        $this->db->update('supplier',array('active' =>0));
        if ($this->db->affected_rows() == 1){
            return true;
        }
        else{
            return $this->db->error();
        }
    }

    public function activate($id){
        $this->db->where('id',$id );
        $this->db->update('supplier',array('active' =>1));
        if ($this->db->affected_rows() == 1){
            return true;
        }
        else{
            return $this->db->error();
        }
    }

    public function delete_supplier($id){
        $this->db->where('id',$id);
        $this->db->update('supplier', array('status'=>0));
        if ($this->db->affected_rows() == 1){
            return true;
        }
        else{
            return false;
        }

    }

    public function get_district_province_postalcode($id){
        $this->db->select('cities.*,districts.name_en as district_name,provinces.name_en as province_name, provinces.id as province_id');
        $this->db->from('cities');
        $this->db->join('districts','districts.id = cities.district_id');
        $this->db->join('provinces','provinces.id = districts.province_id');
        $this->db->where('cities.id', $id);
        $query = $this->db->get();
        return $query->result();
    }

}

?>
