<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Books extends CI_Controller {

	public function index()
	{	
		if(!$this->session->has_userdata('id'))
			redirect('welcome/index');
		
	}
	
	public function get_user_active_loans(){
		$this->index();
		$this->load->view('user_header_view');
	
		$this->load->view('get_user_loans_view');
		$this->load->model('loans_model');
		$this->loans_model->get_user_active_loans_model($this->session->userdata('id'));
		$this->load->view('get_user_loans_view_end');
	}
	
		public function get_user_history_loans(){
		$this->index();
		$this->load->view('user_header_view');
	
		$this->load->view('get_user_loans_view');
		$this->load->model('loans_model');
		$this->loans_model->get_user_history_loans_model($this->session->userdata('id'));
		$this->load->view('get_user_loans_view_end');
	}
	
	public function get_all_books(){
		$this->index();
		$this->load->view('user_header_view');
		$this->load->view('get_user_loans_view');
		$this->load->model('loans_model');
		$this->loans_model->get_all_books_model();
		$this->load->view('get_user_loans_view_end');
		
	}
	
	public function borrow($book_id){
		$this->load->model('loans_model');
		if($this->loans_model->get_number_of_loans($this->session->userdata('id')==5))
			echo '<script type="text/javascript">alert("Nu poti imprumuta mai mult de 5 carti!");</script>';
		else if($this->loans_model->check_borrow($this->session->userdata('id'))==1)
			//	 echo $this->loans_model->check_borrow($this->session->userdata('id'));
				echo '<script type="text/javascript">alert("Aveti aceasta carte in biblioteca!");
							location.href="'.site_url('books/get_all_books').'"</script>';
				
					else if($this->loans_model->borrow_model())
							echo '<script type="text/javascript">alert("Felicitari! Imprumut reusit! Cartea va ajunge la dvs in maxim 3 zile lucratoare!");
										location.href="'.site_url('books/get_all_books').'"</script>';
								else '<script type="text/javascript">alert("Imprumut esuat! Contactati administratorul site-ului!");
								location.href="'.site_url('books/get_all_books').'"</script>'; 
		
	}
}
