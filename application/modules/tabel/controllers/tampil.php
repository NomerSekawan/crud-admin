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

	function index()
	{
		$this->load->view('tampil');
	}

	function display_pengguna()
	{
		$data = $this->pengguna->tampil();
		echo json_encode($data);
	}
}
?>
