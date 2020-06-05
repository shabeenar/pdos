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
        $this->db->from('item');
        $query = $this->db->get();
        return $query->result();
    }
}

?>
