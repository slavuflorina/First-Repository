<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users_model extends CI_Model {
		function get_all_users_model()
		{
			$this->db->select('*');
			$this->db->from('users');
			$query = $this->db->get();

		
		foreach($query->result_array() as $row) {
		
			$users = array('user_id' => $row['user_id'], 'email' => $row['email'],'password' => $row['password']);
			if($row['status'] == 0)
								$users ['status'] = "Admin";
							else 
								$users ['status'] = "User";
			$this->load->view('users_table' , $users);
		}
		}
		
		function edit_user($user_id)
		{
			$this->db->select('*');
			$this->db->from('users');
			$this->db->where('user_id',$user_id);	
			$user = array('user_id' => $row['user_id'], 'email' => $row['email'],'password' => $row['password']);
			$this->load->view('edit_user' , $user);
		}
}