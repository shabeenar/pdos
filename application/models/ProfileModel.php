<?php
Class ProfileModel extends CI_Model {

    public function update_user($update, $id){
        $this->db->where('id',$id);
        $this->db->update('user',$update);
        if ($this->db->affected_rows() == 1){
            return true;
        }
        else{
            return $this->db->error();
        }
    }


}

?>
