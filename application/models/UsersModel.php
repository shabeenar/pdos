<?php
Class UsersModel extends CI_Model {
    public function create($new_user)
    {
        $this->db->insert('users', $new_user);
        if ($this->db->affected_rows() == 1) {
            return true;
        }
        else{
            return false;
        }
    }

//get data from db
    public function select(){
        $this->db->from('users');
        $query = $this->db->get();
        return $query->result();
    }
}

?>
