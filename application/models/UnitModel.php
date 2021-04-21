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
        $this->db->where('status', 1);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_unit($id){
        $this->db->from('unit');
        $this->db->where('id',$id);
        $query = $this->db->get();
        return $query->result();
    }

    public function update_unit($update, $id){
        $this->db->where('id',$id);
        $this->db->update('unit',$update);
        if ($this->db->affected_rows() == 1){
            return true;
        }
        else{
            return $this->db->error();
        }
    }

    public function delete_unit($id){
        $this->db->where('id',$id);
        $this->db->update('unit', array('status'=>0));
        if ($this->db->affected_rows() == 1){
            return true;
        }
        else{
            return false;
        }

    }

    public function check_name($name) {
        $query = $this->db->select("*")->from('unit')->where('name', $name);
        if(count($query->get()->result_array()) == 1) {
            return true;
        }
        else {
            return false;
        }
    }
}

?>
