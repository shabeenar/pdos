<?php
Class MealsModel extends CI_Model {
    public function create($new_meal)
    {
        $this->db->insert('meals', $new_meal);
        if ($this->db->affected_rows() == 1) {
            return true;
        }
        else{
            return false;
        }
    }

    public function select(){
        $this->db->from('meals');
        $this->db->where('status', 1);
        $this->db->order_by('code', 'asd');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_meal($id){
        $this->db->from('meals');
        $this->db->where('id',$id);
        $query = $this->db->get();
        return $query->result();
    }

    public function update_meal($update, $id){
        $this->db->where('id',$id);
        $this->db->update('meals',$update);
        if ($this->db->affected_rows() == 1){
            return true;
        }
        else{
            return $this->db->error();
        }
    }

    public function delete_meal($id){
        $this->db->where('id',$id);
        $this->db->update('meals', array('status'=>0));
        if ($this->db->affected_rows() == 1){
            return true;
        }
        else{
            return false;
        }

    }




}

?>
