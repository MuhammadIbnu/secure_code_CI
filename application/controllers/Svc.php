<?php
class Svc extends CI_Controller{
	function __construct()
	{
		parent::__construct();
	}

	function index(){
		$this->load->view('svc/index');
	}

	function login(){
		header("Access-Control-Allow-Origin: *");
		header("Access-Control-Allow-Headers: authorization");
		$res = ['status'=>0,'pesan'=>'gagal'];
		$username = isset($_SERVER['PHP_AUTH_USER'])?$_SERVER['PHP_AUTH_USER']:'';
		$pass = isset($_SERVER['PHP_AUTH_PW'])?$_SERVER['PHP_AUTH_PW']:'';
		$ip = isset($_SERVER['REMOTE_ADDR'])?$_SERVER['REMOTE_ADDR']:'';
		$query = $this->db->get_where('user',['username'=>$username,'password'=>md5($pass)]);
		if($query->num_rows() > 0){
			$token = generate_token($username,$ip);
			$res =  ['status'=>1,'pesan'=>$token];
		}
		echo json_encode($res);
	}

	function cek_token($token = null){
		header("Access-Control-Allow-Origin: *");
		if(!is_null($token)){
			$res = ['status'=>0,'pesan'=>'gagal'];
			if($data = tes_token($token)){
				$res = ['status'=>1,'pesan'=>$data->result()];
			}
			echo json_encode($res);
		}
	}

	function provinsi($token = null){
		header("Access-Control-Allow-Origin: *");
		//cek token
		if(!is_null($token)){
			$res = ['status'=>0,'pesan'=>'gagal'];
			if($data = tes_token($token)){
				//select data provinsi
				$hasil = $this->db->get('provinces');
				
				$prov = [];
				foreach($hasil->result() as $row){
					$prov[] = $row;
				}
				$res = ['status'=>1,'pesan'=>$prov];
				
			}
			echo json_encode($res);
		}
	}

}
