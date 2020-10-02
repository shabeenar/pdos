<?php
Class PurchaseModel extends CI_Model
{

    public function select()
    {
        $this->db->from('purchase');
        $query = $this->db->get();
        return $query->result();
    }



}
?>