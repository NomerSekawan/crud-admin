<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class pengguna extends CI_Model
{
	private $tabel = 'pengguna';
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	function cek($nama_pengguna)
	{
		$this->db->where('nama_pengguna',$nama_pengguna);
		$kueri = $this->db->get_where($this->tabel);
		if($kueri->num_rows() == 1)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	function masuk($nama_pengguna,$sandi)
	{
		$this->db->where('nama_pengguna',$nama_pengguna);
		$this->db->where('sandi',$sandi);
		$kueri = $this->db->get_where($this->tabel);
		if($kueri->num_rows() == 1)
		{
			return $kueri->row();
		}
		else
		{
			return false;
		}
	}
}
?>