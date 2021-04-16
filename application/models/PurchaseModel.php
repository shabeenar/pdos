<?php
Class PurchaseModel extends CI_Model
{

//    public function select()
//    {
//        $this->db->from('purchase');
//        $query = $this->db->get();
//        return $query->result();
//    }

    public function select()
    {
        $this->db->select('purchase.*, supplier.name as supplier_name');
        $this->db->from('purchase');
        $this->db->join('supplier', 'supplier.id = purchase.supplier_id');
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

    public function addtostock($id, $confirm_date){
        $this->db->where('id', $id);
        $this->db->update('purchase', array('status'=>2, 'confirm_date'=>$confirm_date));

        if ($this->db->affected_rows()==1){
            return true;
        }
        else {
            return false;
        }
    }
    public function get_purchases($po_id){
        $this->db->select('purchase_lines.*, item.name as item_name, unit.unit as unit_name');
        $this->db->from('purchase_lines');
        $this->db->join('item','item.id = purchase_lines.item_id');
        $this->db->join('unit','unit.id = purchase_lines.unit_id');
        $this->db->where('purchase_lines.purchase_id', $po_id);
        $this->db->order_by('purchase_lines.id','asd');
        $query = $this->db->get();
        return $query->result();
    }

    public function update_quantity($purchase_quantity,$products){
        $this->db->select('quantity');
        $this->db->from('item');
        $this->db->where('item.id',$products);
        $query = $this->db->get();
        $quantity = $query->result();

        $new_po_quantity = (float)$quantity[0]->quantity+ (float)$purchase_quantity;


        $this->db->where('id',$products);
        $this->db->update('item',array('quantity'=>$new_po_quantity));

    }

    public function confirm_po($po_id,$data){
        $this->db->where('id',$po_id);
        $this->db->update('purchase',$data);
        if ($this->db->affected_rows() == 1) {
            return true;
        }
        else {
            return false;
        }

    }

    public function cancel_po($po_id){
        $this->db->where('id',$po_id);
        $this->db->update('purchase',array('status' => 0));
        if ($this->db->affected_rows() == 1) {
            return true;
        }
        else {
            return false;
        }
    }

}
?>