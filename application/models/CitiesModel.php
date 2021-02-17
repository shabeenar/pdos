<?php
Class CitiesModel extends CI_Model {

    public function select(){
        $this->db->from('cities');
        $query = $this->db->get();
        return $query->result();
    }
}

?>
