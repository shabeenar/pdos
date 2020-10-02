<?php
Class DistrictModel extends CI_Model {

    public function select(){
        $this->db->from('districts');
        $query = $this->db->get();
        return $query->result();
    }
}

?>
