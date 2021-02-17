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
        $this->db->where('status', 1);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_ward($id){
        $this->db->from('ward');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->result();
    }

    public function update_ward($update, $id){
        $this->db->where('id',$id);
        $this->db->update('ward',$update);
        if ($this->db->affected_rows() == 1){
            return true;
        }
        else{
            return $this->db->error();
        }
    }

    public function delete_ward($id){
        $this->db->where('id',$id);
        $this->db->update('ward', array('status'=>0));
        if ($this->db->affected_rows() == 1){
            return true;
        }
        else{
            return false;
        }

    }
}

?>
