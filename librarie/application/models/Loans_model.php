<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Loans_model extends CI_Model {

	public function index(){
		
	}
	
	public function get_number_of_loans($id)
	{
		$this->db->select('*');
		$this->db->from('loans');
		$this->db->where('loans.user_id',$id);		
		$query = $this->db->get();
		return $query->num_rows();
	}
	
	public function check_borrow($id)
	{
		$book_id = $this->uri->segment(3);
		$this->db->select('*');
		$this->db->from('loans');
		$this->db->where('loans.user_id',$id);	
		$this->db->where('loans.book_id',$book_id);	
		$this->db->where('loans.data_end <', date('Y-m-d'));		
		//$query = $this->db->get();
		//print_r($this->db->count_all_results()); die();
		if($this->db->count_all_results()) return 1;
		else return 0;
	}
	
	public function borrow_model(){
		$book_id = $product_id = $this->uri->segment(3);
		$data = array(
			'book_id' => $book_id,
			'user_id' => $this->session->userdata('id'),
			'data_begin' => date('Y-m-d'),
			'data_end'  => date('Y-m-d', strtotime("+14 day"))
		);

		$this->db->insert('loans',$data);
		return ($this->db->affected_rows() != 1) ? false : true;
	}
	
	public function get_user_active_loans_model($id)
	{	
		
		
		$this->db->select('*');
		$this->db->from('loans'); 
		$this->db->join('books', 'loans.book_id = books.book_id', 'left');
		$this->db->join('genres', 'genres.genre_id=books.genre_id', 'left');
		$this->db->where('loans.user_id',$id);
		$this->db->where('loans.data_end >=  NOW() ');
		$this->db->order_by('loans.data_begin','asc'); 
	
		$query = $this->db->get();
		
		
		foreach($query->result_array() as $row) {
		
			$user_loans = array('loan_id' => $row['loan_id'], 'title' => $row['title'],'author' => $row['author'],
								'genre' => $row['genre'],'image' => $row['image'], 'data_begin' => $row['data_begin'], 'data_end' => $row['data_end']);
			//$books_number++;
			$this->load->view('loan_div_view' , $user_loans);
		}
		//$newdata = [
		//			'books_number' => $books_number
		//	];
	
		//	$this->session->set_userdata($newdata);
	}
	
	public function get_user_history_loans_model($id)
	{	
		$this->db->select('*');
		$this->db->from('loans'); 
		$this->db->join('books', 'loans.book_id = books.book_id', 'left');
		$this->db->join('genres', 'genres.genre_id=books.genre_id', 'left');
		$this->db->where('loans.user_id',$id);
		$this->db->where('loans.data_end <  NOW() ');
		$this->db->order_by('loans.data_begin','asc'); 
	
		$query = $this->db->get();
		
		
		foreach($query->result_array() as $row) {
			
			$user_loans = array('loan_id' => $row['loan_id'], 'title' => $row['title'],'author' => $row['author'],
							'genre' => $row['genre'],'image' => $row['image'], 'data_begin' => $row['data_begin'], 'data_end' => $row['data_end']);
			$this->load->view('loan_div_view' , $user_loans);
		}
		
	}
	
	public function get_all_books_model(){
		$this->db->select('*');
		$this->db->from('books'); 
		$this->db->join('genres', 'genres.genre_id=books.genre_id', 'left');
		$this->db->order_by('books.book_id','asc'); 
	
		$query = $this->db->get();
		
		
		foreach($query->result_array() as $row) {
			
			$book_informations = array('book_id' => $row['book_id'], 'title' => $row['title'],'author' => $row['author'],
							'genre' => $row['genre'],'image' => $row['image']);
			$this->load->view('loan_div_view' , $book_informations);
		}
	}
}
