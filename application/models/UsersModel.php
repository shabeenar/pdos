<?php
Class UsersModel extends CI_Model {
    public function create($new_user)
    {
        $this->db->insert('users', $new_user);
        if ($this->db->affected_rows() == 1) {
            return true;
        }
        else{
            return false;
        }
    }

//get data from db
    public function select(){
        $this->db->select('users.*,ward.name as ward_name');
        $this->db->from('users');
        $this->db->join('ward','ward.number = users.ward_id');
        $this->db->where(array('users.status' => 1));
        $query = $this->db->get();
        return $query->result();
    }

    public function get_user($id){
        $this->db->from('users');
        $this->db->where('id',$id);
        $query = $this->db->get();
        return $query->result();
    }

    public function update_user($update, $id){
        $this->db->where('id',$id);
        $this->db->update('users',$update);
        if ($this->db->affected_rows() == 1){
            return true;
        }
        else{
            return $this->db->error();
        }
    }

    public function inactivate($id){
        $this->db->where('id',$id );
        $this->db->update('users',array('active' =>0));
        if ($this->db->affected_rows() == 1){
            return true;
        }
        else{
            return $this->db->error();
        }
    }

    public function activate($id){
        $this->db->where('id',$id );
        $this->db->update('users',array('active' =>1));
        if ($this->db->affected_rows() == 1){
            return true;
        }
        else{
            return $this->db->error();
        }
    }

    public function delete_user($id){
        $this->db->where('id',$id);
        $this->db->update('users', array('status'=>0));
        if ($this->db->affected_rows() == 1){
            return true;
        }
        else{
            return false;
        }

    }
}

?>
