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
        $this->db->select('item.*,item_category.name as category_name,unit.name as unit_name');
        $this->db->from('item');
        $this->db->join('item_category','item_category.id = item.item_category_id');
        $this->db->join('unit','unit.id = item.unit_id');
        $query = $this->db->get();
        return $query->result();
    }
}

?>
