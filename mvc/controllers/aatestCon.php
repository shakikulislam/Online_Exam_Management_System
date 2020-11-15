<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class aatestCon extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
    }

	function index(){
        $this->load->model('test_m');
        $result=$this->test_m->index();
        $data=array('studentList'=>$result);
        $this->load->view('paymentsettings/index',$data);
    }

}