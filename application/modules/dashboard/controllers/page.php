<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class page extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('pengguna');

		if($this->session->userdata('log') != TRUE)
		{
			$notif = array('id' => 'gagal',
						   'pesan' => 'Anda belum login.');
			$this->session->set_flashdata($notif);
			redirect(base_url());
		}
	}

	function index()
	{
		$this->load->view('page');
	}

	function display_session()
	{
		$id = $this->session->userdata('id_pengguna');
		$data = $this->pengguna->pilih($id);
		echo json_encode($data);
	}

	function display_pengguna()
	{
		$data = $this->pengguna->tampil(8);
		echo json_encode($data);
	}

	function display_detail()
	{
        $id = $this->input->get('id');
		$data = $this->pengguna->pilih($id);
		echo json_encode($data);
	}

	function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url());
	}
}
