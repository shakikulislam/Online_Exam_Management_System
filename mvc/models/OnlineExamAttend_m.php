<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class OnlineExamAttend_m extends MY_Model {
    
    public function __construct(){
        parent::__construct();
    }

    function get_all_exam_by_classes($classesID){
		$this->db->where('classID',$classesID);
		// $this->db->order_by('name', 'ASC');
		$query=$this->db->get('online_exam');
		return $query->result();
	}

    function get_exam_by_classes($classesID, $onlineExamID){
		$this->db->where('classID',$classesID);
		$this->db->where('onlineExamID', $onlineExamID);
		// $this->db->order_by('name', 'ASC');
		$query=$this->db->get('online_exam');
		return $query->row();
	}

	function get_totalStudent($classesID){
		$this->db->where('classesID',$classesID);
		$query=$this->db->get('student');
		return $query->num_rows();
	}

	function get_totalExamAttend($classesID, $onlineExamID){
		$this->db->where('classesID',$classesID);
		$this->db->where('onlineExamID',$onlineExamID);
		$query=$this->db->get('online_exam_user_status');
		return $query->num_rows();
	}

	function get_student_list($classesID, $onlineExamID){
		$this->db->select('*');
		$this->db->from('student');
		$this->db->join('classes', 'classes.classesID=student.classesID');
		$this->db->join('online_exam_user_status', 'online_exam_user_status.userID=student.studentID');
		$this->db->where('classes.classesID', $classesID);
		$this->db->where('online_exam_user_status.onlineExamID', $onlineExamID);
		$query=$this->db->get();
		return $query->result();
	}

	function get_single_examAttend($onlineExamUserStatus){
		$this->db->where('onlineExamUserStatus', $onlineExamUserStatus);
		$result = $this->db->get('online_exam_user_status');
		return $result->row();
	}

	public function download_answer_file($onlineExamUserStatus){
        $this->db->where('onlineExamUserStatus', $onlineExamUserStatus);
		$result=$this->db->get('online_exam_user_status');
		return $result->row();
    }
	
	public function update_result($data, $onlineExamUserStatus){
		$this->db->where('onlineExamUserStatus', $onlineExamUserStatus);
		$this->db->update('online_exam_user_status', $data);
	}

}