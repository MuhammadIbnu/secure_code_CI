<?php
function cek_login(){
	$ci = &get_instance();
	if(!$ci->session->userdata('login')){
	  $ci->session->set_flashdata('pesan_error','anda harus login terlebih dahulu');
	  redirect('login');
	}
}
