<?php
Class WardModel extends CI_Model {
    public function create($new_ward)
    {
        $this->db->insert('ward', $new_ward);
        if ($this->db->affected_rows() == 1) {
            return true;
        }
        else{
            return false;
        }
    }
//get db data
    public function select(){
        $this->db->from('ward');
        $query = $this->db->get();
        return $query->result();
    }
}

?>
