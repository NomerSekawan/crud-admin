<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class form extends CI_Controller
{
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
                    array('field' => 'nama_pengguna',
                          'rules' => 'required|min_length[2]|max_length[40]',
                          'errors' => 
                          array('required' => 'Nama penguna  wajib diisi.',
                          		'min_length' => 'Karakter nama penguna minimal 2.',
                                'max_length' => 'Karakter nama penguna maksimal 40.'),
                    ),
                    array('field' => 'sandi',
                          'rules' => 'required|min_length[5]|max_length[20]',
                          'errors' => 
                          array('required' => 'Sandi wajib diisi.',
                          		'min_length' => 'Karakter sandi minimal 5.',
                                'max_length' => 'Karakter sandi maksimal 20.'),
                    ),
                );
        $this->form_validation->set_rules($data);
	}

	function submit()
	{
		$post_namaPengguna = $this->input->post('nama_pengguna');
		$post_sandi = $this->input->post('sandi');
		$this->validasi();

		if($this->form_validation->run() == false)
		{
			$this->index();
		}
		else
		{
			$nama_pengguna = strtolower($post_namaPengguna);
			$cek = $this->pengguna->cek($nama_pengguna);
			if(!$cek)
			{
				$notif = array('id' => 'gagal',
							   'pesan' => 'Nama pengguna dan sandi salah.');
				$this->session->set_flashdata($notif);
				$this->index();
			}
			else
			{
				$sandi = sha1($post_sandi);
				$masuk = $this->pengguna->masuk($nama_pengguna,$sandi);
				if(!$masuk)
				{
					$notif = array('id' => 'gagal',
								   'pesan' => 'Nama pengguna dan sandi salah.');
					$this->session->set_flashdata($notif);
					$this->index();
				}
				else
				{
					$log = array('log' => TRUE,
								 'id_pengguna' => $masuk->id);
					$this->session->set_userdata($log);
					redirect(base_url("index.php/dashboard/page"));
				}
			}
		}
	}
}
