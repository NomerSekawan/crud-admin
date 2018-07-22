<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class form extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->model('pengguna');
	}

	function index() 
	{
		if($this->session->userdata('log') == TRUE)
        {
			redirect(base_url('index.php/dashboard/page')); 
        }
        else
        {
        	$this->session->sess_destroy();
			$this->load->view('form');
		}
	}

	function validasi()
	{
		$data = array(
                    array('field' => 'email',
                          'rules' => 'required|valid_email|max_length[60]|is_unique[pengguna.email]',
                          'errors' => 
                          array('required' => 'Email  wajib diisi.',
                          		'valid_email' => 'Masukan email sesuai format.',
                                'max_length' => 'Karakter email maksimal 60.',
                            	'is_unique' => 'Email sudah terdaftar.'),
                    ),
                    array('field' => 'nama_pengguna',
                          'rules' => 'required|xss_clean|min_length[2]|max_length[40]|is_unique[pengguna.nama_pengguna]|callback_username',
                          'errors' => 
                          array('required' => 'Nama penguna  wajib diisi.',
                          		'min_length' => 'Karakter nama penguna minimal 2.',
                                'max_length' => 'Karakter nama penguna maksimal 40.',
                            	'is_unique' => 'Nama pengguna sudah terdaftar.'),
                    ),
                    array('field' => 'sandi',
                          'rules' => 'required|xss_clean|min_length[5]|max_length[20]|matches[confirm_sandi]|callback_sandi',
                          'errors' => 
                          array('required' => 'Sandi wajib diisi.',
                          		'min_length' => 'Karakter sandi minimal 5.',
                                'max_length' => 'Karakter sandi maksimal 20.',
                            	'matches' => 'Sandi tidak cocok.'),
                    ),
                    array('field' => 'confirm_sandi',
                          'rules' => 'required|xss_clean|min_length[5]|max_length[20]|matches[sandi]|callback_sandi',
                          'errors' => 
                          array('required' => 'Ulangi sandi wajib diisi.',
                          		'min_length' => 'Karakter ulangi sandi minimal 5.',
                                'max_length' => 'Karakter ulangi sandi maksimal 20.',
                            	'matches' => 'Ulangi sandi tidak cocok.'),
                    ),
                );
        $this->form_validation->set_rules($data);
	}

	function username()
	{
		$namaPengguna = $this->input->post('nama_pengguna');
		$allow = array('.','-','_');
		
		if(!ctype_alnum(str_replace($allow, '', $namaPengguna)))
		{
			$this->form_validation->set_message('username','Nama pengguna tidak valid.');
			return false;
		}
		else
		{
			return true;
		}
	}

	function sandi()
	{
		$sandi = $this->input->post('sandi');
		if(strpos($sandi, " "))
		{
			$this->form_validation->set_message('sandi','Sandi tidak valid.');
			return false;
		}
		else
		{
			return true;
		}
	}

	function submit()
	{
		$email = $this->input->post('email');
		$namaPengguna = $this->input->post('nama_pengguna');
		$sandi = $this->input->post('sandi');
		$this->validasi();

		if($this->form_validation->run() == false)
		{
			$this->index();
		}
		else
		{
			$data = array('nama_lengkap' => 'nama lengkap',
						  'email' => $email,
						  'nama_pengguna' => strtolower($namaPengguna),
						  'sandi' => sha1($sandi),
						  'photo' => 'default.jpg',
						  'jenis_kelamin' => '',
						  'tgl_lahir' => '');
			$daftar = $this->pengguna->daftar($data);
			if(!$daftar)
			{
				$notif = array('id' => 'gagal',
							   'pesan' => 'Gagal menyimpan data.');
				$this->session->set_flashdata($notif);
				$this->index();
			}
			else
			{
				$notif = array('id' => 'berhasil',
							   'pesan' => 'Selamat, Anda berhasil terdaftar.');
				$this->session->set_flashdata($notif);
				$log = array('log' => TRUE,
							 'id_pengguna' => $daftar->id);
				$this->session->set_userdata($log);
				redirect(base_url("index.php/dashboard/page"));
			}
		}
	}
}
?>