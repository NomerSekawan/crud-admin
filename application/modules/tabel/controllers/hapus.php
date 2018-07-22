<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class hapus extends CI_Controller
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
		elseif($this->session->userdata('level') != "admin")
		{
			$notif = array('id' => 'gagal',
						   'pesan' => 'Anda tidak memiliki akses.');
			$this->session->set_flashdata($notif);
			header('location:'.$_SERVER['HTTP_REFERER']);
		}
	}

	function id($id,$photo)
	{
		if(!$id)
		{
			$notif = array('id' => 'id',
						   'pesan' => 'Pilih data yg akan dihapus.');
			$this->session->set_flashdata($notif);
			redirect(base_url("index.php/tabel/tampil"));
		}
		else
		{
			$cekId = $this->pengguna->pilih($id);
			if(!$cekId)
			{
				$notif = array('id' => 'id',
							   'pesan' => 'ID tidak terdaftar.');
				$this->session->set_flashdata($notif);
			}
			else
			{
				$hapus = $this->pengguna->hapus($id);
				if($hapus)
				{
					if($photo != "default.jpg")
					{
						unlink("./assets/img/".$photo);
					}
					$notif = array('id' => 'berhasil',
								   'pesan' => 'Berhasil Menghapus Data.');
					$this->session->set_flashdata($notif);
				}
				else
				{
					$notif = array('id' => 'gagal',
								   'pesan' => 'Gagal Menghapus Data.');
					$this->session->set_flashdata($notif);
				}
			}
			redirect(base_url("index.php/tabel/tampil"));
		}
	}
}
?>