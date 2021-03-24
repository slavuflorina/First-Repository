<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
		
		$this -> load -> database();
		$this -> load -> helper('url');
		if(!$this->session->has_userdata('id'))
			$this->load->view('login_view');
		
	}
	
	
}
