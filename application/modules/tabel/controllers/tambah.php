<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class tambah extends CI_Controller
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
		$this->load->view('tambah');
	}

	function validasi()
	{
		$data = array(
                    array('field' => 'nama_lengkap',
                          'rules' => 'min_length[2]|max_length[40]',
                          'errors' => 
                          array('min_length' => 'Karakter nama lengkap minimal 2.',
                          		'max_length' => 'Karakter nama lengkap maksimal 40.'),
                    ),
                    array('field' => 'email',
                          'rules' => 'required|valid_email|max_length[60]|is_unique[pengguna.email]',
                          'errors' => 
                          array('required' => 'Email  wajib diisi.',
                          		'valid_email' => 'Masukan email sesuai format.',
                                'max_length' => 'Karakter email maksimal 60.',
                            	'is_unique' => 'Email sudah terdaftar.'),
                    ),
                    array('field' => 'tgl_lahir',
                          'rules' => 'callback_min_tgl|callback_max_tgl'
                    ),
                    array('field' => 'nama_pengguna',
                          'rules' => 'required|xss_clean|min_length[5]|max_length[40]|is_unique[pengguna.nama_pengguna]|callback_username',
                          'errors' => 
                          array('required' => 'Nama penguna  wajib diisi.',
                          		'min_length' => 'Karakter nama penguna minimal 5.',
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
                    array('field' => 'photo',
                          'rules' => 'callback_photo'
                    ),
                );
        $this->form_validation->set_rules($data);
	}

	function username($id,$namaPengguna)
	{
		$id = $this->input->post('id');
		$namaPengguna = $this->input->post('nama_pengguna');
		
		$allow = array('.','-','_');
		$cek = $this->pengguna->cek($id);

		if(!ctype_alnum(str_replace($allow, '', $namaPengguna)))
		{
			$this->form_validation->set_message('username','Nama pengguna tidak valid.');
			return false;
		}
		elseif($cek->nama_pengguna != $namaPengguna)
		{
			$cekuname = $this->pengguna->cekuname($namaPengguna);
			if($cekuname == false)
			{
				$this->form_validation->set_message('username','Nama pengguna sudah digunakan.');
				return false;
			}
			else
			{
				return true;
			}
		}
		else
		{
			return true;
		}
	}

	function sandi($sandiLm,$sandiBr)
	{
		if(strpos($sandiLm, " "))
		{
			$this->form_validation->set_message('sandi','Sandi tidak valid.');
			return false;
		}
		elseif(strpos($sandiBr, " "))
		{
			$this->form_validation->set_message('sandi','Sandi tidak valid.');
			return false;
		}
		else
		{
			return true;
		}
	}

	function photo()
    {
    	$allowed = array('image/jpg','image/jpeg','image/png');
    	$extensi = get_mime_by_extension($_FILES['photo']['name']);
    	$size = $_FILES['photo']['size'];

    	if(!$_FILES['photo']['name'])
    	{
    		return true;
    	}
    	elseif(!in_array($extensi, $allowed))
    	{
    		$this->form_validation->set_message('ext','Pilih gambar sesuai format.');
			return false;
    	}
    	elseif($size > 2097152)
    	{
    		$this->form_validation->set_message('size','Ukuran gambar harus kurang dari 2mb.');
    		return false;
    	}
    	else
    	{
    		return true;
    	}
    }

    function min_tgl($lahir)
    {
    	$tgl = date('d');
		$bln = date('m');
		$thn = date('Y');
		$min = ($thn - 65);
		$fix_min = $tgl."-".$bln."-".$min;
		//$view_min = date('d-m-Y',strtotime($fix_min));

    	if(!$lahir)
    	{
    		return true;
    	}
    	elseif(strtotime($lahir) < strtotime($fix_min))
    	{
    		$this->form_validation->set_message('min_tgl','Tanggal lahir harus sesudah '.$fix_min.'.');
    		return false;
    	}
    	else
    	{
    		return true;
    	}
    }

    function max_tgl($lahir)
    {
    	$tgl = date('d');
		$bln = date('m');
		$thn = date('Y');
		$max = ($thn - 10);
		$fix_max = $tgl."-".$bln."-".$max;
		//$view_max = date('d-m-Y',strtotime($fix_max));

    	if(!$lahir)
    	{
    		return true;
    	}
    	elseif(strtotime($lahir) > strtotime($fix_max))
    	{
    		$this->form_validation->set_message('max_tgl','Tanggal lahir harus sebelum '.$fix_max.'.');
    		return false;
    	}
    	else
    	{
    		return true;
    	}
    }

	function submit()
	{
		$nama = $this->input->post('nama_lengkap');
		$email = $this->input->post('email');
		$namaPengguna = $this->input->post('nama_pengguna');
		$jk = $this->input->post('jenis_kelamin');
		$lahir = $this->input->post('tgl_lahir');
		$sandi = $this->input->post('sandi');
		$photo = $this->input->post('photo');
		$this->validasi();

		if($this->form_validation->run() == false)
		{
			$this->index();
		}
		else
		{
			if($nama == "")
			{
				$nama = "nama lengkap";
			}
			if(!$_FILES['photo']['name'])
			{
				$data = array('nama_lengkap' => $nama,
							  'email' => $email,
							  'nama_pengguna' => $namaPengguna,
							  'sandi' => sha1($sandi),
							  'photo' => 'default.jpg',
							  'jenis_kelamin' => $jk,
							  'tgl_lahir' => $lahir);
				$tambah = $this->pengguna->tambah($data);
				if(!$tambah)
				{
					$notif = array('id' => 'gagal',
								   'pesan' => 'Gagal menyimpan data.');
					$this->session->set_flashdata($notif);
					redirect(base_url("index.php/tabel/tampil"));
				}
				else
				{
					$notif = array('id' => 'berhasil',
								   'pesan' => 'Data Berhasil Disimpan.');
					$this->session->set_flashdata($notif);
					redirect(base_url("index.php/tabel/tampil"));
				}
			}
			else
			{
				$config['upload_path'] = './assets/img/';
				$config['allowed_types'] = 'jpg|jpeg|png';
				$config['max_size'] = '2100';
				$config['remove_space'] = TRUE;
				$config['encrypt_name'] = TRUE;
				$this->load->library('upload',$config);
				
				if(!$this->upload->do_upload('photo'))
				{
					$notif = array('id' => 'gagal',
								   'pesan' => 'Gagal Mengunggah Gambar.');
					$this->session->set_flashdata($notif);
					redirect(base_url("index.php/tabel/tampil"));
				}
				else
				{
					$file = $this->upload->data();
					$data = array('nama_lengkap' => $nama,
								  'email' => $email,
								  'nama_pengguna' => $namaPengguna,
								  'sandi' => sha1($sandi),
								  'photo' => $file['file_name'],
								  'jenis_kelamin' => $jk,
								  'tgl_lahir' => $lahir);
					$tambah = $this->pengguna->tambah($data);
					if(!$tambah)
					{
						unlink("./assets/img/".$file['file_name']);
						$notif = array('id' => 'gagal',
									   'pesan' => 'Gagal menyimpan data.');
						$this->session->set_flashdata($notif);
						redirect(base_url("index.php/tabel/tampil"));
					}
					else
					{
						$notif = array('id' => 'berhasil',
									   'pesan' => 'Data Berhasil Disimpan.');
						$this->session->set_flashdata($notif);
						redirect(base_url("index.php/tabel/tampil"));
					}
				}
			}
		}
	}
}
