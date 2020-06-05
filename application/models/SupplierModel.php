<?php
Class SupplierModel extends CI_Model {
    public function create($new_supplier)
    {
        $this->db->insert('supplier', $new_supplier);
        if ($this->db->affected_rows() == 1) {
            return true;
        }
        else{
            return false;
        }
    }

//get data from db
    public function select(){
        $this->db->from('supplier');
        $query = $this->db->get();
        return $query->result();
    }
}

?>
