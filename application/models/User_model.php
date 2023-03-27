<?php

class User_model extends CI_Model{
    public function __construct(){
		parent::__construct();
		$this->load->database();
	}
    public function insert($data){ //insert data into database
        $this->db->insert("users",$data);
        return true;                
    }
    public function login_validate($user_name,$password){ //validate user to login
        $result=$this->db->where("user_name",$user_name)->where("password",$password)->get("users")->row();        
        return $result;
    }
    public function get_data(){ //get user details from database
        $data=$this->db->where("user_type","normal")->get("users");
        return $data->result();
    }
    public function update_data($id,$data){ //update user details into database
        $this->db->where("id",$id);
		$this->db->update("users",$data);
        return true;
    }
    public function delete_row($id){ //delete user data from database
        $this->db->where("id",$id)->delete("users");
        return true;
    }
}
?>