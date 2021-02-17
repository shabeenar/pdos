<?php
Class ViewPurchaseModel extends CI_Model
{


    public function select()
    {
        $this->db->select('purchase.*, supplier.name as supplier_name');
        $this->db->from('purchase');
        $this->db->join('supplier', 'supplier.id = purchase.supplier_id');
        $query = $this->db->get();
        return $query->result();
    }


}
?>