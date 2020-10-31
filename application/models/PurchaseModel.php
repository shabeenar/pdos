<?php
Class PurchaseModel extends CI_Model
{

    public function select()
    {
        $this->db->from('purchase');
        $query = $this->db->get();
        return $query->result();
    }

    public function create($purchase){
        $this->db->insert('purchase', $purchase);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    public function create_purchase($purchase_lines, $purchase_id){
        $this->db->insert_batch('purchase_lines', $purchase_lines);
        $query = $this->db->get_where('purchase_lines', array('purchase_id'=>$purchase_id));
        return $query->result();
    }


}
?>