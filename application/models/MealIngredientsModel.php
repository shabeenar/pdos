<?php
Class MealIngredientsModel extends CI_Model {

    public function select_meal($id){
        $this->db->from('meals');
        $this->db->where('meals.id', $id);
        $this->db->order_by('meals.id','asd');
        $query = $this->db->get();
        return $query->result();
    }

    public function select($id){

        $this->db->select('meal_ingredient.*, meals.meal_name as meal_name');
        $this->db->from('meal_ingredient');
        $this->db->join('meals', 'meals.id = meal_ingredient.meals_id');
        $this->db->where('meal_ingredient.id', $id);
        $this->db->order_by('meal_ingredient.id','asd');
        $query = $this->db->get();
        return $query->result();

    }

    public function view_per_meal($id){

        $this->db->select('meal_ingredient.*, meals.meal_name as meal_name');
        $this->db->from('meal_ingredient');
        $this->db->join('meals', 'meals.id = meal_ingredient.meals_id');
        $this->db->where('meal_ingredient.meals_id', $id);
        $this->db->order_by('meal_ingredient.id','asd');
        $query = $this->db->get();
        return $query->result();

    }

    public function mainlines($data)
    {
        $this->db->select('meal_ingredient.*, meals.meal_name as meal_name');
        $this->db->from('meal_ingredient');
        $this->db->join('meals', 'meals.id = meal_ingredient.meals_id');
        $this->db->where('meal_ingredient.id', $data);
        $query = $this->db->get();
        return $query->result();
    }

    public function lines($data){
        $this->db->select('meal_ingredient_lines.*, item.name as item_name, item_category.name as category_name');
        $this->db->from('meal_ingredient_lines');
        $this->db->join('item','item.id = meal_ingredient_lines.item_id');
        $this->db->join('item_category','item_category.id = meal_ingredient_lines.item_category_id');
        $this->db->join('meal_ingredient','meal_ingredient.id = meal_ingredient_lines.meal_ingredient_id');
        $this->db->where('meal_ingredient_lines.meal_ingredient_id', $data);
        $query = $this->db->get();
        return $query->result();
    }

    public function create($ingredientl){
        $this->db->insert('meal_ingredient', $ingredientl);

        $insert_id = $this->db->insert_id();
        return $insert_id;

    }

    public function add_ingredient($ingredient_lines, $ingredient_id){
        $this->db->insert_batch('meal_ingredient_lines', $ingredient_lines);
        $query = $this->db->get_where('meal_ingredient_lines', array('meal_ingredient_id'=>$ingredient_id));
        return $query->result();

        $result = $this->db->affected_rows();
        if($result == 1){
            return true;
        }else{
            return false;
        }
    }

    public function get_ingredients($id){
        $this->db->select('meal_ingredient_lines.*, item.name as item_name');
        $this->db->from('meal_ingredient_lines');
        $this->db->join('item','item.id = meal_ingredient_lines.item_id');
        $this->db->where('meal_ingredient_lines.meal_ingredient_id', $id);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_item_names($id){
        $this->db->select('item.id as category_id, item.name as category_name');
        $this->db->from('item');
        $this->db->join('item_category', 'item_category.id = item.item_category_id');
        $this->db->where('item_category_id',$id);
        $query = $this->db->get();
        return $query->result();

    }

    public function update_quantity($quantity,$products){
        $this->db->select('quantity');
        $this->db->from('item');
        $this->db->where('item.id',$products);
        $query = $this->db->get();
        $quantities = $query->result();

        $new_quantity = (float)$quantities[0]->quantity-(float)$quantity;


        $this->db->where('id',$products);
        $this->db->update('item',array('quantity'=>$new_quantity));

    }

    public function confirm_ingredients($id,$data){
        $this->db->where('id',$id);
        $this->db->update('meal_ingredient',$data);
        if ($this->db->affected_rows() == 1) {
            return true;
        }
        else {
            return false;
        }

    }

    public function check_quantity($id){
        $this->db->select('item.*,item_category.name as category_name,unit.name as unit_name, ((item.quantity/item.maximum_quantity)*100) as inventory_level');
        $this->db->from('item');
        $this->db->join('item_category','item_category.id = item.item_category_id');
        $this->db->join('unit','unit.id = item.unit_id');
        $this->db->where('item.id',$id);
        $this->db->order_by('item_category_id', 'asd');
        $query = $this->db->get();
        return $query->result();
    }

}

?>
