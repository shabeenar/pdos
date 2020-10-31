<?php
Class ViewModel extends CI_Model
{


    public function mainlines($data)
    {
        $this->db->select('purchase.*, supplier.name as supplier_name');
        $this->db->from('purchase');
        $this->db->join('supplier', 'supplier.id = purchase.supplier_id');
        $this->db->where('purchase.id', $data);
        $query = $this->db->get();
        return $query->result();
    }

    public function lines($data){
        $this->db->select('purchase_lines.*, item.name as item_name, unit.unit as unit_name');
        $this->db->from('purchase_lines');
        $this->db->join('item','item.id = purchase_lines.item_id');
        $this->db->join('unit','unit.id = purchase_lines.unit_id');
        $this->db->where('purchase_id', $data);
        $query = $this->db->get();
        return $query->result();
    }

    public function addtostock($id){
        $this->db->where('id', $id);
        $this->db->update('purchase', array('status'=>2));
        if ($this->db->affected_rows()==1){
            return true;
        }
        else {
            return false;
        }
    }




}
?>