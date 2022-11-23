<?php
class User extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		cek_login();
		cek_akses([1]);
	}
	function index()
	{
		$query	=	$this->db->get("user");
		$konten['data_user'] = $query;
		$konten['center'] = 'user/vUser';
		$this->load->view('dashboard/vDashboard', $konten);
	}

	function tambah()
	{
		$this->form_validation->set_rules('username', 'username', 'required|valid_email');
		$this->form_validation->set_rules('password', 'password', 'required');
		$this->form_validation->set_rules('confirm', 'confirm', 'required|matches[password]');
		$this->form_validation->set_rules('nama', 'nama', 'required');
		if (!$this->form_validation->run()) {
			$konten['center'] = 'user/vTambah';
			$this->load->view('dashboard/vDashboard', $konten);
			return;
		}
		$data_simpan = [
			"username" => $this->input->post("username"),
			"password" => md5($this->input->post("confirm")),
			"nama" => $this->input->post("nama"),
			"user_level_id" => $this->input->post("level")
		];
		if ($this->db->insert('user', $data_simpan)) {
			$this->session->set_flashdata('pesan_sukses', 'data user telah disimpan');
			redirect('user');
		} else {
			$this->session->set_flashdata('pesan_error', 'data gagal disimpan');
			redirect('user/tambah');
		}
	}


	function hapus($user_id = null)
	{
		if (is_null($user_id)) {
			$this->session->set_flashdata('pesan_error', 'url tidak lengkap');
		}
		$user_id = decode($user_id);
		$query = $this->db->get_where('user', ['user_id' => $user_id]);
		if ($query->num_rows() == 1) {
			if ($this->db->delete('user', ['user_id' => $user_id])) {
				$this->session->set_flashdata('pesan_sukses', 'data sudah dihapus');
			} else {
				$this->session->set_flashdata('pesan_error', 'data gagal dihapus');
			}
		} else {
			$this->session->set_flashdata('pesan_error', 'data tidak ada');
		}
		redirect('user');
	}

	function cari()
	{
		$respon = [];
		$q = $this->input->post('q');
		$query = $this->db->query(
			"SELECT * FROM user WHERE username LIKE '%$q%' OR nama LIKE '%$q%'"
		);
		$baris = "";
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$baris .= "<tr>
				<td>$row->username</td>
 <td>$row->nama</td>
 <td>$row->user_level_id</td>
 <td>$row->user_last_login</td>
 <td>$row->user_last_ip</td>
 <td>$row->token</td>
				</tr>";
			}
		} else {
			$baris = '<tr><td colspan="5"></td></tr>';
		}
		$respon['body'] = $baris;
		$respon['csrfHash'] = $this->security->get_csrf_hash();
		echo json_encode($respon);
	}
}
