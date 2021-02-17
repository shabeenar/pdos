<?php
Class DietCategoryModel extends CI_Model {
    public function create($new_category)
    {
        $this->db->insert('diet_category', $new_category);
        if ($this->db->affected_rows() == 1) {
            return true;
        }
        else{
            return false;
        }
    }

    public function select(){
        $this->db->from('diet_category');
        $this->db->where('status', 1);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_dietcategory($id){
        $this->db->from('diet_category');
        $this->db->where('id',$id);
        $query = $this->db->get();
        return $query->result();
    }

    public function update_dietcategory($update, $id){

        $this->db->where('id',$id);
        $this->db->update('diet_category',$update);
        if ($this->db->affected_rows() == 1){
            return true;
        }
        else{
            return $this->db->error();
        }
    }

    public function delete_dietcategory($id){
        $this->db->where('id',$id);
        $this->db->update('diet_category', array('status'=>0));
        if ($this->db->affected_rows() == 1){
            return true;
        }
        else{
            return false;
        }

    }
}

?>
