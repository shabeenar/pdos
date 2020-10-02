<?php
Class RoleNames extends CI_Model {

    public function select(){
        $this->db->from('role_names');
        $query = $this->db->get();
        return $query->result();
    }
}

?>
