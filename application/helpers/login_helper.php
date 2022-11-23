<?php
function cek_login(){
	$ci = &get_instance();
	if(!$ci->session->userdata('login')){
	  $ci->session->set_flashdata('pesan_error','anda harus login terlebih dahulu');
	  redirect('login');
	}
}

function cek_akses($akses=[]){
	$ci = &get_instance();
	if(!in_array($ci->session->userdata('level'),$akses)){
		$ci->session->set_flashdata('pesan_error','anda tidak memiliki hak ke halaman ini');
	    redirect('dashboard');
	}
}

function encode($teks=""){
	$ci = &get_instance();
	$enc = $ci->encryption->encrypt($teks);
	$clean = strtr($enc,"+/","-_");
	return $clean;
}

function decode($teks=""){
	$ci = &get_instance();
	$orig = strtr($teks,"-_","+/");
	$dect = $ci->encryption->decrypt($orig);
	return $dect;
}

function generate_token($username,$ip){
	$ci = &get_instance();
	$enc = $ci->encryption->encrypt($username);
	$clean = strtr($enc,"+/","-_");
	$data_token = [
		'token'=>$clean,
		'user_last_ip'=>$ip,
		'user_last_login'=>date('Y-m-d H:i:s')
	];
	if($ci->db->update('user',$data_token,['username'=>$username])){
		return $clean;
	}

}

function tes_token($token){
	$ci = &get_instance();
	$orig = strtr($token,"-_","+/");
	$dect = $ci->encryption->decrypt($orig);
	$valid = $ci->db->get_where('user',['token'=>$token,'username'=>$dect]);
	if($valid->num_rows()>0){
		return $valid;
	}else{
		return false;
	}
}

