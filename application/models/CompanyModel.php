<?php
Class CompanyModel extends CI_Model {

    public function select(){
        $this->db->from('company_details');
        $query = $this->db->get();
        return $query->result();
    }

    public function update_company($update, $id){
        $this->db->where('id', $id);
        $this->db->update('company_details', $update);
        if ($this->db->affected_rows() == 1){
            return true;
        }
        else{
            return $this->db->error();
        }
    }
}

?>
