<?php
Class ItemCategoryModel extends CI_Model {
    public function create($new_itemcategory)
    {
        $this->db->insert('item_category', $new_itemcategory);
        if ($this->db->affected_rows() == 1) {
            return true;
        }
        else{
            return false;
        }
    }

    public function select(){
        $this->db->from('item_category');
        $this->db->where('status', 1);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_itemcategory($id){
        $this->db->from('item_category');
        $this->db->where('id',$id);
        $query = $this->db->get();
        return $query->result();
    }

    public function update_itemcategory($update,$id){
        $this->db->where('id',$id);
        $this->db->update('item_category',$update);
        if ($this->db->affected_rows() == 1){
            return true;
        }
        else{
            return $this->db->error();
        }
    }

    public function delete_itemcategory($id){
        $this->db->where('id', $id);
        $this->db->update('item_category', array('status'=>0));
        if ($this->db->affected_rows() == 1){
            return true;
        }
        else{
            return false;
        }
    }

    public function check_name($name) {
        $query = $this->db->select("*")->from('item_category')->where('name', $name);
        if(count($query->get()->result_array()) == 1) {
            return true;
        }
        else {
            return false;
        }
    }

}

?>
