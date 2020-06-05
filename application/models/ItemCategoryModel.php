<?php
Class ItemCategoryModel extends CI_Model {
    public function create($new_itemcategory)
    {
        $this->db->insert('item_category', $new_itemcategory);
        if ($this->db->affected_rows() == 1) {
            return true;
        }
        else{
            return false;
        }
    }

    public function select(){
        $this->db->from('item_category');
        $query = $this->db->get();
        return $query->result();
    }
}

?>
