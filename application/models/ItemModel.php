<?php
Class ItemModel extends CI_Model {
    public function create($new_item)
    {
        $this->db->insert('item', $new_item);
        if ($this->db->affected_rows() == 1) {
            return true;
        }
        else{
            return false;
        }
    }

    public function select(){
        $this->db->select('item.*,item_category.name as category_name,unit.name as unit_name, ((item.quantity/item.maximum_quantity)*100) as inventory_level');
        $this->db->from('item');
        $this->db->join('item_category','item_category.id = item.item_category_id');
        $this->db->join('unit','unit.id = item.unit_id');
        $this->db->where(array('item.status' => 1));
        $query = $this->db->get();
        return $query->result();
    }

    public function get_item($id){
        $this->db->from('item');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->result();
    }

    public function update_item($update, $id){
        $this->db->where('id', $id);
        $this->db->update('item', $update);
        if ($this->db->affected_rows() == 1){
            return true;
        }
        else{
            return $this->db->error();
        }
    }

    public function delete_item($id){
        $this->db->where('id', $id);
        $this->db->update('item', array('status'=>0));
        if ($this->db->affected_rows() == 1){
            return true;
        }
        else{
            return false;
        }
    }

    public function get_single_product($id){
        $this->db->select('item.*,item_category.name as category_name,unit.name as unit_name, unit.id as unit_id');
        $this->db->from('item');
        $this->db->join('item_category','item_category.id = item.item_category_id');
        $this->db->join('unit','unit.id = item.unit_id');
        $this->db->where(array('item.id' => $id));
        $query = $this->db->get();
        return $query->result();
    }

    public function get_quantity($uom){
        $this->db->from('unit');
        $this->db->where('id', $uom);
        $query = $this->db->get();
        return $query->result();
    }
}

?>
