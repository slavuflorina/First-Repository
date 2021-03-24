<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index()
	{
		
		$this -> load -> database();
		$this->load->library('session');
		$this -> load -> helper('url');
		if(!$this->session->has_userdata('id'))
			$this->load->view('login_view');
		else $this->check_user_status();
	
		
	}
	public function login()
	{
		$email = $this->input->post('email');    
		$password = md5($this->input->post('password'));
		
		$this->load->model('login_model');
			if ($row=$this->login_model->check_login($email, $password))
			{	
				$newdata = [
					'id' => $row['user_id'],
					'email'  => $email,
					'password'     => $password,
					'status' => $row['status'],
					'logged_in' => TRUE
			];
	
			$this->session->set_userdata($newdata);
		
			$this->check_user_status();
			//$this->load->model(books);
			
			}
	}
	
	public function check_user_status()
	{
		if($this->session->status == 0)
				$this->load->view('user_header_view');
			else
				$this->load->view('admin_home_view');
			
	}		
	
	public function logout(){
		$this->session->sess_destroy();
        redirect('welcome/index');
	}
}
