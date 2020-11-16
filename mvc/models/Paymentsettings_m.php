<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Paymentsettings_m extends MY_Model {

	protected $_table_name = 'paymentsetting';
	protected $_primary_key = 'paymentsettingID';
	protected $_primary_filter = 'intval';
	protected $_order_by = "paymentsettingID asc";


    public function add_payment($paymentData){
		//insert
        $this->db->insert("payment",$paymentData);
	}
	
	public function get_student_and_classes($roll){
		//select *from
		//join table

		$this->db->select('*');
		$this->db->from('student');
		$this->db->join('classes','classes.classesID=student.classesID');
		$this->db->where('roll',$roll);
		// return $this->db->get();
		return $this->db->get()->row();
	}


	public function get_student($roll){
		//select from where
		//join 3 tables
		$this->db->select('*');
		$this->db->from('student');
		$this->db->join('payment','student.studentID=payment.studentID');
		$this->db->join('classes', 'payment.classesID=classes.classesID');
		$this->db->where('roll',$roll);
		return $this->db->get()->result_array();
	}


	public function get_payment($array){
		$this->db->where('studentID',$array['studentID']);
		$this->db->where('classesID',$array['classesID']);
		return $this->db->get('payment')->row() ;
		// $paymentData=$this->db->get('payment');
		// return $paymentData->row(); persistence
	}

	// public function get_single_student($roll){
	// 	//select from where
	// 	//join 2 table
	// 	$this->db->select('*');
	// 	$this->db->from('student');
	// 	$this->db->join('payment','student.studentID=payment.studentID');
	// 	$this->db->where('roll',$roll);
	// 	return $this->db->get()->result_array();
	// }

	// public function get_single_student($roll){
	// 	//select from where
	// 	$this->db->select('*');
	// 	$this->db->from('student');
	// 	$this->db->where('roll',$roll);
	// 	return $this->db->get()->result_array();
	// }

	// function get_due_data(){
	// 	//select *from
	// 	$result=$this->db->get($this->dueTable);
	// 	return $result->result_array();
	// }

	// public function payment($paymentData){
	// 	$this->db->where('student', $id);
	// 	$this->db->delete($this->dueTable);
	// }











	public function update_key($array) 
	{
		$this->db->update_batch('paymentsetting', $array, 'fieldoption'); 
	}

	public function get_order_by_config() 
	{
		$query = $this->db->get_where($this->_table_name);
		return $query->result();
	}

	public function get_order_by_paymentsetting($id = NULL, $single = FALSE) 
	{
		$query = parent::get($id, $single);
		return $query;
	}

	public function get_paymentsetting() 
	{
		$compress = [];
		$query = $this->db->get($this->_table_name);
		foreach ($query->result() as $row) {
		    $compress[$row->fieldoption] = $row->value;
		}
		return (object) $compress;
	}
}