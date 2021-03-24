<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

	public function index()
	{	
		if(!$this->session->has_userdata('id'))
			redirect('welcome/index');
		if($this->session->status == 0)
			alert("Nu sunteti pe cont de Admin.");
	}
	
	function get_all_users()
	{
		$this->index();
		$this->load->view('admin_home_view');
		$this->load->view('users_table_begin');
		$this->load->model('users_model');
		$this->users_model->get_all_users_model();
	}
	
	function edit_user($user_id)
	{
		if(!$this->session->has_userdata('id'))
			redirect('welcome/index');
		if($this->session->status == 0){
			$this->load->view('user_header_view');
		}
		else {
			$this->load->view('admin_home_view');
		}
		
		$this->load->view('edit_user');
	}
}
