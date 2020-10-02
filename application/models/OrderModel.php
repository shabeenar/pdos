<?php
Class OrderModel extends CI_Model
{

    public function select()
    {
        $this->db->from('order');
        $query = $this->db->get();
        return $query->result();
    }



}
?>