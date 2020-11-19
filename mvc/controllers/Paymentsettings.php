<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

use Omnipay\Omnipay;
class Paymentsettings extends Admin_Controller {
    
    function __construct () {
        parent::__construct();
        $this->load->model("paymentsettings_m");
        $language = $this->session->userdata('lang');
        $this->lang->load('paymentsettings', $language);

        if(config_item('demo')) {
            // $this->session->set_flashdata('error', 'In demo payment setting module is disable!');
            // redirect(base_url('dashboard/index'));
        }
    }

    function create(){
        $this->form_validation->set_rules('studentRoll', 'Student Roll','required');
        $this->form_validation->set_rules('due','Due','required');
        $this->form_validation->set_rules('class','Class','required');
        if($this->form_validation->run()==false){
            // $this->db->view('payment');
            $paymentStatus=array();
            $paymentStatus['studentRoll']=$this->input->post('studentRoll');
            $paymentStatus['due']=$this->input->post('due');
            $paymentStatus['class']=$this->input->post('class');
            $this->paymentsettings_m->create($paymentStatus);
            $this->session->set_flashdata('success','Record Saved...');
            $this->form_validation->set_message("unique_field", "The %s is required.");
            // $this->redirect(base_url('paymentsettings'));
            $this->data["subview"] = "paymentsettings/index";
            $this->load->view('_layout_main', $this->data);
        }
        else{
            // $this->load->view('_layout_main', $this->data);
        }
    }

    protected function rules_paypal() {
        $rules = array(
            array(
                'field' => 'paypal_email',
                'label' => $this->lang->line("paypal_email"),
                'rules' => 'trim|xss_clean|max_length[255]|valid_email|callback_unique_field'
            ),
            array(
                'field' => 'paypal_api_username',
                'label' => $this->lang->line("paypal_api_username"),
                'rules' => 'trim|xss_clean|max_length[255]|callback_unique_field'
            ),
            array(
                'field' => 'paypal_api_password',
                'label' => $this->lang->line("paypal_api_password"),
                'rules' => 'trim|xss_clean|max_length[255]|callback_unique_field'
            ),
            array(
                'field' => 'paypal_api_signature',
                'label' => $this->lang->line("paypal_api_signature"),
                'rules' => 'trim|xss_clean|max_length[255]|callback_unique_field'
            ),
            array(
                'field' => 'paypal_demo',
                'label' => $this->lang->line("paypal_demo"),
                'rules' => 'trim|xss_clean|max_length[255]'
            ),
        );
        return $rules;
    }

    protected function rules_stripe() {
        $rules = array(
            array(
                'field' => 'stripe_secret',
                'label' => $this->lang->line("stripe_secret"),
                'rules' => 'trim|xss_clean|max_length[255]|callback_unique_field'
            ),
            array(
                'field' => 'stripe_demo',
                'label' => $this->lang->line("stripe_demo"),
                'rules' => 'trim|xss_clean|max_length[255]'
            ),
        );
        return $rules;
    }

    protected function rules_payumoney() {
        $rules = array(
            array(
                'field' => 'payumoney_key',
                'label' => $this->lang->line("payumoney_key"),
                'rules' => 'trim|xss_clean|max_length[255]|callback_unique_field'
            ),
            array(
                'field' => 'payumoney_salt',
                'label' => $this->lang->line("payumoney_salt"),
                'rules' => 'trim|xss_clean|max_length[255]|callback_unique_field'
            ),
            array(
                'field' => 'payumoney_demo',
                'label' => $this->lang->line("payumoney_demo"),
                'rules' => 'trim|xss_clean|max_length[255]'
            ),
        );
        return $rules;
    }

    protected function rules_voguepay() {
        $rules = array(
            array(
                'field' => 'voguepay_merchant_id',
                'label' => $this->lang->line("voguepay_merchant_id"),
                'rules' => 'trim|xss_clean|max_length[255]|callback_unique_field'
            ),
            array(
                'field' => 'voguepay_merchant_ref',
                'label' => $this->lang->line("voguepay_merchant_ref"),
                'rules' => 'trim|xss_clean|max_length[255]|callback_unique_field'
            ),
            array(
                'field' => 'voguepay_developer_code',
                'label' => $this->lang->line("voguepay_developer_code"),
                'rules' => 'trim|xss_clean|max_length[255]|callback_unique_field'
            ),
            array(
                'field' => 'voguepay_status',
                'label' => $this->lang->line("voguepay_status"),
                'rules' => 'trim|xss_clean|max_length[255]'
            ),
        );
        return $rules;
    }

    public function unique_field($field) {
        if(($this->input->post('paypal_status') == 1) || 
            ($this->input->post('stripe_status') == 1) || 
            ($this->input->post('payumoney_status') == 1) ||
            ($this->input->post('voguepay_status') == 1)
        ) {
            if($field == '') {
                $this->form_validation->set_message("unique_field", "The %s is required.");
                return FALSE;
            }
            return TRUE;
        }
        return TRUE;
    }



    public function add_payment(){

        $data=array(
            'studentID'=>$this->input->post('studentID'),
            'classesID'=>$this->input->post('classesID'),
        );
        $findPayment=$this->paymentsettings_m->get_payment($data);
        
        if(!empty($findPayment)){
            //$this->data['findPayment']="Already Payment";
            $this->session->set_flashdata('form','<div class="alert alert-danger"> Already Payment </div>');
        }
        else{
            $this->paymentsettings_m->add_payment($data);
        }
        
        header('location:'.base_url('paymentsettings'));

    }

    public function get_single_student(){
        $roll=$this->input->post('studentRoll');
        $this->data['stRoll']=$this->paymentsettings_m->get_student($roll);
        $this->data["subview"] = "paymentsettings/index";
        $this->load->view('_layout_main', $this->data);
        // header('location:'.base_url('paymentsettings'));
    }
    public function index() {

        $roll=$this->input->post('studentRoll');
        
        $this->data['stInfo']=$this->paymentsettings_m->get_student_and_classes($roll);
        //$st=$this->paymentsettings_m->get_student_and_classes("170222001");
    
        $this->data['paymentList']=$this->paymentsettings_m->get_student($roll);

        // echo "<pre>";
        // print_r($this->data->checkPayment->studentID);
        // die();
 
        $this->data["subview"] = "paymentsettings/index";
        $this->load->view('_layout_main', $this->data);
    }

}