<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Emailsetting_m extends MY_Model {

	protected $_table_name = 'emailsetting';
	protected $_primary_key = 'fieldoption';
	protected $_primary_filter = 'intval';
	protected $_order_by = "fieldoption asc";

	public function __construct() 
	{
		parent::__construct();
	}


	public function get_emailsetting() 
	{
		$emailsettingArray = array();
		$query = $this->db->get($this->_table_name);
		if(inicompute($query)) {
			foreach ($query->result() as $row) {
			    $emailsettingArray[$row->fieldoption] = $row->value;
			}
		}
		return (object) $emailsettingArray;
	}

	public function insertorupdate($arrays) 
	{
		foreach ($arrays as $key => $array) {
			$this->db->query("INSERT INTO emailsetting (fieldoption, value) VALUES ('".$key."', '".$array."') ON DUPLICATE KEY UPDATE fieldoption='".$key."' , value='".$array."'");
		}
		return TRUE;
	}
}
