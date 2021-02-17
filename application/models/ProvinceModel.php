<?php
Class ProvinceModel extends CI_Model {

    public function select(){
        $this->db->from('provinces');
        $query = $this->db->get();
        return $query->result();
    }
}

?>
