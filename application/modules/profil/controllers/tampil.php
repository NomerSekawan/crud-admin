<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class tampil extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('pengguna');

		if ($this->session->userdata('log') != TRUE)
		{
			$notif = array('id' => 'gagal',
						   'pesan' => 'Anda belum login.');
			$this->session->set_flashdata($notif);
			redirect(base_url());
		}
	}

	function user($id)
	{
		if(!$id)
		{
			$notif = array('id' => 'id',
						   'pesan' => 'Tidak Dapat Memuat Halaman.');
			$this->session->set_flashdata($notif);
			redirect(base_url("index.php/dashboard/page"));
		}
		else
		{
			$data['us'] = $this->pengguna->pilih($id);
			$this->load->view('tampil',$data);
		}
	}

	function display_session()
	{
		$id = $this->session->userdata('id_pengguna');
		$data = $this->pengguna->pilih_json($id);
		echo json_encode($data);
	}

	function display_pengguna()
	{
		$data = $this->pengguna->tampil();
		echo json_encode($data);
	}
}
?>
