<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {

	
	public function check_login($email, $password)
	{	
	
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('email', $email);
		$this->db->where('password', $password);
		$query = $this->db->get();
		
		if ($query->result_array()) {
			$row = $query->row_array();
			return $row;
		} else {
			return false;
		}
	}
}
