<?php
Class UnitModel extends CI_Model {
    public function create($new_unit)
    {
        $this->db->insert('unit', $new_unit);
        if ($this->db->affected_rows() == 1) {
            return true;
        }
        else{
            return false;
        }
    }

    public function select(){
        $this->db->from('unit');
        $query = $this->db->get();
        return $query->result();
    }
}

?>
