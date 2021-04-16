<?php
Class MealIngredientsModel extends CI_Model {

    public function select($data){
        $this->db->select('meal_ingredients.*, meals.meal_name as meal_name, item.name as item_name');
        $this->db->from('meal_ingredients');
        $this->db->join('meals', 'meals.id = meal_ingredients.meals_id');
        $this->db->join('item', 'item.id = meal_ingredients.item_id');
        $this->db->where('meal_ingredients.id', $data);
        $query = $this->db->get();
        return $query->result();
    }

    public function create_meal($meal){
        $this->db->insert('meal_ingredients', $meal);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    public function add_ingredient($ingredient_lines, $meal_id){
        $this->db->insert_batch('meal_ingredients', $ingredient_lines);
        $query = $this->db->get_where('meals_id', $meal_id);
        return $query->result();
    }

}

?>
