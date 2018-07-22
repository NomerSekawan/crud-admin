<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class hapus extends CI_Controller
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

	function id($id,$photo)
	{
		$namaPengguna = $this->input->post('nama_pengguna');
		$sandi = $this->input->post('sandi');
		$conSandi = $this->input->post('confirm_sandi');
		$encSandi = sha1($sandi);

		if($this->session->userdata('level') == "admin")
		{
			$notif = array('id' => 'gagal',
						   'pesan' => 'us.');
			$this->session->set_flashdata($notif);
			redirect(base_url("index.php/profil/tampil/user/".$this->session->userdata('id_pengguna')));
		}
		else
		{
			if(!$id)
			{
				$notif = array('id' => 'gagal',
							   'pesan' => 'id.');
				$this->session->set_flashdata($notif);
				redirect(base_url("index.php/profil/tampil/user/".$this->session->userdata('id_pengguna')));
			}
			else
			{
				if($sandi != $conSandi)
				{
					$notif = array('id' => 'gagal',
								   'pesan' => 'Sandi Tidak Cocok.');
					$this->session->set_flashdata($notif);
					redirect(base_url("index.php/profil/tampil/user/".$this->session->userdata('id_pengguna')));
				}
				else
				{
					$hapus = $this->pengguna->hapus($id,$namaPengguna,$encSandi);
					if(!$hapus)
					{
						$notif = array('id' => 'gagal',
									   'pesan' => 'Gagal Menghapus Akun.');
						$this->session->set_flashdata($notif);
						redirect(base_url("index.php/profil/tampil/user/".$this->session->userdata('id_pengguna')));
					}
					else
					{
						$this->session->sess_destroy();
						redirect(base_url());
						if($photo == "default.jpg")
						{
							$notif = array('id' => 'berhasil',
										   'pesan' => 'Berhasil Menghapus Akun.');
							$this->session->set_flashdata($notif);
						}
						else
						{
							$notif = array('id' => 'berhasil',
										   'pesan' => 'Berhasil Menghapus Akun.');
							$this->session->set_flashdata($notif);
							unlink("./assets/img/".$photo);
						}
					}
				}
			}
		}
	}
}
?>