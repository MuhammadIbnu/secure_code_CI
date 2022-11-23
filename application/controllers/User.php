<?php
class User extends CI_Controller{
	function __construct()
	{
		parent::__construct();
		cek_login();
	}
	function index(){
		$query	=	$this->db->get("user");
		$konten['data_user']=$query;
		$konten['center']='user/vUser';
		$this->load->view('dashboard/vDashboard',$konten);
	}
	
	function tambah(){
		$this->form_validation->set_rules('username','username','required|valid_email');
		$this->form_validation->set_rules('password','password','required');
		$this->form_validation->set_rules('confirm','confirm','required|matches[password]');
		$this->form_validation->set_rules('nama','nama','required');
		if(! $this->form_validation->run()){
			$konten['center'] = 'user/vTambah';
			$this->load->view('dashboard/vDashboard',$konten);
			return;
		}
		$data_simpan = [
			"username"=>$this->input->post("username"),
			"password"=>$this->input->post("confirm"),
			"nama"=>$this->input->post("nama"),
			"user_level_id"=>$this->input->post("level")
		];
		if($this->db->insert('user',$data_simpan)){
			$this->session->set_flashdata('pesan_sukses','data user telah disimpan');
			redirect('user');
		}else{
			$this->session->set_flashdata('pesan_error','data gagal disimpan');
			redirect('user/tambah');
		}
	}
	
}
