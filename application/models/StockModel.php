<?php
Class StockModel extends CI_Model {

    public function select(){
        $this->db->select('stock.*,item.item_category_id as category_name,item.unit_id as unit_name');
        $this->db->from('stock');
        $this->db->join('item','item.id = stock.category_id', 'item.id = stock.unit_id');
        $query = $this->db->get();
        return $query->result();
    }
}

?>
