<?php
class dashboard extends CI_Controller{
	function __construct()
	{
		parent::__construct();
		cek_login();
	}

	function index(){
		$query = $this->db->query("select * from user where username=?",
		[$this->session->userdata("username")]);
		if($query->num_rows()==0){
			$this->session->sess_destroy();
			redirect('login');
		}
		$konten['user_data']=$query->row();
		$konten['center']='profile/vProfile';
		$this->load->view('dashboard/vDashboard',$konten);
	}
}
