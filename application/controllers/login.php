<?php
class login extends CI_Controller{
	function __construct()
	{
		parent::__construct();
		
	}

	function index(){
		
		

		if ($this->session->userdata('login')) {
			# code...
			redirect('dashboard');
		} else {
			# code...
			$this->load->helper('captcha');
			$cap = array(
				'img_path'=>'./captcha/',
				'img_url'=>base_url('captcha'),
				'img_width'=>'150',
				'img_height'=>30,
				'font_size'=>16,
				'img_id'=>'Imageid'
			);
			$captcha = create_captcha($cap);
			$this->session->set_flashdata("captcha", $captcha['word']);
			$this->load->view("login/vLogin",$captcha);
			
		}
		
		
	}

	function do_login()
	{
		$this->form_validation->set_rules('username', 'username', 'required|valid_email');
		$this->form_validation->set_rules('password', 'password', 'required|min_length[3]');
		$this->form_validation->set_rules('captcha', 'captcha', 'required|min_length[3]');

		$username = $this->input->post("username");
		$password = md5($this->input->post("password"));
		$captcha	=	$this->input->post("captcha");

		//memeriksa berapa kali login
		$ip = $_SERVER['REMOTE_ADDR'];
		$percobaan_login = $this->session->userdata($ip);
		$this->session->mark_as_temp('login',60);
		$this->session->set_userdata($ip,$percobaan_login+1);
		if ($percobaan_login > 3) {
			# code...
			$this->session->set_flashdata("pesan_error", "max login 3 kali");
			redirect("login");
		}
		if($captcha != $this->session->userdata('captcha')){
			$this->session->set_flashdata("pesan_error", "captcha salah!");
			redirect("login");
		}
		$query = $this->db->query("select * from user where username=?	and password=?	",[$username,$password]);
		$log_data = [
			'username'=>$username,
			'login_browser'=>$_SERVER['HTTP_USER_AGENT'],
			'login_ip'=>$_SERVER['REMOTE_ADDR']
		];
		if (!$this->form_validation->run()) {
			$log_data['status']	=	0;
			$this->db->insert('login_log',$log_data);
			$this->load->view('login/vLogin');
			return;
		} else {
			# code...
			if ($query->num_rows() == 1) {
				$row = $query->row();
				$this->session->set_userdata(["user_id" => $row->user_id, "login" => true, "username" => $username, "nama" =>
				$row->nama, "level" => $row->user_level_id]);
				if ($username == $row->username && $password == $row->password) {
					# code...
					$this->db->update(
						"user",
						[
							'user_last_login' => date('Y-m-d H:i:s'),
							'user_last_ip' => $this->input->ip_address(),
						],
						['username' => $username]
					);
					$log_data['status']	=	1;
					$this->db->insert('login_log',$log_data);
					redirect("dashboard");
				} else {
					# code...
					$log_data['status']	=	0;
					$this->db->insert('login_log',$log_data);
					$this->session->set_flashdata("pesan_error","from input tidak sesuai data tersimpan!");
					redirect("login");
				}
				
			} else {
				$log_data['status']	=	0;
					$this->db->insert('login_log',$log_data);
				$this->session->set_flashdata("pesan_error", "Gagal Login Username/Password Salah!");
				redirect("login");
			}
		}
		
		
	}
	
	function logout(){
		$this->session->sess_destroy();
		redirect('login');
	}
}
