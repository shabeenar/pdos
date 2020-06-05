<?php
Class DietCategoryModel extends CI_Model {
    public function create($new_category)
    {
        $this->db->insert('diet_category', $new_category);
        if ($this->db->affected_rows() == 1) {
            return true;
        }
        else{
            return false;
        }
    }

    public function select(){
        $this->db->from('diet_category');
        $query = $this->db->get();
        return $query->result();
    }
}

?>
