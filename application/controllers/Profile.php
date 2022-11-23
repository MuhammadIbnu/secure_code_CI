<?php
class Profile extends CI_Controller{
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

	public function do_upload(){
		$config['upload_path']='./assets/profile/';
		$config['allowed_types']='gif|jpg|png';
		$config['max_size']	=	100;
		$config['overwrite']=TRUE;
		$config['file_name']=$this->session->userdata('user_id')."f.jpg";
		$this->load->library('upload',$config);
		if(! $this->upload->do_upload('userfile')){
			$error = $this->upload->display_errors();
			$this->session->set_flashdata('pesan_error','gagal upload :'.$error);
		}else{
			$this->session->set_flashdata('pesan_sukses','upload sukses');
		}
		redirect('profile');
	}
}
