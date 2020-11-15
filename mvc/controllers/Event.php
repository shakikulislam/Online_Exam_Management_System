<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Event extends Admin_Controller {
/*
| -----------------------------------------------------
| PRODUCT NAME: 	INILABS SCHOOL MANAGEMENT SYSTEM
| -----------------------------------------------------
| AUTHOR:			INILABS TEAM
| -----------------------------------------------------
| EMAIL:			info@inilabs.net
| -----------------------------------------------------
| COPYRIGHT:		RESERVED BY INILABS IT
| -----------------------------------------------------
| WEBSITE:			http://inilabs.net
| -----------------------------------------------------
*/
	function __construct() {
		parent::__construct();
		$this->load->model("event_m");
		$this->load->model("eventcounter_m");
		$this->load->model("student_m");
		$this->load->model("usertype_m");
		$language = $this->session->userdata('lang');
		$this->lang->load('event', $language);
	}

	public function send_mail_rules() {
		$rules = array(
			array(
				'field' => 'to',
				'label' => $this->lang->line("event_to"),
				'rules' => 'trim|required|max_length[60]|valid_email|xss_clean'
			),
			array(
				'field' => 'subject',
				'label' => $this->lang->line("event_subject"),
				'rules' => 'trim|required|xss_clean'
			),
			array(
				'field' => 'message',
				'label' => $this->lang->line("event_message"),
				'rules' => 'trim|xss_clean'
			),
			array(
				'field' => 'eventID',
				'label' => $this->lang->line("event_eventID"),
				'rules' => 'trim|required|max_length[10]|xss_clean|callback_unique_data'
			)
		);
		return $rules;
	}

	public function unique_data($data) {
		if($data != '') {
			if($data == '0') {
				$this->form_validation->set_message('unique_data', 'The %s field is required.');
				return FALSE;
			}
			return TRUE;
		}
		return TRUE;
	}

	public function index() {
		$this->data['events'] = $this->event_m->get_order_by_event();
		$this->data["subview"] = "event/index";
		$this->load->view('_layout_main', $this->data);
	}

	protected function rules() {
		$rules = array(
				 array(
					'field' => 'title',
					'label' => $this->lang->line("event_title"),
					'rules' => 'trim|required|xss_clean|max_length[75]|min_length[3]'
				),
				array(
					'field' => 'date',
					'label' => $this->lang->line("event_fdate"),
					'rules' => 'trim|required|xss_clean|max_length[41]'
				),
				array(
					'field' => 'photo',
					'label' => $this->lang->line("event_photo"),
					'rules' => 'trim|max_length[200]|xss_clean|callback_photoupload'
				),
				array(
					'field' => 'event_details',
					'label' => $this->lang->line("event_details"),
					'rules' => 'trim|required|xss_clean'
				)
			);
		return $rules;
	}

	public function photoupload() {
		$id = htmlentities(escapeString($this->uri->segment(3)));
		$event = array();
		if((int)$id) {
			$event = $this->event_m->get_event($id);	
		}

		$new_file = "holiday.png";
		if($_FILES["photo"]['name'] !="") {
			$file_name = $_FILES["photo"]['name'];
			$random = rand(1, 10000000000000000);
	    	$makeRandom = hash('sha512', $random.$this->input->post('title') . config_item("encryption_key"));
			$file_name_rename = $makeRandom;
            $explode = explode('.', $file_name);
            if(inicompute($explode) >= 2) {
	            $new_file = $file_name_rename.'.'.end($explode);
				$config['upload_path'] = "./uploads/images";
				$config['allowed_types'] = "gif|jpg|png";
				$config['file_name'] = $new_file;
				$config['max_size'] = '1024';
				$config['max_width'] = '3000';
				$config['max_height'] = '3000';
				$this->load->library('upload', $config);
				if(!$this->upload->do_upload("photo")) {
					$this->form_validation->set_message("photoupload", $this->upload->display_errors());
	     			return FALSE;
				} else {
					$this->upload_data['file'] =  $this->upload->data();
					return TRUE;
				}
			} else {
				$this->form_validation->set_message("photoupload", "Invalid file");
	     		return FALSE;
			}
		} else {
			if(inicompute($event)) {
				$this->upload_data['file'] = array('file_name' => $event->photo);
				return TRUE;
			} else {
				$this->upload_data['file'] = array('file_name' => $new_file);
			return TRUE;
			}
		}
	}

	public function add() {
		$this->data['headerassets'] = array(
			'css' => array(
				'assets/daterangepicker/daterangepicker.css',
				'assets/editor/jquery-te-1.4.0.css'
			),
			'js' => array(
				'assets/editor/jquery-te-1.4.0.min.js',
				'assets/daterangepicker/moment.min.js',
				'assets/daterangepicker/daterangepicker.js',

			)
		);

		if($_POST) {
			$rules = $this->rules();
			$this->form_validation->set_rules($rules);
			if ($this->form_validation->run() == FALSE) {
				$this->data["subview"] = "event/add";
				$this->load->view('_layout_main', $this->data);
			} else {
				$array["title"] = $this->input->post("title");
				$explode = explode('-', $this->input->post("date"));
				$array["fdate"]   = date("Y-m-d", strtotime($explode[0]));
				$array['ftime']   = date("H:i:s", strtotime($explode[0]));
				$array["tdate"]   = date("Y-m-d", strtotime($explode[1]));
				$array["ttime"]   = date("H:i:s", strtotime($explode[1]));
				$array["details"] = $this->input->post("event_details");
				$array['create_date']       = date('Y-m-d H:i:s');
				$array['schoolyearID']      = $this->data['siteinfos']->school_year;
				$array['create_userID']     = $this->session->userdata('loginuserID');
				$array['create_usertypeID'] = $this->session->userdata('usertypeID');
				$array['photo'] = $this->upload_data['file']['file_name'];
				$this->event_m->insert_event($array);

				$eventID = $this->db->insert_id();
				if(!empty($eventID)) {
					$this->alert_m->insert_alert(array('itemID' => $eventID, "userID" => $this->session->userdata("loginuserID"), 'usertypeID' => $this->session->userdata('usertypeID'), 'itemname' => 'event'));
				}

				$this->session->set_flashdata('success', $this->lang->line('menu_success'));
				redirect(base_url("event/index"));
			}
		} else {
			$this->data["subview"] = "event/add";
			$this->load->view('_layout_main', $this->data);
		}
	}

	public function edit() {
		$this->data['headerassets'] = array(
			'css' => array(
				'assets/daterangepicker/daterangepicker.css',
				'assets/editor/jquery-te-1.4.0.css'
			),
			'js' => array(
				'assets/editor/jquery-te-1.4.0.min.js',
				'assets/daterangepicker/moment.min.js',
				'assets/daterangepicker/daterangepicker.js',

			)
		);

		$id = htmlentities(escapeString($this->uri->segment(3)));
		if((int)$id) {
			$this->data['event'] = $this->event_m->get_event($id);
			if($this->data['event']) {
				if($_POST) {
					$rules = $this->rules();
					$this->form_validation->set_rules($rules);
					if ($this->form_validation->run() == FALSE) {
						$this->data["subview"] = "event/edit";
						$this->load->view('_layout_main', $this->data);
					} else {
						$explode = explode('-', $this->input->post("date"));
						$fdate = date("Y-m-d", strtotime($explode[0]));
						$ftime = date("H:i:s", strtotime($explode[0]));
						$tdate = date("Y-m-d", strtotime($explode[1]));
						$ttime = date("H:i:s", strtotime($explode[1]));
						$array = array(
							"title" => $this->input->post("title"),
							"details" => $this->input->post("event_details"),
							"fdate" => $fdate,
							"ftime" => $ftime,
							"tdate" => $tdate,
							"ttime" => $ttime
						);

						$array['photo'] = $this->upload_data['file']['file_name'];
						$this->event_m->update_event($array,$id);
						$this->session->set_flashdata('success', $this->lang->line('menu_success'));
						redirect(base_url("event/index"));
					}
				} else {
					$this->data["subview"] = "event/edit";
					$this->load->view('_layout_main', $this->data);
				}
			} else {
				$this->data["subview"] = "error";
				$this->load->view('_layout_main', $this->data);
			}
		} else {
			$this->data["subview"] = "error";
			$this->load->view('_layout_main', $this->data);
		}
		
	}

	public function view() {
		$id = htmlentities(escapeString($this->uri->segment(3)));
		if((int)$id) {
			$this->data['event'] = $this->event_m->get_event($id);
			$this->data['id'] = $id;
			$this->data['goings'] = $this->eventcounter_m->get_order_by_eventcounter(array('eventID' => $id, 'status' => 1));
			$this->data['ignores'] = $this->eventcounter_m->get_order_by_eventcounter(array('eventID' => $id, 'status' => 0));
			if($this->data['event']) {
				$alert = $this->alert_m->get_single_alert(array('itemID' => $id, "userID" => $this->session->userdata("loginuserID"), 'usertypeID' => $this->session->userdata('usertypeID'), 'itemname' => 'event'));
				if(!inicompute($alert)) {
					$array = array(
						"itemID" => $id,
						"userID" => $this->session->userdata("loginuserID"),
						"usertypeID" => $this->session->userdata("usertypeID"),
						"itemname" => 'event',
					);
					$this->alert_m->insert_alert($array);
				}
				$this->data["subview"] = "event/view";
				$this->load->view('_layout_main', $this->data);
			} else {
				$this->data["subview"] = "error";
				$this->load->view('_layout_main', $this->data);
			}
		} else {
			$this->data["subview"] = "error";
			$this->load->view('_layout_main', $this->data);
		}
	}

	public function delete() {
		$id = htmlentities(escapeString($this->uri->segment(3)));
		if((int)$id) {
			$event = $this->event_m->get_event($id);
			if(inicompute($event)) {
				if(config_item('demo') == FALSE) {
					if(file_exists(FCPATH.'uploads/images/'.$event->photo)) {
						unlink(FCPATH.'uploads/images/'.$event->photo);
					}
				}
				$this->event_m->delete_event($id);
				$this->session->set_flashdata('success', $this->lang->line('menu_success'));
				redirect(base_url("event/index"));
			}
			
			
		} else {
			redirect(base_url("event/index"));
		}
	}

	public function print_preview() {
		if(permissionChecker('event_view')) {
			$id = htmlentities(escapeString($this->uri->segment(3)));
			if((int)$id) {
				$this->data['event'] = $this->event_m->get_event($id);
				if(inicompute($this->data['event'])) {
					$userID = $this->data['event']->create_userID;
					$usertypeID = $this->data['event']->create_usertypeID;
					$this->data['userName'] = getNameByUsertypeIDAndUserID($usertypeID, $userID);
					$usertype = $this->usertype_m->get_single_usertype(array('usertypeID'=>$usertypeID));
					$this->data['usertype'] = $usertype->usertype;
				    $this->data['panel_title'] = $this->lang->line('panel_title');
					$this->reportPDF('event.css',$this->data, 'event/print_preview');
				} else {
					$this->data["subview"] = "error";
					$this->load->view('_layout_main', $this->data);
				}
			} else {
				$this->data["subview"] = "error";
				$this->load->view('_layout_main', $this->data);
			}
		} else {
			$this->data["subview"] = "errorpermission";
			$this->load->view('_layout_main', $this->data);
		}
	}

	public function send_mail() {
		$retArray['status'] = FALSE;
		$retArray['message'] = '';
		if(permissionChecker('event_view')) {
			if($_POST) {
				$rules = $this->send_mail_rules();
				$this->form_validation->set_rules($rules);
				if ($this->form_validation->run() == FALSE) {
					$retArray = $this->form_validation->error_array();
					$retArray['status'] = FALSE;
				    echo json_encode($retArray);
				    exit;
				} else {
					$eventID = $this->input->post('eventID');
					if ((int)$eventID) {
						$this->data['event'] = $this->event_m->get_event($eventID);
						if(inicompute($this->data['event'])) {
							$email = $this->input->post('to');
							$subject = $this->input->post('subject');
							$message = $this->input->post('message');
							$userID = $this->data['event']->create_userID;
							$usertypeID = $this->data['event']->create_usertypeID;
							$this->data['userName'] = getNameByUsertypeIDAndUserID($usertypeID, $userID);
							$usertype = $this->usertype_m->get_single_usertype(array('usertypeID'=>$usertypeID));
							$this->data['usertype'] = $usertype->usertype;
							$this->reportSendToMail('event.css',$this->data, 'event/print_preview', $email, $subject, $message);
							$retArray['message'] = "Message";
							$retArray['status'] = TRUE;
							echo json_encode($retArray);
						    exit;
						} else {
							$retArray['message'] = $this->lang->line('event_data_not_found');
							echo json_encode($retArray);
							exit;
						}
					} else {
						$retArray['message'] = $this->lang->line('event_data_not_found');
						echo json_encode($retArray);
						exit;
					}
				}
			} else {
				$retArray['message'] = $this->lang->line('event_permissionmethod');
				echo json_encode($retArray);
				exit;
			}
		} else {
			$retArray['message'] = $this->lang->line('event_permission');
			echo json_encode($retArray);
			exit;
		}
	}

	public function eventcounter() {
		$username = $this->session->userdata("username");
		$usertype = $this->session->userdata("usertype");
		$photo = $this->session->userdata("photo");
		$name = $this->session->userdata("name");
		$eventID = $this->input->post('id');
		$status = $this->input->post('status');
		if($eventID) {
			$have = $this->eventcounter_m->get_order_by_eventcounter(array("eventID" => $eventID, "username" => $username, "type" => $usertype),TRUE);
			if(inicompute($have)) {
				$array = array('status' => $status);
				$this->eventcounter_m->update($array,$have[0]->eventcounterID);
			} else {
				$array = array('eventID' => $eventID,
					'username' => $username,
					'type' => $usertype,
					'photo' => $photo,
					'name' => $name,
					'status' => $status
				);
				$this->eventcounter_m->insert($array);
			}
			$this->session->set_flashdata('success', $this->lang->line('menu_success'));
		}
	}
}

/* End of file event.php */
/* Location: .//D/xampp/htdocs/school/mvc/controllers/event.php */
