<?php

class test_m extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    function index(){
        // select *from student Table
        return $this->db->get('student');
    }
}
